<?php

namespace App\Controllers;

use App\Models\Payment\Payments;
use CodeIgniter\API\ResponseTrait;



class Project2 extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        $output = [];
        $body = $this->request->getJSON();

        $payModel = new Payments();

        // step A
        try {
            $orders = $payModel->getPayments($body->imp_uid);    
        } catch (\Exception $e) {
            return $this->respond($e->getMessage(), 500);
        }
        
        foreach ($orders as $order) {
            if ($order->status == 'paid') { // step B
                try {
                    $output[] = $payModel->cancel($this->orderToCancelBody($order));
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
