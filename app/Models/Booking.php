<?php

namespace App\Models;

use App\Models\BookingRoomList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function assign_rooms(){
        return $this->hasMany(BookingRoomList::class , 'booking_id');
    }
}
