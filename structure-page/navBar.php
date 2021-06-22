<div class="navBar">   
    <div class="bg-dark d-flex">
        <a class="navbar-brand m-3" href="/">
        <i class='fas fa-comments iconNavBar'style='font-size:48px;color:white'></i>
        </a>
 
            <div class="ms-auto mt-3 navBtn">

                <?php if (isset($_SESSION['nickname'])) { ?>
                    <a href="/recuperation-donnees/deco_login.php"><button class="btn btn-danger" type="button">LOG OUT</button></a>
                    <a href="/user/perfilUser.php"><button class="btn btn-success" type="button">ADD NEW POST</button></a>
                <?php } else { ?>
                    <a href="/login/login.php"><button class="btn btn-success" type="button">LOG IN</button></a>
                    <a href="/login/signup.php"><button class="btn btn-info" type="button">SIGN UP</button></a>
                <?php } ?>
            </div>
    </div>
            <div class="bg-dark d-flex justify-content-center pb-3 navForm">
                <form class="d-flex form" method="POST">
                    <input class="form-control me-2 search-post" type="search" name="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
</div>            
    

    <div class="overlayModalSearch" id="overlayModalSearch"></div>
        <div class="modalSearch" id="modalSearch">
            <div class='text-end'>  
                <button type="button" class="btn-close" aria-label="Close" id="closeBtnModalSearch"></button>
            </div>    
                <div class="row" id="post-list"></div>
        </div>