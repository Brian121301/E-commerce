<?php
// Include Composer autoloader for the fetch library
require 'vendor/autoload.php';

use GuzzleHttp\Client;

// Initialize Express-like app
$app = function ($request, $response) {
    echo "Hello World!";
    $response->withHeader('Content-Type', 'application/json');

    $port = $_ENV['PORT'] ?? 3000;
    $environment = $_ENV['ENVIRONMENT'] ?? 'sandbox';
    $client_id = $_ENV['PAYPAL_CLIENT_ID'];
    $client_secret = $_ENV['PAYPAL_CLIENT_SECRET'];
    $endpoint_url = $environment === 'sandbox' ? 'https://api-m.sandbox.paypal.com' : 'https://api-m.paypal.com';

    // Create an order endpoint
    if ($request->getMethod() === 'POST' && $request->getUri()->getPath() === '/create_order') {
        $body = json_decode($request->getBody(), true);
        $intent = strtoupper($body['intent']);
        $orderData = [
            'intent' => $intent,
            'purchase_units' => [
                'amount' => [
                    'currency_code' => 'USD',
                    'value' => '100.00'
                ]
            ]
        ];
        $data = json_encode($orderData);

        try {
            $accessToken = getAccessToken($client_id, $client_secret, $endpoint_url);
            $client = new Client();
            $response = $client->request('POST', $endpoint_url . '/v2/checkout/orders', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken
                ],
                'body' => $data
            ]);

            $order = json_decode($response->getBody(), true);
            $response->getBody()->write(json_encode($order));
        } catch (Exception $e) {
            $response->withStatus(500);
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
        }

        return $response;
    }

    // Complete order endpoint
    if ($request->getMethod() === 'POST' && $request->getUri()->getPath() === '/complete_order') {
        $body = json_decode($request->getBody(), true);
        $orderId = $body['order_id'];
        $intent = $body['intent'];

        try {
            $accessToken = getAccessToken($client_id, $client_secret, $endpoint_url);
            $client = new Client();
            $response = $client->request('POST', $endpoint_url . '/v2/checkout/orders/' . $orderId . '/' . $intent, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $accessToken
                ]
            ]);

            $completedOrder = json_decode($response->getBody(), true);
            $response->getBody()->write(json_encode($completedOrder));
        } catch (Exception $e) {
            $response->withStatus(500);
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
        }

        return $response;
    }

    if ($request->getMethod() === 'GET' && $request->getUri()->getPath() === '/style.css') {
        $response->getBody()->write(file_get_contents(__DIR__ . '/css/style.css'));
        return $response;
    }

    if ($request->getMethod() === 'GET' && $request->getUri()->getPath() === '/script.js') {
        $response->getBody()->write(file_get_contents(__DIR__ . '/server/script.js'));
        return $response;
    };

    // Default 404 response
    $response->withStatus(404);
    $response->getBody()->write(json_encode(['error' => 'Not Found']));
    return $response;
};

// PayPal Developer YouTube Video:
// How to Retrieve an API Access Token (Node.js)
// https://www.youtube.com/watch?v=HOkkbGSxmp4
function getAccessToken($client_id, $client_secret, $endpoint_url)
{
    $auth = $client_id . ':' . $client_secret;
    $data = 'grant_type=client_credentials';
    $client = new Client();
    $response = $client->request('POST', $endpoint_url . '/v1/oauth2/token', [
        'headers' => [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic ' . base64_encode($auth)
        ],
        'body' => $data
    ]);

    $tokenData = json_decode($response->getBody(), true);
    return $tokenData['access_token'];
}
