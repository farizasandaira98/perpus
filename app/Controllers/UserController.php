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
        try {
            $save = $model->insert($data);
        } catch (\Throwable $th) {
            session()->setFlashdata('errors', [$th->getMessage()]);
            return redirect()->to('/user/create');
        }
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
        try {
            $update = $model->update($id, $data);
        } catch (\Throwable $th) {
            session()->setFlashdata('errors', [$th->getMessage()]);
            return redirect()->to('/user/edit/' . $id);
        }
        return redirect()->to('/user');
    }

    public function delete($id)
    {
        $model = new UserModel();
        try {
            $model->delete($id);
        } catch (\Throwable $th) {
            session()->setFlashdata('errors', [$th->getMessage()]);
            return redirect()->to('/user');
        }
        return redirect()->to('/user');
    }

    public function search(){
        $model = new UserModel();
        $keyword = $this->request->getVar('search');
        try {
            $data['users'] = $model->like('username', $keyword)->findAll();
        } catch (\Throwable $th) {
            session()->setFlashdata('errors', [$th->getMessage()]);
            return redirect()->to('/user');
        }
        return view('user/index', $data);
    }

    public function auth()
    {
        $session = session();
        if ($session->get('logged_in')) {
            $session->setFlashdata('error', 'Anda Sudah Login, Silahkan Logout Terlebih Dahulu');
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
                $session->setFlashdata('errors', ['Password Salah, Silahkan Ulang Lagi']);
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('errors', ['Username Tidak Ditemukan, Silahkan Ulang Lagi']);
            return redirect()->to('/login');
        }
        } catch (Exception $e) {
            $session->setFlashdata('errors', ['Terjadi Kesalahan: '+$e->getMessage()]);
            return redirect()->to('/login');
        }
        
    }

    public function logout()
    {
        $session = session();
        try {
            $session->destroy();
        } catch (\Throwable $th) {
            session()->setFlashdata('errors', [$th->getMessage()]);
            return redirect()->to('/login');
        }
        return redirect()->to('/login');
    }
}