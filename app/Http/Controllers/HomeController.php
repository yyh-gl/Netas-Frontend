<?php

namespace App\Http\Controllers;

use App\Helpers\RequestHelper;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function home() {
        $users = RequestHelper::sendGetRequest(config('const_api.REQUEST_GET_ALL_USERS'));
        return view('pages.home', ['users' => $users]);
    }
}
