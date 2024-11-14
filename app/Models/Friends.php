<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    protected $table = "friends";

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
                    ->withPivot('status')
                    ->wherePivot('status', 'accepted');
    }

    public function friendRequests()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
                    ->withPivot('status')
                    ->wherePivot('status', 'pending');
    }

    public function sentFriendRequests()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
                    ->withPivot('status')
                    ->wherePivot('status', 'pending');
    }
        public function sendFriendRequest(User $user)
    {
        $this->sentFriendRequests()->attach($user->id, ['status' => 'pending']);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->updateExistingPivot($user->id, ['status' => 'accepted']);
    }

    public function rejectFriendRequest(User $user)
    {
        $this->friendRequests()->updateExistingPivot($user->id, ['status' => 'rejected']);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');  // A kapcsolat a user_id alapján
    }

    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');  // A kapcsolat a friend_id alapján
    }
}
