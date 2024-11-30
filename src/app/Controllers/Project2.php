<?php

namespace App\Controllers;

use App\Models\Payment\Payment;
use CodeIgniter\API\ResponseTrait;



class Project2 extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        $output = [];
        $body = $this->request->getJSON();

        $paymentModel = new Payment();

        // step A
        try {
            $orders = $paymentModel->getPayments($body->imp_uid);    
        } catch (\Exception $e) {
            return $this->respond($e->getMessage(), 500);
        }
        
        foreach ($orders as $order) {
            if ($order->status == 'paid') { // step B
                try {
                    $output[] = $paymentModel->cancel($this->orderToCancelBody($order));
                } catch (\Exception $e) {
                    $output[] = ['order' => $order, 'error' => $e];
                }
            } else { // step C
                $output[] = $order;
            }
        }
        
        return $this->respond($output, 200);
    }

    private function orderToCancelBody(\stdClass $order)
    {
        return json_encode([
            'imp_uid' => $order->imp_uid,
            'amount' => $order->amount,
        ]);
    }

}
