<?php 
include __DIR__.'/../config/bdd.php';
include __DIR__.'/../config/autoload.php';
include __DIR__.'/../treatment/uploadimg.php';

$PostManager= new PostManager($pdo);
$ReviewManager = new ReviewManager($pdo);
$ImageManager = new ImageManager($pdo);



// Create Post
if(isset($_POST['name_post']) && isset($_POST['description']) && isset($_POST['id_user'])){
    
    $newPost= new Post(['name_post'=> $_POST['name_post'], 'description'=>$_POST['description'], 'id_user'=>$_POST['id_user'], 'link' => $_POST['link']=='null'? null:$_POST['link']]);
    $PostManager->createPost($newPost);
    $id = $pdo->lastInsertId();

    if(isset($_FILES["photo_link1"]) && $_FILES["photo_link1"]["error"] == 0){

        $filename1 = $_FILES["photo_link1"]["name"];
        $filetype1 = $_FILES["photo_link1"]["type"];
        $filesize1 = $_FILES["photo_link1"]["size"];
        $filetmp1 = $_FILES["photo_link1"]["tmp_name"];
        uploadimg($filename1, $filetype1, $filesize1, $filetmp1); 
        $image = new Image(["photo_link"=>"/images/" .$_FILES["photo_link1"]["name"] ,"id_post" =>$id]);
        $ImageManager->createPhotoLink($image);
    }

    if(isset($_FILES["photo_link2"]) && $_FILES["photo_link2"]["error"] == 0){

        $filename2 = $_FILES["photo_link2"]["name"];
        $filetype2 = $_FILES["photo_link2"]["type"];
        $filesize2 = $_FILES["photo_link2"]["size"];
        $filetmp2 = $_FILES["photo_link2"]["tmp_name"];
        uploadimg($filename2, $filetype2, $filesize2, $filetmp2); 
        $image = new Image(["photo_link"=>"/images/" .$_FILES["photo_link2"]["name"] ,"id_post" =>$id]);
        $ImageManager->createPhotoLink($image);
    }
    if(isset($_FILES["photo_link3"]) && $_FILES["photo_link3"]["error"] == 0){

        $filename3 = $_FILES["photo_link3"]["name"];
        $filetype3 = $_FILES["photo_link3"]["type"];
        $filesize3 = $_FILES["photo_link3"]["size"];
        $filetmp3 = $_FILES["photo_link3"]["tmp_name"];
        uploadimg($filename3, $filetype3, $filesize3, $filetmp3); 
        $image = new Image(["photo_link"=>"/images/" .$_FILES["photo_link3"]["name"] ,"id_post" =>$id]);
        $ImageManager->createPhotoLink($image);
    }   
    
    header("location: ../user/perfilUser.php?message= New Post created");
}

function uploadimg($filename, $filetype, $filesize, $filetmp){

   $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)){
        header("location: ../user/perfilUser.php?error= Please select a valid file format.");
    }
    $maxsize = 5 * 1024 * 1024;
    if($filesize > $maxsize){
        header("location: ../user/perfilUser.php?error= The file size is larger than the allowed limit.");
    }
    if(in_array($filetype, $allowed)){

        if(file_exists(__DIR__."/../images/" . $filename)){
            header("Location: ../user/perfilUser.php?error=".$filename . " already exists.");
        } else{
            move_uploaded_file($filetmp, __DIR__."/../images/" . $filename);
            $path = __DIR__."./../images/" . $filename; 
        } 
           
    }
}
