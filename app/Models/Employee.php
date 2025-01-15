<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Authenticatable
{
    use HasFactory;
    protected $table = 'employees'; // Tên bảng trong cơ sở dữ liệu
    protected $primaryKey = 'employee_id'; // Khóa chính của bảng

    protected $fillable = [
        'username',
        'password_hash',
        'name',
        'email',
        'phone',
        'role',
    ];

    protected $hidden = [
        'password_hash',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}


