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
        $session = session();

        // If already logged in, redirect based on user type
        if ($session->get('isLoggedIn')) {
            $userType = $session->get('userType') ?? ($session->get('user')['type'] ?? null);

            if (strtolower($userType) === 'admin') {
                return redirect()->to('/admin/users');
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

            if (!$user) {
                $session->setFlashdata('error', 'Invalid email or password');
                return redirect()->back()->withInput();
            }

            if ($user->is_active != 1) {
                $session->setFlashdata('error', 'Your account has been deactivated. Please contact support.');
                return redirect()->back()->withInput();
            }

            if (!password_verify($post['password'], $user->password)) {
                $session->setFlashdata('error', 'Invalid email or password');
                return redirect()->back()->withInput();
            }

            // Set session data with userType
            $sessionData = [
                'user'       => [
                    'id'    => $user->id,
                    'email' => $user->email,
                    'name'  => $user->first_name . ' ' . $user->last_name,
                    'type'  => $user->type,
                    'photo' => $user->photo ?? null,
                ],
                'userType'   => strtolower($user->type), // added userType for easy check
                'isLoggedIn' => true
            ];

            $session->set($sessionData);

            // Redirect based on user type
            if (strtolower($user->type) === 'admin') {
                return redirect()->to('/admin/users');
            } else {
                return redirect()->to('/'); // regular users
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

    // ============================================
    // Show Signup Page
    // ============================================
    public function showSignupPage()
    {
        $session = session();

        // If already logged in, redirect based on user type
        if ($session->get('isLoggedIn')) {
            $userType = $session->get('userType') ?? ($session->get('user')['type'] ?? null);

            if (strtolower($userType) === 'admin') {
                return redirect()->to('/admin/users');
            } else {
                return redirect()->to('/'); // redirect regular users to home
            }
        }

        return view('signup');
    }

    // ============================================
    // Process Signup
    // ============================================
    public function signup()
    {
        $request = service('request');
        $post = $request->getPost();
        $session = session();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'first_name' => 'required|min_length[2]|max_length[100]',
            'last_name'  => 'required|min_length[2]|max_length[100]',
            'email'      => 'required|valid_email|is_unique[users.email]',
            'password'   => 'required|min_length[6]',
        ]);

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        try {
            $userData = [
                'first_name'  => $post['first_name'],
                'middle_name' => $post['middle_name'] ?? null,
                'last_name'   => $post['last_name'],
                'email'       => $post['email'],
                'password'    => $post['password'], // will be hashed by model
                'type'        => 'user', // default regular user
                'is_active'   => 1,
            ];

            $userId = $this->userModel->insert($userData);
            if (!$userId) throw new \Exception('Failed to create account');

            $user = $this->userModel->find($userId);

            // Set session data for new user
            $sessionData = [
                'user'       => [
                    'id'    => $user->id,
                    'email' => $user->email,
                    'name'  => $user->first_name . ' ' . $user->last_name,
                    'type'  => $user->type,
                    'photo' => $user->photo ?? null,
                ],
                'userType'   => strtolower($user->type),
                'isLoggedIn' => true
            ];

            $session->set($sessionData);

            $session->setFlashdata('success', 'Account created successfully! Welcome to Edo Ember Gallery.');
            return redirect()->to('/'); // redirect new user to home
        } catch (\Throwable $e) {
            $session->setFlashdata('error', 'Server error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
