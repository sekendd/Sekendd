<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn') === TRUE) {
            return redirect()->to(base_url('dashboard'));
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'inputEmail'    => 'required|valid_email',
                'inputPassword' => 'required',
            ];
            if (!$this->validate($rules)) {
                return view('pages/commons/login', [
                    'validation' => $this->validation,
                    'old' => $this->request->getPost(),
                ]);
            }
            $inputEmail    = htmlspecialchars($this->request->getVar('inputEmail', FILTER_UNSAFE_RAW));
            $inputPassword = htmlspecialchars($this->request->getVar('inputPassword', FILTER_UNSAFE_RAW));
            $user = $this->ApplicationModel->getUser(username: $inputEmail);
            if ($user && password_verify($inputPassword, $user['password'])) {
                session()->set([
                    'username'    => $user['username'],
                    'role'        => $user['role'],
                    'isLoggedIn'  => TRUE
                ]);
                return redirect()->to(base_url('dashboard'));
            } else {
                session()->setFlashdata('notif_error', '<b>Email or Password is incorrect!</b>');
                return redirect()->to(base_url('login'));
            }
        }
        return view('pages/commons/login');
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function forbiddenPage()
    {
        $data = array_merge($this->data, [
            'title'         => 'Forbidden Page'
        ]);
        return view('pages/commons/forbidden', $data);
    }

    public function register()
    {
        if (session()->get('isLoggedIn') === TRUE) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('pages/commons/register');
    }

    public function registration()
    {
        $validationRules = [
            'inputFullname'  => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[3]'
            ],
            'inputEmail'     => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.username]'
            ],
            'inputPassword'  => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]'
            ],
            'inputPassword2' => [
                'label' => 'Password Confirmation',
                'rules' => 'required|matches[inputPassword]'
            ],
        ];

        if (!$this->validate($validationRules)) {
            $data = array_merge($this->data, [
                'title'         => 'Register Page',
                'validation'    => $this->validation,
                'old'           => $this->request->getPost(),
            ]);
            return view('pages/commons/register', $data);
        } else {
            $inputFullname = htmlspecialchars($this->request->getVar('inputFullname', FILTER_UNSAFE_RAW));
            $inputEmail    = htmlspecialchars($this->request->getVar('inputEmail', FILTER_UNSAFE_RAW));
            $inputPassword = htmlspecialchars($this->request->getVar('inputPassword', FILTER_UNSAFE_RAW));
            $dataUser      = [
                'inputFullname' => $inputFullname,
                'inputUsername' => $inputEmail,
                'inputPassword' => $inputPassword,
                'inputRole'     => 1
            ];
            $this->ApplicationModel->createUser($dataUser);
            session()->setFlashdata('notif_success', '<b>Registration Successfully!</b> Please login with your account.');
            return redirect()->to(base_url('login'));
        }
    }
}
