## Tap Payment Php
[![Packagist License](https://poser.pugx.org/barryvdh/laravel-debugbar/license.png)](http://choosealicense.com/licenses/mit/)
[![Build Status](https://travis-ci.org/iZaL/tap-payment-php.svg?branch=master)](https://travis-ci.org/iZaL/tap-payment-php)

This is a package to integrate [Tap Payments](https://www.tap.company/) with Php.

## Documentation

## Installation

Require this package with composer:

```shell
composer require izal/tap-payment-php
```


### Usage:


```php

$config =
    [
        'ApiKey' => '1tap7',
        'UserName' => 'test',
        'Password' => 'test',
        'MerchantID' => '1014'
    ];

$products =
    [
        [
            'Quantity' => '1',
            'TotalPrice' => '500',
            'UnitName' => 'Product Name',
            'UnitDesc' => 'Product Description',
            'UnitPrice' => '500',
        ],
        [
            'Quantity' => '2',
            'TotalPrice' => '300',
            'UnitName' => 'Product Name',
            'UnitDesc' => 'Product Description',
            'UnitPrice' => '150',
        ]
    ];

$customer =
    [
        'Email' => 'customer@email.com',
        'Name' => 'Awesome Customer',
        'Mobile' => '9999999',
    ];

$gateway =
    [
        'Name' => 'ALL'
    ];

$merchant =
    [
        'ReturnURL' => 'http://test.com/payment/returnurl',
        'ReferenceID' => uniqid(),
    ];

$billing = new TapBilling(
    $config
);

$billing->setProducts($products);
$billing->setCustomer($customer);
$billing->setGateway($gateway);
$billing->setMerchant($merchant);

// request for payment url
$paymentRequest = $billing->requestPayment();

// get the response
$response = $paymentRequest->response->getRawResponse();

```

With the response object, you can redirect the user to the payment page

```

$paymentURL = $response->PaymentURL;
$paymentReferenceID = $response->ReferenceID;

```

read the official tap documentation to know all the details of the response object
