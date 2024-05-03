<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <link rel="stylesheet" href="css/common.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
</head>


<div class="container-fluid" id="main-content" style="background-color:whitesmoke;">
    <div class="row">
        <div class="ms-auto p-4 overflow-hidden">

            <?php
            $login = 0;
            if (isset($_SESSION['UserID'])) {
                $login = 1;
            }
            ?>
            <?php
            if ($login == 1) {
                echo "<a href='index.php?page=urbill' class='btn btn-sm text-white custom-bg shadow-none'>Xem đơn hàng đã đặt</a>";
            }
            ?>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="table-responsive-md" style="height:300px; overflow-y:scroll; width: 65%;">
                        <table class="table table-hover border text-cennter">
                            <thead class="sticky-top">
                                <tr class="bg-dark text-light">
                                    <th scope="col">Image</th>
                                    <th scope="col">ProductName</th>
                                    <!-- <th scope="col">Image</th> -->
                                    <th scope="col">Size</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="cart-data">

                            </tbody>
                        </table>
                    </div>

                    <div class="card" style="width:30%;">
                        <div class="card-header">
                            Thanh Toán Đơn Hàng
                        </div>
                        <table class="table table-hover text-cennter">
                            <tbody id="thanhtoan">

                            </tbody>
                        </table>

                        <?php
                        if ($login == 1)
                        {
                            echo "<button type='button' data-bs-toggle='modal' data-bs-target='#checkoutModal' class='btn btn-sm text-white custom-bg shadow-none' style='float:right;'>Thanh Toán</button>";
                        } else {
                            echo "<p class='text-center text-danger'>Xin Mời Đăng Nhập Tài Khoản</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$data = "";
if ($login = 1) {
    $data .= "<form action='' id='hoadon' style=''>
        <h1 style='text-align: center;margin-bottom:10px'><i>Payment Form</i></h1>
        <div class='mb-3'>
        <label for='pttt' class='form-label'>Payments</label>
        <select id='pttt' style='float:right;'>
            <option selected value='0'>Select Option</option>
            <option value='1'>VisaCard</option>
            <option value='2'>Paypal</option>
            <option value='3'>Internet Banking</option>
            <option value='4'>Cash</option>
        </select>
    </div>

    <div class='form-floating mb-3'>
        <textarea class='form-control' placeholder='Leave a comment here' id='delivery' required></textarea>
        <label for='delivery'>Delivery</label>
    </div>

    <div class='form-floating mb-3'>
        <textarea class='form-control' placeholder='Leave a comment here' id='note'></textarea>
        <label for='note'>Note</label>
    </div>


    <button type='submit' class='btn btn-sm text-white shadow-none' style='float:right; background: #ff523b; padding: 10px;font-weight: bold;cursor: pointer;margin: 20px;border-radius: 20px;'>Thanh Toán</button>

    </form>";
}
?>

<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <?php echo $data ?>
        </div>
    </div>
</div>

<?php include "js/cart.php" ?>