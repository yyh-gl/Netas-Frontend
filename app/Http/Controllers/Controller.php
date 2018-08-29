<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $currentUser = [
        'user_id'      => null,
        'name'         => null,
        'email'        => null,
        'avatar'       => null,
        'introduction' => null,
        'password'     => null,
        'client'       => [
            'id'     => null,
            'secret' => null,
        ],
    ];

}
