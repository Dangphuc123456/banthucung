<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'Order_Items'; // tên bảng
    protected $primaryKey = 'order_item_id';    // khóa chính
    protected $fillable = [
        'order_item_id',
        'order_id',
        'pet_id',
        'quantity',
        'price',
        'description',
        'created_at',
        'updated_at',
        'image_url',
    ];
    public function pets()
    {
        return $this->belongsTo(Pets::class, 'pet_id');
    }
    // Quan hệ với model Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
}
