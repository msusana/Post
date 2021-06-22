<?php


class ReviewManager
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
//creation review 

public function createReview(Review $review)
{ 
  $insertReview = $this->pdo->prepare('INSERT INTO reviews(id_user, id_post, text_review) 
 VALUES(:id_user, :id_post,:text_review)');
  $insertReview->bindValue(':id_user', $review->getId_user(), PDO::PARAM_INT);
  $insertReview->bindValue(':id_post', $review->getId_post(), PDO::PARAM_INT);
  $insertReview->bindValue(':text_review', $review->getText_review(), PDO::PARAM_STR);
  $insertReview->execute();
  
}

/*****************************UPDATE************************************************************/



  /*****************************DELETE************************************************************/  
  //delete Review
  public function deleteReview($id)
  {
    $deleteReview = $this->pdo->prepare('DELETE FROM reviews WHERE id = :id');
    $deleteReview->bindValue(':id', $id, PDO::PARAM_INT);
    $deleteReview->execute();

    
  }
  
  /*************************************** GET INFORMATIONS ************************************/ 

 public function getAllReview()
 {
   $reviews = [];
   
   $allReviews = $this->pdo->prepare('SELECT * FROM  reviews');
   $allReviews->execute();
   
   while ($donneesReviews = $allReviews->fetch(PDO::FETCH_ASSOC))
   {
     array_push($reviews, new Review ($donneesReviews)); 
 
   }
   
   return $reviews;
 } 

 public function getAllReviewByPost($idPost)
 {
   $reviewsPost = [];
   
   $allReviewsPost = $this->pdo->prepare('SELECT * FROM  reviews WHERE id_post = :id_post');
   $allReviewsPost->bindValue(':id_post', $idPost, PDO::PARAM_INT);
   $allReviewsPost->execute();
   
   while ($donneesReviewsPost = $allReviewsPost->fetch(PDO::FETCH_ASSOC))
   {
     array_push($reviewsPost, new Review ($donneesReviewsPost)); 
 
   }
   
   return $reviewsPost;
 } 
}