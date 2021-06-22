<?php
session_start();
include __DIR__.'/../config/bdd.php';
include __DIR__.'/../config/autoload.php';

$nickname = $_SESSION['nickname'];
$UserManager = new UserManager($pdo);
$LikeManager = new LikeManager($pdo);
$newUser = $UserManager->getUser($nickname);
$user = new User($newUser); 
$idUser = $user->getId();

if(isset($_POST['id'])){ 
$verificationLike = $LikeManager->getOneLike($_POST['id'], $idUser);
var_dump($idUser);
if($verificationLike){
    $LikeManager->deleteLike($_POST['id'], $idUser);
}else{
    $LikeManager->createLike($_POST['id'], $idUser);
}
}
