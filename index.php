<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8" />
    <title>MBKT Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

    <link rel="stylesheet" type="text/css" href="css/Project.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/cart.css"> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
    <script src="https://kit.fontawesome.com/54a12c09af.js" crossorigin="anonymous"></script>
    <script src="js/Project.js"></script>
</head>

<body>
    <?php 
        include "database.php";
        // session_set_cookie_params(1800);
        session_start();
        
    ?>
    <script>
        window.onload=function(){
            slider();      
        }
    </script>
    <div id="logbox_0" style="position:fixed;opacity:0;z-index:-1;width:100%;height:100%;background-color:black"></div>
    <div id="logbox" style="overflow:auto;">
        <?php require 'pages/login.php'?>
    </div>
    <div id="logbox_2" style="overflow:auto;">
        <?php require 'pages/register.php'?>
    </div>
    <div id="wrapper">
        <div class="P-navbar">
            <?php require "pages/navbar.php"?>
        </div>

        <div class="content-wrapper" id="content-wrapper" style="background-color:whitesmoke;">
            <?php require "pages/content-wrapper.php"?>;
        </div>

        <footer id="footer">
            <?php require "pages/footer.php"; ?>
        </footer>
    </div>
</body>

</html>