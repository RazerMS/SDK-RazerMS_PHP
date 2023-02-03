<?php
use Lib\RazerMerchantServices\Payment;

class PaymentController extends Controller
{
    public function processPayment()
    {
        $molpay = new Payment(config('services.molpay.merchant_id'), config('services.molpay.verify_key'), config('services.molpay.secret_key'));
        $paymentUrl = $molpay->getPaymentUrl($transactionId, $amount, $callbackUrl);
    
        return redirect($paymentUrl);
    }
    
    public function handleCallback(Request $request)
    {
        $molpay = new Payment(config('services.molpay.merchant_id'), config('services.molpay.verify_key'), config('services.molpay.secret_key'));
        $isPaymentValid = $molpay->verifySignature($transactionId, $amount, $status, $domain, $appcode, $vcode);
    
        if ($isPaymentValid) {
            // Payment is valid, update order status
        } else {
            // Payment is invalid, show error message
        }
    }
}

?>
