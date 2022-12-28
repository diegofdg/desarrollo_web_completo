<?php
require_once 'config.php';
 
if (isset($_POST['submit'])) {    
    try {
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        
        $response = $gateway->purchase(array(
            'amount' => $_POST['precio'],
            'currency' => PAYPAL_CURRENCY,
            'returnUrl' => PAYPAL_RETURN_URL,
            'cancelUrl' => PAYPAL_CANCEL_URL
        ))->setItems(array(
            array(
                'name' => $producto,
                'quantity' => 1,
                'price' => $precio
            ),
            array(
                'name' => 'envío gratis',
                'quantity' => 1,
                'price' => '0.00'
            )
        ))->send();
 
        if ($response->isRedirect()) {
            $response->redirect();
        } else {
            echo $response->getMessage();
        }
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}