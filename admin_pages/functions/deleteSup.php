<?php
    require_once __DIR__."/../../database.php";
    $dtb = new database();
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "UPDATE supplier SET status=2 WHERE SupplierID='$id'"; 
        $dtb->modify_data($sql);
        $dtb->close_dtb();
        header("Location:../admin.php?key=ncc");
    }