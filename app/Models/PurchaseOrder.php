<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $table = 'purchase_orders';  // Tên bảng tương ứng trong DB
    protected $primaryKey = 'purchase_order_id';  // Khóa chính của bảng
    protected $fillable = [
        'purchase_order_id',
        'supplier_id',
        'order_date',
        'total_amount',
        'updated_at',
        'created_at',

    ];
    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id', 'purchase_order_id');
    }

    // Mối quan hệ với bảng Supplier
    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
}
