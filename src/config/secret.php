<?php

class secret{
    private $db_host = 'localhost';
    private $db_port = 3306;
    private $db_name = 'database';
    private $db_user = 'n3rdy';
    private $db_pass = '';


    private $assas_api_url = 'https://api-sandbox.asaas.com/v3';
    private $assas_apiKey = '';
    private $assas_addressWallet = '';
    


    public function getDatabaseInfo(){
        return array(
            'host' => $this->db_host,
            'port' => $this->db_port,
            'database' => $this->db_name,
            'user' => $this->db_user,
            'pass' => $this->db_pass
        );
    }

    public function getAssasSecretInformation(){
        return array(
            'api_url' => $this->assas_api_url,
            'api_key' => $this->assas_apiKey,
            'address_wallet' => $this->assas_addressWallet
        );
    }
    
}