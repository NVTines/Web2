<script>
  function thongbaobox(id){
    document.getElementById('boxtb').style.animation="tb 1s forwards";
    document.getElementById('boxtb').innerHTML=
    '<div id="boxtb-title">XÁC NHẬN XÓA (ID - '+id+')</div><div class="confirm-btn-boxtb"><a id="yes-btn" href="functions/deleteSup.php?id='+id+'">YES</a><a href="#" id="no-btn" onclick="invthongbaobox()">NO</a></div>';
  }
</script>
<?php
  $db = new database();
  echo 
  '<div id="boxtb">
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
            <table id="showlist">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Fax</th>
                <th>Status</th>
                <th></th>
              </tr>';
            $sql = "SELECT * FROM supplier order by status ASC";
            if($results = $db->get_data($sql)){
              while($rows = $results->fetch_assoc()){
                echo 
                '<tr><td>'.$rows["SupplierID"].'</td>';
                if($rows['status']=="1"){
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
                }else{
                  echo 
                  '<td>'.$rows["SupplierName"].'</td>
                  <td>'.$rows["Address"].'</td>
                  <td>'.$rows["Phone"].'</td>
                  <td>'.$rows["FaxNumber"].'</td>';
                  echo 
                  '<td style="color:red;font-weight:bold;">NGƯNG HOẠT ĐỘNG</td>';
                  echo 
                  '<td>
                    <a href="admin.php?key=ncc&id='.$rows["SupplierID"].'">
                      <button class="info_btn" id="info_btn">
                        <i class="fa-solid fa-circle-info"></i>
                      </button>
                    </a>
                  </td></tr>';   
                }
                         
              }    
            }
            echo  
            '</table>
          </div>
        </div>
      </div>';
  }
  echo '</div>';