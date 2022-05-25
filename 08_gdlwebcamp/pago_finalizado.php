<?php include_once 'includes/templates/header.php'; ?>

    <section class="seccion contenedor">
        <h2>Resumen Registro</h2>

        <?php
            require_once 'includes/paypal.php';

            if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
                try {
                    $transaction = $gateway->completePurchase(array(
                        'payer_id' => $_GET['PayerID'],
                        'transactionReference' => $_GET['paymentId'],
                    ));
                    $response = $transaction->send();
                    $id_pago = (int) $_GET['id_pago'];
                
                    if ($response->isSuccessful()) {
                        $arr_body = $response->getData();
                        $payment_id = $arr_body['id'];
                        $payer_id = $arr_body['payer']['payer_info']['payer_id'];
                        $payment_status = $arr_body['state'];

                        require_once('includes/funciones/bd_conexion.php');
                        $stmt = $conn->prepare("UPDATE registrados SET payment_id = ?, payer_id = ?, payment_status = ? WHERE ID_registrado = ?");
                        $stmt->bind_param("sssi", $payment_id, $payer_id, $payment_status, $id_pago);
                        $stmt->execute();
                        $stmt->close();
                        $conn->close();

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
        ?>
    </section>

<?php include_once 'includes/templates/footer.php'; ?>