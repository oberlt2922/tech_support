<?php
    require('database_oo.php');
    
    $dsn = 'mysql:host=localhost;dbname=tech_support';
    $username = 'root';
    $password = '';
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    
    $databaseConnection = new Database($dsn, $username, $password, $options);

    try {
        $db = new PDO($databaseConnection->getDsn(), $databaseConnection->getUsername(), $databaseConnection->getPassword(), $databaseConnection->getOptions());
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>