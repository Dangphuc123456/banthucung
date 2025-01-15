<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    use HasFactory;
    protected $table = 'Pets'; // tên bảng
    protected $primaryKey = 'pet_id';    // khóa chính
    protected $fillable = [
        'pet_id',
        'name',
        'species', 
        'breed',
        'age', 
        'price', 
        'description', 
        'image_url', 
        'status', 
        'category_id', 
         'created_at', 
         'updated_at', 
         'gender', 
    ];
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
