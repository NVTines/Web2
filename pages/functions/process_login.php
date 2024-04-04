<?php
session_start();
require_once __DIR__."/../../database.php";
function getAccount($username, $password)
{
    $query = "SELECT * FROM account WHERE UserName = '$username'";
    $hashedPassword = hash('sha256', $password);
    $dtb = new database();
    $result = $dtb->get_data($query);
    $dtb->close_dtb();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (hash_equals($row['Password'], $hashedPassword)) {
            return $row;
        } else {
            return null;
        }
    } else {
        return null;
    }
}


$response = array();
if (isset($_POST['tendn']) && isset($_POST['mk'])) {
    $username = isset($_POST['tendn']);
    $password = isset($_POST['mk']);
    $loginInfo = getAccount($username, $password);

    if ($loginInfo == null) {
        $response['status'] = "error";
    } else {
        $response['status'] = "success";
        $_SESSION['username'] = $username;
        $_SESSION['UserID'] = $loginInfo['UserID'];
    }
}else{
    $response['status'] = "error";
}
header('Content-Type: application/json');
echo json_encode($response);
