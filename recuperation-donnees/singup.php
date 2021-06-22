<?php
session_start();
require __DIR__."/../connexion/bdd.php";

if (isset($_POST['nickname']) && isset($_POST['password'])){
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    checkPasswords($pdo ,$password, $password2, $password_hash, $nickname);
}

function checkPasswords($pdo, $password, $password2, $password_hash, $nickname) {
    if ($password!= $password2) {
        header("location: /login/singup.php?error=Les mots de passe ne correspondent pas, réessayez!");
    }else {

        $stmt = $pdo->prepare("SELECT * FROM user WHERE nickname=:nickname");
        $stmt->bindParam("nickname", $nickname, PDO::PARAM_STR);
        $stmt->execute(); 
    
        if ($stmt->rowCount() > 0) {
             header("location: /login/singup.php?error=Le pseudo existe déjà");
        }
        else{
            $stmt = $pdo->prepare("INSERT INTO user (nickname, password) VALUES (?,?)");
            $result = $stmt->execute([
                $nickname,
                $password_hash
            ]);
    
            if ($result) {
                $stmt1 = $pdo->prepare("SELECT * FROM user WHERE nickname=:nickname");
                $stmt1->bindParam("nickname", $nickname, PDO::PARAM_STR);
                $stmt1->execute(); 
                $stmt3 = $stmt1->fetch();
                $_SESSION['id'] = $stmt3['id'];
                $_SESSION['nickname'] = $stmt3['nickname'];
                var_dump($stmt3);
                header("location: /login/login.php?success=Votre inscription a réussi!");
        
            } else {
                header("location: /login/singup.php?error=Un problème est survenu!");
        }
    }  }
}
  
?>