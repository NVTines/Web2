<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="css/Project.css">
    <link rel="stylesheet" type="text/css" href="css/cart.css">
    <meta charset="utf-8" />
    <title>MBKT Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
    <script src="https://kit.fontawesome.com/54a12c09af.js" crossorigin="anonymous"></script>
    <script src="js/Project.js"></script>
</head>

<body>
    <script>
        window.onload=function(){
            slider();
            //createAdmin();
            //hideTK();        
        }
    </script>
    <div id="logbox_0" style="position:fixed;opacity:0;z-index:-1;width:100%;height:100%;background-color:black"></div>
    <div id="logbox">
        <?php require 'pages/login.php'?>
    </div>
    <div id="logbox_2">
        <?php require 'pages/register.php'?>
    </div>
    <div id="wrapper">
        <nav class="navbar">
            <?php require "pages/navbar.php"?>
        </nav>

        <div class="content-wrapper" id="content-wrapper">
            <?php require "pages/content-wrapper.php"?>;
        </div>

        <footer id="footer">
            <?php require "pages/footer.php"; ?>
        </footer>
    </div>
</body>

</html>