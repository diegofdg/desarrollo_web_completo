<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://necolas.github.io/normalize.css/5.0.0/normalize.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="formulario">
        <h2>Pagos con Paypal</h2>
        
        <?php
            require_once 'config.php';

            $resultado = (bool) $_GET['exito'];              

                if($resultado == true) {
                    if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
                        $transaction = $gateway->completePurchase(array(
                            'payer_id' => $_GET['PayerID'],
                            'transactionReference' => $_GET['paymentId'],
                        ));
                        $response = $transaction->send();
                  
                        if ($response->isSuccessful()) {
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
                    } else {
                        echo "<div class='resultado error'>";
                        echo 'El usuario ha cancelado el pago';
                        echo "</div>";
                    }
                }
        ?> 
    </div>
</body>
</html>