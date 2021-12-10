<?php 


$bdd = "mysql:host=db;dbname=blog;charset=UTF8";

try {

    $db = new PDO($bdd, 'root', 'example');

} catch (PDOException $e) {

    echo $e->getMessage();

}
    
?>