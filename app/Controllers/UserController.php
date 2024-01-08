<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class UserController extends Controller
{

    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->orderBy('created_at', 'DESC')->findAll();
        return view('user/index', $data);
    }

    public function create()
    {
        return view('user/create');
    }

    public function store()
    {
        $model = new UserModel();
        $data = [
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email'  => $this->request->getVar('email'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'nomor_telepon' => $this->request->getVar('nomor_telepon'),
            'alamat' => $this->request->getVar('alamat'),
            'id_role' => $this->request->getVar('id_role')
        ];

        $save = $model->insert($data);

        return redirect()->to('/user');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);
        return view('user/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama' => $this->request->getVar('nama'),
            'email'  => $this->request->getVar('email'),
            'updated_at' => date('Y-m-d H:i:s'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'nomor_telepon' => $this->request->getVar('nomor_telepon'),
            'alamat' => $this->request->getVar('alamat'),
            'id_role' => $this->request->getVar('id_role')
        ];
        $model = new UserModel();
        $update = $model->update($id, $data);

        return redirect()->to('/user');
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('/user');
    }

    public function auth()
    {
        $session = session();
        if ($session->get('logged_in')) {
            return redirect()->to('/');
        } else {
            return view('auth/login');
        }
    }

    public function login()
    {
        try {
            $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_user' => $data['id_user'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'pekerjaan' => $data['pekerjaan'],
                    'nomor_telepon' => $data['nomor_telepon'],
                    'alamat' => $data['alamat'],
                    'id_role' => $data['id_role'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username does not exist');
            return redirect()->to('/login');
        }
        } catch (Exception $e) {
            echo "An exception occurred: " . $e->getMessage();
        }
        
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}