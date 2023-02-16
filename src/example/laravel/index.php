<?php
use RazerMerchantServices\Payment;

class PaymentController extends Controller
{
    public function payment()
    {   
        $orderid = '12345';
        $amount = '1.10';
        $bill_name = 'RazerMS PHP';
        $bill_email = 'test@gmail.com';
        $bill_mobile = '0123456789';

        $rms = new Payment(env('RMS_MERCHANT_ID'), env('RMS_VERIFY_KEY'), env('RMS_SECRET_KEY'), env('RMS_ENVIRONMENT'));
        
        // Optional variable to pass in getPaymentUrl - $bill_desc, $channel, $currency, $returnUrl, $callbackurl, $cancelurl
        $paymentUrl = $rms->getPaymentUrl($orderid, $amount, $bill_name, $bill_email, $bill_mobile);
    
        return redirect($paymentUrl);
    }

    //   "skey" => ""
    //   "tranID" => ""
    //   "domain" => ""
    //   "status" => ""
    //   "amount" => ""
    //   "currency" => ""
    //   "paydate" => ""
    //   "orderid" => ""
    //   "appcode" => 
    //   "error_code" => ""
    //   "error_desc" => ""
    //   "channel" => ""
    //   "extraP" => "{""}"
    
    public function notification(Request $request)
    {   
        $rms = new Payment(env('RMS_MERCHANT_ID'), env('RMS_VERIFY_KEY'), env('RMS_SECRET_KEY'), env('RMS_ENVIRONMENT'));
        $key = md5($request->tranID.$request->orderid.$request->status.$request->domain.$request->amount.$request->currency);
        $isPaymentValid = $rms->verifySignature($request->paydate, $request->domain, $key, $request->appcode, $request->skey);
    
        if ($isPaymentValid) {
            // Payment is valid, update order status
        } else {
            // Payment is invalid, show error message
        }
    }

    public function callback(Request $request)
    {   
        $rms = new Payment(env('RMS_MERCHANT_ID'), env('RMS_VERIFY_KEY'), env('RMS_SECRET_KEY'), env('RMS_ENVIRONMENT'));
        $key = md5($request->tranID.$request->orderid.$request->status.$request->domain.$request->amount.$request->currency);
        $isPaymentValid = $rms->verifySignature($request->paydate, $request->domain, $key, $request->appcode, $request->skey);
    
        if ($isPaymentValid) {
            // Payment is valid, update defer order status
        } else {
            // Payment is invalid, show error message
        }
    }

    public function return(Request $request)
    {   
        $rms = new Payment(env('RMS_MERCHANT_ID'), env('RMS_VERIFY_KEY'), env('RMS_SECRET_KEY'), env('RMS_ENVIRONMENT'));
        $key = md5($request->tranID.$request->orderid.$request->status.$request->domain.$request->amount.$request->currency);
        $isPaymentValid = $rms->verifySignature($request->paydate, $request->domain, $key, $request->appcode, $request->skey);

        if ($isPaymentValid) {
            // Payment is valid, redirect to result page
        } else {
            // Payment is invalid, show error message
        }
    }
}

?>
