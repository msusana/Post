<?php
session_start();
include __DIR__.'/structure-page/head.php'; 
include __DIR__.'/structure-page/navBar.php'; 
?>
<body>
<?php if (!empty($_GET["message"])) : ?>
        <div class='divMessage'>
            <?=$_GET["message"]?>
        </div>
<?php endif;
include __DIR__.'/config/bdd.php';
include __DIR__.'/config/autoload.php';

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
?>
        
        <?php include 'recuperation-donnees/affichage.php'; ?>
        
    
</body>


<?php include __DIR__.'/structure-page/footer.php'; ?>
</html>