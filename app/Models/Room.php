<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'Room';
    protected $primaryKey = 'RoomID';
    // Define which fields are mass assignable
    protected $fillable = [
            'PricePerNight' ,    
            'Status' , 
            'created_at' ,
            'updated_at',
    ];
    public function bookings()  
    {  
        return $this->hasMany(Booking::class, 'RoomID');  
    }  
}
