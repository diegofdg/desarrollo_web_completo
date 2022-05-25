<?php include_once 'includes/templates/header.php'; ?>

    <section class="seccion contenedor">
        <h2>Resumen Registro</h2>

        <?php
            require_once 'includes/paypal.php';

            $resultado = (bool) $_GET['exito'];              

                if($resultado == true) {
                    if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
                        try {
                            $transaction = $gateway->completePurchase(array(
                                'payer_id' => $_GET['PayerID'],
                                'transactionReference' => $_GET['paymentId'],
                            ));
                            $response = $transaction->send();
                            $id_pago = (int) $_GET['id_pago'];
                        
                            if ($response->isSuccessful()) {
                                require_once('includes/funciones/bd_conexion.php');
                                $stmt = $conn->prepare("UPDATE registrados SET pagado = ? WHERE ID_registrado = ?");
                                $pagado = 1;
                                $stmt->bind_param("ii", $pagado, $id_pago);
                                $stmt->execute();
                                $stmt->close();
                                $conn->close();

                                $arr_body = $response->getData();
                                
                                $payment_id = $arr_body['id'];
                                $payer_id = $arr_body['payer']['payer_info']['payer_id'];
                                $payer_email = $arr_body['payer']['payer_info']['email'];
                                $precio = $arr_body['transactions'][0]['amount']['total'];
                                $currency = PAYPAL_CURRENCY;
                                $payment_status = $arr_body['state'];
                                
                                $db->query("INSERT INTO payments(payment_id, payer_id, payer_email, amount, currency, payment_status) VALUES('". $payment_id ."', '". $payer_id ."', '". $payer_email ."', '". $precio ."', '". $currency ."', '". $payment_status ."')");
                                echo "<div class='resultado correcto'>";
                                echo "El pago se realizó correctamente <br/>";
                                echo "El ID es {$payment_id}";
                                echo "</div>";
                            } else {
                                echo "<div class='resultado error'>";
                                echo "El pago no se realizo";
                                echo $response->getMessage();
                                echo "</div>";
                            }                            
                        } catch(\Exception $e) {
                            echo $e->getMessage();
                        }                        
                    } else {
                            echo 'El usuario ha cancelado el pago';
                    }
                }
        ?>        
    </section>

<?php include_once 'includes/templates/footer.php'; ?>