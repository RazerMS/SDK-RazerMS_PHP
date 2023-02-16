<?php
namespace RazerMerchantServices;

class Payment
{
    protected $merchantId;
    protected $verifyKey;
    protected $secretKey;
    protected $environment;
    protected $baseUrl;

    public function __construct($merchantId, $verifyKey, $secretKey, $environment)
    {
        $this->merchantId = $merchantId;
        $this->verifyKey = $verifyKey;
        $this->secretKey = $secretKey;
        $this->environment = $environment;
        $this->baseUrl = ($environment === 'sandbox') ? 'https://sandbox.merchant.razer.com/RMS/pay/'.$merchantId : 'https://pay.merchant.razer.com/RMS/pay/'.$merchantId;
    }

    public function getPaymentUrl($orderid, $amount, $bill_name, $bill_email, $bill_mobile, $bill_desc = null, $channel = null, $currency = null, $returnUrl = null, $callbackurl = null, $cancelurl = null,)
    {
        $data = [
            'orderid' => $orderid,
            'amount' => $amount,
            'bill_name' => $bill_name,
            'bill_email' => $bill_email,
            'bill_mobile' => $bill_mobile,
            'bill_desc' => $bill_desc,
            'channel' => $channel,
            'currency' => $currency,
            'returnurl' => $returnUrl,
            'callbackurl' => $callbackurl,
            'cancelurl' => $cancelurl,
            'vcode' => md5($amount . $this->merchantId . $orderid . $this->verifyKey),
        ];

        return $this->baseUrl . '?' . http_build_query($data);
    }

    public function verifySignature($paydate, $domain, $key, $appcode, $skey)
    {
        $checkVcode = md5($paydate . $domain . $key . $appcode . $this->secretKey);
        return $checkVcode === $skey;
    }
}
