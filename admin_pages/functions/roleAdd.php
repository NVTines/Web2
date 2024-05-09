<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem roleName và functions đã được gửi chưa
    if (isset($_POST['roleName']) && isset($_POST['functions'])) {
        // Nhận dữ liệu từ Ajax request
        $roleName = $_POST['roleName'];
        $functions = $_POST['functions'];

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

        // Thêm tên vai trò vào bảng role
        $sql_insert_role = "INSERT INTO `role` (RoleName) VALUES ('$roleName')";
        

        if ($conn->query($sql_insert_role) === TRUE) {
            // Lấy ID của vai trò vừa thêm vào bằng cách lấy max trong cột RoleID của bảng role
            $sql_max_roleId = "SELECT MAX(RoleID) AS maxRoleId FROM role";
            $result_max_roleId = $conn->query($sql_max_roleId);
            if ($result_max_roleId->num_rows > 0) {
                $row_max_roleId = $result_max_roleId->fetch_assoc();
                $roleId = $row_max_roleId['maxRoleId'];
            }

            // Thêm các dữ liệu mới vào bảng roledetail
            foreach ($functions as $function) {
                $sql_insert = "INSERT INTO roledetail (RoleID, FunctionID) VALUES ($roleId, $function)";
                if ($conn->query($sql_insert) !== TRUE) {
                    // Gửi lại response với thông báo lỗi
                    die("Lỗi khi thêm dữ liệu mới vào bảng roledetail: " . $conn->error);
                }
            }
            // Gửi lại response với thông báo thành công
            echo "Dữ liệu đã được cập nhật thành công";
        } else {
            // Gửi lại response với thông báo lỗi
            die("Lỗi khi thêm vai trò vào bảng role: " . $conn->error);
        }

        // Đóng kết nối
        $conn->close();
    } else {
        // Gửi lại response với thông báo lỗi
        die("Lỗi: Thiếu dữ liệu gửi đến.");
    }
} else {
    // Gửi lại response với thông báo lỗi
    die("Lỗi: Yêu cầu không hợp lệ.");
}
?>