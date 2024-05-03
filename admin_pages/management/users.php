<?php
$db = new Database();
$role = null;
if (isset($_SESSION['RoleID'])) {
  $role = $_SESSION['RoleID'];
} else {
  $role = 3;
  // $role = 1;
}
$query =
  "
  SELECT function.FunctionName
  FROM role
  JOIN roledetail ON role.RoleID = roledetail.RoleID
  JOIN function ON roledetail.FunctionID = function.FunctionID
  WHERE role.RoleID = '" . $role . "'";
echo
'
  <div id="boxtb"></div>
  <div id="shows">
';
if (isset($_GET["id"])) {
  require "management/userDetail.php";
} else if (isset($_GET["func"])) {
  require "management/userForm.php";
} else {
  echo
  '
  <div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ NGƯỜI DÙNG</div>
        ';
  if ($results = $db->get_data($query)) {
    while ($rows = $results->fetch_assoc()) {
      if ($rows["FunctionName"] == "Staff Management") {
        echo '<a href="admin.php?key=users&func=add" id="add-btn-supplier">THÊM NHÂN VIÊN</a>';
        break;
      }
    }
  }
  echo '
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
                  <th>Tên</th>
                  <th>Điện thoại</th>
                  <th>Email</th>
                  <th>Loại tài khoản</th>
                  <th>Trạng thái</th>
                  <th></th>
                </tr>
  ';
  $sql = "
  SELECT
  account.UserID,
  account.UserName,
  CASE
      WHEN customer.CustomerID IS NOT NULL THEN 'Customer'
      WHEN staff.StaffID IS NOT NULL THEN 'Staff'
      ELSE 'Admin'
  END AS Role,
  CONCAT(COALESCE(customer.CustomerSurname, staff.LastName), ' ', COALESCE(customer.CustomerName, staff.FirstName)) AS Fullname,
  COALESCE(customer.Phone, staff.Phone) AS Phone,
  account.Email,
  account.Enable AS Enable
  FROM
    account
  LEFT JOIN
    customer ON account.UserID = customer.UserID
  LEFT JOIN
    staff ON account.UserID = staff.UserID;
";
  if ($results = $db->get_data($sql)) {
    while ($rows = $results->fetch_assoc()) {
      if (str_contains($rows["UserName"], "admin")) {
        continue;
      }
      echo '
          <tr>
            <td>' . $rows["UserID"] . '</td>
            <td>' . $rows["UserName"] . '</td>
            <td>********</td>
            <td>' . $rows["Fullname"] . '</td>
            <td>' . $rows["Phone"] . '</td>
            <td>' . $rows["Email"] . '</td>';

      if ($rows["Role"] == "Admin") {
        echo '<td>Admin</td>';
      } elseif ($rows["Role"] == "Staff") {
        echo '<td>Nhân viên</td>';
      } else {
        echo '<td>Khách hàng</td>';
      }

      if ($rows["Enable"] == 1) {
        echo '<td style="color:green;font-weight:bold;">HOẠT ĐỘNG</td>';
      } else {
        echo '<td style="color:red;font-weight:bold;">KHÓA</td>';
      }

      if ($result = $db->get_data($query)) {
        while ($row = $result->fetch_assoc()) {
          if ($row["FunctionName"] == "Staff Management") {
            echo
            '<td>
              <a href="admin.php?key=users&role=' . $rows["Role"] . '&id=' . $rows["UserID"] . '">
                <button class="info_btn" id="info_btn">
                  <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                </button>
              </a>
            </td>
          </tr>';
            break;
          }
        }
      }
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
