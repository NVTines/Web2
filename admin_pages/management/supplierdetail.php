<?php
$id = $_GET["id"];
$sql = "SELECT * from supplier where SupplierID = '$id'";
echo 
'<div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ NHÀ CUNG CẤP</div>
    </div>
</div>
<div class="col-div-8" style="margin-bottom:50px;">
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
        if($results = $db->get_data($sql)){
            while($rows = $results->fetch_assoc()){
            echo 
            '<td>'.$rows["SupplierID"].'</td>
            <td>'.$rows["SupplierName"].'</td>
            <td>'.$rows["Address"].'</td>
            <td>'.$rows["Phone"].'</td>
            <td>'.$rows["FaxNumber"].'</td>';
            if($rows['status']=="1"){
                echo '<td style="color:green;font-weight:bold;">ĐANG HOẠT ĐỘNG</td>';  
            }else{
                echo '<td style="color:red;font-weight:bold;">NGƯNG HOẠT ĐỘNG</td>'; 
            }
            echo
            '<td>
                <a href="admin.php?key=ncc">
                    <button class="quit_btn" id="quit_btn">
                        <i class="fa-solid fa-circle-xmark"></i>
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
$sql = "SELECT p.* FROM product as p, supplierdetail as sd WHERE sd.SupplierID = '$id' AND sd.ProductID = p.ProductID";
echo 
'<div class="col-div-8">
    <div class="box-8">
        <div class="content-box">
            <table id="showlist">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                </tr>
                <tr>';
if($results = $db->get_data($sql)){
    while($rows = $results->fetch_assoc()){
    echo 
        '<td>'.$rows["ProductID"].'</td>
        <td>'.$rows["ProductName"].'</td>
        <td>'.$rows["IMG"].'</td>
        <td>'.$rows["Description"].'</td>';    
    }
}
echo 
                '</tr>
            </table>
        </div>
    </div>
</div>';