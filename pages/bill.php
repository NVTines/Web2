<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <link rel="stylesheet" href="css/common.css">
    <?php include "js/cart.php" ?>
</head>

<?php
require_once __DIR__ . "/../database.php";
$login = 0;
if (isset($_SESSION['UserID'])) {
    $login = 1;
}
?>

<div class="container-fluid" id="main-content">

    <div class="row">
        <?php
        $dtb = new database();
        $res1 = $dtb->select("SELECT * FROM `account` WHERE `UserID`=?", [$_SESSION['UserID']], 'i');
        if (mysqli_num_rows($res1) > 0) {
            $row1 = $res1->fetch_assoc();
            $res2 = $dtb->select("SELECT * FROM `bill` WHERE `AccountID`=?", [$row1['UserID']], 'i');
            if(mysqli_num_rows($res2)>0){
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $dataCart = "";
                    $res3 = $dtb->select("SELECT * FROM `billdetail` WHERE `BillID`=?", [$row2['BillID']], 'i');
                    while ($row3 = mysqli_fetch_assoc($res3)) {
                        $res4 = $dtb->select("SELECT * FROM `product` WHERE `ProductID`=?", [$row3['ProductID']], 'i');
                        if (mysqli_num_rows($res4) > 0) {
                            $row4 = $res4->fetch_assoc();
                            $imgBase64 = base64_encode($row4['IMG']);
                            // Tạo đường dẫn dữ liệu (data URL) cho thẻ <img>
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
    
                    echo <<<donhang
                            <div class="ms-auto p-4 overflow-hidden">
                                <div class="card">
                                    <h5 class="card-header text-end">Tình Trạng Đơn Hàng: $row2[status]</h5>
                                    <div>
                                    $dataCart
                                    </div>
                                    <a href='index.php?page=bill_detail&bill_id=$row2[BillID]' class='btn edit text-center text-success'>Xem Chi Tiết</a> 
                                </div>
                            </div>
                        donhang;
                }
            } else {
                echo "<div class='mt-5 mb-5'><p class='text-center text-danger'>Bạn chưa có đơn hàng nào trong dữ liệu</p></div>";
            }
            
        }

        ?>



    </div>
</div>