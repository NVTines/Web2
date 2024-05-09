<?php
    require_once __DIR__."/../../database.php";
    $dtb = new database();
    $response = array();
    if(isset($_POST["data"])){
        $id = $_POST["data"];
        $sql = "UPDATE supplier SET status=2 WHERE SupplierID='$id'"; 
        if($dtb->modify_data($sql)){
            $response['status'] = "success";       
        }else{
            $response['status'] = "error";
        }
        $dtb->close_dtb();
        header('Content-Type: application/json');
        echo json_encode($response);    
    }