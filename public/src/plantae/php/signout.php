<?php
    session_start();
    // on détruit la variable de session 'user'
    unset($_SESSION['user']);
    // et on envoie une demande de redirection en GET vers signin.php
    header('Location: signin.php');
    exit;
