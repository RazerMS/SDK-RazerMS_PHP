<?php
use Lib\RazerMerchantServices\Payment;

class PaymentController extends Controller
{
    public function processPayment()
    {
        $molpay = new Payment(env('RMS_MERCHANT_ID'), env('RMS_VERIFY_KEY'), env('RMS_SECRET_KEY'));
        $paymentUrl = $molpay->getPaymentUrl($transactionId, $amount, $callbackUrl);
    
        return redirect($paymentUrl);
    }
    
    public function handleCallback(Request $request)
    {
        $molpay = new Payment(env('RMS_MERCHANT_ID'), env('RMS_VERIFY_KEY'), env('RMS_SECRET_KEY'));
        $isPaymentValid = $molpay->verifySignature($transactionId, $amount, $status, $domain, $appcode, $vcode);
    
        if ($isPaymentValid) {
            // Payment is valid, update order status
        } else {
            // Payment is invalid, show error message
        }
    }
}

?>
