<?php
session_start();
require_once __DIR__ . "/../../database.php";
function getAccount($username, $password)
{
    $query = "SELECT * FROM account WHERE UserName = '$username'";
    $hashedPassword = hash('sha256', $password);
    $dtb = new database();
    if ($result = $dtb->get_data($query)) {
        $dtb->close_dtb();
        while ($row = $result->fetch_assoc()) {
            if (hash_equals($row['Password'], $hashedPassword)) {
                return $row;
            } else {
                return null;
            }
        }
    } else {
        $dtb->close_dtb();
        return null;
    }
}
function getCustomerInfo()
{
    $dtb = new database();
    if (((string)$_SESSION['RoleID']) === "1") {
        $query = "SELECT * FROM customer WHERE UserID = '" . $_SESSION['UserID'] . "'";
    } else {
        $query = "SELECT * FROM staff WHERE UserID = '" . $_SESSION['UserID'] . "'";
    }
    if ($result = $dtb->get_data($query)) {
        $dtb->close_dtb();
        while ($row = $result->fetch_assoc()) {
            $_SESSION['Phone'] = $row['Phone'];
            $_SESSION['Address'] = $row['Address'];
            $_SESSION['IMG'] = base64_encode($row['IMG']);
            $_SESSION['StaffID'] = (((string)$_SESSION['RoleID']) !== "1") ? $row['StaffID'] : "";
            $_SESSION['Surname'] = (((string)$_SESSION['RoleID']) === "1") ? $row['CustomerSurname'] : $row['LastName'];
            $_SESSION['FirstName'] = (((string)$_SESSION['RoleID']) === "1") ? $row['CustomerName'] : $row['FirstName'];
        }
    }
}

$response = array();
if (isset($_POST['tendn']) && isset($_POST['mk'])) {
    $username = trim($_POST['tendn']);
    $password = $_POST['mk'];
    $loginInfo = getAccount($username, $password);
    if ($loginInfo === null) {
        $response['status'] = "error";
    } else {
        $response['status'] = "success";

        $_SESSION['UserID'] = $loginInfo['UserID'];
        $_SESSION['RoleID'] = $loginInfo['RoleID'];

        $_SESSION['username'] = $username;
        $_SESSION['Email'] = $loginInfo['Email'];

        $dtb = new database();
        $select2 = $dtb->select("SELECT * FROM `cart` WHERE `UserID`=?", [$_SESSION['UserID']], 'i');
        if($select2->num_rows>0){
            while($row=$select2->fetch_assoc()){
                $_SESSION['cart_idUser'] = $row['CartID'];
            }
        }else{
            $_SESSION['cart_idUser'] = -1;
        }
        getCustomerInfo();
    }
} else {
    $response['status'] = "error";
}
header('Content-Type: application/json');
echo json_encode($response);
