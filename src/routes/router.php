<?php
header('Content-Type: application/json; charset=utf-8');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../config/secret.php');

use Pecee\SimpleRouter\SimpleRouter as Router;

// https://github.com/skipperbent/simple-php-router?tab=readme-ov-file#basic-routing

Router::get('/', function () {
    return json_encode(['status' => 'success', 'message' => 'Hello World!']);
});


//TEMP
Router::get('/payment/pix/create', function () {
    require(__DIR__ . '/../helpers/RequestHelper.php');

    $httpRequest = new RequestHelper\RequestHelper('https://api.asaas.com/v3/pix/qrCodes/static', true);

    $secret = new \secret();

    $data = json_encode([
        "addressKey" => $secret->getAssasSecretInformation()['address_wallet'],
        "description" => "Testing",
        "value" => 15.01,
        "allowsMultiplePayments" => "false"
    ]);

    $response = $httpRequest->sendPost(data: $data);

    return json_encode(['status'=>'success','data' => $response]);
});

Router::start();
