<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminUsers extends BaseController
{
    protected $userModel;
    protected $productModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    // ============================================
    // READ - Show all users
    // ============================================
    public function showUsersPage()
    {
        try {
            // Fetch users from database
            $listOfUsers = $this->userModel
                ->where('is_active', 1)
                ->orderBy('id', 'ASC')
                ->findAll();

            // Send data to view
            return view('admin/users', ['listOfUsers' => $listOfUsers]);
        } catch (\Exception $e) {
            // Error handling
            $listOfUsers = "There is an issue with the database";
            return view('admin/users', ['listOfUsers' => $listOfUsers]);
        }
    }

    // ============================================
    // CREATE - Show create form
    // ============================================
    public function showCreateUserPage()
    {
        return view('admin/user_create');
    }

    // ============================================
    // CREATE - Process user creation
    // ============================================
    public function createUser()
    {
        $request = service('request');
        $post = $request->getPost();
        $session = session();

        // Validation rules
        $validation = \Config\Services::validation();
        $validation->setRules([
            'first_name' => 'required|min_length[2]|max_length[100]',
            'last_name'  => 'required|min_length[2]|max_length[100]',
            'email'      => 'required|valid_email|is_unique[users.email]',
            'password'   => 'required|min_length[6]',
            'type'       => 'required|in_list[admin,user]',
        ]);

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        try {
            // Prepare data
            $payload = [
                'first_name'  => $post['first_name'],
                'middle_name' => $post['middle_name'] ?? null,
                'last_name'   => $post['last_name'],
                'email'       => $post['email'],
                'password'    => $post['password'],
                'type'        => $post['type'],
                'is_active'   => 1,
            ];

            // Insert to database
            $ok = $this->userModel->insert($payload);

            if ($ok === false) {
                throw new \Exception('Failed to create user');
            }

            $session->setFlashdata('success', 'User created successfully!');
            return redirect()->to('/admin/users');
        } catch (\Throwable $e) {
            $session->setFlashdata('error', 'Server error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // ============================================
    // UPDATE - Show update form
    // ============================================
    public function showUpdateUserPage($id)
    {
        try {
            $user = $this->userModel->find($id);

            if (!$user) {
                session()->setFlashdata('error', 'User not found');
                return redirect()->to('/admin/users');
            }

            return view('admin/user_update', ['user' => $user]);
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Error loading user: ' . $e->getMessage());
            return redirect()->to('/admin/users');
        }
    }

    // ============================================
    // UPDATE - Process user update
    // ============================================
    public function updateUser()
    {
        $request = service('request');
        $post = $request->getPost();
        $session = session();

        // Validation rules
        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');
        $validation->setRule('first_name', 'First Name', 'required|min_length[2]');
        $validation->setRule('last_name', 'Last Name', 'required|min_length[2]');
        $validation->setRule('type', 'User Type', 'required|in_list[admin,user]');

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        try {
            // Check if user exists
            $user = $this->userModel->find($post['id']);

            if (!$user) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'User not found']);
            }

            // Prepare data
            $payload = [
                'id'          => $post['id'],
                'first_name'  => $post['first_name'],
                'middle_name' => $post['middle_name'] ?? null,
                'last_name'   => $post['last_name'],
                'type'        => $post['type'],
            ];

            // Update in database
            $ok = $this->userModel->save($payload);

            if ($ok === false) {
                throw new \Exception('Model update failed');
            }

            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'User updated successfully']);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }

    // ============================================
    // DELETE - Soft delete user
    // ============================================
    public function deleteUser()
    {
        $request = service('request');
        $post = $request->getPost();
        $session = session();

        // Validation
        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        try {
            // Check if user exists
            $user = $this->userModel->find($post['id']);

            if (!$user) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'User not found']);
            }

            // Soft delete (set is_active to 0 and deleted_at timestamp)
            $payload = [
                'id'        => $post['id'],
                'is_active' => 0,
            ];

            // Save will trigger soft delete because of deleted_at field
            $ok = $this->userModel->delete($post['id']);

            if ($ok === false) {
                throw new \Exception('Model deletion failed');
            }

            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'User deleted successfully']);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }
}