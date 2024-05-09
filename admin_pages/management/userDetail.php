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
            CONCAT(staff.LastName, ' ', staff.FirstName) AS Fullname,
            staff.Phone,
            staff.YearOfBirth,
            account.Email,
            account.Enable,
            staff.IMG,
            staff.Salary,
            staff.Gender,
            staff.Address
        FROM staff
        JOIN account ON staff.UserID = account.UserID
        WHERE staff.UserID = $id;
        ";
} elseif ($role == "Customer") {
    $sql =
        "
        SELECT
            customer.CustomerID,
            account.UserName,
            CONCAT(customer.CustomerSurname, ' ', customer.CustomerName) AS Fullname,
            customer.Phone,
            account.Email,
            account.Enable,
            customer.IMG,
            '' AS Salary,
            customer.Gender,
            customer.Address
        FROM customer
        JOIN account ON customer.UserID = account.UserID
        WHERE customer.UserID = $id;
        ";
}
// else {
//     $sql =
//         "
//         SELECT
//             account.UserID,
//             account.UserName,
//             'Admin' AS Role,
//             'Admin' AS Fullname,
//             'Admin' AS Phone,
//             account.Email,
//             'Admin' AS Address
//         FROM account
//         WHERE account.UserID = $id;
//         ";
// }
// echo $sql;
if ($results = $db->get_data($sql)) {
    $rows = $results->fetch_assoc();
}
?>
<div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776; THÔNG TIN NGƯỜI DÙNG</div>
        <a href="admin.php?key=users" class="back-btn">QUAY LẠI</a>
    </div>
</div>
<div class="col-div-8">
    <div class="box-8" style="display:flex;justify-content:center;">
        <form action="./functions/updateUser.php?id=<?php echo $id; ?>&type=<?php echo $role; ?>" class="info-manage-form" method="POST">
            <div style="margin-left:20%;margin-right:20%;margin-top:50px;">
                <div class="right-form-info">
                    <img alt="/img/default-avatar.png" class="avt-info" src="/img/default-avatar.png" /><br>
                    <label for="uploadProductImage" class="choose-img-btn">Choose picture</label>
                    <input id="uploadProductImage" accept="image/*" style="display:none" onchange="previewImage(event)" type="file" name="fileToUpload" class="fileToUpload" id="" />
                </div>
                <div class="left-form-info">
                    <div class="info-wrapper">
                        <h3>Họ tên:</h3>
                        <h3><?php echo $rows["Fullname"]; ?></h3>
                    </div>
                    <div class="info-wrapper">
                        <h3>Tài khoản:</h3>
                        <h3><?php echo $rows["UserName"]; ?></h3>
                    </div>
                    <?php
                    if ($role == "Staff") {
                        echo
                        '
                        <div class="info-wrapper">
                            <h3>Năm sinh:</h3>
                            <h3>' . $rows["YearOfBirth"] . '</h3>
                        </div>
                        ';
                    }
                    ?>
                    <div class="info-wrapper">
                        <h3>Giới tính:</h3>
                        <h3><?php echo $rows["Gender"]; ?></h3>
                    </div>
                    <div class="info-wrapper">
                        <h3>SĐT:</h3>
                        <h3><?php echo $rows["Phone"]; ?></h3>
                    </div>
                    <div class="info-wrapper">
                        <h3>Email:</h3>
                        <h3><?php echo $rows["Email"]; ?></h3>
                    </div>
                    <div class="info-wrapper">
                        <h3>Địa chỉ:</h3>
                        <h3><?php echo $rows["Address"]; ?></h3>
                    </div>
                    <div class="info-wrapper">
                        <h3>Lương:</h3>
                        <h3><?php echo $rows["Salary"]; ?> VND</h3>
                    </div>
                    <div class="info-wrapper">
                        <h3>Vai trò:</h3>
                        <h3><?php echo $role; ?></h3>
                    </div>
                    <div class="info-wrapper">
                        <h3>Mật khẩu:</h3>
                        <h3>********</h3>
                    </div>
                    <div class="info-wrapper">
                        <label class="info-manage-label">Trạng thái:</label>
                        <select style="margin-left: 5px;" class="info-manage-input" name="enable">
                            <option value="1" <?php if ($rows["Enable"] == 1) {
                                                    echo "selected";
                                                } ?>>Hoạt động</option>
                            <option value="0" <?php if ($rows["Enable"] == 0) {
                                                    echo "selected";
                                                } ?>>Khóa</option>
                        </select>
                    </div>
                    <?php
                    if ($role == "Staff") {
                        echo
                        '
                        <div class="info-manage-wrapper">
                        <label class="info-manage-label">Vai trò:</label>
                        <select class="info-manage-input" name="role">';
                        $sql = "SELECT * FROM role";
                        if ($results = $db->get_data($sql)) {
                            while ($rows = $results->fetch_assoc()) {
                                if ($rows["RoleName"] == "Customer") {
                                    continue;
                                }
                                echo '<option value="' . $rows["RoleID"] . '">' . $rows["RoleName"] . '</option>';
                            }
                        }
                        echo "</select>
                        </div>";
                    }
                    ?>
                </div>
                <div style="clear:both"></div>
            </div>
            <div class="info-btn-wrapper">
                <input type="submit" id="sup-submit-btn" value="Xác nhận">
                <input id="sup-reset-btn" type="reset" value="Refresh">
            </div>
        </form>
    </div>
</div>