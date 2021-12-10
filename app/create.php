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

if($_POST['valider']){

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];
    $admin = 1;

    $valider = $db->prepare("INSERT INTO user (nom, prenom, mail, mdp, admin_blog) VALUES (:nom, :prenom, :mail, :mdp, :admin_blog)");
    $valider->bindParam(':nom', $nom);
    $valider->bindParam(':prenom', $prenom);
    $valider->bindParam(':mail', $mail);
    $valider->bindParam(':mdp', $mdp);
    $valider->bindParam(':admin_blog', $admin);
    $valider->execute();
    header('Location:login.php');
}

?>

    <form action="" method="post" class="form">
  <div class="form-example">
    <label for="nom">Nom: </label>
    <input type="text" name="nom" id="nom" required>
  </div>
  <div class="form-example">
    <label for="prenom">Prenom: </label>
    <input type="text" name="prenom" id="prenom" required>
  </div>
  <div class="form-example">
    <label for="mail">Mail: </label>
    <input type="email" name="mail" id="mail" required>
  </div>
  <div class="form-example">
    <label for="mdp">Votre mot de passe: </label>
    <input type="password" name="mdp" id="mdp" required>
  </div>
  <div class="form-example">
    <input type="submit" value="valider" name='valider'>
  </div>
</form>
    
</body>
</html>