<?php
$id = $_GET["id"];
$role = $_GET["role"];
$sql = "";
if ($role == "Staff") {
    $sql =
        "
        SELECT
            staff.StaffID,
            account.UserName,
            CONCAT(staff.LastName, '', staff.FirstName) AS Fullname,
            staff.Phone,
            account.Email,
            staff.IMG,
            staff.Address
        FROM staff
        JOIN account ON staff.UserID = account.UserID;
        WHERE staff.StaffID = $id;
        ";
} elseif ($role == "Customer"){
    $sql =
        "
        SELECT
            customer.CustomerID,
            account.UserName,
            CONCAT(customer.CustomerSurname, '', customer.CustomerName) AS Fullname,
            customer.Phone,
            account.Email,
            customer.IMG,
            customer.Address
        FROM customer
        JOIN account ON customer.UserID = account.UserID;
        WHERE customer.CustomerID = $id;
        ";
} else {
    $sql =
        "
        SELECT
            account.UserID,
            account.UserName,
            'Admin' AS Role,
            'Admin' AS Fullname,
            'Admin' AS Phone,
            account.Email,
            'Admin' AS Address
        FROM account
        WHERE account.UserID = $id;
        ";
}
echo $sql;