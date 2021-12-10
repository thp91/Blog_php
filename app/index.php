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
    <link rel="stylesheet" href="style.css" >
    <title>Document</title>
</head>
<body>

    <?php

    if(isset($_SESSION['pseudo'])){
        ?>

    <div class="nav">
        <a href="logout.php">Se déconnecter</a>
        <a href="newarticle.php">Poster un article</a>
        <a href="account.php">Mon compte</a>
    </div>

<?php
    }else{

    ?>

    <div class="nav">
        <a href="login.php">Connexion</a>
        <a href="create.php">Créer son compte</a>
    </div>

    <?php

    }

?>

<?php 
require 'src/db-connect/db.php';

$reqArticles = $db->prepare('SELECT * FROM articles');
$reqArticles->execute();
$affArticles = $reqArticles->fetchAll();

foreach ($affArticles as $article) {

    $reqAuteur = $db->prepare('SELECT * FROM user WHERE id = ?');
    $reqAuteur->execute(array($article['auteur_id']));
    $reqAuteur->execute();
    $affAuteur = $reqAuteur->fetch();
    
?>
    <div class="article">
    <h1><?php echo $article['titre']; ?></h1><br>
    <p><?php echo $article['contenu']; ?></p><br>
    <p><?php echo $article['date']; ?></p><br>
    <p><?php echo 'Auteur: ' . $affAuteur['prenom'] . ' ' . $affAuteur['nom']; ?></p><br>
    <a href="article.php?id=<?php echo $article['id']; ?>">Acceder a cet article</a>

    <?php

    if($_SESSION['admin_blog']){
        ?>

        <a href="delete_article.php?id=<?php echo $article['id']; ?>">Supprimer cet article</a>

        <?php
    }

    ?>

    </div>

<?php
}

?>    

</body>
</html>

