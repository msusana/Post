<?php


class PostManager
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
//creation destination 
public function createPost(Post $post)
 { 
   $insertPost = $this->pdo->prepare('INSERT INTO post(name_post, description, id_user, link) 
  VALUES(:name_post, :description, :id_user, :link)');
   $insertPost->bindValue(':name_post', $post->getName_post(),PDO::PARAM_STR);
   $insertPost->bindValue(':description', $post->getDescription(), PDO::PARAM_STR);
   $insertPost->bindValue(':id_user', $post-> getId_user(), PDO::PARAM_INT);
   $insertPost->bindValue(':link', $post->getLink(), PDO::PARAM_STR);
   $insertPost->execute();
   
   
 }

/*****************************UPDATE************************************************************/



  /*****************************DELETE************************************************************/

  //delete Destination
  public function deletePost($idPost)
  { 
    $deletePost = $this->pdo->prepare('DELETE FROM post WHERE id = :id');
    $deletePost->bindValue(':id', $idPost, PDO::PARAM_INT);
    $deletePost->execute();
  }
  
  
  /*************************************** GET INFORMATIONS ************************************/ 
  
  public function getAllPost()
  {
    $posts = [];
    
    $allPost = $this->pdo->prepare('SELECT * FROM  post');
    $allPost->execute();
    
    while ($donneesPost = $allPost->fetch(PDO::FETCH_ASSOC))
    {
      array_push($posts, new Post ($donneesPost)); 
  
    }
    
    return $posts;
  }
  
  public function getOnePost($idPost)
  {

  
    $onePost = $this->pdo->prepare('SELECT * FROM  post WHERE id = :id');
    $onePost->bindValue(':id', $idPost, PDO::PARAM_INT);
    $onePost->execute();
    $post =  $onePost-> fetch();
    
    return new Post($post);
  }
  
  
  public function getListPostByUser($idUser)
  {
    $listPostByUser = [];
    $allPostByUser = $this->pdo->prepare('SELECT * FROM  post 
    WHERE id_user = :id_user');
    $allPostByUser->bindValue(':id_user', $idUser ,PDO::PARAM_INT);
    $allPostByUser->execute();

    while ($donneesPostByUser = $allPostByUser->fetch(PDO::FETCH_ASSOC))
    {
      array_push($listPostByUser, new Post ($donneesPostByUser)); 
  
    }

    return $listPostByUser;
    

  }

  public function getPeersPostUser()
  {
    $AllPeers = [];
    
    $allPostUser = $this->pdo->prepare('SELECT post.*, user.nickname FROM  user 
    JOIN post ON user.id = post.id_user');
    $allPostUser->execute();
    
    while ($donneesAllPeers = $allPostUser->fetch(PDO::FETCH_ASSOC))
    { 
      $peer = [
      'post'=>new Post([
        'id'=>$donneesAllPeers['id'],
        'name_post'=>$donneesAllPeers['name_post'],
        'description'=>$donneesAllPeers['description'],
        'created'=>$donneesAllPeers['created'],
        'id_user'=>$donneesAllPeers['id_user'],
        'link'=>$donneesAllPeers['link'],
      ]),
      'user'=>new User([
        'id'=>$donneesAllPeers['id_user'],
        'nickname'=>$donneesAllPeers['nickname'],
      ])
      ];
      array_push($AllPeers, $peer); 
    }

    return $AllPeers;
  }

  public function getSearchPost(){


    $AllPostSearch = [];
    
    $allPost = $this->pdo->prepare('SELECT post.*, user.nickname FROM  user 
    JOIN post ON user.id = post.id_user');
    $allPost->execute();
    
    while ($donneesAllPost = $allPost->fetch(PDO::FETCH_ASSOC))
    { 
      $peer = [
        'id'=>$donneesAllPost['id'],
        'name_post'=>$donneesAllPost['name_post'],
        'description'=>$donneesAllPost['description'],
        'created'=>$donneesAllPost['created'],
        'id_user'=>$donneesAllPost['id_user'],
        'link'=>$donneesAllPost['link'],
        'idUser'=>$donneesAllPost['id_user'],
        'nickname'=>$donneesAllPost['nickname'],
      ];
      array_push($AllPostSearch, $peer); 
    }

    return $AllPostSearch;

 
  }
}