## Tap Payment Php
[![Packagist License](https://poser.pugx.org/barryvdh/laravel-debugbar/license.png)](http://choosealicense.com/licenses/mit/)
[![Build Status](https://travis-ci.org/iZaL/tap-payment-php.svg?branch=master)](https://travis-ci.org/iZaL/tap-payment-php)

This is a package to integrate [Tap Payments](https://www.tap.company/) with Php.

##Documentation

## Installation

Require this package with composer:

```shell
composer require izal/tap-payment-php
```


### Usage:

For Lumen, register a different Provider in `bootstrap/app.php`:

```php

$billing = new IZaL\Tap\TapBilling(
    [
    ]
);

```