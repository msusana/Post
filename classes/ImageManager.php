<?php
class ImageManager
{
  private $pdo;

  public function __construct(PDO $pdo)
  {
    $this->setPdo($pdo);
  }
  public function getPdo(){
      return $this->pdo; 
  }
  public function setPdo($pdo){
      $this->pdo = $pdo; 
  }

  /*******************************CREATE*********************************************************/

  public function createPhotoLink(Image $image)
 { 
   $insertPhotoLink = $this->pdo->prepare('INSERT INTO photos(photo_link,id_post) 
  VALUES(:photo_link, :id_post)');
   $insertPhotoLink->bindValue(':photo_link', $image->getPhoto_Link(),PDO::PARAM_STR);
   $insertPhotoLink->bindValue(':id_post', $image->getIdPost(), PDO::PARAM_INT);
   $insertPhotoLink->execute();
   }
     /*****************************DELETE************************************************************/
  public function deleteImage($id)
  { 
     
    $deletePhoto = $this->pdo->prepare('DELETE FROM photos WHERE id = :id');
    $deletePhoto->bindValue(':id', $id, PDO::PARAM_INT);
    $deletePhoto->execute();


  }

     /*************************************** GET INFORMATIONS ************************************/ 
     // List image by destination // 
  public function getPhotoByIdPost($idPost)
  {
    $ImageByPost = [];
    
    $allgetImageByPost = $this->pdo->prepare('SELECT * FROM  photos
    WHERE id_post = :id_post ');
    $allgetImageByPost->bindValue(':id_post', $idPost ,PDO::PARAM_INT);
    $allgetImageByPost->execute();
    
    while ($donneesImageByPost = $allgetImageByPost->fetch(PDO::FETCH_ASSOC))
    {
      array_push($ImageByPost, new Image ($donneesImageByPost)); 
  
    }

    return $ImageByPost;
  }
}