<?php
session_start();
require_once __DIR__ . "/../../database.php";
$dtb = new database();
if (isset($_POST['add_bill'])) {
    $data = $dtb->filteration($_POST);
    $res1 = $dtb->select("SELECT * FROM `account` WHERE `UserID`=?", [$_SESSION['UserID']], 'i');
    if (mysqli_num_rows($res1) > 0) {
        $row1 = $res1->fetch_assoc();
        $res2 = $dtb->select("SELECT * FROM `cart` WHERE `UserID`=?", [$_SESSION['UserID']], 'i');
        if (mysqli_num_rows($res2) > 0) {
            $row2 = $res2->fetch_assoc();
            $res3 = $dtb->select("SELECT * FROM `cartdetails` WHERE `CartID`=?", [$row2['CartID']], 'i');
            $total = 0;
            while ($row3 = mysqli_fetch_assoc($res3)) {
                $total += $row3['Quantity'] * $row3['UnitPrice'];

                $billDetails[] = array(
                    'ProductID' => $row3['ProductID'],
                    'SizeID'=>$row3['SizeID'],
                    'Quantity' => $row3['Quantity'],
                    'UnitPrice' => $row3['UnitPrice']
                );
            }
            $createDate = date('Y-m-d H:i:s');
            //insert bill
            $is1 = "INSERT INTO `bill`(`AccountID`,`CreateTime`, `Total`,`delivery`,`note`,`payment`, `status`) VALUES (?,?,?,?,?,?,?)";
            $vl1 = [$_SESSION['UserID'], $createDate, $total,$data['delivery'],$data['note'],$data['pttt'], "Đã Đặt"];
            if ($dtb->insert($is1, $vl1, 'isdssss')) {
                $bill_id = mysqli_insert_id($dtb->get_conn()); // sẽ chứa giá trị ID của phòng vừa được thêm vào
                foreach ($billDetails as $billDetail) {
                    $is2 = "INSERT INTO `billdetail`(`BillID`, `ProductID`,`SizeID`, `Quantity`, `Unitprice`) VALUES (?,?,?,?,?)";
                    $vl2 = [$bill_id, $billDetail['ProductID'],$billDetail['SizeID'], $billDetail['Quantity'], $billDetail['UnitPrice']];
                    $resIS = $dtb->insert($is2, $vl2, 'iiiid');

                    $res4=$dtb->select("SELECT * FROM `sizedetail` WHERE `SizeID`=? AND `ProductID`=?",[$billDetail['SizeID'],$billDetail['ProductID']],'ii');
                    if(mysqli_num_rows($res4)>0){
                        $row4=$res4->fetch_assoc();
                        $quantity=$row4['Quantity']-$billDetail['Quantity'];
                        $resUP=$dtb->update("UPDATE `sizedetail` SET `Quantity`=? WHERE `SizeID`=? AND `ProductID`=?",[$quantity,$billDetail['SizeID'],$billDetail['ProductID']],'iii');
                    }
                }
            }

            $res5 = $dtb->delete("DELETE FROM `cartdetails` WHERE `CartID`=?", [$row2['CartID']], 'i');
            $res6 = $dtb->delete("DELETE FROM `cart` WHERE `UserID`=?", [$_SESSION['UserID']], 'i');
            if ($res5 || $res6) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 'GHR';
        }
    } else {
        echo 'Server Down!';
    }
}


?>