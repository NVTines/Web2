<?php
session_start();
require_once __DIR__."/../../database.php";

$dtb = new database();
$response = array();
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordrp']) && isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address'])) {
    $username = trim($_POST['username']);
    $sql = "SELECT * FROM account WHERE UserName = '$username'";
    $checkUserName = $dtb->get_data($sql);
    if($checkUserName && $checkUserName->num_rows > 0){
        $response['status'] = "username_error";
    }else{
        $password = $_POST['password'];
        $hashPassword = hash('sha256', $password);
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $surname = $_POST['surname'];
        $name = $_POST['name'];
        $img_url = __DIR__.'/../../img/default-avatar.png';
        $sql = "INSERT INTO account (UserName, Password, RoleID, Email, Enable) values ('$username','$hashPassword','1','$email','1')";
        if($dtb->insert_data($sql)){
            $sql = "SELECT * FROM account where UserName = '$username'";
            if($result = $dtb->get_data($sql)){
                while($row = $result->fetch_assoc()){
                    $userid = $row["UserID"];
                    $sql = "INSERT INTO Customer (UserID, CustomerSurname, CustomerName, Phone, Address, IMG, status) values ('$userid','$surname','$name','$phone','$address',:img,'1')";
                    if($dtb->changeImgByPDO($img_url, $sql)){
                        $response['status']="success";
                    }
                }                            
            }
        }   
    }       
}else{
    $response['status'] = "undefined_error";
}
$dtb->close_dtb();
header('Content-Type: application/json');
echo json_encode($response);
