<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
    header('Location: /#!/signup');
    exit;
}

session_start();
unset($_SESSION['message']);


if ( isset($_POST['pseudo']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['confirm']) )
{
    $pseudo = htmlentities($_POST['pseudo']);
    $login = htmlentities($_POST['login']);
    $password = htmlentities($_POST['password']);
    $confirm = htmlentities($_POST['confirm']);

    if ( $password != $confirm )
    {
        $_SESSION['message'] = "Password and confirmed password are different.";
        $_SESSION['message'] .= '<script>$.notify({
                                    	// options
                                        title: "Création du compte",
                                        message: "Les deux mots de passe sont différents."
                                    },{
                                    	// settings
                                    	type: "warning",
                                        allow_dismiss: true,
                                        newest_on_top: true,
                                        showProgressbar: false
                                    });</script>';
        header('Location: /#!/signup');
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
        $_SESSION['message'] .= '<script>$.notify({
                                        title: "Création du compte",
                                        message: "Erreur de connexion à la base de données"
                                    },{
                                    	type: "danger",
                                        allow_dismiss: true,
                                        newest_on_top: true,
                                        showProgressbar: false
                                    });</script>';
        header('Location: /#!/signup');
        exit;
    }

    // On essaye d'ajouter le nouvel utilisateur
    $q = $db->prepare('INSERT INTO USERS SET pseudo = :pseudo, login = :login, password = :password');
    $q->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $q->bindValue(':login', $login, PDO::PARAM_STR);
    $q->bindValue(':password', password_hash($password,PASSWORD_DEFAULT), PDO::PARAM_STR);
    $ok = $q->execute();
    //var_dump($ok);

    // Si la requête a été exécutée avec succès
    if ( $ok )
    {
        $_SESSION['message'] = 'Congratulations '.$login. ', Account successfully created !<br>';
        $_SESSION['message'] .= ' Please signin to access to your account.';
        $_SESSION['message'] .= '<script>$.notify({
                                    	// options
                                        title: "Création du compte",
                                        message: "Félicitations, votre compte à bien été créé, merci de vous connecter."
                                    },{
                                    	// settings
                                    	type: "success",
                                        allow_dismiss: true,
                                        newest_on_top: true,
                                        showProgressbar: false
                                    });</script>';
    }
    else
    // Si la requête a échoué, c'est que le login existe déjà
    {
        $_SESSION['message'] = "The login '". $login ."' still exists. Try to signin.";
        $_SESSION['message'] .= '<script>$.notify({
                                    	// options
                                        title: "Création du compte",
                                        message: "Désolé mais ce nom existe déjà, merci de le changer."
                                    },{
                                    	// settings
                                    	type: "warning",
                                        allow_dismiss: true,
                                        newest_on_top: true,
                                        showProgressbar: false
                                    });</script>';
    }

    header('Location: /#!/signup');
    exit;
}

header('Location: /#!/signup');
exit;
