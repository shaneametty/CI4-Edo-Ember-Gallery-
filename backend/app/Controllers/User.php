<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\ProductsModel;
use App\Models\OrdersModel;
use App\Models\OrderItemsModel;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    protected $userModel;
    protected $productModel;
    protected $orderModel;
    protected $orderItemModel;
    protected $userId;
    protected $userEmail;
    protected $userName;

    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->productModel = new ProductsModel();
        $this->orderModel = new OrdersModel();
        $this->orderItemModel = new OrderItemsModel();
        
        // Get current logged-in user data from session
        $this->userId = session()->get('userId');
        $this->userEmail = session()->get('userEmail');
        $this->userName = session()->get('userName');
    }

    // ============================================
    // USER PROFILE - View
    // ============================================
    public function profile()
    {
        // Get user data
        $user = $this->userModel->find($this->userId);

        $data = [
            'title' => 'My Profile',
            'user' => $user,
        ];

        return view('user/profile', $data);
    }

    // ============================================
    // USER PROFILE - Update
    // ============================================
    public function updateProfile()
    {
        $request = service('request');
        $post = $request->getPost();
        $session = session();

        // Get current user
        $currentUser = $this->userModel->find($this->userId);
        
        // Validation rules (controller level - lighter validation)
        $validation = \Config\Services::validation();
        $rules = [
            'first_name' => 'required|min_length[2]|max_length[100]',
            'last_name'  => 'required|min_length[2]|max_length[100]',
            'email'      => 'required|valid_email',
        ];

        // Add password validation only if password fields are filled
        if (!empty($post['new_password'])) {
            $rules['current_password'] = 'required';
            $rules['new_password'] = 'required|min_length[6]';
            $rules['confirm_password'] = 'required|matches[new_password]';
        }

        $validation->setRules($rules);

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        try {
            // Prepare update data
            $updateData = [
                'id'          => $this->userId, // Include ID for model validation
                'first_name'  => $post['first_name'],
                'middle_name' => $post['middle_name'] ?? null,
                'last_name'   => $post['last_name'],
                'email'       => $post['email'],
            ];

            // Handle password change
            if (!empty($post['new_password'])) {
                // Verify current password
                if (!password_verify($post['current_password'], $currentUser->password)) {
                    $session->setFlashdata('error', 'Current password is incorrect');
                    return redirect()->back()->withInput();
                }

                // Add new password to update data
                $updateData['password'] = $post['new_password']; // Will be hashed by model
            }

            // Update user (model will validate with proper ID context)
            $result = $this->userModel->update($this->userId, $updateData);
            
            if (!$result) {
                // Get model errors if update failed
                $errors = $this->userModel->errors();
                $session->setFlashdata('errors', $errors);
                return redirect()->back()->withInput();
            }

            // Update session data
            $session->set([
                'userEmail' => $updateData['email'],
                'userName'  => $updateData['first_name'] . ' ' . $updateData['last_name'],
            ]);

            $session->setFlashdata('success', 'Profile updated successfully!');
            return redirect()->to('/user/profile');

        } catch (\Throwable $e) {
            $session->setFlashdata('error', 'Server error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // ============================================
    // USER PROFILE - Deactivate Account
    // ============================================
    public function deactivateAccount()
    {
        $session = session();

        try {
            // Get current user
            $user = $this->userModel->find($this->userId);

            if (!$user) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'User not found']);
            }

            // Deactivate account (set is_active to 0)
            $updateData = [
                'id' => $this->userId,
                'is_active' => 0,
            ];

            $ok = $this->userModel->save($updateData);

            if ($ok === false) {
                throw new \Exception('Failed to deactivate account');
            }

            // Return success response
            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Account deactivated successfully']);

        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }

    // ============================================
    // USER PRODUCTS - Browse Available Products
    // ============================================
    public function products()
    {
        // Get all available products with stock
        $products = $this->productModel
            ->where('is_available', 1)
            ->orderBy('category', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();

        $data = [
            'title' => 'Browse Products',
            'products' => $products,
        ];

        return view('user/products', $data);
    }

    // ============================================
    // USER ORDER - Show Confirmation Page
    // ============================================
    public function orderConfirm($productId)
    {
        // Get product
        $product = $this->productModel->find($productId);

        // Verify product exists and is available
        if (!$product) {
            session()->setFlashdata('error', 'Product not found');
            return redirect()->to('/user/products');
        }

        if ($product->is_available != 1 || $product->stock <= 0) {
            session()->setFlashdata('error', 'Product is not available for order');
            return redirect()->to('/user/products');
        }

        // Get current user
        $user = $this->userModel->find($this->userId);

        $data = [
            'title' => 'Order Confirmation',
            'product' => $product,
            'user' => $user,
        ];

        return view('user/order_confirm', $data);
    }

    // ============================================
    // USER ORDER - Submit Order
    // ============================================
    public function orderSubmit()
    {
        $request = service('request');
        $post = $request->getPost();
        $session = session();

        // Validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'product_id'       => 'required|integer',
            'quantity'         => 'required|integer|greater_than[0]',
            'customer_name'    => 'required|min_length[3]',
            'customer_email'   => 'required|valid_email',
            'shipping_address' => 'required|min_length[10]',
        ]);

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        try {
            // Get product
            $product = $this->productModel->find($post['product_id']);

            if (!$product) {
                throw new \Exception('Product not found');
            }

            // Check stock availability
            if ($product->stock < $post['quantity']) {
                throw new \Exception('Not enough stock available');
            }

            // Calculate total
            $quantity = (int)$post['quantity'];
            $price = (float)$product->price;
            $subtotal = $quantity * $price;

            // Start transaction
            $this->orderModel->transStart();

            // Create order
            $orderData = [
                'user_id'          => $this->userId,
                'customer_name'    => $post['customer_name'],
                'customer_email'   => $post['customer_email'],
                'customer_phone'   => $post['customer_phone'] ?? null,
                'shipping_address' => $post['shipping_address'],
                'total_amount'     => $subtotal,
                'status'           => 'pending',
                'payment_status'   => 'unpaid',
                'notes'            => $post['notes'] ?? null,
            ];

            $orderId = $this->orderModel->insert($orderData);

            if (!$orderId) {
                throw new \Exception('Failed to create order');
            }

            // Create order item
            $orderItemData = [
                'order_id'         => $orderId,
                'product_id'       => $product->id,
                'product_name'     => $product->name,
                'product_category' => $product->category,
                'quantity'         => $quantity,
                'price'            => $price,
                'subtotal'         => $subtotal,
            ];

            $itemInserted = $this->orderItemModel->insert($orderItemData);

            if (!$itemInserted) {
                throw new \Exception('Failed to create order item');
            }

            // Update product stock
            $newStock = $product->stock - $quantity;
            $this->productModel->update($product->id, ['stock' => $newStock]);

            // Complete transaction
            $this->orderModel->transComplete();

            if ($this->orderModel->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            $session->setFlashdata('success', 'Order placed successfully! Our team will contact you soon.');
            return redirect()->to('/user/orders');

        } catch (\Throwable $e) {
            $session->setFlashdata('error', 'Failed to place order: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // ============================================
    // USER ORDERS - List
    // ============================================
    public function orders()
    {
        // Get orders for current user
        $orders = $this->orderModel
            ->where('user_id', $this->userId)
            ->orderBy('id', 'DESC')
            ->findAll();
        
        // Count items for each order
        foreach ($orders as $order) {
            $order->items_count = $this->orderItemModel
                ->where('order_id', $order->id)
                ->countAllResults();
        }

        $data = [
            'title' => 'My Orders',
            'orders' => $orders,
        ];

        return view('user/orders', $data);
    }

    // ============================================
    // USER ORDERS - View Single Order
    // ============================================
    public function viewOrder($orderId)
    {
        // Get order with items
        $order = $this->orderModel->getOrderWithItems($orderId);
        
        // Verify order exists
        if (!$order) {
            session()->setFlashdata('error', 'Order not found');
            return redirect()->to('/user/orders');
        }
        
        // Verify order belongs to current user (security check)
        if ($order->user_id != $this->userId) {
            session()->setFlashdata('error', 'You do not have permission to view this order');
            return redirect()->to('/user/orders');
        }

        $data = [
            'title' => 'Order Details',
            'order' => $order,
        ];

        return view('user/order_detail', $data);
    }
}