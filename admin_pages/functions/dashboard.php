<?php
require_once __DIR__ . "/../../database.php";
session_start();
$dtb = new database();
if (isset($_POST['countAll'])) {
    $countKH = 0;
    $countSP = 0;
    $countDHDD = 0;
    $countSPBD = 0;
    $percent = 0;

    // Lấy số lượng khách hàng
    $res1 = $dtb->mysqli_query("SELECT COUNT(*) AS `customer_count` FROM `customer`");
    if ($res1) {
        if ($row1 = $res1->fetch_assoc()) {
            $countKH = $row1['customer_count'];
        }
    }

    // Lấy số lượng sản phẩm
    $res2 = $dtb->mysqli_query("SELECT COUNT(*) AS `product_count` FROM `product`");
    if ($res2) {
        if ($row2 = $res2->fetch_assoc()) {
            $countSP = $row2['product_count'];
        }
    }

    // Lấy hóa đơn
    $res3 = $dtb->select("SELECT COUNT(*) AS `bill_count` FROM `bill` WHERE `status`=?", ['Đã Nhận Hàng'], 's');
    if ($res3) {
        if ($row3 = $res3->fetch_assoc()) {
            $countDHDD = $row3['bill_count'];
        }
    }

    //lấy sản phẩm bán được
    $res4 = $dtb->mysqli_query("SELECT SUM(`Quantity`) AS `quantity` FROM `billdetail`");
    if ($res4) {
        if ($row3 = $res4->fetch_assoc())
            $countSPBD = $row3['quantity'];
        else 
            $countSPBD = 0;
    }

    //tỉ lệ 
    $res5 = $dtb->selectAll('bill');
    $hd = 0;
    $hdtc = 0;
    while ($row5 = $res5->fetch_assoc()) {
        if ($row5['status'] == 'Đã Nhận Hàng') {
            $hd++;
            $hdtc++;
        } else {
            $hd++;
        }
    }


    if ($hd == 0 || $hdtc == 0)
        $percent = 0;
    else
        $percent = ($hdtc / $hd) * 100;

    $response = array(
        'countKH' => $countKH,
        'countSP' => $countSP,
        'countDHDD' => $countDHDD,
        'countSPBD' => $countSPBD,
        'percent' => $percent
    );
    echo json_encode($response);
}
