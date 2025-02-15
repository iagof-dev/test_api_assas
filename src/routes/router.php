<?php

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../config/secret.php');

use Pecee\SimpleRouter\SimpleRouter as Router;

// https://github.com/skipperbent/simple-php-router?tab=readme-ov-file#basic-routing
Router::get('/favicon.ico', function() {
    return ''; // Ou um arquivo válido de ícone
});


Router::get('/', function () {
    return json_encode(['status' => 'success', 'message' => 'Hello World!', 'time' => date('Y/m/d h:i:s a', time())]);
});

Router::error(function() {
    return json_encode(['status' => 'error', 'message' => 'endpoint not found.']);
});


//TEMP
Router::get('/payment/pix/create', function () {
    require(__DIR__ . '/../helpers/RequestHelper.php');
    $secret = new \secret();


    $httpRequest = new RequestHelper\RequestHelper($secret->getAssasSecretInformation()['api_url'] . '/pix/qrCodes/static', true);


    $data = json_encode(value: [
        "addressKey" => $secret->getAssasSecretInformation()['address_wallet'],
        "description" => "Testing",
        "value" => 15.01,
        "allowsMultiplePayments" => "false"
    ]);

    $response = $httpRequest->sendPost(data: $data);

    return $response;
});

Router::start();
