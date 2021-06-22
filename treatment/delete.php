<?php 
include __DIR__.'/../config/bdd.php';
include __DIR__.'/../config/autoload.php';

$PostManager= new PostManager($pdo);



if(isset($_POST['idPost'])){
    $PostManager->deletePost($_POST['idPost']);
    header("location:/user/perfilUser.php?message= Post deleted");
}
