<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.querySelector('.avt-info');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<?php
$db = new database();
?>
<div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776;THÊM NHÂN VIÊN</div>
        <a href="admin.php?key=users" class="back-btn">QUAY LẠI</a>
    </div>
</div>
<div class="col-div-8">
    <div class="box-8" style="display:flex;justify-content:center;">
        <form action="./functions/addNewStaff.php" class="info-manage-form" method="POST">
            <div style="margin-left:20%;margin-right:20%;margin-top:50px;">
                <div class="right-form-info">
                    <img alt="/img/default-avatar.png" class="avt-info" src="/img/default-avatar.png" /><br>
                    <label for="uploadProductImage" class="choose-img-btn">Choose picture</label>
                    <input id="uploadProductImage" accept="image/*" style="display:none" onchange="previewImage(event)" type="file" name="fileToUpload" class="fileToUpload" id="" />
                </div>
                <div class="left-form-info">
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label">Họ:</label>
                        <input required type="text" name="lastname" class="info-manage-input" />
                    </div>
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label">Tên:</label>
                        <input required type="text" name="firstname" class="info-manage-input" />
                    </div>
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label">Năm sinh:</label>
                        <input required type="number" maxlength="4" name="yob" class="info-manage-input" />
                    </div>
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label">Giới tính:</label>
                        <select class="info-manage-input" name="gender">
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label">SĐT:</label>
                        <input required type="text" maxlength="10" name="phone" class="info-manage-input" id="phone" />
                    </div>
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label">Email:</label>
                        <input required type="email" name="email" class="info-manage-input" />
                    </div>
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label">Địa chỉ:</label>
                        <input required type="text" name="address" class="info-manage-input" />
                    </div>
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label">Lương:</label>
                        <input required type="number" min="5000000" step="200000" name="salary" class="info-manage-input" />
                    </div>
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label">Tài khoản:</label>
                        <input required type="text" name="username" class="info-manage-input" />
                    </div>
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label">Mật khẩu:</label>
                        <input required type="text" name="password" class="info-manage-input" />
                    </div>
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label">Vai trò:</label>
                        <select class="info-manage-input" name="role">
                            <?php
                            $sql = "SELECT * FROM role";
                            if ($results = $db->get_data($sql)) {
                                while ($rows = $results->fetch_assoc()) {
                                    if ($rows["RoleName"] == "Customer") {
                                        continue;
                                    }
                                    echo '<option value="' . $rows["RoleID"] . '">' . $rows["RoleName"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
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