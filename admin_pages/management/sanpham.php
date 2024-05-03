<script>
  function redirectToAdmin() {
    window.location.href = "#";
  }
  function thongbaobox(id){
    document.getElementById('boxtb_product').style.animation="tb 1s forwards";
    document.getElementById('boxtb_product').innerHTML=
    '<div class="boxtb-title">XÁC NHẬN XÓA (ID - '+id+')</div><div class="confirm-btn-boxtb"><a id="yes-btn" href="functions/deleteSup.php?id='+id+'">YES</a><a href="#" id="no-btn" onclick="invthongbaobox()">NO</a></div>';
  }
  function invthongbaobox() {
    document.getElementById('boxtb_product').style.animation = "tb_2 1s forwards";
  }
</script>
<?php
$db = new database();
echo
'<div class="boxtb" id="boxtb_product">
  </div>
  <div id="shows">';

if (isset($_GET["id"])) {
  require "management/productDetail.php";
} else {
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
          <button title="Thêm sản phẩm mới" class="add-product-button" onclick="redirectToAdmin()"> <!--onclick added here-->
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
                <th>Tên</th>
                <th>Hãng</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th></th>
              </tr>';
  $query = "
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
  ORDER BY product.status ASC;
  ";
  $result = $db->get_data($query);
  if ($result->num_rows > 0) {
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
  echo '
          </table>
         </div>
        </div>
      </div>
    </div>';
}