<?php

namespace App\Models;

use App\Helpers\RequestHelper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @param string $user_id
     * @param string $name
     * @param string $email
     * @param string $avatar
     * @param string $introduction
     * @param string $password
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function store(string $user_id, string $name, string $email,
                                 string $avatar, string $introduction = '', string $password = '') : array
    {
        if (empty($introduction)) {
            $introduction = config('const.DEFAULT_INTRODUCTION');
        }

        if (empty($password)) {
            $password = config('const.DEFAULT_PASSWORD');
        }

        $params = [
            'user_id'      => $user_id,
            'name'         => $name,
            'email'        => $email,
            'avatar'       => $avatar,
            'introduction' => $introduction,
            'password'     => $password,
        ];

        $user = RequestHelper::sendPostRequest(config('const_api.REQUEST_SAVE_USER'), $params);
        return $user;
    }

    /**
     * Github経由ログインユーザを保存
     *
     * @param SocialUser $user
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function saveGithubUser(SocialUser $user) : array
    {
        return static::store($user->nickname, $user->name, $user->email, $user->avatar);
    }

    /**
     * ユーザの存在確認
     *
     * @param string $userId
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function isNull(string $userId) : bool
    {
        $response = RequestHelper::sendGetRequest(config('const_api.REQUEST_GET_USER') . $userId);
        return is_null($response['user']);
    }
}
