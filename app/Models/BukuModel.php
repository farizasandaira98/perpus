<?php
namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model 
{
    protected $table = 'buku';
    protected $primaryKey = 'kode_buku';
    protected $allowedFields = ['nama_buku', 'nama_pengarang', 'nama_penerbit', 'tahun_terbit', 'created_at','updated_at'];
}
