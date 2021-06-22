<?php
session_start();
$nickname = $_SESSION['nickname'];
if (isset($_POST['id_post'])) :
    include __DIR__ . '/config/bdd.php';
    include __DIR__ . '/config/autoload.php';
    $PostManager = new PostManager($pdo);
    $ReviewManager = new ReviewManager($pdo);
    $UserManager = new UserManager($pdo);
    $LikeManager = new LikeManager($pdo);
    $ImageManager = new ImageManager($pdo);
    $newUser = $UserManager->getUser($nickname);
    $user = new User($newUser); 
    $idUser = $user->getId();
    

    $post = $PostManager->getOnePost($_POST['id_post']);
    $reviews = $ReviewManager->getAllReviewByPost($_POST['id_post']);

?>
    <div class="popup-header">
        <div class="container modals">
            <div class="row">
                <div class="col-12">
                    <h1><?= $post->getName_post() ?></h1>
                </div>
                <div class="col-12">
                    <p class="titles"><?= $post->getLink() ?> <?= $post->getCreated() ?></p>
                </div>


                <div class="col-12">
                    <p class="descriptif"> </p>
                    <p><?= $post->getDescription() ?></p>
                </div>
            </div>
        </div>

    </div>

    <div class="popup-body">
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">  
  <?php 
   $allPhotos = $ImageManager->getPhotoByIdPost($post->getId() );
   $isFirst = true; 
               foreach($allPhotos as $image){ ?> 
               <div class="carousel-item <?php if($isFirst){ echo 'active';}else{ echo'';} ?>" >
                   <img src="<?= $image->getPhoto_Link() ?>" class="d-block w-100" alt="...">
                 </div>
               <?php $isFirst = false; ?>  
               <?php } ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</div>

    <div class="popup-footer" id='refresh'>
        <h5>Espace commentaires</h5><br>
        <div class="commentaire-list">
            <?php
            
            
            foreach ($reviews as $commentaire) : ?>
                <div class="commentaires">
                    <?php
                    $userReview = $UserManager->getUserById($commentaire->getId_user());
                    
                    ?>
                    <p class="nickname"> <b> <?= $userReview->getNickname() ?> </b></br><b> Post :</b> <?= $commentaire->getCreated()?> </b>a = <?= $commentaire->getTime()?> <b></p>
                    <p class="commentaire"> <?= $commentaire->getText_review()?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div id="like">
            <div class='nblike'>
                <p class='ion'>
                    <ion-icon name="caret-up-outline"></ion-icon>
                </p></br>
                <?php  $countLikes = $LikeManager->getCountLike($post->getId()); 
                      echo $countLikes['nb_likes']; ?>
            </div>
        </div>

        <input id="id_post" value="<?= $_POST['id_post']?>" type="hidden">
        <input id="id_user" value="<?=$idUser ?>" type="hidden">
        <textarea name="commentaires" id="commentaire" placeholder="votre commentaire..."> </textarea>
        <button class="btn btn-primary" id='envoyer' onclick="send();">Envoyer</button>

    </div>
    </div>
    </div>
    
<?php

include __DIR__ .'/structure-page/footer.php';
endif; ?>