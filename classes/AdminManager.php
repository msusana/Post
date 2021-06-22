<?php


class AdminManager
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
 public function createAdmin(Admin $admin)
 {  $password_hash = password_hash($admin->getPassword(),PASSWORD_BCRYPT);
    $insertAdmin = $this->pdo->prepare("INSERT INTO admin (firstname,lastname, password) 
    VALUES (:firstname,:lastname,:password)");
    $insertAdmin->bindValue(':firstname', $admin->getFirstname(),PDO::PARAM_STR);
    $insertAdmin->bindValue(':lastname', $admin->getLastname(), PDO::PARAM_STR);
    $insertAdmin->bindValue(':password', $password_hash);
    $insertAdmin->execute();

    return $insertAdmin;
   
 }
/*****************************UPDATE************************************************************/
//modifier les tourOperatorPremium 
  public function updateAdminOperator(Admin $admin, $newpassword)
  {
    $updatePasswordAdmin = $this->pdo->prepare('UPDATE admin SET  password = :password WHERE id = :id');
    $updatePasswordAdmin->bindValue(':id', $admin->getId(), PDO::PARAM_INT);
    $updatePasswordAdmin->bindValue(':password', $newpassword);
    
    $updatePasswordAdmin->execute();
    return $updatePasswordAdmin; 
  }

  /*****************************DELETE************************************************************/
  
  //delete Review
  public function deleteAdmin(Admin $admin)
  {
    $deleteAdmin = $this->pdo->prepare('DELETE FROM password WHERE id = :id');
    $deleteAdmin->bindValue(':id', $admin->getId(), PDO::PARAM_INT);
    $deleteAdmin->execute();
    return $deleteAdmin; 
  }
  
  /*************************************** GET INFORMATIONS ************************************/ 
  
  // List all Destination // 
  public function getAllAdmin()
  {
    $allAdmin = [];
    
    $allAdmin = $this->pdo->prepare('SELECT * FROM  admin');
    $allAdmin->execute();
    
    while ($donneesAllAdmin = $allAdmin->fetch(PDO::FETCH_ASSOC))
    {
      array_push($allAdmin, new Destination ($donneesAllAdmin)); 
  
    }
    
    return $allAdmin;
  }
  public function getAdmin(Admin $admin)
  {
        $statementAdmin = $this->pdo->prepare("SELECT * FROM admin WHERE firstname=:firstname AND lastname=:lastname");
        $statementAdmin->bindValue("firstname", $admin->getFirstname(), PDO::PARAM_STR);
        $statementAdmin->bindValue("lastname", $admin->getLastname(), PDO::PARAM_STR);
        $statementAdmin->execute(); 
        $statementAdmin->fetch(PDO::FETCH_ASSOC);
    
    return $statementAdmin;
  }
  public function verificationPassword(Admin $admin, $password)
  {
        $statementPassword = $this->pdo->prepare("SELECT password FROM admin WHERE firstname=:firstname AND lastname=:lastname");
        $statementPassword->bindValue("firstname", $admin->getFirstname(), PDO::PARAM_STR);
        $statementPassword->bindValue("lastname", $admin->getLastname(), PDO::PARAM_STR);
        $statementPassword->execute(); 
        $result=$statementPassword->fetchAll(PDO::FETCH_ASSOC);
        
    $password2=$result['0'];
    $pas=implode($password2);
    if (password_verify($password, $pas)) {
        return $password;
    }
   
       
  }
 
   
 
}