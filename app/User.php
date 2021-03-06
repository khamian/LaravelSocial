<?php

namespace LaravelSocial;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'sex', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function friendsOfOther() {
        return $this->belongsToMany('LaravelSocial\User', 'friends', 'user_id', 'friend_id')->wherePivot('accepted', 1);
    }

    public function friendsOfMine() {
        return $this->belongsToMany('LaravelSocial\User', 'friends', 'friend_id', 'user_id')->wherePivot('accepted', 1);
    }

    public function friends() {
        return $this->friendsOfOther->merge($this->friendsOfMine);
    }

}
