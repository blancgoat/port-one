<?php

namespace App\Models\Payment;

class PortOneToken
{
    
    public function getToken()
    {
        $client = \Config\Services::curlrequest();
        
        $response = $client->post('https://api.iamport.kr/users/getToken', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'imp_key' => getenv('api_key'),
                'imp_secret' => getenv('api_secret')
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            throw \Exception();   
        }

        $data = json_decode($response->getBody(), true);

        return $data['response']['access_token'];
    }
}
