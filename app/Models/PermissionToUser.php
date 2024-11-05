<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionToUser extends Model
{
    protected $fillable = [
        'user_id',          
        'permission_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
