<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'Orders'; // tên bảng
    protected $primaryKey = 'order_id';    // khóa chính
    protected $fillable = [
        'order_id',
        'customer_id',
        'order_date',
        'total_amount',
        'status',
        'created_at',
        'updated_at',
        'phone',
        'address',
        'email',
        'payment',
        'customer_name',
    ];
    // Quan hệ với model OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'order_id', 'order_id');
    }
    
}
