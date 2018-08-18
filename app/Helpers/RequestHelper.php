<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class RequestHelper {

    /**
     * 【GET】Guzzle経由のHTTPリクエスト
     *
     * @param string $path
     * @return \Illuminate\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function sendGetRequest(string $path) : string
    {
        $client = new \GuzzleHttp\Client();

        $requestUrl = config('const_api.BASE_URL') . $path;

        $response = $client->request('GET', $requestUrl);
        $response_body = (string) $response->getBody();
        return $response_body;
    }
}
