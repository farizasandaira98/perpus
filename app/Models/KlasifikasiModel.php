<?php

namespace App\Models;

use CodeIgniter\Model;

class KlasifikasiModel extends Model
{
    protected $table = 'klasifikasi_buku';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_klasifikasi' 
    ];
}
