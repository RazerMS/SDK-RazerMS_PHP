<?php

require_once 'vendor/autoload.php';

use Lib\RazerMerchantServices\Payment;

$rms = new Payment($merchantId, $verifyKey, $secretKey);
$paymentUrl = $rms->getPaymentUrl($transactionId, $amount, $callbackUrl);

// Redirect the customer to the payment page
header("Location: " . $paymentUrl);

// Verify the payment status upon callback from Molpay
$isPaymentValid = $rms->verifySignature($transactionId, $amount, $status, $domain, $appcode, $vcode);
if ($isPaymentValid) {
    // Payment is valid, update order status
} else {
    // Payment is invalid, show error message
}
