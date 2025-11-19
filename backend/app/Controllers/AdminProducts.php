<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductsModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminProducts extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductsModel();
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