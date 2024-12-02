<?php

if (!defined('PROJECT_PATH')) {
    define('PROJECT_PATH', 'https://localhost/Completed/Student-Project/ticket-booking'); // replace this value with your project path
}

if (!defined('IS_SANDBOX')) {
    define('IS_SANDBOX', true); // 'true' for sandbox, 'false' for live
}

if (!defined('STORE_ID')) {
    define('STORE_ID', 'sasbo674da98693d70'); // your store id. For sandbox, register at https://developer.sslcommerz.com/registration/
}

if (!defined('STORE_PASSWORD')) {
    define('STORE_PASSWORD', 'sasbo674da98693d70@ssl'); // your store password.
}

return [
    'success_url' => 'SSLCommerz/pg_redirection/success.php', // your success url
    'failed_url' => 'SSLCommerz/pg_redirection/fail.php', // your fail url
    'cancel_url' => 'SSLCommerz/pg_redirection/cancel.php', //your cancel url
    'ipn_url' => 'SSLCommerz/pg_redirection/ipn.php', // your ipn url


    'projectPath' => PROJECT_PATH,
    'apiDomain' => IS_SANDBOX ? 'https://sandbox.sslcommerz.com' : 'https://securepay.sslcommerz.com',
    'apiCredentials' => [
        'store_id' => STORE_ID,
        'store_password' => STORE_PASSWORD,
    ],
    'apiUrl' => [
        'make_payment' => "/gwprocess/v4/api.php",
        'order_validate' => "/validator/api/validationserverAPI.php",
    ],
    'connect_from_localhost' => true,
    'verify_hash' => true,
];
