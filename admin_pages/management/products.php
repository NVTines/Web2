<?php
$db = new database();
$query = "SELECT 
  product.ProductID AS ID,
  product.ProductName AS Name,
  producer.ProducerName AS Brand,
  product.IMG AS Img,
  product.Quantity,
  product.status,
  product.ProductPrice AS Price
  FROM 
	product
  JOIN 
  producer 
  ON 
  product.ProducerID = producer.ProducerID
  WHERE product.status = 'acti'
  ";
$result = $db->get_data($query);

echo
'<div id="boxtb" style="background-color:white;height:-100px;width:350px;position:fixed;z-index:10;right:0">
    </div>
    <div id="shows">
      <div id="main">
        <div class="head">
          <div class="col-div-6">
            <span class="nav2" onclick="invinbox()" style="font-size: 30px; cursor: pointer; color: white">
              &#9776;   QUẢN LÝ SẢN PHẨM
            </span>
          </div>
          <div class="col-div-6">
          <button title="Nhập sản phẩm" class="add-product-button">
          <ion-icon name="download-outline"></ion-icon>
          </button> 
          <button title="Thêm sản phẩm mới" class="add-product-button">
          <ion-icon name="add-circle-outline"></ion-icon>
          </button>
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
                <th>Name</th>
                <th>Brand</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Status</th>
                <th></th>
              </tr>';

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $encoded_image = base64_encode($row['Img']);
    $status = $row['status'];
    if ($status == 'acti') {
      $status = 'Active';
    } else {
      $status = 'Hidden';
    }
    $img = "<img src='data:image/jpg;base64,{$encoded_image}' style='width:80px;height:80px'/>";
    echo '
      <tr id="row_' . $row['ID'] . '">
        <td>' . $row['ID'] . '</td>
        <td>' . $row['Name'] . '</td>
        <td>' . $row['Brand'] . '</td>
        <td>' . $img . '</td>
        <td>' . "$" . $row['Price'] . '</td>
        <td>' . $row['Quantity'] . '</td>
        <td>' . $status . '</td>
        <td>
          <button class="delete" onclick="thongbaobox(' . $row['ID']  . ')">Xóa</button>
          <button class="modify" onclick="hideFixSP()">Sửa</button>
        </td>
      </tr>';
  }
}
echo '
        </table>
       </div>
      </div>
    </div>
  </div>';