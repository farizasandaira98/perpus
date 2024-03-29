<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class UserController extends Controller
{

    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            $session->setFlashdata('errors', ['Perlu Login Untuk Akses Fitur Ini']);
            return redirect()->to('/login');
        }
        $model = new UserModel();
        $data['users'] = $model->orderBy('created_at', 'DESC')->findAll();
        return view('user/index', $data);
    }

    public function create()
    {
        $session = session();
        if ($session->get('id_role') == 2 && $session->has('logged_in')) {
            $session->setFlashdata('errors', ['Hak Akses Akun Tidak Diizinkan, Silahkan Login Sebagai Admin']);
            return redirect()->to('/');
        }
        return view('user/create');
    }

    public function store()
    {
        $idrole = 2;
        $session = session();

        if ($session->get('id_role') == 2 && $session->has('logged_in')) {
            $session->setFlashdata('errors', ['Hak Akses Akun Tidak Diizinkan, Silahkan Login Sebagai Admin']);
            return redirect()->to('/');
        }

        $validationRules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nama wajib diisi.'
                ],
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom username wajib diisi.'
                ],
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.'
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Kolom password wajib diisi.',
                    'min_length' => 'Panjang password minimal 8 karakter.'
                ],
            ],
            'pekerjaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom pekerjaan wajib diisi.'
                ],
            ],
            'nomor_telepon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nomor telepon wajib diisi.'
                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom alamat wajib diisi.'
                ],
            ],
        ];

        // Check if id_role is 1, then add validation for id_role
        if (session()->id_role == 1) {
            $validationRules['id_role'] = [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom role wajib diisi.'
                ],
            ];
        }

        $validation = $this->validate($validationRules);
        
        if($this->request->getVar('id_role')) {
            $idrole = $this->request->getVar('id_role');
        }
        
        if (!$validation) {
            // Flashing the validation errors
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back(); // Redirecting back to the previous page
        }

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
            'id_role' => $idrole
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
        $session = session();
        if ($session->get('id_role') == 2) {
            $session->setFlashdata('errors', ['Hak Akses Akun Tidak Diizinkan, Silahkan Login Sebagai Admin']);
            return redirect()->to('/');
        }
        $data['user'] = $model->find($id);
        return view('user/edit', $data);
    }

    public function update($id)
    {
        $idrole = 2;
        $validationRules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nama wajib diisi.'
                ],
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Kolom email wajib diisi.',
                    'valid_email' => 'Format email tidak valid.'
                ],
            ],
            'pekerjaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom pekerjaan wajib diisi.'
                ],
            ],
            'nomor_telepon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nomor telepon wajib diisi.'
                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom alamat wajib diisi.'
                ],
            ],
        ];

        // Check if id_role is 1, then add validation for id_role
        if (session()->id_role == 1) {
            $validationRules['id_role'] = [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom role wajib diisi.'
                ],
            ];
        }

        $validation = $this->validate($validationRules);
        
        if($this->request->getVar('id_role')) {
            $idrole = $this->request->getVar('id_role');
        }
        
        if (!$validation) {
            // Flashing the validation errors
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back(); // Redirecting back to the previous page
        }

        $model = new UserModel();
        
        $data = [
            'nama' => $this->request->getVar('nama'),
            'email'  => $this->request->getVar('email'),
            'updated_at' => date('Y-m-d H:i:s'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'nomor_telepon' => $this->request->getVar('nomor_telepon'),
            'alamat' => $this->request->getVar('alamat'),
            'id_role' => $idrole
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
        $session = session();
        if ($session->get('id_role') == 2) {
            $session->setFlashdata('errors', ['Hak Akses Akun Tidak Diizinkan, Silahkan Login Sebagai Admin']);
            return redirect()->to('/');
        }

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
        if ($session->get('logged_in') && $session->get('id_role') == 2) {
            $session->setFlashdata('errors', ['Anda Sudah Login, Silahkan Logout Terlebih Dahulu']);
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