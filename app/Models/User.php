<?php

namespace App\Models;

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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @param string $user_id
     * @param string $name
     * @param string $email
     * @param string $avatar
     */
    public static function store(string $user_id, string $name, string $email, string $avatar, string $password = '')
    {
        $user = new User();
        $user->user_id = $user_id;
        $user->name = $name;
        $user->email = $email;
        $user->avatar = $avatar;
        $user->password = $password;
        $user->save();
    }
}
