<?php

session_start();
ob_start();

require 'src/db-connect/db.php';

?>

<a href="index.php">Accueil</a><br>

<?php

if(isset($_SESSION['pseudo'])){

    if(isset($_POST['valider'])){

    $contenu = $_POST['contenu'];
    $auteur_id = $_SESSION['id'];
    $titre = $_POST['titre'];

    $valider = $db->prepare("INSERT INTO articles (date, contenu, auteur_id, titre) VALUES (NOW(), :contenu, :auteur_id, :titre)");
    $valider->bindParam(':contenu', $contenu);
    $valider->bindParam(':auteur_id', $auteur_id);
    $valider->bindParam(':titre', $titre);
    $valider->execute();

    header('Location: index.php');

    }

?>


    <form action="" method="post" class="form">
  <div class="form-example">
    <label for="titre">Titre de l'article: </label>
    <input type="titre" name="titre" id="titre" required>
  </div>
  <div class="form-example">
    <textarea name="contenu" id="contenu" cols="30" rows="10" required></textarea>
  </div>
  <div class="form-example">
    <input type="submit" value="valider" name="valider">
  </div>
</form>








<?php

}else{
    header('Location: index.php');
}

?>