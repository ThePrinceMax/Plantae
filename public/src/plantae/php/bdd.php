<?php
    /// Constantes afin de se connecter à la base de données
    const SQL_DSN      = "mysql:host=mysql;port=3306;dbname=t3";
    const SQL_USERNAME = 't3';
    const SQL_PASSWORD = 'K66R3o3Qrk1vokaO';

    /// Connexion à la base de données, message d'erreur si exception
    try {
        $db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    }
    catch( PDOException $e ) {
        echo 'Erreur : ' . $e->getMessage();
        exit;
    }
?>
