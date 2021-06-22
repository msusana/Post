<?php 

$allPost = $PostManager->getPeersPostUser();


foreach($allPost as $post){ ?>   

<div class="card mb-3 produit">
  <div class="row">  
      <div class="col-md-2 col-sm-12 align-self-center">
      <div class="carousel2 owl-carousel">
<?php    $allPhotos = $ImageManager->getPhotoByIdPost($post['post']->getId());
foreach($allPhotos as $image){ ?>
                   <img class='mt-1 mb-1 w-100 h-100' src="<?= $image->getPhoto_Link() ?>" >
                        <?php } ; ?>
                    </div>
      </div>
          <?php if($_SESSION): ?>
          <div class="col-md-7 col-sm-12 align-self-center box-post" data-popup-ref= <?php if($_SESSION): echo '"monPopup"'; endif?> id='<?= $post["post"]->getId()?>'>
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
          <?php else :?>
            <div class="col-md-7 col-sm-12 align-self-center box-post" onClick="alert('You must be connected to see this post');" >
            <div class="card-body">
              <h5 class="card-title">"<?=$post['post']->getName_post()?>"</h5>
              <p class="card-text"><?=$post['post']->getDescription()?> </p>
              <p class="card-text"> <?=$post['post']->getCreated()?>  <?=$post['post']->getLink()?></p>
            </div>
          </div>

          <div class="col-md-3 col-sm-12 align-self-center" id="like">
            <div class='btnClick' id='<?=$post['post']->getId()?>'>
            <?php $nbLikes = $LikeManager->getCountLike($post['post']->getId()); ?>
                 <div id='uplike' onClick="alert('You must be connected to like this post');" >
                    <div class="uplike ups" ><ion-icon name="caret-up-outline"></ion-icon> <p><?=$nbLikes['nb_likes'] ?></p></div>      
                  </div>
                </div>
            </div>
            <?php endif?>
          </div>
  </div>

<?php } ?>
<div class="popup" data-popup-id="monPopup">
  <div class="popup-content">
    <?php include 'content_modal.php'?>
  </div>
</div>


