<?php
include_once "../../database.php";
$db = new database();
$sortHeader = $_GET["sortHeader"];
$sortDirection = $_GET["sortDirection"];

if ($sortHeader == "ID") {
    $sortHeader = "ImportID";
} else if ($sortHeader == "Supplier") {
    $sortHeader = "SupplierName";
} else if ($sortHeader == "Date") {
    $sortHeader = "CreateTime";
} else if ($sortHeader == "Staff") {
    $sortHeader = "staff";
} else if ($sortHeader == "Total") {
    $sortHeader = "Total";
}

if ($sortDirection == "asc") {
    $sortDirection = "ASC";
} else {
    $sortDirection = "DESC";
}


$query =
    "
    SELECT import.ImportID, import.CreateTime, import.Total, CONCAT(staff.LastName, ' ', staff.FirstName) AS staff, supplier.SupplierName
    FROM import
    JOIN staff ON import.StaffID = staff.StaffID
    JOIN supplier ON import.SupplierID = supplier.SupplierID
    ORDER BY $sortHeader $sortDirection;
    ";

if ($results = $db->get_data($query)) {
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
