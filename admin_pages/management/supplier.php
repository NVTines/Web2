<?php
  $db = new database();
  echo '<div id="shows">';
  if(isset($_GET["id"])){
    require "management/supplierdetail.php";
  }else if(isset($_GET["func"])){
    require "management/addSupplier.php";
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
              </tr>
              <tr>';
            $sql = "SELECT * FROM supplier";
            if($results = $db->get_data($sql)){
              while($rows = $results->fetch_assoc()){
                echo 
                '<td>'.$rows["SupplierID"].'</td>
                <td>'.$rows["SupplierName"].'</td>
                <td>'.$rows["Address"].'</td>
                <td>'.$rows["Phone"].'</td>
                <td>'.$rows["FaxNumber"].'</td>
                <td>'.$rows["status"].'</td>
                <td>
                  <a href="admin.php?key=ncc&id='.$rows["SupplierID"].'">
                    <button class="info_btn" id="info_btn">
                      <i class="fa-solid fa-circle-info"></i>
                    </button>
                  </a>
                  <a href="deleteSupplier.php">
                      <button class="quit_btn" id="quit_btn">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                  </a>
                </td>';            
              }    
            }
            echo 
              '</tr>
            </table>
          </div>
        </div>
      </div>';
  }
  echo '</div>';
  
            
