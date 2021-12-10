<?php

ob_start();
session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
require 'src/db-connect/db.php';

?>

<a href="index.php">Accueil</a><br>

<?php

    $req = $db->prepare("SELECT * FROM user WHERE mail = ? AND mdp = ?");
    $req->execute(array($_POST['mail'], $_POST['pass']));
    $userexist = $req->rowCount();
    if($userexist == 1){
        $userinfo = $req->fetch();
        $_SESSION['id'] = $userinfo['id'];
        $_SESSION['pseudo'] = $userinfo['prenom'];
        $_SESSION['mail'] = $userinfo['mail'];
        $_SESSION['nom'] = $userinfo['nom'];
        $_SESSION['admin_blog'] = $userinfo['admin_blog'];
        header('Location: index.php');
    }else{
        print 'Mail ou mot de passe incorrect!';
    }

    if($_SESSION['pseudo']){
        header('Location:index.php');
    }

?>

    <form action="" method="post" class="form">
  <div class="form-example">
    <label for="mail">Mail: </label>
    <input type="email" name="mail" id="mail" required>
  </div>
  <div class="form-example">
    <label for="pass">Mot de passe: </label>
    <input type="password" name="pass" id="pass" required>
  </div>
  <div class="form-example">
    <input type="submit" value="valider" name="valider">
  </div>
</form>
    
</body>
</html>