<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class AwesomeApiService
{
    private const BASE_URL = 'https://economia.awesomeapi.com.br';

    /**
     * @param $type
     * @return mixed|Object
     */
    public static function getLastBRL($type)
    {

        $response = Http::withoutVerifying()->get(self::BASE_URL . '/json/last/BRL-' . $type);

        $data = json_decode($response->body());

        return (object) [
            'status'=>$response->status(),
            'data' => isset($data->BRL) ? $data->BRL: $data
        ];

    }
}
