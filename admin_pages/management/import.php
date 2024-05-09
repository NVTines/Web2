<script>
    // Function to sort data by ajax
    function sortData() {
        var sortHeader = document.getElementById("sort-header").value;
        var sortDirection = document.querySelector('input[name="sort-direction"]:checked').value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("showlist").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "functions/sortImports.php?sortHeader=" + sortHeader + "&sortDirection=" + sortDirection, true);
        xhttp.send();
    }
</script>
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
          <div class="manage-name-btn" onclick="invinbox()">&#9776; QUẢN LÝ NHẬP HÀNG</div>
          <a href="admin.php?key=nh&func=add" id="add-btn-supplier">NHẬP HÀNG</a>
        </div>
      </div>
    <div class="col-div-8">
        <div class="box-8">
            <div class="box-8-body">
            <table class="table-fill">
                <thead>
                    <tr>
                        <td colspan="6">
                        <div class="sort-section">
                            <div class="sort-options">
                                <label for="sort-header">Sắp xếp theo:</label>
                                <select id="sort-header" name="sort-header">
                                    <option value="ID">ID</option>
                                    <option value="Supplier">Nhà cung cấp</option>
                                    <option value="Date">Ngày nhập</option>
                                    <option value="Staff">Nhân viên</option>
                                    <option value="Total">Tổng tiền</option>
                                </select>
                            </div>
                    
                            <div class="sort-options">
                                <label for="sort-direction">Chiều sắp xếp:</label>
                                <input type="radio" id="sort-asc" name="sort-direction" value="asc" checked>
                                <label for="sort-asc">Tăng dần</label>
                                <input type="radio" id="sort-desc" name="sort-direction" value="desc">
                                <label for="sort-desc">Giảm dần</label>
                            </div>
                    
                            <div class="sort-options">
                                <button id="sort-button" onclick="sortData()">Sắp xếp</button>
                                <button id="refresh-button" onclick="refreshData()">Refresh</button>
                            </div>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left">Mã nhập hàng</th>
                        <th class="text-left">Nhà cung cấp</th>
                        <th class="text-left">Ngày nhập</th>
                        <th class="text-left">Nhân viên nhập</th>
                        <th class="text-left">Tổng tiền</th>
                        <th class="text-left"></th>
                    </tr>
                </thead>
                <tbody id="showlist" class="table-hover">
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
