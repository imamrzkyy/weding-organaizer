<?php
namespace Midtrans;


use Exception;

require_once dirname(__FILE__) . '/midtrans/Midtrans.php';

Config::$serverKey = 'SB-Mid-server-N6Lp-h-Q06dgM2WIh53JdwNZ';
Config::$clientKey = 'SB-Mid-client-BLUyugD7t0NiNWmy';
\Midtrans\Config::$isProduction = false;

$amount = (int)$_POST['jumlahPembayaran']; // pastikan dikonversi ke integer

$orderId = 'ORDER-' . time();

$transaction_details = array(
    'order_id' => $orderId,
    'gross_amount' => $amount,
);

$customer_details = array(
    'first_name' => 's',
);

$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
);

try {
    $snapToken = \Midtrans\Snap::getSnapToken($transaction);
    echo json_encode(['token' => $snapToken]);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}