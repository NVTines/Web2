<?php
include_once "../../database.php";
$db = new database();
$sortHeader = $_GET["sortHeader"];
$sortDirection = $_GET["sortDirection"];

switch ($sortHeader) {
    case 'ID':
        $sortHeader = "UserID";
        break;
    case 'Name':
        $sortHeader = "Fullname";
        break;
    case 'Role':
        $sortHeader = "Role";
        break;
    case 'Status':
        $sortHeader = "Enable";
        break;
}

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
    staff ON account.UserID = staff.UserID
  ORDER by $sortHeader $sortDirection
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
