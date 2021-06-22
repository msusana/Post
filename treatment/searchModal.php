<?php 
include __DIR__.'./../config/bdd.php';
include __DIR__.'./../config/autoload.php';

$PostManager= new PostManager($pdo);

$allPost =  $PostManager->getSearchPost();

echo json_encode($allPost), "\n";