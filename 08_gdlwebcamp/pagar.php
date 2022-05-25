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
    $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
    $precioCamisa = $_POST['pedido_extra']['camisas']['precio'];
    
    $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];;
    $precioEtiquetas = $_POST['pedido_extra']['etiquetas']['precio'];;

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    exit;

    include_once 'includes/funciones/funciones.php';

    $pedido = productos_json($boletos, $camisas, $etiquetas);

    $eventos = $_POST['registro'];
    $registro = eventos_json($eventos);

    try {
        require_once('includes/funciones/bd_conexion.php');
        $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header('Location: validar_registro.php?exitoso=1');
    } catch(\Exception $e) {
        echo $e->getMessage();
    }  












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