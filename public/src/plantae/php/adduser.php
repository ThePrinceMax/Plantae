<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
    header('Location: #');
    exit;
}

session_start();
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
    header('Location: /');
    exit;
}
//unset($_SESSION['message']);


if (isset($_POST['pseudo']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['confirm']))
{
    $pseudo = htmlentities($_POST['pseudo']);
    $login = htmlentities($_POST['login']);
    $password = htmlentities($_POST['password']);
    $confirm = htmlentities($_POST['confirm']);

    if ( $password != $confirm )
    {
        $_SESSION['message'] = "Password and confirmed password are different.";
        header('Location: /');
        exit;
    }
    else{
        try {
            $request = $db->prepare('INSERT INTO USERS(pseudo, login, password ) VALUES (:pseudo, :login, :password');
            $request->bindValue(":pseudo", $pseudo);
            $request->bindValue(':login', $login, PDO::PARAM_STR);
            $request->bindValue(":password", password_hash($password, PASSWORD_DEFAULT));
            $ok = $request->execute();
        }

        catch( PDOException $e ) {
            $_SESSION['message'] = $e->getMessage();
            header("Location: signup.php");
            exit;
        }
        if($ok){
            $_SESSION['message'] = 'Congratulations '.$pseudo. ', Account successfully created !<br>';
            $_SESSION['message'] .= 'Please signin to access to your account.';
            header('Location: /');
            exit;
        }
        else{
            $_SESSION['message'] = "The login '". $login ."' still exists. Try to signin.";
            header('Location: /');
            exit;
        }
    }
}
else{
    $_SESSION['message'] = 'Champs non renseigné';
    header('Location: /');
    exit;
}
