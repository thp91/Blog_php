<?php

session_start();
ob_start();

require 'src/db-connect/db.php';

?>

<a href="index.php">Accueil</a><br>

<?php

$reqArticles = $db->prepare('SELECT * FROM articles WHERE id = ?');
$reqArticles->execute(array($_GET['id']));
$reqArticles->execute();
$affArticles = $reqArticles->fetch();

$reqAuteur = $db->prepare('SELECT * FROM user WHERE id = ?');
$reqAuteur->execute(array($affArticles['auteur_id']));
$reqAuteur->execute();
$affAuteur = $reqAuteur->fetch();

echo 'Titre: ' . $affArticles['titre'] . '<br>';
echo 'Contenu: ' . $affArticles['contenu'] . '<br>';
echo 'Date: ' . $affArticles['date'] . '<br>';
echo 'Auteur: ' . $affAuteur['prenom'] . ' ' . $affAuteur['nom'] . '<hr>';

if($_SESSION['pseudo']){

    if(isset($_POST['valider'])){

        $contenu = $_POST['contenu'];
        $id_article = $_GET['id'];
        $id_user = $_SESSION['id'];
    
        $valider = $db->prepare("INSERT INTO commentaires (contenu, date, id_article, id_user) VALUES (:contenu, NOW(), :id_article, :id_user)");
        $valider->bindParam(':contenu', $contenu);
        $valider->bindParam(':id_article', $id_article);
        $valider->bindParam(':id_user', $id_user);
        $valider->execute();
    
        }

    ?>
<p>Poster un commentaire:</p>
<form action="" method="post" class="form">
  <div class="form-example">
    <textarea name="contenu" id="contenu" cols="30" rows="10" required></textarea>
  </div>
  <div class="form-example">
    <input type="submit" value="valider" name="valider">
  </div>

  <hr>

    <?php
}

$reqComment = $db->prepare('SELECT * FROM commentaires WHERE id_article = ?');
$reqComment->execute(array($_GET['id']));
$reqComment->execute();
$affComment = $reqComment->fetchAll();

foreach ($affComment as $comments){

    $reqAuteur = $db->prepare('SELECT * FROM user WHERE id = ?');
    $reqAuteur->execute(array($comments['id_user']));
    $reqAuteur->execute();
    $affAuteur = $reqAuteur->fetch();

    echo 'Commentaire: ' . $comments['contenu'] . '<br>';
    echo 'Date: ' . $comments['date'] . '<br>';
    echo 'Auteur: ' . $affAuteur['prenom'] . ' ' . $affAuteur['nom'] . '<br>';

    if($_SESSION['admin_blog'] == 1){
        ?>

        <a href="delete_comment.php?id=<?php echo $comments['id']; ?>&article=<?php echo $_GET['id']; ?>">Supprimer ce commentaire</a><hr>

        <?php
    }

}


?>