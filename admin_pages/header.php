<?php
    echo '<div id="nav" class="sidenav">
      <a href="../index.php">
          <p class="logo"><span>M</span>BKT SHOP</p>
      </a>';
    $dtb = new database();
    $query = "SELECT * FROM roledetail WHERE RoleID='".$_SESSION["RoleID"]."'";
    if($results=$dtb->get_data($query)){
      while($row = $results->fetch_assoc()){
        switch($row["FunctionID"]){
          case 1:
            $_SESSION["function1"]=True;
            echo '<a href="admin.php?key=stt" class="icon-a"><i class="fa fa-dashboard icons"></i>&nbsp;&nbsp;DASHBOARD</a>';
            break;
          case 2:
            $_SESSION["function2"]=True;
            echo '<a href="admin.php?key=ncc" class="icon-a"><i class="fa-solid fa-truck-fast"></i>&nbsp;&nbsp;NHÀ CUNG CẤP</a>';
            break;
          case 3:
            $_SESSION["function3"]=True;
            echo '<a href="admin.php?key=sp" class="icon-a"><i class="fa-solid fa-warehouse"></i>&nbsp;&nbsp;KHO</a>';
            break;
          case 4:
            $_SESSION["function4"]=True;
            echo '<a href="admin.php?key=users" class="icon-a"><i class="fa fa-users icons"></i>&nbsp;&nbsp;NGƯỜI DÙNG</a>';
            break;
          case 5:
            $_SESSION["function5"]=True;
            echo '<a href="admin.php?key=q" class="icon-a"><i class="fa-solid fa-list-check"></i>&nbsp;&nbsp;QUYỀN</a>';
            break;
          case 6:
            $_SESSION["function6"]=True;
            echo '<a href="admin.php?key=nh" class="icon-a"><i class="fa-solid fa-boxes-stacked"></i>&nbsp;&nbsp;NHẬP HÀNG</a>';
            break;
          case 7:
            $_SESSION["function7"]=True;
            echo '<a href="admin.php?key=dh" class="icon-a"><i class="fa fa-shopping-bag icons"></i>&nbsp;&nbsp;ĐƠN HÀNG</a>';
            break;
        }
      }
      $dtb->close_dtb();    
    }
    echo '</div>';
?>