<?php

namespace App\Models\Payment;

class Payments
{

    const API_URL = 'https://api.iamport.kr';
    
    public function getPayments(array $impUids): array
    {
        $tokenModel = new PortOneToken();
        $token = $tokenModel->getToken();

        $client = \Config\Services::curlrequest();
        $queryData = [
            'imp_uid' => $impUids
        ];
        
        $response = $client->get(self::API_URL . '/payments', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $token,
            ],
            'query' => $queryData
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception();
        }

        return json_decode($response->getBody())->response;
    }

    public function cancel($cancelBody)
    {
        $client = \Config\Services::curlrequest();
        $tokenModel = new PortOneToken();
        $token = $tokenModel->getToken();

        
        $response = $client->post(self::API_URL . '/payments/cancel', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => $token,
            ],
            'body' => $cancelBody
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception();
        }

        return json_decode($response->getBody())->response;
        
    }
}
