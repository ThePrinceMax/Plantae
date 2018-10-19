<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Change Password - Testing Interface">
    <meta name="author" content="Maxime Princelle">

    <title>Sign Up</title>

    <script src="./bootstrap.min.js"></script>

    <link href="./bootstrap.min.css" rel="stylesheet">
    <link href="./sign.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <form class="form-signin" method="POST" action="./changepassword.php">
        <h2 class="form-signin-heading">Changer mot de passe</h2>
        <label for="login" class="sr-only">Adresse mail</label>
        <input type="email" id="login" name="login" class="form-control" placeholder="Email address" value="<?php if (isset($_SESSION['user'])) {echo($_SESSION['user']);} ?>" required autofocus>
        <label for="password" class="sr-only">Mot de passe</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <label for="confirm" class="sr-only">Confirm - Mot de passe</label>
        <input type="password" id="confirm" name="confirm" class="form-control" placeholder="Confirm" required>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Changer password</button>
      </form>
    </div>
  </body>
</html>
