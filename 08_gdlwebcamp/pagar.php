<?php
require_once 'includes/paypal.php';

use Omnipay\Common\ItemBag;
 
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
    
    $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
    $precioEtiquetas = $_POST['pedido_extra']['etiquetas']['precio'];

    $totalPedido = $_POST['total_pedido'];
    
    include_once 'includes/funciones/funciones.php';

    $pedido = productos_json($boletos, $camisas, $etiquetas);

    $eventos = $_POST['registro'];
    $registro = eventos_json($eventos);

    try {
        require_once('includes/funciones/bd_conexion.php');
        $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total);
        $stmt->execute();
        $ID_registro = $stmt->insert_id;
        $stmt->close();
        $conn->close();
    } catch(\Exception $e) {
        echo $e->getMessage();
    }

    define('PAYPAL_RETURN_URL', 'http://localhost:5500/pago_finalizado.php?&id_pago=' . $ID_registro);

    $items = new ItemBag();

    foreach($numero_boletos as $key => $value) {
        if( (int) $value['cantidad'] > 0) {
            $items->add(array(
                'name' => $key,
                'quantity' => (int) $value['cantidad'],
                'price' => (int) $value['precio']
            ));
        }
    }

    foreach($pedidoExtra as $key => $value) {
        if( (int) $value['cantidad'] > 0) {
            $items->add(array(
                'name' => $key,
                'quantity' => (int) $value['cantidad'],
                'price' => (float) $value['precio']
            ));
        }
    }

    try {
        $response = $gateway->purchase([
            'amount' => $totalPedido,
            'currency' => PAYPAL_CURRENCY,
            'returnUrl' => PAYPAL_RETURN_URL,
            'cancelUrl' => PAYPAL_CANCEL_URL
        ])->setItems($items)->send();
 
        if ($response->isRedirect()) {
            $response->redirect();
        } else {
            echo $response->getMessage();
        }
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}