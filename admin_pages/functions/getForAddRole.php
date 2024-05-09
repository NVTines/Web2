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

// Truy vấn cơ sở dữ liệu để lấy danh sách chức năng
$functionSql = "SELECT * FROM `function`";
$functionResult = mysqli_query($conn, $functionSql);
$functionNames = array();

if ($functionResult && mysqli_num_rows($functionResult) > 0) {
    while ($functionRow = mysqli_fetch_assoc($functionResult)) {
        $functionNames[] = $functionRow['FunctionName'];
    }
}

// Đóng kết nối
mysqli_close($conn);

// Tạo mảng phản hồi JSON
$response = array(
    'functionNames' => $functionNames
);

// Phản hồi dữ liệu dưới dạng JSON
echo json_encode($response);
?>
