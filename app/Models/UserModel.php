<? 
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model 
{
    protected $table = 'user';   
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama','alamat','pekerjaan','nomor_telepon','email'];
}
?>