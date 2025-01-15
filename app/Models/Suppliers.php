<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    protected $table = 'suppliers'; // tên bảng
    protected $primaryKey = 'supplier_id';    // khóa chính
    protected $fillable = [
        'supplier_id',
        'name',
        'contact_person',
        'address',
        'phone',
        'email',
        'created_at',
        'updated_at',
    ];
}
