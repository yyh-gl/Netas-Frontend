<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class RequestHelper {

    /**
     * 【GET】Guzzle経由のHTTPリクエスト
     *
     * @param string $path
     * @param array $query
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function sendGetRequest(string $path, array $query = []) : array
    {
        $client = new \GuzzleHttp\Client();

        $requestUrl = static::createRequestUrl($path);

        $response = $client->request('GET', $requestUrl, [
            'query' => $query,
        ]);
        $responseBody = json_decode($response->getBody(), true);
        return $responseBody;
    }

    /**
     * 【POST】Guzzle経由のHTTPリクエスト
     *
     * @param string $path
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function sendPostRequest(string $path, array $params = []) : array
    {
        $client = new \GuzzleHttp\Client();

        $requestUrl = static::createRequestUrl($path);

        $response = $client->request('POST', $requestUrl, [
            'form_params' => $params,
        ]);
        $responseBody = json_decode($response->getBody(), true);
        return $responseBody;
    }

    /**
     * リクエストURLを生成
     *
     * @param string $path
     * @return \Illuminate\Http\Response
     */
    private static function createRequestUrl(string $path) : string
    {
        return config('const_api.BASE_URL') . $path;
    }
}
