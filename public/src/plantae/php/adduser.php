<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
    header('Location: #');
    exit;
}

session_start();
unset($_SESSION['message']);


if (isset($_POST['pseudo']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['confirm']))
{
    $pseudo = htmlentities($_POST['pseudo']);
    $login = htmlentities($_POST['login']);
    $password = htmlentities($_POST['password']);
    $confirm = htmlentities($_POST['confirm']);

    if ( $password != $confirm )
    {
        $_SESSION['message'] = "Password and confirmed password are different.";
        header('Location: #');
        exit;
    }

    // Fichier contenant les informations de connexion à la BDD
    require_once 'bdd.php';

    try
    {
        $db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    }
    catch (PDOException $e)
    {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['message'] .= 'Erreur de connexion à la BDD';
        header('Location: #');
        exit;
    }

    // On essaye d'ajouter le nouvel utilisateur
    $q = $db->prepare('INSERT INTO USERS SET pseudo = :pseudo, login = :login, password = :password');
    $q->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $q->bindValue(':login', $login, PDO::PARAM_STR);
    $q->bindValue(':password', password_hash($password,PASSWORD_DEFAULT), PDO::PARAM_STR);
    $ok = $q->execute();
    var_dump($ok);

    // Si la requête a été exécutée avec succès
    if ( $ok )
    {
        $_SESSION['message'] = 'Congratulations '.$pseudo. ', Account successfully created !<br>';
        $_SESSION['message'] .= 'Please signin to access to your account.';
<<<<<<< HEAD
        header('Location: #');
=======
        header('Location: ../index.php');
>>>>>>> 3c09fddede51f3fd26a3c45e1bc419798298a535
        exit;
    }
    else
    // Si la requête a échoué, c'est que le login existe déjà
    {
        $_SESSION['message'] = "The login '". $login ."' still exists. Try to signin.";
<<<<<<< HEAD
        header('Location: #');
=======
        header('Location: ../index.php');
>>>>>>> 3c09fddede51f3fd26a3c45e1bc419798298a535
        exit;
    }
}

header('Location: #');
exit;
