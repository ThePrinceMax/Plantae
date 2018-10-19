<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
    header('Location: index.php');
    exit;
}

session_start();
unset($_SESSION['message']);


if ( isset($_POST['login']) && isset($_POST['password']) )
{
    $login = htmlentities($_POST['login']);
    $password = htmlentities($_POST['password']);

    //-------------------------------------------------------------------------
    // Fichier contenant les informations de connexion à la BDD
    require_once 'bdd.php';

    try
    {
        $db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
    }
    catch (PDOException $e)
    {
        $_SESSION['message'] = $e->getMessage();
        header('Location: index.php');
        exit;
    }

    $q = $db->prepare('SELECT * FROM Users WHERE login = :login');
    $q->bindValue(':login', $login, PDO::PARAM_STR);
    $q->execute();
    //-------------------------------------------------------------------------

    if ($user = $q->fetch(PDO::FETCH_ASSOC))
    {
        if ( password_verify($password,$user['password']) )
        {
            $_SESSION['user'] = $login;
            header('Location: index.php');
            exit;
        }
        else
            $_SESSION['message'] = "Wrong password.";
    }
    else
        $_SESSION['message'] = "Wrong login.";
}

header('Location: index.php');
exit;
