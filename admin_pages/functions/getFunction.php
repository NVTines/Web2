<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laptrinhweb2";

// Tạo kết nối
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Lấy dữ liệu từ yêu cầu Ajax
$roleId = $_POST['roleId'];

// In ra dữ liệu đã nhận được
echo "Dữ liệu nhận được từ yêu cầu Ajax: ";
echo "Role ID: " . $roleId;

// Truy vấn cơ sở dữ liệu để lấy danh sách chức năng
$functionSql = "SELECT * FROM `function`";
$functionResult = mysqli_query($conn, $functionSql);
$functionNames = array();

if ($functionResult && mysqli_num_rows($functionResult) > 0) {
    while ($functionRow = mysqli_fetch_assoc($functionResult)) {
        $functionNames[] = $functionRow['FunctionName'];
    }
}

// Thực hiện truy vấn cơ sở dữ liệu để lấy danh sách chức năng của vai trò
$roleFunctionSql = "SELECT * FROM roledetail WHERE RoleID = '$roleId'";
$roleFunctionResult = mysqli_query($conn, $roleFunctionSql);
$roleFunctions = array();

if ($roleFunctionResult && mysqli_num_rows($roleFunctionResult) > 0) {
    while ($roleFunctionRow = mysqli_fetch_assoc($roleFunctionResult)) {
        $roleFunctions[] = $roleFunctionRow['FunctionID'];
    }
}

// Đóng kết nối
mysqli_close($conn);

// Tạo mảng phản hồi JSON
$response = array(
    'functionNames' => $functionNames,
    'roleFunctions' => $roleFunctions
);

// Phản hồi dữ liệu dưới dạng JSON
echo json_encode($response);
?>