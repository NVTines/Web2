<?php
session_start();
require_once __DIR__ . "/../../database.php";
$dtb = new database();
if (isset($_POST['add_to_cart'])) {
    $data=$dtb->filteration($_POST);
    $product_id = $data['ProductID'];
    $product_name = $data['ProductName'];
    $product_price = $data['ProductPrice'];
    $product_size = $data['Size'];
    $product_quantity = $data['Quantity'];

    $res0 = $dtb->select("SELECT * FROM `cart` WHERE `UserID`=?", [$_SESSION['UserID']], 'i');

    if (mysqli_num_rows($res0) > 0) {
        $row0 = $res0->fetch_assoc();
        $_SESSION['cart_idUser'] = $row0['CartID'];

        $res3 = $dtb->mysqli_query("SELECT f.SizeID,f.value FROM `size` f 
            INNER JOIN `sizedetail` rfac ON f.SizeID=rfac.SizeID WHERE rfac.ProductID=$product_id AND f.value=$product_size"); //lấy sizeID
        if (mysqli_num_rows($res3) > 0) {
            $row3 = mysqli_fetch_assoc($res3);
            $select1 = "SELECT * FROM `cartdetails` WHERE `ProductID`=? AND `SizeID`=? AND `CartID`=?"; //kiểm tra sp vs size có tồn tại trong giỏ của uId chưa
            $vs1 = [$product_id,$row3['SizeID'], $row0['CartID']];
            $res1 = $dtb->select($select1, $vs1, 'iii');
            if (mysqli_num_rows($res1) > 0) {
<<<<<<< HEAD
                echo 'added';
=======
                $row1=$res1->fetch_assoc();
                $n_quantity=$product_quantity+ $row1['Quantity'];
                $update1="UPDATE `cartdetails` SET `Quantity`=? WHERE `ProductID`=? AND `SizeID`=? AND `CartID`=?";
                $valueu1=[$n_quantity,$product_id,$row3['SizeID'], $row0['CartID']];
                $res5=$dtb->update($update1,$valueu1,'iiii');
                if($res5){
                    echo 'u_success';
                } else {
                    echo 0;
                }
>>>>>>> tuan
            } else {
                    $row1 = $res1->fetch_assoc();
                    $select2 = "SELECT * FROM `product` WHERE `ProductID`=?";
                    $vs2 = [$product_id];
                    $res2 = $dtb->select($select2, $vs2, 'i');
                    if (mysqli_num_rows($res2) > 0) {
                        $row2 = $res2->fetch_assoc();
                        $query2 = "INSERT INTO `cartdetails`(`CartID`, `ProductID`,`SizeID`, `Quantity`, `UnitPrice`) VALUES (?,?,?,?,?)";
<<<<<<< HEAD
                        $values2 = [$row0['CartID'], $product_id, $row3['SizeID'], $product_quantity, $row2['ProductPrice']*110/100];
=======
                        $values2 = [$row0['CartID'], $product_id, $row3['SizeID'], $product_quantity, $row2['ProductPrice']];
>>>>>>> tuan
                        if ($dtb->insert($query2, $values2, 'iiiid')) {
                            echo 1;
                        } else {
                            echo 'ins_failed';
                        }
                    }
            }
        }
    } else {
        $query1 = "INSERT INTO `cart` (`UserID`) VALUES (?)";
        $values1 = [$_SESSION['UserID']];
        if ($dtb->insert($query1, $values1, 'i')) {
            $cart_id = mysqli_insert_id($dtb->get_conn()); // sẽ chứa giá trị ID của phòng vừa được thêm vào
            $_SESSION['cart_idUser'] = $cart_id;
            $select1 = "SELECT * FROM `cart` WHERE `CartID`=?";
            $vsl = [$cart_id];
            $res1 = $dtb->select($select1, $vsl, 'i');

            if (mysqli_num_rows($res1) > 0) {
                $row1 = $res1->fetch_assoc();
                $res3 = $dtb->mysqli_query("SELECT f.SizeID,f.value FROM `size` f 
            INNER JOIN `sizedetail` rfac ON f.SizeID=rfac.SizeID WHERE rfac.ProductID=$product_id AND f.value=$product_size"); //lấy sizeID
                if (mysqli_num_rows($res3) > 0) {
                    $row3 = mysqli_fetch_assoc($res3);
                    $select2 = "SELECT * FROM `product` WHERE `ProductID`=?";
                    $vs2 = [$product_id];
                    $res2 = $dtb->select($select2, $vs2, 'i');
                    if (mysqli_num_rows($res2) > 0) {
                        $row2 = $res2->fetch_assoc();
                        $query2 = "INSERT INTO `cartdetails`(`CartID`, `ProductID`,`SizeID`, `Quantity`, `UnitPrice`) VALUES (?,?,?,?,?)";
<<<<<<< HEAD
                        $values2 = [$row1['CartID'], $product_id, $row3['SizeID'], $product_quantity, $row2['ProductPrice']*110/100];
=======
                        $values2 = [$row1['CartID'], $product_id, $row3['SizeID'], $product_quantity, $row2['ProductPrice']];
>>>>>>> tuan
                        if ($dtb->insert($query2, $values2, 'iiiid')) {
                            echo 1;
                        } else {
                            echo 'ins_failed';
                        }
                    }
                }
            }
        } else {
            echo 'ins_failed';
        }
    }
}

if (isset($_POST['get_product_cart'])) {
    $data = $dtb->filteration($_POST);
    $res1 = $dtb->select("SELECT * FROM `cart` WHERE `CartID`=?", [$data['cart_id']], 'i');
    if (mysqli_num_rows($res1) > 0) {
        $row1 = $res1->fetch_assoc();
        $res2 = $dtb->select("SELECT * FROM `cartdetails` WHERE `CartID`=?", [$row1['CartID']], 'i');
        $cartData = "";
        $thanhtoan = "";
        $subtotal = 0;
        $total = 0;
        while ($row2 = mysqli_fetch_assoc($res2)) {
            $res3 = $dtb->select("SELECT * FROM `product` WHERE `ProductID`=?", [$row2['ProductID']], 'i');
            if (mysqli_num_rows($res3) > 0) {
                $row3 = $res3->fetch_assoc();
                $res4=$dtb->mysqli_query("SELECT * FROM `size` f 
                INNER JOIN `sizedetail` rfac ON f.SizeID=rfac.SizeID WHERE rfac.ProductID=$row2[ProductID] and rfac.SizeID=$row2[SizeID]");
                if($row4=mysqli_fetch_assoc($res4)){
                    $imgBase64 = base64_encode($row3['IMG']);
                    // Tạo đường dẫn dữ liệu (data URL) cho thẻ <img>
                    $imgSrc = 'data:image/jpeg;base64,' . $imgBase64;
                    $cartData .= "
                        <tr class='align-middle'>
                            <td><img src='$imgSrc' class='img-fluid' style='width:60px;'></td>
                            <td>$row3[ProductName]</td>
                            <td>$row4[value]</td>
                            <td>
<<<<<<< HEAD
                                <button onclick='setQuantityPlus($_SESSION[cart_idUser],$row2[ProductID],$row4[Quantity],$row2[SizeID])' class='cart-qty-plus' type='button'>+</button>
                                <input disabled type='number' name='quantity' id='quantity$row2[ProductID]$row2[SizeID]' style='width:60px;' min='0' max='$row4[Quantity]' value='$row2[Quantity]'/>
                                <button onclick='setQuantityMinus($_SESSION[cart_idUser],$row2[ProductID], $row2[SizeID])' class='cart-qty-minus' type='button'>-</button>
=======
                                <button onclick='setQuantityPlus($_SESSION[cart_idUser],$row2[ProductID],$row4[Quantity],$row2[SizeID])' class='cart-qty-plus btn btn-secondary' type='button'>+</button>
                                <input disabled type='number' name='quantity' id='quantity$row2[ProductID]$row2[SizeID]' style='width:60px;' min='0' max='$row4[Quantity]' value='$row2[Quantity]'/>
                                <button onclick='setQuantityMinus($_SESSION[cart_idUser],$row2[ProductID], $row2[SizeID])' class='cart-qty-minus btn btn-secondary' type='button'>-</button>
>>>>>>> tuan
                            </td>
                            <td>$row3[Color]</td>
                            <td>$row2[UnitPrice]$</td>
                            <td>       
                            <button type='button' onclick='remove_product($row2[ProductID],$row1[CartID],$row2[SizeID])' class='btn btn-danger shadow-none btn-sm'>
                                <i class='bi bi-trash'></i>
                            </button>
                            </td>
                        </tr>
                    ";
                    $subtotal += $row2['Quantity'] * $row2['UnitPrice'];
                }
            }
        }
        $thanhtoan .= "
        <tr>
            <td>Total</td>
            <td>$subtotal</td>
        </tr>
        ";
        $response = array(
            'cartData' => $cartData,
            'thanhtoan' => $thanhtoan
        );

        echo json_encode($response);
    }
}


if(isset($_POST['remove_product'])){
    $data = $dtb->filteration($_POST);
    $sl1=$dtb->delete("DELETE FROM `cartdetails` WHERE `CartID`=? AND `ProductID`=? AND `SizeID`=?",[$data['cart_id'],$data['product_id'],$data['size_id']],'iii');
    if($sl1){
        echo 1;
    } else {
        echo 0;
    }
}


if(isset($_POST['update_quantity'])){
    $data=$dtb->filteration($_POST);
    $res=$dtb->update("UPDATE `cartdetails` SET `Quantity`=? WHERE `CartID`=? AND `ProductID`=? AND `SizeID`=? ",[$data['quantity'],$_SESSION['cart_idUser'],$data['product_id'],$data['size_id']],'iiii');
    if($res){
        echo 1;
    } else {
        echo 0;
    }
}


function calculateTotalCart()
{
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $price = (float)$product['product_price'];
        $quantity = (int)$product['product_quantity'];
        $total += $price * $quantity;
    }
    $_SESSION['total'] = $total;
<<<<<<< HEAD
}
=======
}
>>>>>>> tuan
