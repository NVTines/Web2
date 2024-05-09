<script>
  function toAddNewProduct() {
    window.location.href = "admin.php?key=sp&func=add";
  }

  function toImportProducts() {
    window.location.href = "admin.php?key=nh&func=add";
  }
  function thongbaobox(id){
    showForm();
    document.getElementById('boxtb_product').style.animation="tb 1s forwards";
    document.getElementById('boxtb_product').innerHTML=
    '<div class="boxtb-title">Chắc chắn muốn xóa?('+id+')</div><div class="confirm-btn-boxtb"><a class="yes-btn" onclick="deleteOneProduct('+id+')">YES</a><a class="no-btn" onclick="invthongbaobox()">NO</a></div>';
  }
  function invthongbaobox() {
    hideForm();
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
  ' <div class="col-div-8" style="margin:20px 0px;">
        <div class="box-8">
          <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ SẢN PHẨM</div>
          <button title="Nhập sản phẩm" class="add-product-button" onclick="toImportProducts()">
            <ion-icon name="download-outline"></ion-icon>
          </button> 
          <button title="Thêm sản phẩm mới" class="add-product-button" onclick="toAddNewProduct()">
              <ion-icon name="add-circle-outline"></ion-icon>
          </button>
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
                    <button class="info_btn">
                        <i class="fa-solid fa-circle-info"></i>
                    </button>
                </a>';
      if($row['Status'] == 'acti'){
        echo '<a onclick="thongbaobox(' . $row['ID'] . ');">
            <button class="quit_btn">
                <i class="fa-solid fa-trash"></i>
            </button>
        </a>';
      }   
            echo'</td>' .
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