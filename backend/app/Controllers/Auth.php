<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    // ============================================
    // Show Login Page
    // ============================================
    public function showLoginPage()
    {
        // If already logged in, redirect based on user type
        if (session()->get('isLoggedIn')) {
            if (session()->get('userType') === 'admin') {
                return redirect()->to('/test/users');
            } else {
                return redirect()->to('/'); // Redirect regular users to home
            }
        }

        return view('login');
    }

    // ============================================
    // Process Login
    // ============================================
    public function login()
    {
        $request = service('request');
        $post = $request->getPost();
        $session = session();

        // Validation rules
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ]);

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        try {
            // Find user by email
            $user = $this->userModel->where('email', $post['email'])->first();

            // Check if user exists
            if (!$user) {
                $session->setFlashdata('error', 'Invalid email or password');
                return redirect()->back()->withInput();
            }

            // Check if user is active
            if ($user->is_active != 1) {
                $session->setFlashdata('error', 'Your account has been deactivated. Please contact support.');
                return redirect()->back()->withInput();
            }

            // Verify password
            if (!password_verify($post['password'], $user->password)) {
                $session->setFlashdata('error', 'Invalid email or password');
                return redirect()->back()->withInput();
            }

            // Set session data
            $sessionData = [
                'userId'      => $user->id,
                'userEmail'   => $user->email,
                'userName'    => $user->first_name . ' ' . $user->last_name,
                'userType'    => $user->type,
                'isLoggedIn'  => true,
            ];

            $session->set($sessionData);

            // Redirect based on user type
            if ($user->type === 'admin') {
                return redirect()->to('/test/users');
            } else {
                return redirect()->to('/'); // Regular users go to home
            }

        } catch (\Throwable $e) {
            $session->setFlashdata('error', 'Server error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // ============================================
    // Logout
    // ============================================
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out successfully');
    }
}