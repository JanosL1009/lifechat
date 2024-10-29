<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatsInTheRoom extends Model
{
    //

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    
}
