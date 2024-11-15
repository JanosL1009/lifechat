<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        'username',
        'email',
        'password',
        'birthdate',
        'sex',
        'lastlogin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    //nem biztos hogy jo
    public function permission()
    {
        return $this->belongsTo(PermissionToUser::class, 'id','user_id');
    }

    public function permissions()
    {
        return $this->hasMany(PermissionToUser::class);
    }

    public function roomoperator()
    {
        return $this->belongsTo(RoomOperators::class, 'id','user_id');
    }

    public function latestlog()
    {
        return $this->belongsTo(UserLog::class,'id','user_id');
    }
    
}
