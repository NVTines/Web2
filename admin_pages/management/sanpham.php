<?php
global $db;
showProducts();
function showProducts()
{
  $db = new database();
  $query = "SELECT 
  product.ProductID AS ID,
  product.ProductName AS Name,
  producer.ProducerName AS Brand,
  product.IMG AS Img,
  product.Quantity AS Amount,
  product.ProductPrice AS Price
FROM 
	product
JOIN 
  producer 
ON 
  product.ProducerID = producer.ProducerID;
";
  $result = $db->get_data($query);

  echo
  '<div id="boxtb" style="background-color:white;height:-100px;width:500px;position:fixed;z-index:10;right:20%;display:flex">
    </div>
    <div id="shows">
      <div id="main">
        <div class="head">
          <div class="col-div-6">
            <span  onclick="invinbox()"
              style="font-size: 30px; cursor: pointer; color: white"
              class="nav2"
              >&#9776;QUẢN LÝ SẢN PHẨM</span
            >
          </div>
          <div class="col-div-6">
            <div class="profile">
              <img src="user.png" class="pro-img" />
              <p class="profile">MBKT<span>DESIGNER</span></p>
            </div>
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
                <th>Img</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Action</th>
              </tr>';
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $encoded_image = base64_encode($row['Img']);
      $img = "<img src='data:image/jpg;base64,{$encoded_image}' style='width:80px;height:80px'/>";
      echo '
      <tr>
        <td>' . $row['ID'] . '</td>
        <td>' . $row['Name'] . '</td>
        <td>' . $row['Brand'] . '</td>
        <td>' . "..." . '</td>
        <td>' . "$" . $row['Price'] . '</td>
        <td>' . $row['Amount'] . '</td>
        <td>'. 
          $img
        .
        '</td>
        <td>
          <button class="delete" onclick="thongbaobox()">&times;</button>
          <button style="margin-left:10px" onclick="hideFixSP()">&#9881;</button>
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
}
