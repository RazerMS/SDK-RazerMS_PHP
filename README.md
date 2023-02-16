# SDK-RazerMS_PHP

This is a PHP library for integrating with the Razer Merchant Services (RMS) payment gateway. It provides a simple interface for creating and managing transactions, handling callbacks, and more.

## Installation

To use this library, simply clone the repository or install via composer:

```
composer require razermerchantservices/payment
```

## Usage

To get started, you will need to provide your RMS merchant ID, verify key, and secret key. These can be obtained from your RMS account dashboard.

You will also need to set the RMS environment, which can be either `sandbox` or `production`. This can be done by adding the following to your `.env` file:

````
RMS_MERCHANT_ID=your_merchant_id
RMS_VERIFY_KEY=your_verify_key
RMS_SECRET_KEY=your_secret_key
RMS_ENVIRONMENT=sandbox
````

Note that you should replace `your_merchant_id`, `your_verify_key`, and `your_secret_key` with your actual values.

Once you have configured your environment, you can create a new instance of the RMS class:

```php
use RazerMerchantServices\Payment;

$rms = new Payment(env('RMS_MERCHANT_ID'), env('RMS_VERIFY_KEY'), env('RMS_SECRET_KEY'), env('RMS_ENVIRONMENT'));
```

From there, you can create a new transaction by calling the getPaymentUrl method:

```php

$orderid = '12345';
$amount = '1.10';
$bill_name = 'RazerMS PHP';
$bill_email = 'test@gmail.com';
$bill_mobile = '0123456789';
        
// Optional variable to pass in getPaymentUrl - $bill_desc, $channel, $currency, $returnUrl, $callbackurl, $cancelurl
$paymentUrl = $rms->getPaymentUrl($orderid, $amount, $bill_name, $bill_email, $bill_mobile);
```

This will return a new Transaction object, which you can use to generate a payment form or redirect the user to the RMS hosted payment page.

When the transaction is complete, RMS will send a notification to your server to notify you of the transaction status. You can handle this notification by defining a notification URL in your RMS account dashboard and adding the following code to your notification script:

```php

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

 ```
 
 This will parse the notification data and update the status of the corresponding transaction.
 
 
## Documentation

For more information on using this library, please refer to this example.

Contribution
------------

You can contribute to this plugin by sending the pull request to this repository.


## Resources

- GitHub:     https://github.com/RazerMS
- Website:    https://merchant.razer.com/
- Twitter:    https://twitter.com/Razer_MS
- YouTube:    https://www.youtube.com/c/RazerMerchantServices
- Facebook:   https://www.facebook.com/RazerMerchantServices/
- Instagram:  https://www.instagram.com/RazerMerchantServices/


Issues
------------

Submit issue to this repository or email to our support-sa@razer.com


Contact Support
-------

Merchant Technical Support / Customer Care : support-sa@razer.com <br>
Sales/Reseller Enquiry : sales-sa@razer.com <br>
Marketing Campaign : marketing-sa@razer.com <br>
Channel/Partner Enquiry : channel-sa@razer.com <br>
Media Contact : media-sa@razer.com <br>
R&D and Tech-related Suggestion : technical-sa@razer.com <br>
Abuse Reporting : abuse-sa@razer.com

