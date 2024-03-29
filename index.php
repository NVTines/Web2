<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="css/Project.css">
    <link rel="stylesheet" type="text/css" href="css/cart.css">
    <meta charset="utf-8" />
    <title>Untitled Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="./vendor/js/Magnific-Popup-master/magnific-popup.css" />
    <script src="https://kit.fontawesome.com/54a12c09af.js" crossorigin="anonymous"></script>
    <script src="js/Project.js"></script>
</head>

<body>
    <script>
        window.onload=function(){
            slider();
            createAdmin();
            hideTK();        
        }
    </script>
    <form>
        <div id="logbox_0" style="position:fixed;opacity:0;z-index:-1;width:100%;height:100%;background-color:black"></div>
    </form>
    <form>
        <div id="logbox">
            <?php require 'pages/login.php'?>
        </div>
    </form>
    <form>
        <div id="logbox_2">
            <?php require 'pages/register.php'?>
        </div>
    </form>
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