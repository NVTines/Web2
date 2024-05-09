<?php
session_start();
<<<<<<< HEAD
require_once __DIR__ . "/../../database.php";
=======
require_once __DIR__ . '/../../database.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
>>>>>>> tuan
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
<<<<<<< HEAD
                    'SizeID'=>$row3['SizeID'],
=======
                    'SizeID' => $row3['SizeID'],
>>>>>>> tuan
                    'Quantity' => $row3['Quantity'],
                    'UnitPrice' => $row3['UnitPrice']
                );
            }
            $createDate = date('Y-m-d H:i:s');
            //insert bill
            $is1 = "INSERT INTO `bill`(`AccountID`,`CreateTime`, `Total`,`delivery`,`note`,`payment`, `status`) VALUES (?,?,?,?,?,?,?)";
<<<<<<< HEAD
            $vl1 = [$_SESSION['UserID'], $createDate, $total,$data['delivery'],$data['note'],$data['pttt'], "Đã Đặt"];
=======
            $vl1 = [$_SESSION['UserID'], $createDate, $total, $data['delivery'], $data['note'], $data['pttt'], "Đã Đặt"];
>>>>>>> tuan
            if ($dtb->insert($is1, $vl1, 'isdssss')) {
                $bill_id = mysqli_insert_id($dtb->get_conn()); // sẽ chứa giá trị ID của phòng vừa được thêm vào
                foreach ($billDetails as $billDetail) {
                    $is2 = "INSERT INTO `billdetail`(`BillID`, `ProductID`,`SizeID`, `Quantity`, `Unitprice`) VALUES (?,?,?,?,?)";
<<<<<<< HEAD
                    $vl2 = [$bill_id, $billDetail['ProductID'],$billDetail['SizeID'], $billDetail['Quantity'], $billDetail['UnitPrice']];
                    $resIS = $dtb->insert($is2, $vl2, 'iiiid');

                    $res4=$dtb->select("SELECT * FROM `sizedetail` WHERE `SizeID`=? AND `ProductID`=?",[$billDetail['SizeID'],$billDetail['ProductID']],'ii');
                    if(mysqli_num_rows($res4)>0){
                        $row4=$res4->fetch_assoc();
                        $quantity=$row4['Quantity']-$billDetail['Quantity'];
                        $resUP=$dtb->update("UPDATE `sizedetail` SET `Quantity`=? WHERE `SizeID`=? AND `ProductID`=?",[$quantity,$billDetail['SizeID'],$billDetail['ProductID']],'iii');
=======
                    $vl2 = [$bill_id, $billDetail['ProductID'], $billDetail['SizeID'], $billDetail['Quantity'], $billDetail['UnitPrice']];
                    $resIS = $dtb->insert($is2, $vl2, 'iiiid');

                    $res4 = $dtb->select("SELECT * FROM `sizedetail` WHERE `SizeID`=? AND `ProductID`=?", [$billDetail['SizeID'], $billDetail['ProductID']], 'ii');
                    if (mysqli_num_rows($res4) > 0) {
                        $row4 = $res4->fetch_assoc();
                        $quantity = $row4['Quantity'] - $billDetail['Quantity'];
                        $resUP = $dtb->update("UPDATE `sizedetail` SET `Quantity`=? WHERE `SizeID`=? AND `ProductID`=?", [$quantity, $billDetail['SizeID'], $billDetail['ProductID']], 'iii');
>>>>>>> tuan
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


<<<<<<< HEAD
?>
=======
if (isset($_POST['remove_bill'])) {
    $data = $dtb->filteration($_POST);
    $updateDate = date('Y-m-d H:i:s');
    $res = $dtb->update("UPDATE `bill` SET `status`=?, `UpdateTime`=? WHERE `BillID`=?", ["Đã Hủy", $updateDate, $data['bill_id']], 'ssi');
    if ($res) {
        echo 1;
    } else {
        echo 0;
    }
}


if (isset($_POST['check_status'])) {
    $data = $dtb->filteration($_POST);
    $res1 = $dtb->select("SELECT * FROM `account` WHERE `UserID`=?", [$_SESSION['UserID']], 'i');
    if (mysqli_num_rows($res1) > 0) {
        $row1 = $res1->fetch_assoc();
        if ($data['valueStatus'] == "Tất Cả") {
            $res2 = $dtb->select("SELECT * FROM `bill` WHERE `AccountID`=?", [$row1['UserID']], 'i');
        } else {
            $res2 = $dtb->select("SELECT * FROM `bill` WHERE `AccountID`=? AND `status`=?", [$row1['UserID'], $data['valueStatus']], 'is');
        }
        if (mysqli_num_rows($res2) > 0) {
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $dataCart = "";
                $res3 = $dtb->select("SELECT * FROM `billdetail` WHERE `BillID`=?", [$row2['BillID']], 'i');
                while ($row3 = mysqli_fetch_assoc($res3)) {
                    $res4 = $dtb->select("SELECT * FROM `product` WHERE `ProductID`=?", [$row3['ProductID']], 'i');
                    if (mysqli_num_rows($res4) > 0) {
                        $row4 = $res4->fetch_assoc();
                        $imgBase64 = base64_encode($row4['IMG']);
                        $imgSrc = 'data:image/jpeg;base64,' . $imgBase64;
                        $dataCart .= "<div class='card-body border border-black m-2 d-flex justify-content-between'>
                                <div class='d-flex justify-content-between' style='flex-direction:column;'>
                                <h5 class='card-title fw-bold'>$row4[ProductName] x $row3[Quantity]</h5>
                                <p class='card-text'>$row3[Unitprice]$</p>
                                </div>
                                <img src='$imgSrc' class='img-fluid' style='width:60px;'>
                            </div>";
                    }
                }

                echo "
                            <div class='ms-auto p-4 overflow-hidden'>
                                <div class='card'>
                                    <h5 class='card-header text-end'>Tình Trạng Đơn Hàng: $row2[status]</h5>
                                    <div>
                                    $dataCart
                                    </div>
                                    <a href='index.php?page=bill_detail&bill_id=$row2[BillID]' class='btn edit text-center text-success'>Xem Chi Tiết</a> 
                                </div>
                            </div>
            ";
            }
        } else {
            echo "<div class='mt-5 mb-5'><p class='text-center text-danger'>Bạn chưa có đơn hàng nào trùng với kết quả tìm kiếm</p></div>";
        }
    }
}
>>>>>>> tuan
