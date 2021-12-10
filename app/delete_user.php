<?php

ob_start();
session_start();

require 'src/db-connect/db.php';


if($_SESSION['admin_blog'] == 1){

    $reqComment = $db->prepare('DELETE FROM user WHERE id = ?');
    $reqComment->execute(array($_GET['id']));
    $reqComment->execute();

    header('Location:account.php');

}else{
    header('Location:index.php');
}


?>