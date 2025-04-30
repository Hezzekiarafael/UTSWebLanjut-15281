<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    function __construct()
    {
        helper('form');
    }

    // Data pengguna dengan username/email dan password yang di-hash
    private $dataUser = [
        [
            'username' => 'Hezzekia', // Username admin
            'email' => 'admin@pakhezze.com', // Email admin
            'password' => '$2a$12$ZnLK0jJQJOxakdexVNc.POZJClA.g7Cel/KDBukYy7HndTMM21OZq', // hash dari password "1234"
            'role' => 'admin',
            'id' => 1
        ],
        [
            'username' => 'Rafael', // Username user biasa
            'email' => 'user@pakhezze.com', // Email user
            'password' => '$2a$12$ZnLK0jJQJOxakdexVNc.POZJClA.g7Cel/KDBukYy7HndTMM21OZq', // hash dari password "1234"
            'role' => 'user',
            'id' => 2
        ]
    ];

    public function login()
    {
        if ($this->request->getPost()) {
            $usernameOrEmail = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            // Cek apakah username/email ada di dalam array data user
            foreach ($this->dataUser as $user) {
                if ($usernameOrEmail == $user['username'] || $usernameOrEmail == $user['email']) {
                    // Verifikasi password
                    if (password_verify($password, $user['password'])) {
                        session()->set([
                            'id' => $user['id'],
                            'username' => $user['username'],
                            'role' => $user['role'],
                            'logged_in' => TRUE
                        ]);

                   
                      // Tambahkan ke login history di session
                        $history = session()->get('login_history') ?? []; // Ambil data lama, kalau belum ada bikin array baru
                        $history[] = [
                            'username' => $user['username'],
                            'role' => $user['role'],
                            'login_time' => date('Y-m-d H:i:s')
                        ];
                        session()->set('login_history', $history); // Simpan ke session

                        // Redirect ke halaman dashboard
                        if ($user['role'] == 'admin') {
                            return redirect()->to('/dashboard/admin/admin');
                        } else {
                            return redirect()->to('/dashboard/user/user');
                        }
                    


                        // Redirect ke halaman sesuai role
                        if ($user['role'] == 'admin') {
                            return redirect()->to('dashboard/admin/admin'); // Halaman dashboard admin
                        } else {
                            return redirect()->to('dashboard/user/user'); // Halaman dashboard user
                        }
                    } else {
                        session()->setFlashdata('error', 'Password Salah');
                        return redirect()->back();
                    }
                }
            }

            session()->setFlashdata('error', 'Username atau Email Tidak Ditemukan');
            return redirect()->back();
        } else {
            return view('auth/login');
        }
    }

    public function logout()
    {
        $session = session();
    
        // Hapus hanya data login user
        $session->remove(['username', 'role', 'logged_in']);
    
        // Jaga-jaga set logged_in jadi false
        $session->set('logged_in', false);
    
        return redirect()->to('/');
    }
    

}

