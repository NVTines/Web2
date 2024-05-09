<?php
include_once "../../database.php";
$db = new database();
$id = $_GET["id"];
$type = $_GET["type"];
$enable = $_POST["enable"];

$role = "";
$sql = "";
if ($type == "Staff") {
    $role = $_POST["role"];
    $sql = "UPDATE account SET Enable = $enable, RoleID = $role WHERE UserID = $id";
} elseif ($type == "Customer") {
    $sql = "UPDATE account SET Enable = $enable WHERE UserID = $id";
}

$db->modify_data($sql);
header("Location: ../admin.php?key=users");