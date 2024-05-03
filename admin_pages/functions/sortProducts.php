<?php
include_once "../../database.php";
$db = new database();
$sortHeader = $_GET["sortHeader"];
$sortDirection = $_GET["sortDirection"];
if ($sortHeader == "ID") {
    $sortHeader = "ProductID";
} else if ($sortHeader == "Name") {
    $sortHeader = "ProductName";
} else if ($sortHeader == "Price") {
    $sortHeader = "Price";
} else if ($sortHeader == "Status") {
    $sortHeader = "status";
} else if ($sortHeader == "Brand") {
    $sortHeader = "ProducerName";
}

if ($sortDirection == "asc") {
    $sortDirection = "ASC";
} else {
    $sortDirection = "DESC";
}

$query =
    "
SELECT 
    product.ProductID AS ID,
    product.ProductName AS Name,
    producer.ProducerName AS Brand,
    product.IMG AS Img,
    product.status AS Status,
    product.ProductPrice AS Price
FROM 
    product
  JOIN producer ON product.ProducerID = producer.ProducerID
ORDER BY $sortHeader $sortDirection
";

$result = $db->get_data($query);
while ($row = mysqli_fetch_assoc($result)) {
    $encoded_image = base64_encode($row['Img']);
    $img = "<img src='data:image/jpg;base64,{$encoded_image}' style='width:80px;height:80px'/>";
    while ($row = $result->fetch_assoc()) {
        $encoded_image = base64_encode($row['Img']);
        $status = $row['Status'];
        if ($status == 'acti') {
            $status = '
            <td style="color:green;font-weight:bold;">ĐANG BÁN</td>';
        } else {
            $status = '<td style="color:red;font-weight:bold;">NGƯNG BÁN</td>';
        }
        $img = "<img src='data:image/jpg;base64,{$encoded_image}' style='width:80px;height:80px'/>";
        echo '
          <tr id="row_' . $row['ID'] . '">
            <td>' . $row['ID'] . '</td>
            <td>' . $row['Name'] . '</td>
            <td>' . $row['Brand'] . '</td>
            <td>' . $img . '</td>
            <td>' . "$" . $row['Price'] . '</td>
            ' .
            $status .
            '
            <td>
                  <a href="admin.php?key=sp&id=' . $row['ID'] . '">
                      <button class="info_btn" id="info_btn">
                          <i class="fa-solid fa-circle-info"></i>
                      </button>
                  </a>
                  <a onclick="thongbaobox(' . $row['ID'] . ');">
                      <button class="quit_btn" id="quit_btn">
                          <i class="fa-solid fa-trash"></i>
                      </button>
                  </a>
              </td>' .
            '</tr>';
    }
}
