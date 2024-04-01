<?php
    if (isset($_GET['key'])) {
        $key = $_GET['key'];
        switch($key){
            case 'sp':
                echo '<div id="flat" style="background-color:black;position:fixed;width:100%;height:100%;opacity:0.5;z-index:-1;display:none"></div>
                <div id="clearfix_2" style="display:none;position:fixed;background-color:gray;text-align: center;padding:50px;left:40%;top: 30%;z-index:11;border-radius:20%">
                <div id="ttsp2"></div> 
                <div id="ttsp3"  style="color: white; font-size: 20px;"></div> 
                <div id="ttsp" style="color: white; font-size: 20px;"></div>
                <div style="color: white; font-size: 20px;margin-top:30px">Chọn đối tượng muốn sửa:</div>
                <select style="font-size: 18px;" id="choose" onchange="changetype()">
                  <option value="">Choose</option>
                  <option value="name">Name</option>
                  <option value="img">Image</option>
                  <option value="price">Price</option>
                  <option value="brd">Brand</option>
                </select>
                <div id="capnhat"><input readonly style="height:20px" type="text" id="change"/></div>
                <div id="confirm" style="margin-top:20px"><a href="#" style="float: left;background-color:white;text-decoration: none;font-weight:bold;padding:10px;" onclick="Fixproduct()">XÁC NHẬN</a><a href="#" style="background-color:white;text-decoration: none;font-weight:bold;padding:10px;float:right" onclick="cancelbox()">CANCEL</a></div>
                </div>';
                break;

        }
    }
    echo '<div id="nav" class="sidenav">
      <a href="../index.php">
          <p class="logo"><span>M</span>BKT SHOP</p>
      </a>
      <a href="admin.php" class="icon-a"><i class="fa fa-dashboard icons"></i>&nbsp;&nbsp;DASHBOARD</a>
      <a href="admin.php?key=users" class="icon-a"><i class="fa fa-users icons"></i>&nbsp;&nbsp;NGƯỜI DÙNG</a>
      <a href="admin.php?key=sp" class="icon-a"><i class="fa-solid fa-warehouse"></i>&nbsp;&nbsp;KHO</a>
      <a href="admin.php?key=dh" class="icon-a"><i class="fa fa-shopping-bag icons"></i>&nbsp;&nbsp;ĐƠN HÀNG</a>
      <a href="admin.php?key=nh" class="icon-a"><i class="fa-solid fa-boxes-stacked"></i>&nbsp;&nbsp;NHẬP HÀNG</a>
      <a href="admin.php?key=ncc" class="icon-a"><i class="fa-solid fa-truck-fast"></i>&nbsp;&nbsp;NHÀ CUNG CẤP</a>
      <a href="admin.php?key=q" class="icon-a"><i class="fa-solid fa-list-check"></i>&nbsp;&nbsp;QUYỀN</a>
    </div>';
?>