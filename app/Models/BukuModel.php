<?php
namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model 
{
    protected $table = 'buku';
    protected $primaryKey = 'kode_buku';
    protected $allowedFields = ['kode_buku','nama_buku', 'nama_pengarang', 'nama_penerbit', 'tahun_terbit','foto', 'created_at','updated_at'];
}
