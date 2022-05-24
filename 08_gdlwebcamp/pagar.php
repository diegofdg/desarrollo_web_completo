<?php
require_once 'includes/paypal.php';
 
if (isset($_POST['submit'])) {    
    try {
        $response = $gateway->purchase(array(
            'amount' => $_POST['precio'],
            'currency' => PAYPAL_CURRENCY,
            'returnUrl' => PAYPAL_RETURN_URL,
            'cancelUrl' => PAYPAL_CANCEL_URL,
            'producto' => $_POST['producto']
        ))->send();
 
        if ($response->isRedirect()) {
            $response->redirect(); // this will automatically forward the customer
        } else {
            // not successful
            echo $response->getMessage();
        }
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}