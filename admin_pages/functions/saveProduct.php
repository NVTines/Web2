<?php
require_once __DIR__ . "/../../database.php";
$dtb = new database();
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $productName = $_POST["product-name"];
    $productBrand = $_POST["brands"];
    $productStatus = $_POST["status"];

    $sql = "UPDATE product SET ProductName='$productName', ProducerID='$productBrand', status='$productStatus' WHERE ProductID='$id'";
    echo $sql;
    $dtb->modify_data($sql);
    $dtb->close_dtb();
    header("Location:../admin.php?key=sp");
}
