<?php

require 'vendor/autoload.php'; // Include the AWS SDK for PHP

use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\Exception\AwsException;

// Get configuration
$config = include('newConfig.php');

// Get form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Set up Cognito client
$client = new CognitoIdentityProviderClient([
    'version' => 'latest',
    'region'  => $config['region'],
]);

// Call SignUp API
try {
    $result = $client->signUp([
        'ClientId' => $config['clientId'],
        'Username' => $username,
        'Password' => $password,
        'UserAttributes' => [
            [
                'Name' => 'email',
                'Value' => $email,
            ],
        ],
    ]);

    // Registration successful
    echo 'Registration successful! Please check your email to verify your account.';
} catch (AwsException $e) {
    // Handle errors
    echo 'Registration failed. Please try again later.';
    error_log($e->getMessage());
}

?>
