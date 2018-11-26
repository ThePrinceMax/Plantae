<?php
    const SQL_DSN      = "mysql:host=localhost;port=3306;dbname=t3";
    const SQL_USERNAME = 'test';
    const SQL_PASSWORD = 'test';

    try {
        $db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    }
    catch( PDOException $e ) {
        echo 'Erreur : ' . $e->getMessage();
        exit;
    }
?>
