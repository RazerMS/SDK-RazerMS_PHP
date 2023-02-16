<?php
use Lib\RazerMerchantServices\Payment;

class PaymentController extends Controller
{
    public function processPayment()
    {   
        $orderid = '12345';
        $amount = '1.10';
        $returnUrl = 'https://stackdaemon.com';
        $bill_name = 'RazerMS PHP';
        $bill_email = 'test@gmail.com';
        $bill_mobile = '0123456789';
        $bill_desc = 'RMS PHP Library Test';

        $rms = new Payment(env('RMS_MERCHANT_ID'), env('RMS_VERIFY_KEY'), env('RMS_SECRET_KEY'), env('RMS_ENVIRONMENT'));
        $paymentUrl = $rms->getPaymentUrl($orderid, $amount, $returnUrl, $bill_name, $bill_email, $bill_mobile, $bill_desc);
    
        return redirect($paymentUrl);
    }
    
    public function handleNotification(Request $request)
    {
        $rms = new Payment(env('RMS_MERCHANT_ID'), env('RMS_VERIFY_KEY'), env('RMS_SECRET_KEY'), env('RMS_ENVIRONMENT'));
        $isPaymentValid = $rms->verifySignature($transactionId, $amount, $status, $domain, $appcode, $vcode);
    
        if ($isPaymentValid) {
            // Payment is valid, update order status
        } else {
            // Payment is invalid, show error message
        }
    }
}

?>
