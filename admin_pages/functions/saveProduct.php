<?php
include_once "../../database.php";
$db = new database();
$id = $_GET["id"];
$productName = $_POST["product-name"];
$brand = $_POST["brands"];
$price = $_POST["price"];
$status = $_POST["status"];
$sql = "UPDATE product SET ProductName = '$productName', ProducerID = '$brand', ProductPrice = '$price', status = '$status' WHERE ProductID = '$id'";
// echo $sql;
$db->modify_data($sql);
header("Location: ../admin.php?key=sp");