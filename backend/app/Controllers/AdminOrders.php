<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrdersModel;
use App\Models\OrderItemsModel;
use App\Models\UsersModel;
use App\Models\ProductsModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * OrdersController
 * 
 * Handles all order-related operations for admin panel.
 * This controller manages the complete order lifecycle including
 * creating, viewing, updating, and deleting orders.
 */
class AdminOrders extends BaseController
{
    protected $orderModel;
    protected $orderItemModel;
    protected $userModel;
    protected $productModel;

    /**
     * Constructor
     * 
     * Initializes all required models.
     * This ensures models are available in all methods.
     */
    public function __construct()
    {
        $this->orderModel = new OrdersModel();
        $this->orderItemModel = new OrderItemsModel();
        $this->userModel = new UsersModel();
        $this->productModel = new ProductsModel();
    }

    // ============================================
    // READ - Show all orders
    // ============================================
    
    /**
     * Index - Display all orders
     * 
     * Shows a list of all orders in the system.
     * Orders are displayed in reverse chronological order (newest first).
     * 
     * @return string View with orders list
     */
    public function index()
    {
        try {
            // Fetch all orders (not deleted)
            $listOfOrders = $this->orderModel
                ->orderBy('id', 'DESC')
                ->findAll();

            return view('admin/orders', ['listOfOrders' => $listOfOrders]);
        } catch (\Exception $e) {
            // If database error, pass error message instead of data
            $listOfOrders = "There is an issue with the database: " . $e->getMessage();
            return view('admin/orders', ['listOfOrders' => $listOfOrders]);
        }
    }

    // ============================================
    // CREATE - Show create form
    // ============================================
    
    /**
     * Create - Show order creation form
     * 
     * Displays the form for creating a new order.
     * Loads users and products for dropdowns.
     * 
     * @return string View with create form
     */
    public function create()
    {
        try {
            // Get all active users for the user dropdown
            $users = $this->userModel
                ->where('is_active', 1)
                ->findAll();
            
            // Get all available products for the product dropdowns
            $products = $this->productModel
                ->where('is_available', 1)
                ->findAll();

            return view('admin/orders_create', [
                'users' => $users,
                'products' => $products
            ]);
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Error loading form: ' . $e->getMessage());
            return redirect()->to('/admin/orders');
        }
    }

    // ============================================
    // CREATE - Process order creation
    // ============================================
    
    /**
     * Store - Process new order creation
     * 
     * Validates input and creates a new order with items.
     * Uses database transactions to ensure data integrity.
     * 
     * Process:
     * 1. Validate form input
     * 2. Start transaction
     * 3. Create order record
     * 4. Create order item records
     * 5. Commit transaction
     * 
     * @return RedirectResponse Redirects to orders list or back to form
     */
    public function store()
    {
        $request = service('request');
        $post = $request->getPost();
        $session = session();

        // Validation rules
        $validation = \Config\Services::validation();
        $validation->setRules([
            'user_id'        => 'required|integer',
            'customer_name'  => 'required|min_length[3]',
            'customer_email' => 'required|valid_email',
            'total_amount'   => 'required|decimal',
            'status'         => 'required|in_list[pending,processing,shipped,delivered]',
            'payment_status' => 'required|in_list[unpaid,paid]',
        ]);

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        try {
            // Start transaction for data integrity
            $this->orderModel->transStart();

            // Prepare order data
            $orderData = [
                'user_id'          => $post['user_id'],
                'customer_name'    => $post['customer_name'],
                'customer_email'   => $post['customer_email'],
                'customer_phone'   => $post['customer_phone'] ?? null,
                'shipping_address' => $post['shipping_address'] ?? null,
                'total_amount'     => $post['total_amount'],
                'status'           => $post['status'],
                'payment_status'   => $post['payment_status'],
                'notes'            => $post['notes'] ?? null,
            ];

            // Insert order (order_number auto-generated by model)
            $orderId = $this->orderModel->insert($orderData);

            if (!$orderId) {
                throw new \Exception('Failed to create order');
            }

            // Insert order items
            if (isset($post['items']) && is_array($post['items'])) {
                foreach ($post['items'] as $item) {
                    if (!empty($item['product_id']) && !empty($item['quantity'])) {
                        $itemData = [
                            'order_id'         => $orderId,
                            'product_id'       => $item['product_id'],
                            'product_name'     => $item['product_name'],
                            'product_category' => $item['product_category'],
                            'quantity'         => $item['quantity'],
                            'price'            => $item['price'],
                            'subtotal'         => $item['quantity'] * $item['price'],
                        ];

                        $this->orderItemModel->insert($itemData);
                    }
                }
            }

            // Complete transaction
            $this->orderModel->transComplete();

            if ($this->orderModel->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            $session->setFlashdata('success', 'Order created successfully!');
            return redirect()->to('/admin/orders');
        } catch (\Throwable $e) {
            $session->setFlashdata('error', 'Server error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // ============================================
    // READ - Show single order details
    // ============================================
    
    /**
     * Show - Display single order with all details
     * 
     * Shows complete order information including all items.
     * This view allows admins to see and update order status.
     * 
     * @param int $id Order ID
     * @return string View with order details
     */
    public function show($id)
    {
        try {
            // Get order with all items
            $order = $this->orderModel->getOrderWithItems($id);

            if (!$order) {
                session()->setFlashdata('error', 'Order not found');
                return redirect()->to('/admin/orders');
            }

            return view('admin/orders_show', ['order' => $order]);
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Error loading order: ' . $e->getMessage());
            return redirect()->to('/admin/orders');
        }
    }

    // ============================================
    // UPDATE - Update order status
    // ============================================
    
    /**
     * Update Status - Update order fulfillment status
     * 
     * AJAX endpoint to update order status.
     * Allows status changes: pending → processing → shipped → delivered
     * 
     * @return ResponseInterface JSON response
     */
    public function updateStatus()
    {
        $request = service('request');
        $post = $request->getPost();

        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');
        $validation->setRule('status', 'Status', 'required|in_list[pending,processing,shipped,delivered,cancelled]');

        if (!$validation->run($post)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                ->setJSON(['success' => false, 'message' => 'Invalid input']);
        }

        try {
            $order = $this->orderModel->find($post['id']);

            if (!$order) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Order not found']);
            }

            $payload = [
                'id'     => $post['id'],
                'status' => $post['status'],
            ];

            $ok = $this->orderModel->save($payload);

            if ($ok === false) {
                throw new \Exception('Model update failed');
            }

            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Order status updated successfully']);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }

    // ============================================
    // UPDATE - Update payment status
    // ============================================
    
    /**
     * Update Payment - Update payment status
     * 
     * AJAX endpoint to update payment status.
     * Toggles between unpaid and paid.
     * 
     * @return ResponseInterface JSON response
     */
    public function updatePayment()
    {
        $request = service('request');
        $post = $request->getPost();

        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');
        $validation->setRule('payment_status', 'Payment Status', 'required|in_list[unpaid,paid]');

        if (!$validation->run($post)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                ->setJSON(['success' => false, 'message' => 'Invalid input']);
        }

        try {
            $order = $this->orderModel->find($post['id']);

            if (!$order) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Order not found']);
            }

            $payload = [
                'id'             => $post['id'],
                'payment_status' => $post['payment_status'],
            ];

            $ok = $this->orderModel->save($payload);

            if ($ok === false) {
                throw new \Exception('Model update failed');
            }

            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Payment status updated successfully']);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }

    // ============================================
    // DELETE - Soft delete order
    // ============================================
    
    /**
     * Delete - Soft delete an order
     * 
     * AJAX endpoint to delete an order.
     * Uses soft delete (sets deleted_at timestamp).
     * 
     * @return ResponseInterface JSON response
     */
    public function delete()
    {
        $request = service('request');
        $post = $request->getPost();

        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');

        if (!$validation->run($post)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                ->setJSON(['success' => false, 'message' => 'Invalid input']);
        }

        try {
            $order = $this->orderModel->find($post['id']);

            if (!$order) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Order not found']);
            }

            // Soft delete (sets deleted_at)
            $ok = $this->orderModel->delete($post['id']);

            if ($ok === false) {
                throw new \Exception('Model deletion failed');
            }

            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Order deleted successfully']);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }
}