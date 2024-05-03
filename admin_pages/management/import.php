<?php
$db = new database();
$sql = "
SELECT import.ImportID, import.CreateTime, import.Total, CONCAT(staff.LastName, ' ', staff.FirstName) AS staff, supplier.SupplierName
FROM import
JOIN staff ON import.StaffID = staff.StaffID
JOIN supplier ON import.SupplierID = supplier.SupplierID
ORDER BY CreateTime DESC;
";

echo
'<div id="boxtb">
  </div>
  <div id="shows">';
if (isset($_GET["id"])) {
    require "management/importDetail.php";
} else if (isset($_GET["func"])) {
    require "management/importForm.php";
} else {
    echo
    '
    <div class="col-div-8" style="margin:20px 0px;">
        <div class="box-8">
          <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ NHẬP HÀNG</div>
          <a href="admin.php?key=nh&func=add" id="add-btn-supplier">NHẬP HÀNG</a>
        </div>
      </div>
    <div class="col-div-8">
        <div class="box-8">
            <div class="box-8-body">
            <table class="table-fill">
                <thead>
                <tr>
                    <th class="text-left">Mã nhập hàng</th>
                    <th class="text-left">Nhà cung cấp</th>
                    <th class="text-left">Ngày nhập</th>
                    <th class="text-left">Nhân viên nhập</th>
                    <th class="text-left">Tổng tiền</th>
                    <th class="text-left"></th>
                </tr>
                </thead>
                <tbody class="table-hover">
    ';
    if ($results = $db->get_data($sql)) {
        while ($rows = $results->fetch_assoc()) {
            echo
            '<tr>
                <td>' . $rows["ImportID"] . '</td>
                <td>' . $rows["SupplierName"] . '</td>
                <td>' . $rows["CreateTime"] . '</td>
                <td>' . $rows["staff"] . '</td>
                <td>' . "$" . $rows["Total"] . '</td>
                <td>
                    <a href="admin.php?key=nh&id=' . $rows["ImportID"] . '">
                        <button class="info_btn" id="info_btn">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>
                    </a>
            </tr>';
        }
    }
    echo '</tbody>
    </table>
    </div>
    </div>
    </div>';
}
echo '</div>';
