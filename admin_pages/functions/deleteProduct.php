<?php
    require_once __DIR__."/../../database.php";
    $dtb = new database();
    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $sql = "UPDATE product SET status='hidd' WHERE ProductID='$id'"; 
        if($dtb->modify_data($sql)){
            $response['status'] = "success";
        }else{
            $response['status'] = "error";
        }
        $dtb->close_dtb();
        header('Content-Type: application/json');
        echo json_encode($response);  
    }