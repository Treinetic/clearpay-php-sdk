<?php

namespace Clearpay;
class Clearpay
{

    private $url = null;
    private $token = null;

    public function __construct($url, $apiKey, $secret)
    {
        $this->url = $url;
        $this->token = base64_encode($apiKey . ':' . $secret);

    }

    public function createOrder(Order $order)
    {
        $reqObj = new \stdClass();
        $reqObj->type = "ONE_TIME";
        $reqObj->order = $order;
        return $this->sendRequest('/cpv1/order/create', 'POST', $reqObj);

    }

    public function getOrder($id)
    {
        return $this->sendRequest('/cpv1/order/'.$id, 'GET', []);
    }

    private function sendRequest($url, $method, $reqObj)
    {
        $header = array();
        $header[] = 'Content-type: application/json';
        $header[] = 'Authorization: Basic ' . $this->token;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url . $url,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($reqObj),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
