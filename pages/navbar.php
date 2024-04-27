<style>
    #lblCartCount {
        border-radius:50%;
        font-size: 12px;
        font-weight:bold;
        background-color:crimson;
        color: #fff;
        padding: 4px 8px;
        vertical-align: top;
        margin-left: -10px; 
    }
</style>
<div class="nav" style="padding: 3px 10vw;display: flex;justify-content: space-between;">
    <img src="" class="brand-logo" alt="" />
    <div class="nav-items">
        <img onclick="goToMain()" src="img/image-removebg-preview.png" style="position: absolute;height:100px;left: 2%;cursor:pointer" />
      

        <a href="index.php?page=urcart">
            <img src="img/cart.png" alt="" />
            <span class='badge badge-warning' id='lblCartCount'>
                <?php 
                $cartCount=0;
                isset($_SESSION['cart'])?$cartCount=count($_SESSION['cart']):$cartCount=0;
                echo $cartCount; 
                ?>
            </span>
        </a>
        <?php
        if (!isset($_SESSION['RoleID'])) {
            echo '<a id="login"><img src="img/user.png" alt="" onclick="dangnhap()"/></a>';
        } else if ((string)$_SESSION['RoleID'] == "1") {
            echo '<a href="index.php?page=info" id="login"><img src="data:image/png;base64,' . $_SESSION['IMG'] . '" alt=""/></a>';
        } else {
            echo
            '<a class="admin-pages-btn" id="admin-pages-btn" href="admin_pages/admin.php"><i class="fa-solid fa-gear"></i></a>
            <a href="index.php?page=info" id="login"><img src="data:image/png;base64,' . $_SESSION['IMG'] . '" alt=""/></a>';
        }
        ?>
        <a href="index.php?page=info">
            <div id="tkkh" style="color:#507199;margin-right:-50px;font-weight:bold;font-size:20px">
                <?php
                $username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
                echo '<p id="info-link">' . strtoupper($username) . '</p>';
                ?>
            </div>
        </a>
    </div>
</div>
<ul class="links-container" style="width: 100%;display: flex;padding: 7px 10vw;justify-content: center;list-style: none;border-top: 1px solid #d1d1d1;border-bottom: 1px solid #d1d1d1;font-family:Arial, Helvetica, sans-serif;height:34px">
    <li class="link-item"><a href="index.php" class="link" style="font-weight:bold;font-size:15px;margin-left:20px;margin-right:20px">HOME</a></li>
    <li class="link-item"><a href="index.php?page=shopping" class="link" style="font-weight:bold;font-size:15px;margin-left:20px;margin-right:20px">STORE</a></li>
    <li class="link-item"><a href="index.php?page=news" class="link" style="font-weight:bold;font-size:15px;margin-left:20px;margin-right:20px">NEWS</a></li>
    <li class="link-item"><a href="index.php" class="link" style="font-weight:bold;font-size:15px;margin-left:20px;margin-right:20px">ABOUT</a></li>

</ul>