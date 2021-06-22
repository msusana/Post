<?php
session_start();
include __DIR__.'/../structure-page/head.php'; 
include __DIR__.'/../structure-page/navBar.php'; 
?>
<body>

<?php 
include __DIR__.'/../config/bdd.php';
include __DIR__.'/../config/autoload.php';

$nickname = $_SESSION['nickname'];
$PostManager= new PostManager($pdo);
$ReviewManager = new ReviewManager($pdo);
$UserManager = new UserManager($pdo);
$ImageManager = new ImageManager($pdo);
$LikeManager = new LikeManager($pdo);
$newUser = $UserManager->getUser($nickname);
$user = new User($newUser); 
$allPost = $PostManager->getListPostByUser($user->getId()); ?>
<div class='btnFormPost'>
    ➕</br>
    Add Post
</div>

<?php
foreach($allPost as $post):
    $reviews = $ReviewManager->getAllReviewByPost($post->getId())
?>
  <div id="postIndex">


    <div class='formPost'> 
        <?php include __DIR__.'/../forms/formPost.php'; ?>    
    </div>

    <div class="row text-center">
                <div class="col-12">
                    <h1><?= $post->getName_post() ?></h1>
                </div>
                <div class="col-12">
                    <p class="titles"><?= $post->getLink() ?> <?= $post->getCreated() ?></p>
                </div>
                <div class="col-12"> 
                    <div class="d-flex justify-content-around flex-wrap ">
                    <?php 
                    $allPhotos = $ImageManager->getPhotoByIdPost($post->getId() );
                   
                                foreach($allPhotos as $image){ ?> 
                                <div class="w-30 mb-5" >
                                    <img src="<?= $image->getPhoto_Link() ?>" class="imgPerfil" alt="...">
                                </div> 
                                <?php } ?>
                    </div> 
                </div>
                   
                <div class="col-12">
                    <p class="descriptif"> </p>
                    <p><?= $post->getDescription() ?></p>
                </div>
            </div>
        

  
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

      



</div>
<?php endforeach; ?>
</body>


<?php include __DIR__.'/../structure-page/footer.php'; ?>
</html>