<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BukuModel;

class BukuController extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            $session->setFlashdata('errors', ['Perlu Login Untuk Akses Fitur Ini']);
            return redirect()->to('/login');
        }
        $model = new BukuModel();
        $data['buku'] = $model->findAll();

        return view('buku/index', $data);
    }

    public function create()
    {
        $session = session();
        if ($session->get('id_role') == 2) {
            $session->setFlashdata('errors', ['Hak Akses Akun Tidak Diizinkan, Silahkan Login Sebagai Admin']);
            return redirect()->to('/');
        }
        return view('buku/create');
    }

    public function post()
    {
        $validation = $this->validate([
            'kode_buku' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom kode buku wajib diisi.'
                ],
            ],
            'nama_buku' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nama buku wajib diisi.'
                ],
            ],
            'nama_pengarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nama pengarang wajib diisi.'
                ],
            ],
            'nama_penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nama penerbit wajib diisi.'
                ],
            ],
            'tahun_terbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom tahun terbit wajib diisi.'
                ],
            ],
            'jumlah_buku' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom jumlah buku wajib diisi.'
                ],
            ],
            'klasifikasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom klasifikasi wajib diisi.'
                ],
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,1024]',
                'errors' => [
                    'uploaded' => 'Kolom foto wajib diisi.',
                    'max_size' => 'Ukuran foto tidak boleh melebihi 1MB.',
                ],
            ],
        ]);
        
        if (!$validation) {
            // Flashing the validation errors
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back(); // Redirecting back to the previous page
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
            'jumlah_buku'  => $this->request->getVar('jumlah_buku'),
            'klasifikasi'  => $this->request->getVar('klasifikasi'),
            'created_at' => $currentDateTime,
            'updated_at' => $currentDateTime,
            'foto'  => $fotoName,
            'search_foto' => 0,
        ];
        $save = $model->insert($data);
        return redirect()->to('buku');
    }

    public function edit($id)
    {
        $session = session();
        if ($session->get('id_role') == 2) {
            $session->setFlashdata('errors', ['Hak Akses Akun Tidak Diizinkan, Silahkan Login Sebagai Admin']);
            return redirect()->to('/');
        }
        $data = model('BukuModel')->find($id);
        return view('buku/edit', [
            'data' => $data,
        ]);
    }

    public function update($id)
    {
        $validation = $this->validate([
            'kode_buku' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom kode buku wajib diisi.'
                ],
            ],
            'nama_buku' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nama buku wajib diisi.'
                ],
            ],
            'nama_pengarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nama pengarang wajib diisi.'
                ],
            ],
            'nama_penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom nama penerbit wajib diisi.'
                ],
            ],
            'tahun_terbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom tahun terbit wajib diisi.'
                ],
            ],
            'jumlah_buku' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom jumlah buku wajib diisi.'
                ],
            ],
            'klasifikasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom klasifikasi wajib diisi.'
                ],
            ],
        ]);
        
        if (!$validation) {
            // Flashing the validation errors
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back(); // Redirecting back to the previous page
        }
        
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
            $fotoName = $this->request->getVar('foto');
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
            'jumlah_buku'  => $this->request->getVar('jumlah_buku'),
            'klasifikasi'  => $this->request->getVar('klasifikasi'),
            'updated_at' => $currentDateTime,
            'foto'  => $fotoName
        ];
        $update = $model->update($id,$data);
        return redirect()->to('/buku');
    }

    public function delete($id)
    {
        $session = session();
        if ($session->get('id_role') == 2) {
            $session->setFlashdata('errors', ['Hak Akses Akun Tidak Diizinkan, Silahkan Login Sebagai Admin']);
            return redirect()->to('/');
        }
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

    public function search() {
        $model = new BukuModel();
        $startTime = microtime(true);

        $keyword = $this->request->getPost('keyword');
        $advancedSearch = $this->request->getPost('advanced_search');

        $builder = $model->builder();

        if ($advancedSearch) {
            // Advanced search
            $kode_buku = $this->request->getPost('kode_buku');
            $nama_buku = $this->request->getPost('nama_buku');
            $nama_pengarang = $this->request->getPost('nama_pengarang');
            $nama_penerbit = $this->request->getPost('nama_penerbit');
            $tahun_terbit = $this->request->getPost('tahun_terbit');
            $klasifikasi = $this->request->getPost('klasifikasi');

            $builder->groupStart();
            if (!empty($kode_buku)) $builder->like('kode_buku', $kode_buku);
            if (!empty($nama_buku)) $builder->like('nama_buku', $nama_buku);
            if (!empty($nama_pengarang)) $builder->like('nama_pengarang', $nama_pengarang);
            if (!empty($nama_penerbit)) $builder->like('nama_penerbit', $nama_penerbit);
            if (!empty($tahun_terbit)) $builder->like('tahun_terbit', $tahun_terbit);
            if (!empty($klasifikasi)) $builder->like('klasifikasi', $klasifikasi);
            $builder->groupEnd();
        } else {
            // Simple search (keyword searches all columns)
            $builder->groupStart()
                ->like('kode_buku', $keyword)
                ->orLike('nama_buku', $keyword)
                ->orLike('nama_pengarang', $keyword)
                ->orLike('nama_penerbit', $keyword)
                ->orLike('tahun_terbit', $keyword)
                ->orLike('jumlah_buku', $keyword)
                ->orLike('klasifikasi', $keyword)
                ->groupEnd();
        }

        $bukubyid = $builder->get()->getResultArray();

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        $data['buku'] = $bukubyid;
        $data['execution_time'] = number_format($executionTime, 4);

        foreach ($bukubyid as $book) {
            $model->update($book['id'], ['search_count' => $book['search_count'] + 1]);
        }

        return view('buku/index', $data);
    }
    
}
