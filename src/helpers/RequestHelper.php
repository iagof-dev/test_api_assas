<?php
namespace RequestHelper;



class RequestHelper {
    private $ch;

    public function __construct($url, $isPayment = false)
    {
        $this->ch = curl_init($url);
        curl_setopt_array($this->ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
            ]);
        if($isPayment){
            $secret = new \secret();
            $header = [
                'accept: application/json',
                'access_token: ' . $secret->getAssasSecretInformation()['api_key'],
                'content-type: application/json' 
            ];
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $header);
        }
    }

    public function sendPost($data){
        curl_setopt($this->ch,CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($this->ch);
        $err = curl_error($this->ch);
          
        if ($err){
            echo json_encode(['status'=> 'error', 'message' => $err, 'response' => $response]);
            die();
        }    


        return json_encode(['status'=>'success','data' => json_decode($response)]);
    }

    public function __destruct()
    {
        curl_close($this->ch);
    }
}

