<?php

require_once "vendor/autoload.php";
 
use Omnipay\Omnipay;
 
define('CLIENT_ID', '');
define('CLIENT_SECRET', '');
 
define('PAYPAL_CANCEL_URL', 'http://localhost:5500/pago_finalizado.php?');
define('PAYPAL_CURRENCY', 'USD');
 
$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live