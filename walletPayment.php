<?php

require_once(__DIR__ . "/connection.php");

if ($_POST['tran_id']) {
    $tran_id = $_POST['tran_id'];
    $customer_username = $_POST['customer_username'];
    $amount = $_POST['amount'];

    $sql = "SELECT * FROM `balance` WHERE `username` = '$customer_username'";
    $row = $conn->query($sql)->fetch_assoc();
    $balance = $row['balance'];

    if ($balance >= $amount) {
        $sql = "UPDATE `balance` SET `balance` = `balance` - '$amount' WHERE `username` = '$customer_username'";
        $result =  mysqli_query($conn, $sql);

        $sql = "UPDATE `books` SET `accept` = '1' WHERE `pnr` = '$tran_id'";
        $result = mysqli_query($conn, $sql);

        $location = "Location: bookedBusUser.php?msg=Payment+Successful&pnr=$tran_id&status=1";
        exit(header($location));
    }

    $location = "Location: bookedBusUser.php?msg=Insufficient+Balance&pnr=$tran_id&status=2";
    exit(header($location));
}

$location = "Location: bookedBusUser.php?msg=Payment+Failed&pnr=$tran_id&status=2";
exit(header($location));
