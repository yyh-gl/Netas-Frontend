<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class RequestHelper {

    /**
     * 【GET】Guzzle経由のHTTPリクエスト
     *
     * @param string $path
     * @param array $headers
     * @param array $query
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function sendGetRequest(string $path, array $headers = [], array $query = []) : array
    {
        $client = new \GuzzleHttp\Client();

        $requestUrl = static::createRequestUrl($path);

        $defaultHeaders = static::createDefaultHeaders();

        $response = $client->request('GET', $requestUrl, [
            'headers' => array_merge($defaultHeaders, $headers),
            'query'   => $query,
        ]);
        $responseBody = json_decode($response->getBody(), true);
        return $responseBody;
    }

    /**
     * 【POST】Guzzle経由のHTTPリクエスト
     *
     * @param string $path
     * @param array $headers
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function sendPostRequest(string $path, array $headers = [], array $params = []) : array
    {
        $client = new \GuzzleHttp\Client();

        $requestUrl = static::createRequestUrl($path);

        $defaultHeaders = static::createDefaultHeaders();

        $response = $client->request('POST', $requestUrl, [
            'headers' => array_merge($defaultHeaders, $headers),
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

    /**
     * 共通ヘッダーを生成
     *
     * @return array
     */
    private static function createDefaultHeaders() : array
    {
        return [
            'Accept'        => 'application/json',
            'ClientId'      => env('CLIENT_ID'),
            'ClientSecret'  => env('CLIENT_SECRET'),
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImFlNTEzZWM2MzAwNjFiODY3ODI3YTViMWI4OWIzZTY2YmI0N2RkYmYxYmFhMjgxYTVjZjZlOWY1NDc4ODQzZDllNjg3NTlkYzM0YmFhYjNmIn0.eyJhdWQiOiI0IiwianRpIjoiYWU1MTNlYzYzMDA2MWI4Njc4MjdhNWIxYjg5YjNlNjZiYjQ3ZGRiZjFiYWEyODFhNWNmNmU5ZjU0Nzg4NDNkOWU2ODc1OWRjMzRiYWFiM2YiLCJpYXQiOjE1MzU1MzkzOTUsIm5iZiI6MTUzNTUzOTM5NSwiZXhwIjoxNTM1NjI1Nzk1LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.GQCDBLfrmkAULGM_UZSC3Uhs-OdRix9cgESmP1QstLHlm8Jzju_92OgEXsdMAk_OEtkyautrxz_lmnnp-9BsAGeUpkTh2432oD_WXU2rBghD4X5RgsLlT1NkdJJloUc8CcQ8AnYPl5A7LhWALhH4iy6gf8BNO_XocZZmH58Zor3Ai04mbNBvPmPy7BiWbOO9oo7Gk9G1QwY2OBfxo16qnzEzfvrH7ImE4uqgMx06HUKSuvMO4EUzptWJhhQ6Hj5__V6AZLJE4qom-J5mP7BtKDzH8bhuDPteiMLmcsfQrbgbzx0aIOhHN9opXEAvZuxILM-0VqlDj05kUCIQAiqG16cY2IafTpNX0cOdcMUBub-7MMpeK0DSIVP7QS387GpIdX5BUk1RDcjc89o9oRT7-C1rgm9vVddwtcowbw8Ih9Kevg5trYAF0T-QIX4U-WQOJAhrEdD84AFsJ5FUSm_Ki8EoeXP9PrGN7ex2FvJEIEOgg59JU3oeR2f4wuI90y6t62_jF5rOlpfUd4M-9DoM82JUnHBUqcnYc3aFDJi9M-A2NBtVgzdXcg1I1tshJoX65HLzX1MUKDBrObZrIbPmaHXpJ2hrFWaL1_XEnZwbObtrPmUdk55l12f8nBF8Zo_rDi-qpBJ_lRquroAuN4OzoQHRCuT5op-QfFKJnLRE4cw'
        ];
    }

}
