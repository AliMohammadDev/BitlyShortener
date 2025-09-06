<?php

namespace BitlyShortener;

use GuzzleHttp\Client;
use Exception;

class Bitly
{

    public static function shortener($longLink = '')
    {
        if (empty($longLink)) {
            throw new \Exception('Please provide long link');
        }
        if (is_null($token = getBitlyToken())) {
            throw new \Exception('Please provide token in bitlyconfig.php config file ');
        }
        $data = [
            'domain' => 'bit.ly',
            'long_url' => $longLink,
        ];

        try {
            $client = new Client([
                'base_uri' => 'https://api-ssl.bitly.com/v4/',
                'headers'  => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type'  => 'application/json',
                ],
            ]);

            $response = $client->post('shorten', [
                'json' => $data,
            ]);

            $body = json_decode($response->getBody(), true);

            return $body['link'] ?? null;
        } catch (Exception $e) {
            throw new Exception("Bitly API Error: " . $e->getMessage());
        }
    }
}
