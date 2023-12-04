<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BukuModel;

class BukuController extends Controller
{
    public function index()
    {
        $model = new BukuModel();
        $data['buku'] = $model->findAll();

        return view('buku/index', $data);
    }

    public function create()
    {
        return view('buku/create');
    }

    public function post()
    {
        $validation = $this->validate([
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,1024]',
                'errors' => [
                    'uploaded' => 'The foto is required.',
                    'max_size' => 'The foto size cannot exceed 1MB.',
                ],
            ],
        ]);

        if (!$validation) {
            return view('buku/create', [
                'errors' => $this->validator->getErrors(),
            ]);
        }

        // Upload the foto to hosting
        $foto = $this->request->getFile('foto');
        $fotoName = $foto->getRandomName();
        $foto->move('uploads/fotos/', $fotoName);

        // Create the book
        $model = new BukuModel();
        $currentDateTime = date('Y-m-d H:i:s');
        $data = [
            'kode_buku' => $this->request->getVar('kode_buku'),
            'nama_buku'  => $this->request->getVar('nama_buku'),
            'nama_pengarang'  => $this->request->getVar('nama_pengarang'),
            'nama_penerbit'  => $this->request->getVar('nama_penerbit'),
            'tahun_terbit'  => $this->request->getVar('tahun_terbit'),
            'created_at' => $currentDateTime,
            'updated_at' => $currentDateTime,
            'foto'  => $fotoName
        ];
        $save = $model->insert($data);
        return redirect()->to('buku');
    }

    public function edit($id)
    {
        $data = model('BukuModel')->find($id);
        return view('buku/edit', [
            'data' => $data,
        ]);
    }

    public function update($id)
    {
        $validation = $this->validate([
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,1024]',
                'errors' => [
                    'uploaded' => 'The foto is required.',
                    'max_size' => 'The foto size cannot exceed 1MB.',
                ],
            ],
        ]);
        if (!$validation) {
            return view('buku/edit', [
                'errors' => $this->validator->getErrors(),
            ]);
        }
        // Upload the foto to hosting
        $foto = $this->request->getFile('foto');

        if ($foto) {
            $fotoName = $foto->getRandomName();
            $foto->move('uploads/fotos/', $fotoName);

            // Delete the old foto
            $oldFoto = model('BukuModel')->find($id);
            $dataOldFoto = esc($oldFoto['foto']);
            if ($dataOldFoto) {
                unlink('uploads/fotos/' . $dataOldFoto);
            }
        } else {
            $fotoName = '';
        }

        // Update the book
        $model = new BukuModel();
        $currentDateTime = date('Y-m-d H:i:s');
        $data = [
            'kode_buku' => $this->request->getVar('kode_buku'),
            'nama_buku'  => $this->request->getVar('nama_buku'),
            'nama_pengarang'  => $this->request->getVar('nama_pengarang'),
            'nama_penerbit'  => $this->request->getVar('nama_penerbit'),
            'tahun_terbit'  => $this->request->getVar('tahun_terbit'),
            'created_at' => $this->request->getVar('created_at'),
            'updated_at' => $currentDateTime,
            'foto'  => $fotoName
        ];
        $update = $model->update($id,$data);
        return redirect()->to('/buku');
    }

    public function delete($id)
    {
        $model = new BukuModel();
        $oldFoto = model('BukuModel')->find($id);
        $dataOldFoto = esc($oldFoto['foto']);
        if ($dataOldFoto) {
            unlink('uploads/fotos/' . $dataOldFoto);
        }
        // Delete the book
        $data['buku'] = $model->where('id', $id)->delete();
        return redirect()->to('/buku');
    }
}
