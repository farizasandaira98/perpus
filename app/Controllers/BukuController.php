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
} 
