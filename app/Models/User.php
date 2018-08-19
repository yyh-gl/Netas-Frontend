<?php

namespace App\Models;

use App\Helpers\RequestHelper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Socialite\Two\User as SocialUser;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'email', 'avatar', 'introduction'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // TODO: 返り値の型をきちんと決める
    /**
     * The attributes that should be hidden for arrays.
     *
     * @param string $user_id
     * @param string $name
     * @param string $email
     * @param string $avatar
     * @param string $introduction
     * @param string $password
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function store(string $user_id, string $name, string $email,
                                 string $avatar, string $introduction = '', string $password = '') : string
    {
        if (empty($introduction)) {
            $introduction = config('const.DEFAULT_INTRODUCTION');
        }

        if (empty($password)) {
            $password = config('const.DEFAULT_PASSWORD');
        }

        $params = [
            'user_id' => $user_id,
            'name' => $name,
            'email' => $email,
            'avatar' => $avatar,
            'introduction' => $introduction,
            'password' => $password,
        ];

        $user = RequestHelper::sendPostRequest(config('const_api.REQUEST_SAVE_USER'), $params);
        return $user;
    }

    /**
     * Github経由ログインユーザを保存
     *
     * @param SocialUser $user
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function saveGithubUser(SocialUser $user) : string
    {
        return static::store($user->nickname, $user->name, $user->email, $user->avatar);
    }
}
