<?php
  $db = new database();
  echo 
    '<div id="shows">
      <div id="main">
        <div class="head">
          <div class="col-div-6">
  
            <span onclick="invinbox()"
              style="font-size: 30px; cursor: pointer; color: white"
              class="nav2"
              >&#9776;QUẢN LÝ NHÀ CUNG CẤP</span>
          </div>
  
          <div class="col-div-6">
            <div class="profile">
              <img src="user.png" class="pro-img" />
              <p class="profile">MBKT<span>DESIGNER</span></p>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>';
  if(isset($_GET["id"])){
    require "supplierdetail.php";
  }else{
    echo 
      '<div class="col-div-8">
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
                </td>';            
              }    
            }
            echo 
              '</tr>
            </table>
          </div>
        </div>
      </div>
    </div>';
  }
  
            
