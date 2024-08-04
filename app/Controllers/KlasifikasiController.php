<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KlasifikasiModel;

class KlasifikasiController extends BaseController
{
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            $session->setFlashdata('errors', ['Perlu Login Untuk Akses Fitur Ini']);
            return redirect()->to('/login');
        }
        $model = new KlasifikasiModel();
        $data['klasifikasi'] = $model->findAll();
        return view('klasifikasi/index', $data);
    }

    public function create()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            $session->setFlashdata('errors', ['Perlu Login Untuk Akses Fitur Ini']);
            return redirect()->to('/login');
        }
        return view('klasifikasi/create');
    }

    public function post()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            $session->setFlashdata('errors', ['Perlu Login Untuk Akses Fitur Ini']);
            return redirect()->to('/login');
        }
        $validation = $this->validate([
            'nama_klasifikasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Klasifikasi wajib diisi.'
                ],
            ],
        ]);

        if(!$validation){
            return redirect()->to('/klasifikasi/create')->withInput()->with('validation', $this->validator);
        }

        $data = [
            'nama_klasifikasi' => $this->request->getVar('nama_klasifikasi'),
        ];

        $model = new KlasifikasiModel();
        $model->insert($data);

        return redirect()->to('/klasifikasi');
    }

    public function edit($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            $session->setFlashdata('errors', ['Perlu Login Untuk Akses Fitur Ini']);
            return redirect()->to('/login');
        }
        $model = new KlasifikasiModel();
        $data['klasifikasi'] = $model->find($id);
        return view('klasifikasi/edit', $data);
    }

    public function update($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            $session->setFlashdata('errors', ['Perlu Login Untuk Akses Fitur Ini']);
            return redirect()->to('/login');
        }
        $validation = $this->validate([
            'nama_klasifikasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Klasifikasi wajib diisi.'
                ],
            ],
        ]);

        if(!$validation){
            return redirect()->to('/klasifikasi/edit/' . $id)->withInput()->with('validation', $this->validator);
        }

        $data = [
            'nama_klasifikasi' => $this->request->getVar('nama_klasifikasi'),
        ];
        $model = new KlasifikasiModel();
        $model->update($id, $data);

        return redirect()->to('/klasifikasi');
    }

    public function delete($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            $session->setFlashdata('errors', ['Perlu Login Untuk Akses Fitur Ini']);
            return redirect()->to('/login');
        }
        $model = new KlasifikasiModel();
        $model->delete($id);

        return redirect()->to('/klasifikasi');
    }

}

