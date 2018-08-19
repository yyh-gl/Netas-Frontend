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
        $responseBody = (string) $response->getBody();
        return $responseBody;
    }

    /**
     * 【POST】Guzzle経由のHTTPリクエスト
     *
     * @param string $path
     * @param array $params
     * @return \Illuminate\Http\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function sendPostRequest(string $path, array $params) : string
    {
        $client = new \GuzzleHttp\Client(
            [\GuzzleHttp\RequestOptions::VERIFY => false]
        );

        $requestUrl = config('const_api.BASE_URL') . $path;
        $response = $client->request('POST', $requestUrl,
            [
                'form_params' => $params
            ]);
        $responseBody = (string) $response->getBody();
        return $responseBody;
    }
}
