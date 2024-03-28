<?php
require __DIR__ . '/vendor/autoload.php'; // Load Composer's autoloader
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Product Details 
$itemNumber = "DP12345";
$itemName = "Demo Product";
$itemPrice = 100;
$currency = "USD";

/* PayPal REST API configuration from the PayPal developer panel. 
 * See keys here: https://developer.paypal.com/dashboard/ 
 */
define('PAYPAL_SANDBOX', TRUE); //TRUE=Sandbox | FALSE=Production 
define('PAYPAL_SANDBOX_CLIENT_ID',  $_ENV['PAYPAL_CLIENT_ID']);
define('PAYPAL_SANDBOX_CLIENT_SECRET', $_ENV['PAYPAL_CLIENT_SECRET']);
define('PAYPAL_PROD_CLIENT_ID', 'Insert_Live_PayPal_Client_ID_Here');
define('PAYPAL_PROD_CLIENT_SECRET', 'Insert_Live_PayPal_Secret_Key_Here');

// Database configuration  
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'codexworld_db');
