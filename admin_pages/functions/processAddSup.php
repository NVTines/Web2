<?php
    require_once __DIR__."/../../database.php";
    if(isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["phone"]) && isset($_POST["fax"])){
        $dtb = new database();
        $name = $_POST["name"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $fax = $_POST["fax"];
        $sql = "INSERT INTO supplier (SupplierName, Address, Phone, FaxNumber, status) values ('$name','$address','$phone','$fax',1)";
        if($results = $dtb->insert_data($sql)){
            
        }
    }