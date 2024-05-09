<?php
echo '
<div id="shows">
    <div class="col-div-8" style="margin:20px 0px;">
        <div class="box-8">
            <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ QUYỀN</div>
            <a onclick="showAddForm();" class="add-management-btn">THÊM</a>
        </div>
    </div>
    <div class="col-div-8">
        <div class="box-8">
            <div class="content-box">
                <table>
                    <tr>
                        <th>Vai Trò</th>';

$conn = new database();
// Truy vấn cơ sở dữ liệu để lấy danh sách chức năng
$functionSql = "SELECT * FROM function";
$functionResult = $conn->get_data($functionSql);
$functionNames = array();

if ($functionResult && $functionResult->num_rows > 0) {
    while ($functionRow = $functionResult->fetch_assoc()) {
        $functionNames[] = $functionRow['FunctionName'];
        echo '<th>' . $functionRow['FunctionName'] . '</th>';
    }
}

echo '<th></th></tr>';

// Truy vấn cơ sở dữ liệu để lấy danh sách vai trò
$roleSql = "SELECT * FROM role";
$roleResult = $conn->get_data($roleSql);

if ($roleResult && $roleResult->num_rows > 0) {
    while ($roleRow = $roleResult->fetch_assoc()) {
        echo '<tr>';
        echo '<td><b>' . $roleRow['RoleName'] . '</b></td>';
        $roleId = $roleRow['RoleID'];

        for ($i = 0; $i < count($functionNames); $i++) {
            $functionName = $functionNames[$i];
            $functionId = $i + 1;

            // Kiểm tra xem vai trò có chức năng này hay không
            $roleFunctionSql = "SELECT * FROM roledetail WHERE RoleID = '$roleId' AND FunctionID = '$functionId'";
            $roleFunctionResult = $conn->get_data($roleFunctionSql);

            if ($roleFunctionResult && $roleFunctionResult->num_rows > 0) {
                echo '<td><span class="checkbox-icon checked"><i class="fas fa-check" style="color: green;"></i></span></td>';
            } else {
                echo '<td><span class="checkbox-icon"><i class="fas fa-times" style="color: red;"></i></span></td>';
            }
        }

        // Thêm cột chỉnh sửa và button chỉnh sửa
        echo '<td>
                <button onclick="showEditForm(' . $roleId . ', \'' . $roleRow['RoleName'] . '\')" class="info_btn">
                    <i class="fa-solid fa-gear"></i>
                </button>
                <a onclick="">
                    <button class="quit_btn">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </a>
            </td>';
        echo '</tr>';
    }
}

echo '</table>
</div>
</div>
<div id="edit-form-container" style="z-index:2;font-size: 23px;position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #cacddb; border-radius:20px;display: none;padding:20px;"></div>
</div>';

?>
<script>
   
    function cancelEdit() {
        // Xóa form chỉnh sửa
        hideForm();
        var editFormContainer = $('#edit-form-container');
        editFormContainer.html("");
        document.querySelector("#edit-form-container").style.display = "none";
    }
    function cancelAdd() {
        // Xóa form chỉnh sửa
        hideForm();
        var editFormContainer = $('#edit-form-container');
        editFormContainer.html("");
        document.querySelector("#edit-form-container").style.display = "none";
    }
    function showEditForm(roleId, roleName) {
        showForm();
        document.querySelector("#edit-form-container").style.display = "flex";
        // Gửi yêu cầu Ajax để lấy danh sách chức năng
        $.ajax({
            url: 'functions/getFunction.php',
            type: 'post',
            data: { roleId: roleId },
            success: function (response) {
                // console.log(response)
                var jsonDataStart = response.indexOf('{');

                // Trích xuất phần chuỗi JSON từ vị trí '{' đến hết chuỗi
                var jsonData = response.slice(jsonDataStart);

                // Phân tích cú pháp chuỗi JSON thành đối tượng JavaScript
                var parsedData = JSON.parse(jsonData);

                // Truy cập vào các thuộc tính functionNames và roleFunctions
                var functionNames = parsedData.functionNames;
                var roleFunctions = parsedData.roleFunctions;


                // Tạo form chỉnh sửa
                var formHtml = '<form id="edit-form">';

                // Thêm các trường dữ liệu vào form
                formHtml += '<div style="text-align:center;"><h1>Role Information</h1></div>'
                formHtml += '<input type="hidden" name="roleId" value="' + roleId + '">';
                formHtml += '<label for="roleName"><b>VAI TRÒ:</b></label>';
                formHtml += '<input style="font-size:23px;margin-left:10px;border:none;font-weight:bold" type="text" name="roleName" id="roleName" value="' + roleName + '" required>';

                for (var i = 0; i < functionNames.length; i++) {
                    formHtml += '<div>';
                    formHtml += '<input style="margin-top:20px;" type="checkbox" name="functions[]" value="' + functionNames[i] + '"';
                    // Check if the current role has the function assigned
                    if (roleFunctions.includes("" + (i + 1))) {
                        formHtml += ' checked';
                    }


                    formHtml += '> ' + functionNames[i] + '</div>';
                }
                formHtml += '<div style="width:100%;margin-top:20px;"></div><button type="submit" style="padding:10px;font-size:23px;font-weight:bold;">Lưu</button>';
                formHtml += '<button type="button" onclick="cancelEdit()" style="float:right;padding:10px;font-size:23px;font-weight:bold;">Hủy</button>';
                formHtml += '</form>';



                // Thêm form vào trang web
                var editFormContainer = $('#edit-form-container');
                editFormContainer.html(formHtml);
            }
        });

    }
    $(document).on('submit', '#edit-form', function (event) {
        event.preventDefault();

        // Lấy dữ liệu từ form
        var roldName = $("input[name='roleName']").val();
        var roldId = $("input[name='roleId']").val();
        var functions = [];
        var checkboxes = document.getElementsByName('functions[]');

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                functions.push(i + 1);
            }
        }

        // Gửi request Ajax để xử lý dữ liệu
        $.ajax({
            url: 'functions/roleEdit.php',
            type: 'post',
            data: { roleId: roldId, functions: functions, roleName: roldName },
            success: function (response) {
                Swal.fire({
                    title: 'Thành công',
                    text: 'Cập nhật thành công!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        });
    });

    function showAddForm() {
        showForm();
        // Hiển thị container của form
        document.querySelector("#edit-form-container").style.display = "flex";

        // Gửi yêu cầu Ajax để lấy danh sách chức năng
        $.ajax({
            url: 'functions/getForAddRole.php',
            type: 'post',
            success: function (response) {
                console.log(response);
                var jsonDataStart = response.indexOf('{');
                var jsonData = response.slice(jsonDataStart);
                var parsedData = JSON.parse(jsonData);
                var functionNames = parsedData.functionNames;

                // Tạo form thêm mới
                var formHtml = '<form id="add-form">';
                formHtml += '<div style="text-align:center;"><h1>Role Information</h1></div>'
                formHtml += '<label for="roleName"><b>VAI TRÒ:</b></label>';
                formHtml += '<input style="font-size:23px;margin-left:10px;border:none;font-weight:bold" type="text" name="roleName" id="roleName" required>';

                for (var i = 0; i < functionNames.length; i++) {
                    formHtml += '<div>';
                    formHtml += '<input style="margin-top:20px;" type="checkbox" name="functions[]" value="' + functionNames[i] + '"> ' + functionNames[i];
                    formHtml += '</div>';
                }
                formHtml += '<div style="width:100%;margin-top:20px;"></div><button type="submit" style="padding:10px;font-size:23px;font-weight:bold;">Lưu</button>';
                formHtml += '<button type="button" onclick="cancelAdd()" style="float:right;padding:10px;font-size:23px;font-weight:bold;">Hủy</button>';
                formHtml += '</form>';

                // Thêm form vào container trên trang web
                var editFormContainer = $('#edit-form-container');
                editFormContainer.html(formHtml);
            }
        });
    }
    $(document).on('submit', '#add-form', function (event) {
        event.preventDefault();

        // Lấy dữ liệu từ form
        var roleName = $("input[name='roleName']").val();
        var functions = [];
        var checkboxes = document.getElementsByName('functions[]');

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                functions.push(i + 1);
            }
        }

        // Gửi request Ajax để xử lý dữ liệu
        $.ajax({
            url: 'functions/roleAdd.php',
            type: 'post',
            data: {functions: functions, roleName: roleName },
            success: function (response) {
                Swal.fire({
                    title: 'Thành công',
                    text: 'Thêm mới thành công!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        });
    });



</script>