<div class="nav">
    <img src="" class="brand-logo" alt="" />
    <div class="nav-items">
        <img onclick="goToMain()" src="img/image-removebg-preview.png" style="position: absolute;height:100px;left: 2%;cursor:pointer"/>
        <div class="search">
            <a href="index.php?page=shopping" style="width:600px;margin-right:-150px"><input type="text" id="search-box" placeholder="search brand , products"/></a>
            <a href="index.php?page=shopping"><button class="search-btn" style="width:100px">search</button></a>
        </div>
        
        <a href="index.php?page=urcart"><img src="img/cart.png" alt="" /></a>
        <?php
        if(!isset($_SESSION['RoleID'])){ 
            echo '<a id="login"><img src="img/user.png" alt="" onclick="dangnhap()"/></a>';
        }else if ((string)$_SESSION['RoleID']=="1"){
            echo '<a href="index.php?page=info" id="login"><img src="data:image/png;base64,'.$_SESSION['IMG'].'" alt=""/></a>';
        }else{
            echo 
            '<a class="admin-pages-btn" id="admin-pages-btn" href="admin_pages/admin.php"><i class="fa-solid fa-gear"></i></a>
            <a href="index.php?page=info" id="login"><img src="data:image/png;base64,'.$_SESSION['IMG'].'" alt=""/></a>';
        }
        ?>
        <a href="index.php?page=info">
            <div id="tkkh" style="color:#507199;margin-right:-50px;font-weight:bold;font-size:20px">
                <?php 
                    $username = isset($_SESSION['username'])?$_SESSION['username']:"";
                    echo '<p id="info-link">'.strtoupper($username).'</p>';
                ?>
            </div>
        </a>
    </div>
</div>
<ul class="links-container">
    <li class="link-item" ><a href="index.php" class="link" style="font-weight:bold;font-size:15px;margin-left:20px;margin-right:20px">HOME</a></li>
    <li class="link-item" ><a href="index.php?page=shopping" class="link" style="font-weight:bold;font-size:15px;margin-left:20px;margin-right:20px">STORE</a></li>
    <li class="link-item" ><a href="index.php?page=news" class="link" style="font-weight:bold;font-size:15px;margin-left:20px;margin-right:20px">NEWS</a></li>
    <li class="link-item" ><a href="index.php" class="link" style="font-weight:bold;font-size:15px;margin-left:20px;margin-right:20px">ABOUT</a></li>

</ul>