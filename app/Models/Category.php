<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'Categories'; // tên bảng
    protected $primaryKey = 'category_id ';    // khóa chính
    // Các cột trong bảng
    protected $fillable = [
        'category_id ',
        'category_name ',
    ];
    // Đếm sản phẩm theo loại
    public function pets()
    {
        return $this->hasMany(Pets::class, 'category_id');  // Chú ý 'category_id' là đúng
    }
}
