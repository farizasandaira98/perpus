<?php
namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model 
{
    protected $table = 'buku';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kode_buku' , 
        'sinopsis',
        'nama_buku' , 
        'nama_pengarang', 
        'nama_penerbit', 
        'tahun_terbit', 
        'jumlah_buku', 
        'id_klasifikasi',
        'foto' , 
        'search_count' , 
        'created_at' , 
        'updated_at'
    ];

    public function getKlasifikasi()
    {
        return $this->select('buku.*, klasifikasi_buku.nama_klasifikasi')
                    ->join('klasifikasi_buku', 'klasifikasi_buku.id = buku.id_klasifikasi')
                    ->findAll();
    }

    public function getKlasifikasiSearch()
    {
        return $this->db->table($this->table)
                        ->join('klasifikasi_buku', 'klasifikasi_buku.id = buku.id_klasifikasi');
    }
}
