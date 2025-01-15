<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Foundation\Auth\User as Authenticatable;  

class Customer extends Authenticatable  
{  
    use HasFactory;  

    protected $table = 'customers';  
    protected $primaryKey = 'customer_id';  

    protected $fillable = [  
        'username',  
        'password',  
        'name',  
        'email',  
        'phone',  
        'address',  
    ];  

    protected $hidden = [  
        'password',  
    ];  

    public function getAuthPassword()  
    {  
        return $this->password;  
    }  
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}