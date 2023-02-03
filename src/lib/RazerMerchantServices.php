<?php
namespace Lib\RazerMerchantServices;

class Payment
{
    protected $merchantId;
    protected $verifyKey;
    protected $secretKey;
    protected $baseUrl;

    public function __construct($merchantId, $verifyKey, $secretKey)
    {
        $this->merchantId = $merchantId;
        $this->verifyKey = $verifyKey;
        $this->secretKey = $secretKey;
        $this->baseUrl = 'https://pay.merchant.razer.com/RMS/pay/'.$merchantId;
    }

    public function getPaymentUrl($transactionId, $amount, $callbackUrl)
    {
        $data = [
            'orderid' => $transactionId,
            'amount' => $amount,
            'bill_name' => 'test',
            'bill_email' => 'test@example.com',
            'bill_mobile' => '0123456789',
            'bill_desc' => 'test',
            'vcode' => md5($transactionId . $amount . $callbackUrl . $this->verifyKey),
            'returnurl' => $callbackUrl,
        ];

        return $this->baseUrl . '?' . http_build_query($data);
    }

    public function verifySignature($transactionId, $amount, $status, $domain, $appcode, $vcode)
    {
        $checkVcode = md5($transactionId . $amount . $status . $domain . $appcode . $this->secretKey);
        return $checkVcode === $vcode;
    }
}
