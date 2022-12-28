<?php
    require __DIR__ . '/../../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    $conn = mysqli_connect(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $_ENV['DB_BD']
    );

    $conn->set_charset('utf8');
    
    if($conn->connect_error) {
        echo $error-> $conn->connect_error;        
    }    
?>