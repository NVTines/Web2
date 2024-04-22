<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/bill.css">
    <?php include "js/cart.php" ?>
</head>

<?php
require_once __DIR__ . "/../database.php";
$login = 0;
if (isset($_SESSION['UserID'])) {
    $login = 1;
}

?>
<?php
$dtb = new database();
function redirect($url)
{
    header("Location: $url");
    exit();
}
if (!isset($_GET['bill_id'])) {
    redirect('products.php');
}
$data = $dtb->filteration($_GET);
$purchase_res = $dtb->select("SELECT * FROM `bill` WHERE `BillID`=?", [$data['bill_id']], 'i');

if (mysqli_num_rows($purchase_res) == 0) {
    redirect('products.php');
}

$purchase_data = mysqli_fetch_assoc($purchase_res);
$data = "";
if ($purchase_data['status'] == "Đã Đặt") {
    $data .= " <div class='stepper'>
        <div class='stepper__step stepper__step--finish' aria-label='Đơn hàng $purchase_data[status], , $purchase_data[CreateTime]' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/order.svg'/>
            </div>
            <div class='stepper__step-text'>Đơn hàng $purchase_data[status]</div>
            <div class='stepper__step-date'>$purchase_data[CreateTime]</div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chờ xác nhận' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish background_step'>
                <img style='width:40px;' src='img/status/money.svg'/>
            </div>
            <div class='stepper__step-text'>Chờ xác nhận</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chờ lấy hàng' tabindex='0'>
            <div class='stepper__step-icon2 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/truck.svg'/>
            </div>
            <div class='stepper__step-text'>Chờ lấy hàng</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chờ giao hàng' tabindex='0'>
            <div class='stepper__step-icon2 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/box.svg'/>
            </div>
            <div class='stepper__step-text'>Chờ giao hàng</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chưa nhận hàng' tabindex='0'>
            <div class='stepper__step-icon2 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/receive.svg'/>
            </div>
            <div class='stepper__step-text'>Chưa nhận hàng</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__line'>
            <div class='stepper__line-background' style='background: rgb(0,0,0);'></div>
            <div class='stepper__line-foreground' style='width: calc(100% - 140px); background: rgb(0,0,0);'></div>
        </div>";
} else if ($purchase_data['status'] == "Đã Xác Nhận") {
    $data .= " <div class='stepper'>
        <div class='stepper__step stepper__step--finish' aria-label='Đơn hàng Đã Đặt, ,$purchase_data[CreateTime]' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/money.svg'/>
            </div>
            <div class='stepper__step-text'>Đơn hàng Đã Đặt</div>
            <div class='stepper__step-date'>$purchase_data[CreateTime]</div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Đơn hàng $purchase_data[status], , $purchase_data[UpdateTime]' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/order.svg'/>
            </div>
            <div class='stepper__step-text'>Đơn hàng $purchase_data[status]</div>
            <div class='stepper__step-date'>$purchase_data[UpdateTime]</div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chờ lấy hàng' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish background_step'>
                <img style='width:40px;' src='img/status/truck.svg'/>
            </div>
            <div class='stepper__step-text'>Chờ lấy hàng</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chờ giao hàng' tabindex='0'>
            <div class='stepper__step-icon2 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/box.svg'/>
            </div>
            <div class='stepper__step-text'>Chờ giao hàng</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chưa nhận hàng' tabindex='0'>
            <div class='stepper__step-icon2 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/receive.svg'/>
            </div>
            <div class='stepper__step-text'>Chưa nhận hàng</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__line'>
            <div class='stepper__line-background' style='background: rgb(0,0,0);'></div>
            <div class='stepper__line-foreground' style='width: calc(100% - 140px); background: rgb(0,0,0);'></div>
        </div>";
} else if ($purchase_data['status'] == "Đã Lấy Hàng") {
    $data .= " <div class='stepper'>
        <div class='stepper__step stepper__step--finish' aria-label='Đơn hàng Đã Đặt, , $purchase_data[CreateTime]' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/order.svg'/>
            </div>
            <div class='stepper__step-text'>Đơn hàng Đã Đặt</div>
            <div class='stepper__step-date'>$purchase_data[CreateTime]</div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Đã Xác Nhận' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/money.svg'/>
            </div>
            <div class='stepper__step-text'>Đã Xác Nhận</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='$purchase_data[status], , $purchase_data[UpdateTime]' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/truck.svg'/>
            </div>
            <div class='stepper__step-text'>$purchase_data[status]</div>
            <div class='stepper__step-date'>$purchase_data[UpdateTime]</div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chờ giao hàng' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish background_step'>
                <img style='width:40px;' src='img/status/box.svg'/>
            </div>
            <div class='stepper__step-text'>Chờ giao hàng</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chưa nhận hàng' tabindex='0'>
            <div class='stepper__step-icon2 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/receive.svg'/>
            </div>
            <div class='stepper__step-text'>Chưa nhận hàng</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__line'>
            <div class='stepper__line-background' style='background: rgb(0,0,0);'></div>
            <div class='stepper__line-foreground' style='width: calc(100% - 140px); background: rgb(0,0,0);'></div>
        </div>";
} else if ($purchase_data['status'] == "Đang Giao Hàng") {
    $data .= " <div class='stepper'>
        <div class='stepper__step stepper__step--finish' aria-label='Đơn hàng Đã Đặt, , $purchase_data[CreateTime]' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/order.svg'/>
            </div>
            <div class='stepper__step-text'>Đơn hàng Đã Đặt</div>
            <div class='stepper__step-date'>$purchase_data[CreateTime]</div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chờ xác nhận' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/money.svg'/>
            </div>
            <div class='stepper__step-text'>Chờ xác nhận</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chờ lấy hàng' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/truck.svg'/>
            </div>
            <div class='stepper__step-text'>Chờ lấy hàng</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='$purchase_data[status], , $purchase_data[UpdateTime]' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/box.svg'/>
            </div>
            <div class='stepper__step-text'>$purchase_data[status]</div>
            <div class='stepper__step-date'>$purchase_data[UpdateTime]</div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chưa nhận hàng' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish background_step'>
                <img style='width:40px;' src='img/status/receive.svg'/>
            </div>
            <div class='stepper__step-text'>Chưa nhận hàng</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__line'>
            <div class='stepper__line-background' style='background: rgb(0,0,0);'></div>
            <div class='stepper__line-foreground' style='width: calc(100% - 140px); background: rgb(0,0,0);'></div>
        </div>";
} else if ($purchase_data['status'] == "Đã Nhận Hàng") {
    $data .= " <div class='stepper'>
        <div class='stepper__step stepper__step--finish' aria-label='Đơn hàng Đã Đặt, , $purchase_data[CreateTime]' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/order.svg'/>
            </div>
            <div class='stepper__step-text'>Đơn hàng Đã Đặt</div>
            <div class='stepper__step-date'>$purchase_data[CreateTime]</div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chờ xác nhận' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/money.svg'/>
            </div>
            <div class='stepper__step-text'>Chờ xác nhận</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chờ lấy hàng' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/truck.svg'/>
            </div>
            <div class='stepper__step-text'>Chờ lấy hàng</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='Chờ giao hàng' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/box.svg'/>
            </div>
            <div class='stepper__step-text'>Chờ giao hàng</div>
            <div class='stepper__step-date'></div>
        </div>
        <div class='stepper__step stepper__step--finish' aria-label='$purchase_data[status], , $purchase_data[UpdateTime]' tabindex='0'>
            <div class='stepper__step-icon1 stepper__step-icon--finish'>
                <img style='width:40px;' src='img/status/receive.svg'/>
            </div>
            <div class='stepper__step-text'>$purchase_data[status]</div>
            <div class='stepper__step-date'>$purchase_data[UpdateTime]</div>
        </div>
        <div class='stepper__line'>
            <div class='stepper__line-background' style='background: rgb(0,0,0);'></div>
            <div class='stepper__line-foreground' style='width: calc(100% - 140px); background: rgb(0,0,0);'></div>
        </div>";
}
?>
<div class="RgsTlq">
    <?php
    echo $data;
    ?>
</div>
</div>
<div class="container-fluid" id="main-content">

    <div class="row">
        <?php
        $data = $dtb->filteration($_GET);
        $res1 = $dtb->select("SELECT * FROM `customer` WHERE `UserID`=?", [$_SESSION['UserID']], 'i');
        if (mysqli_num_rows($res1) > 0) {
            $row1 = $res1->fetch_assoc();
            $res2 = $dtb->select("SELECT * FROM `bill` WHERE `CustomerID`=? and `BillID`=?", [$row1['CustomerID'], $data['bill_id']], 'ii');
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $dataCart = "";
                $dataBill = "
                <div class='card-body m-2'>
                    <div class='d-flex justify-content-between align-items-center'>
                        <p>Tổng đơn giá:</p>
                        <p class='card-text'>$row2[Total]$</p>
                    </div>
                    <div class='d-flex justify-content-between align-items-center'>
                        <p>Phương thức thanh toán:</p>
                        <p class='card-title'>$row2[payment]</p>
                    </div><div class='d-flex justify-content-between align-items-center'>
                        <p>Địa chỉ nhận hàng</p>
                        <p class='card-text'>$row2[delivery]</p>
                    </div>
                </div>
                ";
                $res3 = $dtb->select("SELECT * FROM `billdetail` WHERE `BillID`=?", [$row2['BillID']], 'i');
                while ($row3 = mysqli_fetch_assoc($res3)) {
                    $res4 = $dtb->select("SELECT * FROM `product` WHERE `ProductID`=?", [$row3['ProductID']], 'i');
                    if (mysqli_num_rows($res4) > 0) {
                        $row4 = $res4->fetch_assoc();
                        $imgBase64 = base64_encode($row4['IMG']);
                        // Tạo đường dẫn dữ liệu (data URL) cho thẻ <img>
                        $imgSrc = 'data:image/jpeg;base64,' . $imgBase64;
                        $dataCart .= "<div class='card-body border border-black m-2 d-flex justify-content-between'>
                        <div>
                        <h5 class='card-title'>$row4[ProductName] x $row3[Quantity]</h5>
                        <p class='card-text'>Đơn giá: $row3[Unitprice]$</p>
                        <p class='card-text'>Màu sắc: $row4[Color]</p>
                        </div>
                        <img src='$imgSrc' class='img-fluid' style='width:60px;'>
                    </div>";
                    }
                }

                echo <<<donhang
                    <div class="ms-auto p-4 overflow-hidden">
                        <div class="card">
                            <div>
                            $dataCart
                            </div>
                            <div>
                            $dataBill
                            </div>
                        </div>
                    </div>
                donhang;
            }
        }

        ?>

    </div>
</div>