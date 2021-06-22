<?php
session_start();
include __DIR__.'./../structure-page/head.php'; 
include __DIR__.'./../structure-page/navBar.php'; 
?>
<body>
<?php if (!empty($_GET["message"])) : ?>
        <div style="padding: 10px;background:gray;color:#fff;">
            <?=$_GET["message"]?>
        </div>
<?php endif;
include __DIR__.'./../config/bdd.php';
include __DIR__.'./../config/autoload.php';

$PostManager= new PostManager($pdo);
$ReviewManager = new ReviewManager($pdo);
$UserManager = new UserManager($pdo);
$LikeManager = new LikeManager($pdo);
$ImageManager = new ImageManager($pdo);
if($_SESSION){
$nickname = $_SESSION['nickname'];
$newUser = $UserManager->getUser($nickname);
$user = new User($newUser); 
$idUser = $user->getId();
}
if($_GET['id']){
  $post = $PostManager->getOnePost($_GET['id']);
  $reviews = $ReviewManager->getAllReviewByPost($_GET['id']);  
}
?>
<div id="postIndex">
            <div class="row text-center">
                <div class="col-12">
                    <h1><?= $post->getName_post() ?></h1>
                </div>
                <div class="col-12">
                    <p class="titles"><?= $post->getLink() ?> <?= $post->getCreated() ?></p>
                </div>
                <div class="col-12">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">  
                    <?php 
                    $allPhotos = $ImageManager->getPhotoByIdPost($post->getId() );
                    $isFirst = true; 
                                foreach($allPhotos as $image){ ?> 
                                <div class="carousel-item bg-dark <?php if($isFirst){ echo 'active';}else{ echo'';} ?>" >
                                    <img src="<?= $image->getPhoto_Link() ?>" class="d-block" id='imgOnePost' alt="...">
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

                <div class="col-12">
                    <p class="descriptif"> </p>
                    <p><?= $post->getDescription() ?></p>
                </div>
            </div>

</div>
        
  

</body>


<?php include __DIR__.'./../structure-page/footer.php'; ?>
</html>