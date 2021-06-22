<?php
session_start();
require_once(__DIR__."/../connexion/bdd.php");

 
if (isset($_POST['nickname']) && isset($_POST['password'])) {
 
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE nickname=:nickname");
    $stmt->bindParam("nickname", $nickname, PDO::PARAM_STR);
    $stmt->execute();
 
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if (!$result) {
        header("location: /login/login.php?error= Le nom d'utilisateur est incorrecte!");
    } 
    else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['id'] = $result['id'];
            $_SESSION['nickname'] = $result['nickname'];
            header('location: /index2.php?message=Salut '.$result['nickname'].' You are connected !');
        } else {
            header("location: /login/login.php?error=Le mot de passe ou le nom d'utilisateur est incorrecte!");
        }
    }
}
 
?>