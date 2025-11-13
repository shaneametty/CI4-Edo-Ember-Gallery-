<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\ProductsModel;
use CodeIgniter\HTTP\ResponseInterface;

class CRUDUsers extends BaseController
{
    protected $userModel;
    protected $productModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->productModel = new ProductsModel();
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

    // ============================================
    // PRODUCTS CRUD METHODS
    // ============================================

    // READ - Show all products
    public function showProductsPage()
    {
        try {
            $listOfProducts = $this->productModel
                ->where('is_available', 1)
                ->orderBy('id', 'DESC')
                ->findAll();

            return view('admin/products', ['listOfProducts' => $listOfProducts]);
        } catch (\Exception $e) {
            $listOfProducts = "There is an issue with the database";
            return view('admin/products', ['listOfProducts' => $listOfProducts]);
        }
    }

    // CREATE - Show create form
    public function showCreateProductPage()
    {
        return view('admin/product_create');
    }

    // CREATE - Process product creation
    public function createProduct()
    {
        $request = service('request');
        $post = $request->getPost();
        $session = session();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'     => 'required|min_length[3]|max_length[255]',
            'price'    => 'required|decimal',
            'category' => 'required|in_list[artwork,artbook,merchandise]',
            'stock'    => 'required|integer',
        ]);

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        try {
            $payload = [
                'name'         => $post['name'],
                'description'  => $post['description'] ?? null,
                'price'        => $post['price'],
                'category'     => $post['category'],
                'artist'       => $post['artist'] ?? null,
                'image_url'    => $post['image_url'] ?? null,
                'stock'        => $post['stock'],
                'is_available' => 1,
            ];

            $ok = $this->productModel->insert($payload);

            if ($ok === false) {
                throw new \Exception('Failed to create product');
            }

            $session->setFlashdata('success', 'Product created successfully!');
            return redirect()->to('/admin/products');
        } catch (\Throwable $e) {
            $session->setFlashdata('error', 'Server error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // UPDATE - Show update form
    public function showUpdateProductPage($id)
    {
        try {
            $product = $this->productModel->find($id);

            if (!$product) {
                session()->setFlashdata('error', 'Product not found');
                return redirect()->to('/admin/products');
            }

            return view('admin/product_update', ['product' => $product]);
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Error loading product: ' . $e->getMessage());
            return redirect()->to('/admin/products');
        }
    }

    // UPDATE - Process product update
    public function updateProduct()
    {
        $request = service('request');
        $post = $request->getPost();
        $session = session();

        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');
        $validation->setRule('name', 'Product Name', 'required|min_length[3]');
        $validation->setRule('price', 'Price', 'required|decimal');
        $validation->setRule('category', 'Category', 'required|in_list[artwork,artbook,merchandise]');
        $validation->setRule('stock', 'Stock', 'required|integer');

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        try {
            $product = $this->productModel->find($post['id']);

            if (!$product) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Product not found']);
            }

            $payload = [
                'id'           => $post['id'],
                'name'         => $post['name'],
                'description'  => $post['description'] ?? null,
                'price'        => $post['price'],
                'category'     => $post['category'],
                'artist'       => $post['artist'] ?? null,
                'image_url'    => $post['image_url'] ?? null,
                'stock'        => $post['stock'],
            ];

            $ok = $this->productModel->save($payload);

            if ($ok === false) {
                throw new \Exception('Model update failed');
            }

            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Product updated successfully']);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }

    // DELETE - Soft delete product
    public function deleteProduct()
    {
        $request = service('request');
        $post = $request->getPost();
        $session = session();

        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        try {
            $product = $this->productModel->find($post['id']);

            if (!$product) {
                return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['success' => false, 'message' => 'Product not found']);
            }

            $ok = $this->productModel->delete($post['id']);

            if ($ok === false) {
                throw new \Exception('Model deletion failed');
            }

            return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                ->setJSON(['success' => true, 'message' => 'Product deleted successfully']);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }
}