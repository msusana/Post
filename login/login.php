<?php
require_once(__DIR__."/../config/bdd.php");
include __DIR__."/../structure-page/head.php";?>

<body>
<?php 
if(!empty($_GET['error'])){
    echo '<div class="alert alert-danger " role="alert">'
    .$_GET['error']. 
    '</div>';
}
?> 

 
<div class = "d-flex justify-content-center">
     <div class='ingreser'>
    
    <form action='/treatment/user.php' method="POST">
        <label class='nickname' for='nickname'>Pseudo</label>
        <input type='text' id='nickname' class='form-control' name='nickname' required>
        <label class='password' for='password' >Password</label>
        <input type='password' id='password' class='form-control' name='password' required>
        <button class='btn btn-success mb-3' type="submit">Log In</button> </br> 
        <a href='/login/signup.php'>Create an Account Now</a>
    </form> 
   
    </div>

</div> 
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js' integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script> 
</body>    
</html>