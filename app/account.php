<?php

session_start();
ob_start();

require 'src/db-connect/db.php';

?>

<a href="index.php">Accueil</a><br>

<?php

if($_SESSION['admin_blog']==1){
    $is_admin = 'yes';
}else{
    $is_admin = 'no';
}

echo 'Mon compte <br>';
echo 'Prenom: ' . $_SESSION['pseudo'] . '<br>';
echo 'Nom: ' . $_SESSION['nom'] . '<br>';
echo 'Mail: ' . $_SESSION['mail'] . '<br>';
echo 'Admin: ' . $is_admin . ' <hr>';

if($_SESSION['admin_blog']==1){

    $reqMembre = $db->prepare('SELECT * FROM user');
    $reqMembre->execute();
    $affMembre = $reqMembre->fetchAll();
    echo 'Liste des membres: <hr>';

    foreach($affMembre as $membres){
        echo 'id: ' .$membres['id'] . ' Prenom: ' .$membres['prenom'] . ' Nom: '  .$membres['nom'] . ' Mail: ' .$membres['mail'] . ' Admin: '  .$membres['admin_blog']. '<br>';
        if($_SESSION['id']==$membres['id']){

        }else{
        echo '<a href="delete_user.php?id=' .$membres['id']. '">Supprimer cet utilisateur</a><hr>';
    }
    }
}

?>