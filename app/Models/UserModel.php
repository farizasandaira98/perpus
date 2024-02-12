<?php 
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model 
{
    protected $table = 'user';   
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username','password','nama','alamat','pekerjaan','nomor_telepon','email','id_role','created_at', 'updated_at'];
}