<?php
session_start();
include '../config/bdd.php';
include '../config/autoload.php';

$UserManager =new UserManager($pdo); 
 
if (isset($_POST['nickname']) && isset($_POST['password'])&& empty($_POST['password2'])) {
$newUser = new User(['nickname'=>$_POST['nickname'],'password'=>$_POST['password']]);
$verificationNameUser =  $UserManager->getUser($newUser->getNickname()); 
if (!$verificationNameUser) {
    header("location:../login/login.php?error= The nickname is incorrect");
} 
else {
    $verificationPassword = $UserManager->verificationPassword($newUser, $_POST['password']); 
  
    if ($verificationPassword) {
        $_SESSION['nickname'] = $_POST['nickname'];
        header('location:../index.php?message=Salut '.$_POST['nickname'].' You are connected !');
        
    } else {
        header("location:../login/login.php?error= The password or the nickname is incorrect!");
    }
    }
   
}

else if(isset($_POST['nickname']) && isset($_POST['password'])&&isset($_POST['password2'])){
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password!= $password2) {
        header("location:../login/signup.php?error= Passwords do not match, try again!");
    }else{
        $newUser = new User(["nickname"=>$_POST['nickname'], "password"=>$_POST['password']]);
        $verificationNameUser =  $UserManager->getUser($_POST['nickname']); 
        if ( $verificationNameUser > 0) {
            header("location:../login/signup.php?error= the nickname already exists");
        }
        else{
            $creationUser =  $UserManager->createUser($newUser); 
        }
           

            if ($creationUser) {
                $_SESSION['nickname'] = $_POST['nickname'];
                header('location:../index.php?message= Hello '.$_POST['nickname'].' You are connected !');

            } else {
                header("location:../login/login.php?error= Something went wrong please try again");
        }
    }  
}


 
?>