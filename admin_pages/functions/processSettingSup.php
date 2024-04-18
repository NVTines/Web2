<?php
    session_start();
    require_once __DIR__."/../../database.php";
    $dtb = new database();
    $response=array();
    if(isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["phone"]) && isset($_POST["fax"]) && isset($_POST['id'])){
        $name = $_POST["name"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $fax = $_POST["fax"];
        $id = $_POST['id'];
        $regex = '/^0[0-9]{9}$/';
        if(preg_match($regex, $phone) && preg_match($regex, $fax)){
            if($id == ""){
                $sql = "INSERT INTO supplier (SupplierName, Address, Phone, FaxNumber, status) values ('$name','$address','$phone','$fax',1)";
                if($results = $dtb->insert_data($sql)){
                    $response['status']="success";
                }
                else $response['status']="error";
            }else{
                $sql = "UPDATE supplier set SupplierName='$name', Address='$address', Phone='$phone', FaxNumber='$fax' WHERE SupplierID = '$id'";
                if($results = $dtb->modify_data($sql)){
                    $response['status']="success-update";
                }
                else $response['status']="error";
            }
        }else{
            $response['status']="regex-error";
        }
    }else $response['status']="error";
    $dtb->close_dtb();
    header('Content-Type: application/json');
    echo json_encode($response);
?>