<?php 

function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=db;dbname=blog;charset=utf8', 'root', 'example');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}

$all_articles = $db->prepare('SELECT * FROM articles');
$all_articles->execute();
$aff_articles = $all_articles->fetchAll();
    
?>