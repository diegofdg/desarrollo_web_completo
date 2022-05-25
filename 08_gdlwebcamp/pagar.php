<?php
require_once 'includes/paypal.php';
 
if (isset($_POST['submit'])) {
    
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $regalo = $_POST['regalo'];
    $total = $_POST['total_pedido'];
    $fecha = date('Y-m-d H:i:s');

    $boletos = $_POST['boletos'];
    $numero_boletos = $boletos;
    $pedidoExtra = $_POST['pedido_extra'];
    $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
    $precioCamisa = $_POST['pedido_extra']['camisas']['precio'];    
    
    $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];;
    $precioEtiquetas = $_POST['pedido_extra']['etiquetas']['precio'];;

    $i=0;

    foreach($numero_boletos as $key => $value) {
        if( (int) $value['cantidad'] > 0) {
            ${"array$i"} = array('Pase' => $key, 'Cantidad' => (int) $value['cantidad'], 'Precio' => (int) $value['precio']);               
            $i++;
        }
    }

    foreach($pedidoExtra as $key => $value) {
        if( (int) $value['cantidad'] > 0) {
            if($key == 'camisas') {
                $precio = (float) $value['precio'] * .93;
            } else {
                $precio = (int) $value['precio'];
            }

            ${"array$i"} = array('Extras' => $key, 'Cantidad' => (int) $value['cantidad'], 'Precio' => $precio);
            $i++;
        }
    }

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    exit;

    try {
        $response = $gateway->purchase([
            'amount' => $_POST['precio'],
            'currency' => PAYPAL_CURRENCY,
            'returnUrl' => PAYPAL_RETURN_URL,
            'cancelUrl' => PAYPAL_CANCEL_URL
        ])->setItems(array(
            array('name' => $producto, 'quantity' => 1, 'price' => $precio),
            array('name' => 'envío gratis', 'quantity' => 1, 'price' => '0.00')
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