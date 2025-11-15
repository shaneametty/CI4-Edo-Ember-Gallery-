<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrdersModel;
use CodeIgniter\HTTP\ResponseInterface;

class CRUDOrders extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrdersModel();
    }

    // READ - Show all orders
    public function showOrdersPage()
    {
        try {
            $listOfOrders = $this->orderModel
                ->where('is_active', 1)
                ->orderBy('id', 'DESC')
                ->findAll();

            return view('admin/orders', ['listOfOrders' => $listOfOrders]);
        } catch (\Exception $e) {
            $listOfOrders = "There is an issue with the database";
            return view('admin/orders', ['listOfOrders' => $listOfOrders]);
        }
    }

    // CREATE - Show create form
    public function showCreateOrderPage()
    {
        return view('admin/orders_create');
    }

    // CREATE - Process order creation
    public function createOrder()
    {
        $request = service('request');
        $post = $request->getPost();
        $session = session();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'user_id'        => 'required|integer',
            'product_id'     => 'required|integer',
            'quantity'       => 'required|integer|greater_than[0]',
            'total_price'    => 'required|decimal',
            'order_status'   => 'required|in_list[pending,completed,canceled]',
            'payment_status' => 'required|in_list[paid,unpaid]',
        ]);

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        try {
            $payload = [
                'user_id'        => $post['user_id'],
                'product_id'     => $post['product_id'],
                'quantity'       => $post['quantity'],
                'total_price'    => $post['total_price'],
                'order_status'   => ucfirst($post['order_status']),
                'payment_status' => ucfirst($post['payment_status']),
                'is_active'      => 1,
            ];

            $ok = $this->orderModel->insert($payload);

            if ($ok === false) throw new \Exception('Failed to create order');

            $session->setFlashdata('success', 'Order created successfully!');
            return redirect()->to('/admin/orders');
        } catch (\Throwable $e) {
            $session->setFlashdata('error', 'Server error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // UPDATE - Show update form
    public function showUpdateOrderPage($id)
    {
        try {
            $order = $this->orderModel->find($id);

            if (!$order) {
                session()->setFlashdata('error', 'Order not found');
                return redirect()->to('/admin/orders');
            }

            return view('admin/orders_update', ['order' => $order]);
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Error loading order: ' . $e->getMessage());
            return redirect()->to('/admin/orders');
        }
    }

    // UPDATE - Process order update
    public function updateOrder()
    {
        $request = service('request');
        $post = $request->getPost();

        try {
            $order = $this->orderModel->find($post['id']);
            if (!$order) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Order not found']);
            }

            $payload = [
                'id'             => $post['id'],
                'user_id'        => $post['user_id'],
                'product_id'     => $post['product_id'],
                'quantity'       => $post['quantity'],
                'total_price'    => $post['total_price'],
                'order_status'   => ucfirst($post['order_status']),
                'payment_status' => ucfirst($post['payment_status']),
            ];

            $ok = $this->orderModel->save($payload);

            if ($ok === false) throw new \Exception('Update failed');

            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Order updated successfully']);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // DELETE - Soft delete order

    public function deleteOrder()
    {
        $request = service('request');
        $post = $request->getPost();

        try {
            $order = $this->orderModel->find($post['id']);
            if (!$order) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Order not found']);
            }

            $ok = $this->orderModel->delete($post['id']);
            if ($ok === false) throw new \Exception('Delete failed');

            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Order deleted successfully']);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
