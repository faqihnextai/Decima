<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthController extends Controller
{
    private string $userFile = WRITEPATH . 'data/users.json';

    public function login()
    {
        if (session()->get('is_admin')) {
            return redirect()->to('/admin/portfolio');
        }
        return view('login/Login');
    }

    public function auth()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $users = file_exists($this->userFile) ? json_decode(file_get_contents($this->userFile), true) : [];

        foreach ($users as $user) {
            if ($user['username'] === $username && $user['password'] === $password) {
                session()->set(['is_admin' => true, 'admin_user' => $username]);
                return redirect()->to('/admin/portfolio');
            }
        }

        return redirect()->back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}