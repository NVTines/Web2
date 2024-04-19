<?php
if (isset($_GET['key'])) {
  $key = $_GET['key'];
  switch ($key) {
    case 'sp':
      echo
      '
      <div id="flat" style="background-color: rgba(0, 0, 0, 0.5); position: fixed; width: 100%; height: 100%; z-index: -1; display: none;"></div>
      <div id="clearfix_2" style="display: none; position: fixed; background-color: #f8f9fa; text-align: center; padding: 50px; left: 50%; top: 50%; transform: translate(-50%, -50%); z-index: 11; border-radius: 5%; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);">
          <div id="ttsp2"></div> 
          <div id="ttsp3" style="color: #343a40; font-size: 20px; margin-bottom: 20px;"></div> 
          <div id="ttsp" style="color: #343a40; font-size: 20px;"></div>
          <div style="color: #343a40; font-size: 20px; margin-top: 30px;">Chọn đối tượng muốn sửa:</div>
          <select style="font-size: 18px; margin-top: 10px;" id="choose" onchange="changetype()">
              <option value="">Choose</option>
              <option value="name">Name</option>
              <option value="img">Image</option>
              <option value="price">Price</option>
              <option value="brd">Brand</option>
          </select>
          <div id="capnhat" style="margin-top: 20px;"><input readonly style="height: 40px; padding: 0 10px; font-size: 18px; width: 100%;" type="text" id="change"/></div>
          <div id="confirm" style="margin-top: 20px;">
              <a href="#" style="background-color: #007bff; color: #fff; text-decoration: none; font-weight: bold; padding: 10px 20px; border-radius: 5px;" onclick="Fixproduct()">XÁC NHẬN</a>
              <a href="#" style="background-color: #6c757d; color: #fff; text-decoration: none; font-weight: bold; padding: 10px 20px; border-radius: 5px; margin-left: 10px;" onclick="cancelbox()">CANCEL</a>
          </div>
      </div>
      ';
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
