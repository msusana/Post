<?php
include __DIR__.'/../config/bdd.php';
include __DIR__.'/../config/autoload.php';
$ReviewManager = new ReviewManager($pdo);


if (isset($_POST['id_user']) && isset($_POST['id_post'])&& isset($_POST['message'])){
  $review = new Review(['id_user'=> $_POST['id_user'], 'id_post' => $_POST['id_post'], 'text_review' => $_POST['message']]);
  $ReviewManager->createReview($review);
}; 
