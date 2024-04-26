<?php
session_start();
if (isset($_POST['add_to_cart'])) {

    // if cart exists
    if (isset($_SESSION['cart'])) {
        $product_array_id = array_column($_SESSION['cart'], 'product_id');

        // if the product not exists in cart => add into cart
        if (!in_array($_POST['ProductID'], $product_array_id)) {

            $product_id = $_POST['ProductID'];
            $product_name = $_POST['ProductName'];
            $product_price = $_POST['ProductPrice'];
            $product_image = $_POST['ProductImage'];
            $product_size = $_POST['Size'];
            $product_producer = $_POST['ProducerName'];
            $product_quantity = $_POST['Quantity'];

            // save info
            $product_array = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_image' => $product_image,
                'product_size' => $product_size,
                'product_producer' => $product_producer,
                'product_quantity' => $product_quantity
            );

            $_SESSION['cart'][$product_id] = $product_array;
            calculateTotalCart();
        }

        // product exists in cart then update quantity
        else {

            $product_id = $_POST['ProductID'];

            $product_array = $_SESSION['cart'][$product_id];

            // Update Quantity
            $product_quantity = $product_array['product_quantity'] + $_POST['Quantity'];

            $product_array['product_quantity'] = $product_quantity;

            // save session
            $_SESSION['cart'][$product_id] = $product_array;
            calculateTotalCart();
        }

        $_SESSION['cart'][$product_id] = $product_array;
        calculateTotalCart();
    }

    // if cart not exists add the first product
    else {
        $product_id = $_POST['ProductID'];
        $product_name = $_POST['ProductName'];
        $product_price = $_POST['ProductPrice'];
        $product_image = $_POST['ProductImage'];
        $product_size = $_POST['Size'];
        $product_producer = $_POST['ProducerName'];
        $product_quantity = $_POST['Quantity'];

        // save info
        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_size' => $product_size,
            'product_producer' => $product_producer,
            'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;
        calculateTotalCart();
    }
}
header('Location:../../index.php?page=shopping&id='.$_POST['ProductID']);


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
}
