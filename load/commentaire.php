<?php
include __DIR__.'/../config/autoload.php';
include __DIR__.'/../config/bdd.php';

$PostManager= new PostManager($pdo);
$ReviewManager = new ReviewManager($pdo);
$UserManager = new UserManager($pdo);

if (isset($_POST['id_post'])) : 
   $reviews= $ReviewManager->getAllReviewByPost($_POST['id_post']);
    foreach($reviews as $commentaire) :
    $userReview = $UserManager->getUserById($commentaire->getId_user()); ?>
        <div class="commentaires" >
        <p class="nickname"> <b> <?= $userReview->getNickname() ?> </b></br><b> Post :</b> <?= $commentaire->getCreated()?> </br><?= $commentaire->getTime()?> </p>
        <p class="commentaire"> <?= $commentaire->getText_review()?></p>
        </div>
<?php  endforeach;?><?php  endif;?>
