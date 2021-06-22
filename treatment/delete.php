<?php 
include '../config/bdd.php';
include '../config/autoload.php';

$PostManager= new PostManager($pdo);
$ReviewManager = new ReviewManager($pdo);
$UserManager = new UserManager($pdo);


if(isset($_POST['idPost'])){
    $PostManager->deletePost($_POST['idPost']);
    header("location: ../AdminModification.php?message= Tour Operator deleted");
}

elseif(isset($_POST['idReview'])){
    $ReviewManager->deleteReview($_POST['idReview']);
    header("location: ../admin/AdminModification.php?message= Destination deleted");
}
elseif(isset($_POST['idUser'])){
    $UserManager->deleteUser($_POST['idUser']);
    header("location: ../admin/AdminModification.php?message= Imagen deleted");
}
