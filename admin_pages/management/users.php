<?php
$db = new Database();
if (isset($_GET["id"])) {
  require "management/userDetail.php";
} else if (isset($_GET["func"])) {
  require "management/importForm.php";
} else {
  echo '<div id="boxtb" style="background-color:white;height:-100px;width:500px;position:fixed;z-index:10;right:20%;display:flex">
</div>
<div id="shows">
  <div id="main">
    <div class="head">
      <div class="col-div-6">

        <span onclick="invinbox()"
          style="font-size: 30px; cursor: pointer; color: white"
          class="nav2"
          >&#9776;QUẢN LÝ NGƯỜI DÙNG</span>
      </div>

      <div class="clearfix"></div>
    </div>
  </div>
  <div class="col-div-8">
    <div class="box-8">
      <div class="content-box">
        <table id="showlist">
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th></th>
          </tr>';
  $sql = "
SELECT
  customer.CustomerID,
  account.UserName,
  CONCAT(customer.CustomerSurname, '', customer.CustomerName) AS Fullname,
  customer.Phone,
  account.Email,
  customer.Address
FROM customer
JOIN account ON customer.UserID = account.UserID;";
  if ($results = $db->get_data($sql)) {
    while ($rows = $results->fetch_assoc()) {
      echo '
          <tr>
            <td>' . $rows["CustomerID"] . '</td>
            <td>' . $rows["UserName"] . '</td>
            <td>********</td>
            <td>' . $rows["Fullname"] . '</td>
            <td>' . $rows["Phone"] . '</td>
            <td>' . $rows["Email"] . '</td>
            <td>' . $rows["Address"] . '</td>
            <td>
              <a href="admin.php?key=users&id=' . $rows["CustomerID"] . '">
                <button class="info_btn" id="info_btn">
                  <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                </button>
              </a>
            </td>
          </tr>';
    }
  }
  echo '
        </table>
      </div>
    </div>
  </div>
</div>
';
}
