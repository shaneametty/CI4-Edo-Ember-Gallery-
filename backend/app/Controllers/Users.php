<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductsModel;

class Users extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductsModel();
    }

    public function index(): string
    {
        return view('users/landingPage');
    }

    public function login(): string
    {
        return view('users/login');
    }

    public function signup(): string
    {
        return view('users/signup');
    }

    public function roadMap(): string
    {
        return view('users/roadMap');
    }

    public function moodBoard(): string
    {
        return view('users/moodBoard');
    }

    /**
     * Public Product Gallery
     * No login required - anyone can browse
     * No ordering capability - just display products
     */
    public function userProducts(): string
    {
        // Get all available products with stock
        $products = $this->productModel
            ->where('is_available', 1)
            ->orderBy('category', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();

        $data = [
            'title' => 'Product Gallery',
            'products' => $products,
        ];

        return view('users/userProducts', $data);
    }
}