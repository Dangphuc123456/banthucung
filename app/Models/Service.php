<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services'; // tên bảng
    protected $primaryKey = 'ServiceID';    // khóa chính
    protected $fillable = [
        'ServiceName',
        'Description' ,
        'Price' ,
        'ServiceDuration',
        'CreatedAt' ,
        'AvailableSlots',
        ' updated_at',
    ];
}
