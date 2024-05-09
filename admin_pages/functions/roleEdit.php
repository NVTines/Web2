<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem roleId, roleName và functions đã được gửi chưa
    if (isset($_POST['roleId']) && isset($_POST['roleName'])) {
        // Nhận dữ liệu từ Ajax request
        $roleId = $_POST['roleId'];
        $roleName = $_POST['roleName'];
        $functions = isset($_POST['functions'])?$_POST['functions']:null;

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "laptrinhweb2";

        // Tạo kết nối
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        // Cập nhật tên vai trò trong bảng role
        $sql_update_role = "UPDATE role SET RoleName = '$roleName' WHERE RoleID = $roleId";
        if ($conn->query($sql_update_role) === TRUE) {
            // Xóa các dữ liệu cũ trong bảng roledetail liên quan đến roleId
            $sql_delete = "DELETE FROM roledetail WHERE RoleID = $roleId";
            if ($conn->query($sql_delete) === TRUE) {
                // Thêm các dữ liệu mới vào bảng roledetail
                foreach ($functions as $function) {
                    $sql_insert = "INSERT INTO roledetail (RoleID, FunctionID) VALUES ($roleId, $function)";
                    if ($conn->query($sql_insert) !== TRUE) {
                        echo "Lỗi khi thêm dữ liệu mới: " . $conn->error;
                    }
                }
            } else {
                echo "Lỗi khi xóa dữ liệu cũ: " . $conn->error;
            }
        } else {
            echo "Lỗi khi cập nhật tên vai trò: " . $conn->error;
        }

        // Đóng kết nối
        $conn->close();
    } else {
        echo "Lỗi: Thiếu dữ liệu gửi đến.";
    }
} else {
    echo "Lỗi: Yêu cầu không hợp lệ.";
}
?>
