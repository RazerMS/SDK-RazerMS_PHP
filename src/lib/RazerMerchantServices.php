<?php
namespace Lib\RazerMerchantServices;

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

    public function getPaymentUrl($orderid, $amount, $returnUrl, $bill_name, $bill_email, $bill_mobile, $bill_desc)
    {
        $data = [
            'orderid' => $orderid,
            'amount' => $amount,
            'bill_name' => $bill_name,
            'bill_email' => $bill_email,
            'bill_mobile' => $bill_mobile,
            'bill_desc' => $bill_desc,
            'vcode' => md5($amount . $this->merchantId . $orderid . $this->verifyKey),
            'returnurl' => $returnUrl,
        ];

        return $this->baseUrl . '?' . http_build_query($data);
    }

    public function verifySignature($transactionId, $amount, $status, $domain, $appcode, $vcode)
    {
        $checkVcode = md5($transactionId . $amount . $status . $domain . $appcode . $this->secretKey);
        return $checkVcode === $vcode;
    }
}
