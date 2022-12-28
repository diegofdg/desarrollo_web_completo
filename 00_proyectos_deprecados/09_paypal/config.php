<?php

require_once "vendor/autoload.php";
 
use Omnipay\Omnipay;
 
define('CLIENT_ID', '');
define('CLIENT_SECRET', '');
 
define('PAYPAL_RETURN_URL', 'http://localhost:5500/pago_finalizado.php?exito=true');
define('PAYPAL_CANCEL_URL', 'http://localhost:5500/pago_finalizado.php?exito=false');
define('PAYPAL_CURRENCY', 'USD');
 
$db = new mysqli('localhost', 'root', '', 'paypal'); 
 
if ($db->connect_error) {
    die("Connect failed: ". $db->connect_error);
}
 
$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live