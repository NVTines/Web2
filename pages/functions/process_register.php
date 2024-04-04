<?php
session_start();
require_once __DIR__."/../../database.php";

$dtb = new database();
$response = array();
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordrp']) && isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address'])) {

    $username = isset($_POST['username']);
    $sql = "SELECT * FROM account WHERE UserName = '$username'";
    $checkUserName = $dtb->get_data($sql);
    if($checkUserName && $checkUserName->num_rows > 0){
        $response['status'] = "username_error";
    }else{
        $password = isset($_POST['password']);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8 || strlen($password) > 15) {
            $response['status'] = "regex_error";
        }else{
            $passwordrp = isset($_POST['passwordrp']);
            if($password != $passwordrp){
                $response['status'] = "confirmpwd_error";
            }else{
                $email = isset($_POST['email']);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $response['status'] = "email_error";
                }else{
                    $phone = isset($_POST['phone']);
                    $phone_format = preg_match('/^[0-9]{10}+$/', $phone);
                    if(!$phone_format){
                        $response['status'] = "phone_error";
                    }else{
                        $address = isset($_POST['address']);
                        $surname = isset($_POST['surname']);
                        $name = isset($_POST['name']);
                        $sql = "INSERT INTO account values ()";
                        if ($loginInfo == null) {
                            $response['status'] = "error";
                        } else {
                            $response['status'] = "success";
                            $_SESSION['username'] = $username;
                            $_SESSION['UserID'] = $loginInfo['UserID'];
                        }
                    }
                    
                }
                
            }
        }
        
        
    }   
}else{
    $response['status'] = "empty_error";
}
header('Content-Type: application/json');
echo json_encode($response);
