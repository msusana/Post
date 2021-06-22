<?php
session_start();
$nickname = $_SESSION['nickname'];
include __DIR__.'/../config/bdd.php';
include __DIR__.'/../config/autoload.php';
$PostManager = new PostManager($pdo);
$ReviewManager = new ReviewManager($pdo);
$UserManager = new UserManager($pdo);
$LikeManager = new LikeManager($pdo);
$newUser = $UserManager->getUser($nickname);
$user = new User($newUser); 
$idUser = $user->getId();


$search = $_POST['search'];
$resultSearch = $PostManager->getSearchPost($search);
if(isset($_POST['search'])):
foreach($resultSearch as $post) 
{ ?>

  <div class="row">  
    
  
          <div class="col-md-2 col-sm-12 align-self-center">
            <img src="" class="card-img" alt="...">
          </div>

          <div class="col-md-7 col-sm-12 align-self-center box-post" data-popup-ref="monPopup" id='<?=$post['post']->getId()?>'>
            <div class="card-body">
              <h5 class="card-title">"<?=$post['post']->getName_post()?>"</h5>
              <p class="card-text"><?=$post['post']->getDescription()?> </p>
              <p class="card-text"> <?=$post['post']->getCreated()?>  <?=$post['post']->getLink()?></p>
            </div>
          </div>

      
          <div class="col-md-3 col-sm-12 align-self-center" id="like">
            <div class='like btnClick' id='<?=$post['post']->getId()?>'>
                 <div id='uplike'>
                
                <?php $verificationLike = $LikeManager->getOneLike($post['post']->getId(), $idUser);
                  $verificationLike = $LikeManager ->getOneLike($post['post']->getId(), $idUser);
                  $nbLikes = $LikeManager->getCountLike($post['post']->getId());
                  if (!$verificationLike){ ?>
                <div class="uplike ups" ><ion-icon name="caret-up-outline"></ion-icon> <p><?=$nbLikes['nb_likes'] ?></p></div>
                  <?php }else{ ?>
                <div class="uplike liked"> <ion-icon  name="caret-up-outline"></ion-icon> <p><?=$nbLikes['nb_likes'] ?></p></div>
                  <?php } ?>      
                        
                  </div>
                </div>
            </div>
          </div>
  
<?php }; endif;