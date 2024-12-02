<?php

error_reporting(0);
ini_set('display_errors', 0);

require_once(__DIR__ . "/../../connection.php");
require_once(__DIR__ . "/../lib/SslCommerzNotification.php");

use SslCommerz\SslCommerzNotification;

$tran_id = $_POST['tran_id'];
$amount =  $_POST['amount'];
$currency =  $_POST['currency'];

$sslc = new SslCommerzNotification();
$validated = $sslc->orderValidate($_POST, $tran_id, $amount, $currency);

if ($validated) {
    $sql = "UPDATE `books` SET `accept` = '0' WHERE `pnr` = '$tran_id'";
    $result = mysqli_query($conn, $sql);
}

header("Location: ../../bookedBusUser.php?pnr=$tran_id&status=2&msg=" . urlencode('Ticket Payment Failed'));
