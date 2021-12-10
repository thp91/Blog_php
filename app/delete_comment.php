<?php

ob_start();
session_start();

require 'src/db-connect/db.php';


if($_SESSION['admin_blog'] == 1){

    $reqComment = $db->prepare('DELETE FROM commentaires WHERE id = ?');
    $reqComment->execute(array($_GET['id']));
    $reqComment->execute();

    header('Location:article.php?id=' . $_GET['article']);

}else{
    header('Location:index.php');
}


?>