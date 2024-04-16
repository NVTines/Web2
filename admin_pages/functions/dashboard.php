<?php
require_once __DIR__."/../../database.php";
session_start();



$dtb = new database();
if (isset($_POST['countAll'])) {
    $countKH = 0;
    $countSP = 0;
    $countDHDD = 0;
    $countSPBD = 0;
    
    // Lấy số lượng khách hàng
    $res1 = $dtb->mysqli_query("SELECT COUNT(*) AS `customer_count` FROM `customer`");
    if ($res1) {
        if($row1 = $res1->fetch_assoc()){
            $countKH = $row1['customer_count'];
        }
    }

    // Lấy số lượng sản phẩm
    $res2 = $dtb->mysqli_query("SELECT COUNT(*) AS `product_count` FROM `product`");
    if ($res2) {
        if($row2 = $res2->fetch_assoc())
        {
            $countSP = $row2['product_count'];
        }
    }

    // Lấy hóa đơn
    $res3=$dtb->select("SELECT COUNT(*) AS `bill_count` FROM `bill` WHERE `status`=?",['Đã Nhận Hàng'],'s');
    if($res3){
        if($row3=$res3->fetch_assoc()){
            $countDHDD=$row3['bill_count'];
        }
    }

    //lấy sản phẩm bán được
    

    $response = array(
        'countKH' => $countKH,
        'countSP' => $countSP,
        'countDHDD' => $countDHDD,
        'countSPBD' => $countSPBD
    );
    echo json_encode($response);
}
?>