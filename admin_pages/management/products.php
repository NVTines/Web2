<script>
  function toAddNewProduct() {
    window.location.href = "admin.php?key=sp&func=add";
  }

  function toImportProducts() {
    window.location.href = "admin.php?key=nh&func=add";
  }
<<<<<<< HEAD
  function thongbaobox(id){
    showForm();
    document.getElementById('boxtb_product').style.animation="tb 1s forwards";
    document.getElementById('boxtb_product').innerHTML=
    '<div class="boxtb-title">Chắc chắn muốn xóa?('+id+')</div><div class="confirm-btn-boxtb"><a class="yes-btn" onclick="deleteOneProduct('+id+')">YES</a><a class="no-btn" onclick="invthongbaobox()">NO</a></div>';
  }
  function invthongbaobox() {
    hideForm();
    document.getElementById('boxtb_product').style.animation = "tb_2 1s forwards";
=======

  document.addEventListener("DOMContentLoaded", function() {
    var searchInput = document.getElementById("search-input");
    searchInput.addEventListener("keydown", function(event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("search-button").click();
      }
    });
  });

  function searchData() {
    var searchInput = document.getElementById("search-input").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("showlist").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "functions/searchProducts.php?searchInput=" + searchInput, true);
    xhttp.send();
  }


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
    xhttp.open("GET", "functions/sortProducts.php?sortHeader=" + sortHeader + "&sortDirection=" + sortDirection, true);
    xhttp.send();
  }

  function refreshData() {
    window.location.href = "admin.php?key=sp";
>>>>>>> origin/Khánh
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
<<<<<<< HEAD
  ' <div class="col-div-8" style="margin:20px 0px;">
        <div class="box-8">
          <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ SẢN PHẨM</div>
=======
  '<div id="boxtb" style="background-color:white;height:-100px;width:350px;position:fixed;z-index:10;right:0">
    </div>
    <div id="shows">
      <div id="main">
        <div class="head">
          <div class="col-div-6">
            <div class="manage-name-btn" onclick="invinbox()">&#9776; QUẢN LÝ SẢN PHẨM</div>
          </div>
          <div class="col-div-6">
>>>>>>> origin/Khánh
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
            <table>
              <tr>
                <td colspan="4">
                  <div class="search-section">
                      <input type="text" id="search-input" placeholder="Nhập tên sản phẩm...">
                      <button id="search-button" onclick="searchData()">
                        <i class="fa-solid fa-magnifying-glass"></i>
                      </button>
                  </div>
                </td>        
                <td colspan="3">
                  <div class="sort-section">
                    <div class="sort-options">
                        <label for="sort-header">Sắp xếp theo:</label>
                        <select id="sort-header" name="sort-header">
                            <option value="ID">ID</option>
                            <option value="Name">Tên</option>
                            <option value="Brand">Hãng</option>
                            <option value="Price">Giá</option>
                            <option value="Status">Trạng thái</option>
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
                  <th>ID</th>
                  <th>Tên</th>
                  <th>Hãng</th>
                  <th>Ảnh</th>
                  <th>Giá</th>
                  <th>Trạng thái</th>
                  <th></th>
                </tr>';
  echo "<tbody id='showlist'>";
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
            </tbody>
          </table>
         </div>
        </div>
      </div>
    </div>';
}