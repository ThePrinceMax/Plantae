<?php
    const SQL_DSN      = "mysql:host=62.210.180.172;port=20120;dbname=t3";
    const SQL_USERNAME = 't3';
    const SQL_PASSWORD = 'K66R3o3Qrk1vokaO';

    try {
        $db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    }
    catch( PDOException $e ) {
        echo 'Erreur : ' . $e->getMessage();
        exit;
    }
?>
