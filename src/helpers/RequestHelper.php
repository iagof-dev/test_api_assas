<?php
namespace RequestHelper;


class RequestHelper {
    private $ch;

    private $data;

    public function __construct($url, $isPayment = false)
    {
        if($isPayment){

            $secret = new \secret();
            $this->ch = curl_init($url);
            curl_setopt_array($this->ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
                CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'access_token: ' . $secret->getAssasSecretInformation()['api_key'],
                'content-type: application/json' 
                ],
            ]);
        }

    }

    public function sendPost($data){
        curl_setopt($this->ch,CURLOPT_POSTFIELDS, $data);

          $response = curl_exec($this->ch);
          $err = curl_error($this->ch);
          
          if ($err){
            echo "cURL Error #:" . $err;
            die();
          }    


          return json_decode($response, true);
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }
}

