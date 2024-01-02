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
        $data = [
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email'  => $this->request->getVar('email'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'nomor_telepon' => $this->request->getVar('nomor_telepon'),
            'alamat' => $this->request->getVar('alamat')
        ];

        $this->model->insert($data);

        return redirect()->to('/user');
    }

    public function edit($id)
    {
        $data['user'] = $this->model->where('id', $id)->first();
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
            'alamat' => $this->request->getVar('alamat')
        ];

        $this->model->update($id, $data);

        return redirect()->to('/user');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/user');
    }

    public function auth()
    {
        return view('user/login');
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->model->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                $this->session->set('user_id', $user['id']);
                return redirect()->to('/');
            } else {
                return redirect()->to('/login')->with('error', 'Invalid username or password');
            }
        }

        return view('login');
    }

    public function logout()
    {
        $this->session->remove('id_user');
        return redirect()->to('/login');
    }
}