<script type="text/javascript">
    $(document).ready(function() {
        $("#info-form").submit(function(e) {
            var form = new FormData();
            form.append("username",document.getElementById("username-info").value);
            form.append("surname",document.getElementById("surname-info").value);
            form.append("firstname",document.getElementById("firstname-info").value);
            form.append("email",document.getElementById("email-info").value);
            form.append("phone",document.getElementById("phone-info").value);
            form.append("address",document.getElementById("address-info").value);
            form.append("fileToUpload",document.getElementById("fileToUpload").files[0]);

            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'pages/functions/update_profile.php',
                data: form,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    switch(response['status']){
                        case "fileMatch_error":
                            Swal.fire({
                                title: 'Cập nhật thất bại',
                                text: 'Chỉ có thể chọn file là hình ảnh.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "index.php?page=info";
                                }
                            });
                            break;
                        case "upload_error":
                            Swal.fire({
                                title: 'Cập nhật thất bại',
                                text: 'Dung lượng tối đa của file ảnh là 1 MB.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "index.php?page=info";
                                }
                            });
                            break;
                        case "username_error":
                            Swal.fire({
                                title: 'Cập nhật thất bại',
                                text: 'Username đã tồn tại/Username không hợp lệ (không tồn tại khoảng trắng).',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            break;
                        case "email_error":
                            Swal.fire({
                                title: 'Cập nhật thất bại',
                                text: 'Mail nhập không đúng (Ex: abc@gmail.com).',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            break;
                        case "phone_error":
                            Swal.fire({
                                title: 'Cập nhật thất bại',
                                text: 'Số điện thoại không hợp lệ (10 kí tự số).',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            break;
                        case "undefined_error":
                            Swal.fire({
                                title: 'Cập nhật thất bại',
                                text: 'Có gì đó sai sai.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            break;
                        case "success":
                            Swal.fire({
                            title: 'Cập nhật thành công',
                            text: 'Bạn đã cập nhật thông tin tài khoản thành công.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "index.php?page=info";
                                }
                            });
                            break;
                    }
                }
            });
        });
    });
</script>
<div style="display:flex;justify-content:center;">
    <div style="width:100%;padding:50px;">
        <div style="width:100%;border: 1px solid #d1d1d1;background-color:white">
            <div id="title-info" class="title-info">
                <h1>Your Information</h1>
            </div>
            <div id="info-wrapper" class="info-wrapper">
                <form id="info-form" class="info-form" enctype="multipart/form-data" method="POST">
                    
                    <div id="right-form-info" class="right-form-info">
                        <img alt="" class="avt-info" id="avt-info" src="data:image/png;base64,<?php echo $_SESSION['IMG']; ?>" /><br>
                        <label for="fileToUpload" id="choose-img-btn" class="choose-img-btn" >Choose picture</label>
                        <input accept="image/*" style="display:none" onchange="previewImage(event)" type="file" name="fileToUpload" class="fileToUpload" id="fileToUpload" />
                    </div>

                    <div id="left-form-info" class="left-form-info">
                        <div class="form-row">
                            <label class="form-col" for="username">User name: </label>
                            <input required type="text" class="form-col" name="username" id="username-info" placeholder="Your username..." value="<?php echo $_SESSION['username'];?>" /><br>                            
                        </div>

                        <div class="form-row">
                            <label class="form-col" for="email">Email: </label>
                            <input required type="text" class="form-col" name="email" id="email-info" placeholder="Your email..." value="<?php echo $_SESSION['Email'];?>"/><br>
                        </div>

                        <div class="form-row">
                            <label class="form-col" for="surname">Surname: </label>
                            <input required type="text" class="form-col" name="surname" id="surname-info" placeholder="Your surname..." value="<?php echo $_SESSION['Surname'];?>"/><br>
                        </div>

                        <div class="form-row">
                            <label class="form-col" for="firstname">First Name: </label>
                            <input required type="text" class="form-col" name="firstname" id="firstname-info" placeholder="Your firstname..." value="<?php echo $_SESSION['FirstName'];?>"/><br>
                        </div>

                        <div class="form-row">
                            <label class="form-col" for="address">Address: </label>
                            <input required type="text" class="form-col" name="address" id="address-info" placeholder="Your address..." value="<?php echo $_SESSION['Address'];?>"/><br>
                        </div>

                        <div class="form-row">
                            <label class="form-col" for="phone">Phone Number: </label>
                            <input required type="text" class="form-col" name="phone" id="phone-info" placeholder="Your phone..." value="<?php echo $_SESSION['Phone'];?>"/><br>
                        </div>
                    </div>

                    

                </form>
                <div class="btn-wrapper-info" id="btn-wrapper-info">
                    <input form="info-form" type="submit" name="submit" id="update-info" class="update-info" value="Save">
                    <a href="pages/functions/logout.php"><input type="submit" name="submit" id="logout-btn" class="logout-btn" value="Quit" /></a>
                </div>
            </div>

        </div>
    </div>
</div>