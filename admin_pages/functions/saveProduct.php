<?php
include_once "../../database.php";
$db = new Database();
$id = $_GET["id"];
$productName = $_POST["product-name"];
$brand = $_POST["brands"];
$price = $_POST["price"];
$status = $_POST["status"];
$file_name = $_FILES['fileToUpload']['name'];
$file_tmp = $_FILES['fileToUpload']['tmp_name'];
$file_destination = "uploads/" . $file_name;
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../../img/upload_img/" . $_FILES["fileToUpload"]["name"]);
$img_full_path = __DIR__ . "/../../img/upload_img/" . $file_name;
$sql = "UPDATE product SET ProductName = '$productName', ProducerID = '$brand', ProductPrice = '$price', status = '$status', IMG = :img WHERE ProductID = '$id'";
echo $sql;
$db->changeImgByPDO($img_full_path, $sql);
header("Location: ../admin.php?key=sp");
