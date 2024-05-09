<script>
  function thongbaobox(id){
    showForm();
    document.getElementById('boxtb_supplier').style.animation="tb 1s forwards";
    document.getElementById('boxtb_supplier').innerHTML=
    '<div class="boxtb-title">Chắc chắn muốn xóa?('+id+')</div><div class="confirm-btn-boxtb"><a class="yes-btn" onclick="deleteOneSup('+id+')">YES</a><a class="no-btn" onclick="invthongbaobox()">NO</a></div>';
  }
  function invthongbaobox() {
    hideForm();
    document.getElementById('boxtb_supplier').style.animation = "tb_2 1s forwards";
  }
</script>
<?php
  $db = new database();
  echo 
  '<div class="boxtb" id="boxtb_supplier">
  </div>
  <div id="shows">';
  if(isset($_GET["id"])){
    require "management/supplierdetail.php";
  }else if(isset($_GET["func"])){
    require "management/modifySupplier.php";
  }
  else{
    echo 
      '<div class="col-div-8" style="margin:20px 0px;">
        <div class="box-8">
          <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ NHÀ CUNG CẤP</div>
          <a href="admin.php?key=ncc&func=add" id="add-btn-supplier">THÊM</a>
        </div>
      </div>
      <div class="col-div-8">
        <div class="box-8">
          <div class="content-box">
            <table id="supTable">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Fax</th>
                <th>Status</th>
                <th></th>
              </tr>';
            $sql = "SELECT * FROM supplier WHERE status=1";
            if($results = $db->get_data($sql)){
              while($rows = $results->fetch_assoc()){
                echo 
                '<tr id="sup'.$rows["SupplierID"].'"><td>'.$rows["SupplierID"].'</td>';
                  echo 
                  '<td><a href="admin.php?key=ncc&func=upd&supid='.$rows["SupplierID"].'&supname='.$rows["SupplierName"].'&supaddress='.$rows["Address"].'&supphone='.$rows["Phone"].'&supfax='.$rows["FaxNumber"].'" style="color:#85BCFF;">'.$rows["SupplierName"].'</a></td>
                  <td>'.$rows["Address"].'</td>
                  <td>'.$rows["Phone"].'</td>
                  <td>'.$rows["FaxNumber"].'</td>';
                  echo 
                  '<td style="color:green;font-weight:bold;">ĐANG HOẠT ĐỘNG</td>';
                  echo 
                  '<td>
                    <a href="admin.php?key=ncc&id='.$rows["SupplierID"].'">
                      <button class="info_btn" id="info_btn">
                        <i class="fa-solid fa-circle-info"></i>
                      </button>
                    </a>
                    <a onclick="thongbaobox('.$rows["SupplierID"].');">
                        <button class="quit_btn" id="quit_btn">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                    </a>
                  </td></tr>';   
              }    
            }
            echo  
            '</table>
          </div>
        </div>
      </div>';
  }
  echo '</div>';