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
<?php if (!empty($_GET["message"])) : ?>
        <div class='divMessageOnePost'>
            <?=$_GET["message"]?>
        </div>
<?php endif;?>
<div class='d-flex justify-content-center'>
    <div class='btnFormPost'>
        ➕ Add Post
    </div>
</div> 

<div class='formPost'> 
        <?php include __DIR__.'/../forms/formPost.php'; ?>    
    </div>  
<div id="postIndex">
<?php
foreach($allPost as $post):
    $reviews = $ReviewManager->getAllReviewByPost($post->getId())
?>

<div class = "card mb-3 produit" >
    <div class='d-flex justify-content-end '>
                <form action="/treatment/delete.php" method="post">
                    <input type="hidden" name="idPost" value="<?=$post->getId()?>">
                    <button type="submit" class='btn btn-danger' onclick="return confirm('Are you sure to delete this Post?')"><i class='far fa-trash-alt'></i></button>
                </form>
    </div> 
    <div class="row text-center ">
                <div class="col-12">
                    <h1><?= $post->getName_post() ?></h1>
                </div>
                <div class="col-12">
                    <a href="<?= $post->getLink() ?>" style= 'color : blue; font-size : 30px;' target="_blank">Link</a>
                    <p class="titles"><?= $post->getCreated() ?></p>
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
                   
                
            </div>
     
            <p class='m-5'><?= $post->getDescription() ?></p>
                

            <div class='d-flex justify-content-center '>
            <button type="button" class="btn btn-primary buttonAccesReviews" id='<?=$post->getId()?>'>See Reviews</button>
            </div> 
       
        <div class="commentaire-list" id='commentaire-list<?=$post->getId()?>'>
            <?php
            if(!$reviews): ?>
                <div class="commentaires">
                There are no comments 
                </div>
            <?php else:
            foreach ($reviews as $commentaire) : ?>
                <div class="commentaires">
                    <?php
                    $userReview = $UserManager->getUserById($commentaire->getId_user());
                    
                    ?>
                    <p class="nickname"> <b> <?= $userReview->getNickname() ?> </b></br><b> Post :</b> <?= $commentaire->getCreated()?> </br> <?= $commentaire->getTime()?> </p>
                    <p class="commentaire"> <?= $commentaire->getText_review()?></p>
                </div>
            <?php endforeach; endif; ?>
        </div>
        <div id="like">
            <div class='nblike'>
                <p class='ion'>  
                    <?php  $countLikes = $LikeManager->getCountLike($post->getId()); ?>
                <div class="uplike liked"> <i class='fas fa-heart' style='font-size:20px;color:red'></i> <p><?=$countLikes ['nb_likes'] ?></p></div>
                </p></br>
              
            </div>
        </div>

      



            </div>
<?php endforeach; ?>
</div>
</body>


<?php include __DIR__.'/../structure-page/footer.php'; ?>
</html>