<?php
    /// Constantes afin de se connecter à la base de données
    // plantae.princelle.org
    const SQL_DSN      = "mysql:host=localhost;port=3306;dbname=t3";
    const SQL_USERNAME = 't3';
    const SQL_PASSWORD = 'K66R3o3Qrk1vokaO';
    
    
    /* Autre (localhost) */
    //const SQL_DSN      = 'mysql:host=mysql.iutrs.unistra.fr;dbname=t3_plantae_princelle';
    //const SQL_USERNAME = 'princelle';
    //const SQL_PASSWORD = '8jy3pz9n';

    /// Connexion à la base de données, message d'erreur si exception
    try {
        $db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    }
    catch( PDOException $e ) {
        echo 'Erreur : ' . $e->getMessage();
        exit;
    }
?>
