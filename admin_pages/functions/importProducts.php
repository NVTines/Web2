<?php
include_once "../../database.php";
$db = new Database();
$products = $_POST["product"];
$quantities = $_POST["quantity"];
foreach ($products as $product) {
    $product = explode(" ", $product);
    $productID = $product[0];
    $sizeID = $product[1];
    $price = $product[2];
    $quantityKey = $productID . '_' . $sizeID;
    $quantity = $quantities[$quantityKey];

}
