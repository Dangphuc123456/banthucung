<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'id';
    // Define which fields are mass assignable
    protected $fillable = [
            'email' ,    
            'content' , 
            'created_at' ,
            'updated_at',
    ];
}
