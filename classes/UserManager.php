<?php


class UserManager
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
 public function createUser(User $user)
 {  $password_hash = password_hash($user->getPassword(),PASSWORD_BCRYPT);
    $insertUser = $this->pdo->prepare("INSERT INTO user (nickname,password) 
    VALUES (:nickname,:password)");
    $insertUser->bindValue(':nickname', $user->getNickname(),PDO::PARAM_STR);
    $insertUser->bindValue(':password', $password_hash);
    $insertUser->execute();

    return $insertUser;
   
 }
/*****************************UPDATE************************************************************/
//
  public function updateUserPassword(User $user, $newpassword)
  {
    $updatePasswordUser = $this->pdo->prepare('UPDATE user SET  password = :password WHERE id = :id');
    $updatePasswordUser->bindValue(':id', $user->getId(), PDO::PARAM_INT);
    $updatePasswordUser->bindValue(':password', $newpassword);
    
    $updatePasswordUser->execute();
    return $updatePasswordUser; 
  }

  /*****************************DELETE************************************************************/
  
  
  public function deleteUser($idUser)
  {
    $deleteUser = $this->pdo->prepare('DELETE FROM user WHERE id = :id');
    $deleteUser->bindValue(':id', $idUser, PDO::PARAM_INT);
    $deleteUser->execute();
    return $deleteUser; 
  }
  
  /*************************************** GET INFORMATIONS ************************************/ 
  public function getUser($nickname)
  {
    
    $oneUser = $this->pdo->prepare('SELECT * FROM  user WHERE nickname = :nickname');
    $oneUser->bindValue(":nickname", $nickname, PDO::PARAM_STR);
    $oneUser->execute();
    $OneUser = $oneUser->fetch();
    
    return $OneUser;
  }
  public function getUserById($idUser)
  {
    
    $oneUser = $this->pdo->prepare('SELECT * FROM  user WHERE id = :id');
    $oneUser->bindValue(":id", $idUser, PDO::PARAM_INT);
    $oneUser->execute();
    $OneUser = $oneUser->fetch();
    
    return new User ($OneUser);
  }
  public function getAllUser()
  {
    $allUser = [];
    
    $allUser = $this->pdo->prepare('SELECT * FROM  user');
    $allUser->execute();
    
    while ($donneesAllUser = $allUser->fetch(PDO::FETCH_ASSOC))
    {
      array_push($allUser, new User ($donneesAllUser)); 
  
    }
    
    return $allUser;
  }
  
  public function verificationPassword(User $user, $password)
  {
        $statementPassword = $this->pdo->prepare("SELECT password FROM user WHERE nickname=:nickname");
        $statementPassword->bindValue("nickname", $user->getNickname(), PDO::PARAM_STR);
        $statementPassword->execute(); 
        $result=$statementPassword->fetchAll(PDO::FETCH_ASSOC);
        
    $password2=$result['0'];
    $pas=implode($password2);
    if (password_verify($password, $pas)) {
        return $password;
    }
   
       
  }
 
   
 
}