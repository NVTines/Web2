<?php   
    if(isset($_SESSION['UserID'])){
        $loginCheck = true;
    }else{
        $loginCheck = false;
    }
    if(isset($_GET['page'])){
        $page_name = $_GET['page'];
        switch($page_name){
            case 'news':
                require "pages/news-content/news.php";
                break;
            case 'news1':
                require "pages/news-content/news1.php";
                break;
            case 'news2':
                require "pages/news-content/news2.php";
                break;
            case 'news3':
                require "pages/news-content/news3.php";
                break;
            case 'news7':
                require "pages/news-content/news7.php";
                break;
            case 'news8':
                require "pages/news-content/news8.php";
                break;
            case 'news9':
                require "pages/news-content/news9.php";
                break;
            case 'shopping':
                require "pages/shopping.php";
                break;
            case 'urcart':
                require "pages/cart.php";
                break;
            case 'info':
                if($loginCheck){
                    require "pages/info.php";
                }else{
                    require "pages/error.php";
                }
                break;
        }
    }else{
        echo '<div class="header">';
        require "pages/header.php";
        echo '</div><div class="row">'; 
        require "pages/content.php";
        echo '</div><div class="beforefooter" id="beforefooter">';
        require "pages/beforefooter.php";
        echo '</div>';
    }
?>
