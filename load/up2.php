<?php
session_start();
include __DIR__."/../config/bdd.php";
include __DIR__."/../config/autoload.php";
$nickname = $_SESSION['nickname'];
$UserManager = new UserManager($pdo);
$LikeManager = new LikeManager($pdo);
$newUser = $UserManager->getUser($nickname);
$user = new User($newUser); 
$idUser = $user->getId();


if (isset($_POST['id_post'])){
   
 
$verificationLike = $LikeManager ->getOneLike($_POST['id_post'], $idUser);

$nbLikes = $LikeManager->getCountLike($_POST['id_post']);

?>

<?php if (!$verificationLike){ ?>
    <div class="uplike ups" ><i class='far fa-heart' style='font-size:20px;'></i> <p><?=$nbLikes['nb_likes'] ?></p></div>  
<?php }else{ ?>
    <div class="uplike liked"> <i class='fas fa-heart' style='font-size:20px;color:red'></i> <p><?=$nbLikes['nb_likes'] ?></p></div>
<?php }} ?>

