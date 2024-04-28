<?php
$id = $_GET["id"];
$sql = "
SELECT 
importdetail.ProductID,
product.ProductName,
importdetail.Unitprice,
size.value AS Size,
importdetail.Unitprice,
importdetail.Quantity,
importdetail.Unitprice * importdetail.Quantity AS Amount
FROM importdetail
JOIN product on importdetail.ProductID = product.ProductID
JOIN size on importdetail.SizeID = size.SizeID
WHERE ImportID = '$id'
";

$getTotal = "
SELECT SUM(Unitprice * Quantity) AS Total
FROM importdetail
WHERE ImportID = '$id';
";

echo
'
<div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ NHẬP HÀNG</div>
        <a href="admin.php?key=nh" class="back-btn">QUAY LẠI</a>
    </div>
</div>
<div class="col-div-8">
    <div class="box-8" ">
        <h2 style="color:white; margin-left: 18px">CHI TIẾT ĐƠN NHẬP HÀNG SỐ ' . $id . '</h2>
        <div class="box-8-body">
        <table class="table-fill">
            <thead>
            <tr>
                <th class="text-left">Mã sản phẩm</th>
                <th class="text-left">Tên sản phẩm</th>
                <th class="text-left">Size</th>
                <th class="text-left">Giá nhập</th>
                <th class="text-left">Số lượng</th>
                <th style="text-align:right; padding-right:70px">Thành tiền</th>
            </tr>
            </thead>
            <tbody class="table-hover">
    ';
if ($results = $db->get_data($sql)) {
    while ($rows = $results->fetch_assoc()) {
        echo
        '<tr>
            <td>' . $rows["ProductID"] . '</td>
            <td>' . $rows["ProductName"] . '</td>
            <td>' . $rows["Size"] . '</td>
            <td>' . "$" . $rows["Unitprice"] . '</td>
            <td>' . $rows["Quantity"] . '</td>
            <td style="text-align:right; padding-right:70px">' . "$" . $rows["Amount"] . '</td>
        </tr>';
    }
}
$results = $db->get_data($getTotal);
$row = $results->fetch_assoc();
echo '</tbody>';
echo '</table>';
echo
'
<h3 style="color:white;text-align:right; margin-right:65px">Tổng tiền: $' . $row["Total"] . '</h3>
';
echo '</div>';
