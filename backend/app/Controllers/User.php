<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    protected $userModel;
    protected $userId;
    protected $userEmail;
    protected $userName;

    public function __construct()
    {
        $this->userModel = new UsersModel();
        
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
    // USER ORDERS - List (placeholder for future)
    // ============================================
    public function orders()
    {
        $data = [
            'title' => 'My Orders',
            'orders' => [],
        ];

        return view('user/orders', $data);
    }

    // ============================================
    // USER ORDERS - View Single Order (placeholder)
    // ============================================
    public function viewOrder($orderId)
    {
        $data = [
            'title' => 'Order Details',
            'orderId' => $orderId,
        ];

        return view('user/order_detail', $data);
    }
}