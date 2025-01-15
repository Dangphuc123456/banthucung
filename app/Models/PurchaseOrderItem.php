<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;
    protected $table = 'purchase_order_items';  // Tên bảng tương ứng trong DB
    protected $primaryKey = 'purchase_order_item_id';  // Khóa chính của bảng
    protected $fillable = [
        'purchase_order_id' ,
        'pet_id' ,
        'quantity' ,
        'price' ,
        'created_at',
        'updated_at',
    ];

    // Mối quan hệ với bảng PurchaseOrder
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
    }

    // Mối quan hệ với bảng Pets
    public function pet()
    {
        return $this->belongsTo(Pets::class, 'pet_id');
    }
}
