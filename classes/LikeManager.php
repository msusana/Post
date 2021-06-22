<?php


class LikeManager
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

//creation Tour Operator 
public function createLike($idPost, $idUser)
{ 

  var_dump($idPost, $idUser);
  $insertLike = $this->pdo->prepare('INSERT INTO likes(id_post, id_user) 
 VALUES(:id_post, :id_user)');
  $insertLike->bindValue(':id_post', $idPost, PDO::PARAM_INT);
  $insertLike->bindValue(':id_user', $idUser, PDO::PARAM_INT);
  $insertLike->execute();
  
  
}


/*****************************UPDATE************************************************************/

  /*****************************DELETE************************************************************/

  public function deleteLike($idPost, $idUser )
  { 
    $deleteLike = $this->pdo->prepare('DELETE FROM likes WHERE id_post = :id_post AND id_user = :id_user');
    $deleteLike->bindValue(':id_post', $idPost);
    $deleteLike->bindValue(':id_user', $idUser);
    $deleteLike->execute();
  }

  
  
  /*************************************** GET INFORMATIONS ************************************/ 
  
  public function getOneLike($idPost, $idUser)
   {
     
     
     $oneLike = $this->pdo->prepare('SELECT id FROM likes WHERE id_post = :id_post AND id_user = :id_user');
     $oneLike->bindValue(':id_post', $idPost);
     $oneLike->bindValue(':id_user', $idUser);
     $oneLike->execute();
     $like = $oneLike->fetch(PDO::FETCH_ASSOC);
     return $like;
  
     
   }

   public function getCountLike($idPost)
   {
     
     
     $countLike = $this->pdo->prepare('SELECT COUNT(*) AS nb_likes FROM likes WHERE id_post = :id_post');
     $countLike->bindValue(':id_post', $idPost ,PDO::PARAM_INT);
     $countLike->execute();
     $donneesLikes = $countLike->fetch(PDO::FETCH_ASSOC);
     return  $donneesLikes; 
     
   }

  

  
  
 
}