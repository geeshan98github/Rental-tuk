<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class APIHelper {
    public static function api_get($url, $params = [])
    {
        try {
            $response = Http::withOptions([
                'verify' => false, // Disable SSL verification
            ])->withHeaders([
                'Authorization' => 'Bearer '.config('constants.STOREMAN.TOKEN'),
                'Accept' => 'application/json',
            ])->get(config('constants.STOREMAN.URL').$url, $params);

            return $response->json();
        } catch (\Exception $e) {
            throw new \Exception("API Error: $url");
            exit;
        }
    }

    public static function api_post($url, $body = [])
    {
        try {
            $response = Http::withOptions([
                'verify' => false, // Disable SSL verification
            ])->withHeaders([
                'Authorization' => config('constants.STOREMAN.TOKEN'),
                'Accept' => 'application/json',
            ])->post(config('constants.STOREMAN.URL').$url, $body);

            return $response->json();
        } catch (\Exception $e) {
            throw new \Exception("API Error: $url");
            exit;
        }
    }
}
