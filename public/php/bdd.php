<?php
    const SQL_DSN      = 'mysql:host=mysql.iutrs.unistra.fr;dbname=W31_princelle';
    const SQL_USERNAME = 'princelle';
    const SQL_PASSWORD = '8jy3pz9n';

    try {
        $db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    }
    catch( PDOException $e ) {
        echo 'Erreur : ' . $e->getMessage();
        exit;
    }
?>
