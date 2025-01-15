<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments'; // tên bảng
    protected $primaryKey = 'id';  
    protected $fillable = [
        'order_id',
        'payment_method',
        'card_holder',
        'card_number',
        'expiry_date',
        'cvv',
        'status',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}

