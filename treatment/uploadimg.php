<?php

function uploadImage(){

    if(isset($_FILES["photo_link"]) && $_FILES["photo_link"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo_link"]["name"];
        $filetype = $_FILES["photo_link"]["type"];
        $filesize = $_FILES["photo_link"]["size"];
        
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Erreur : .");
        header("location: ../user/profilUser.php?error= Please select a valid file format.");
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize);
        header("location: ../user/profilUser.php?error= The file size is larger than the allowed limit.");
        if(in_array($filetype, $allowed)){
    
            if(file_exists(__DIR__."/../images/" . $_FILES["photo_link"]["name"])){
                header("Location: ../user/profilUser.php?error=".$_FILES["photo_link"]["name"] . " already exists.");
            } else{
                move_uploaded_file($_FILES["photo_link"]["tmp_name"], __DIR__."/../images/" . $_FILES["photo_link"]["name"]);
                $path = __DIR__."/../images/" . $_FILES['photo_link']['name'];
            } 
               
        }
    } 
}
