<script type="text/javascript">
    $(document).ready(function() {
        $("#regis-form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'pages/functions/process_register.php',
                data: {
                    username: $("#username").val(),
                    password: $("#password").val(),
                    passwordrp: $("#passwordrp").val(),
                    surname: $("#surname").val(),
                    name: $("#name").val(),
                    email: $("#email").val(),
                    phone: $("#phone").val(),
                    address: $("#address").val(),
                },
                success: function(response) {
                    console.log(response);
                    switch(response['status']){
                        case "username_error":
                            Swal.fire({
                                title: 'Đăng ký thất bại',
                                text: 'Username đã tồn tại/Username không hợp lệ (không tồn tại khoảng trắng).',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            break;
                        case "regex_error":
                            Swal.fire({
                                title: 'Đăng ký thất bại',
                                text: 'Mật khẩu phải ít nhất 1 ký tự thường, 1 ký tự hoa, 1 ký tự đặc biệt, 1 số và có độ dài từ 8-15 kí tự.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            break;
                        case "confirmpwd_error":
                            Swal.fire({
                                title: 'Đăng ký thất bại',
                                text: 'Mật khẩu không trùng khớp.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            break;
                        case "email_error":
                            Swal.fire({
                                title: 'Đăng ký thất bại',
                                text: 'Mail nhập không đúng (Ex: abc@gmail.com).',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            break;
                        case "phone_error":
                            Swal.fire({
                                title: 'Đăng ký thất bại',
                                text: 'Số điện thoại không hợp lệ (10 kí tự số).',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            break;
                        case "undefined_error":
                            Swal.fire({
                                title: 'Đăng ký thất bại',
                                text: 'Không thể thực hiện đăng ký (Undefined Error).',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            break;
                        case "success":
                            Swal.fire({
                            title: 'Đăng ký thành công!',
                            text: 'Bạn đã đăng ký tài khoản thành công.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "index.php";
                                }
                            });
                            break;
                    }
                }
            });
        });
    });
    
    function pwdMatchCheck(){
        if(document.getElementById("password").value != document.getElementById("passwordrp").value)
            document.getElementById("error_pwdrp").style.display="block";
        else
            document.getElementById("error_pwdrp").style.display="none";
    }
    function pwdCheck(){
        var password = document.getElementById("password").value;
        var regex=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
        if(password.match(regex)){
            document.getElementById("check_pwd").style.display="none";
        }else{
            document.getElementById("check_pwd").style.display="block";
        }
        pwdMatchCheck();
    }

</script>
<div style="border-bottom: #CDCDCD solid 1px">
    <a onclick="out_2();"><input type="button"  style="padding:0 3px;float: right;font-size:30px;background: #FFFFFF;border: #FFFFFF;cursor: pointer" class="material-icons" value="backspace"></a>
    <h2 style="text-align: center;padding: 40px">BECOME A MEMBER</h2>
</div>
<div style="padding: 20px;text-align: center">
    <form id="regis-form" class="regis-form" method="POST">
        <p style="padding:20px 0px;">Create your Member profile and get first access to the very best of our products, inspiration and community.</p>
        <input required id="username" type="text" placeholder="Username*" style="width: 100%;height: 32px;margin: 10px 0px;font-weight: bold;font-size: 15px;padding: 10px"/><br>
        <input required onblur="pwdCheck()" id="password" type="password" placeholder="Password*" style="width: 100%;height: 32px;margin: 10px 0px;font-weight: bold;font-size: 15px;padding: 10px"/><br>
        <p id="check_pwd" class="check_pwd" style="color:red;font-style:italic;float:left;display:none;">
            (At least 1 lower & upper case letter, 1 number, 1 special character, 8 up to 15 characters in length) 
        </p>
        <input required onblur="pwdMatchCheck()" id="passwordrp" type="password" placeholder="Fill in password again*" style="width: 100%;height: 32px;margin: 10px 0px;font-weight: bold;font-size: 15px;padding: 10px"/><br>
        <p id="error_pwdrp" class="error_pwdrp" style="color:red;font-style:italic;float:left;display:none;">Incorrect Password</p>
        <input required id="surname" type="text" placeholder="Surname*" style="width: 100%;height: 32px;margin: 10px 0px;font-weight: bold;font-size: 15px;padding: 10px"/><br>
        <input required id="name" type="text" placeholder="Name*" style="width: 100%;height: 32px;margin: 10px 0px;font-weight: bold;font-size: 15px;padding: 10px"/><br>
        <input required id="email" type="text" placeholder="Email address*" style="width: 100%;height: 32px;margin: 10px 0px;font-weight: bold;font-size: 15px;padding: 10px"/><br>
        <input required id="phone" type="text" placeholder="Phone number*" style="width: 100%;height: 32px;margin: 10px 0px;font-weight: bold;font-size: 15px;padding: 10px"/><br>
        <input required id="address" type="text" placeholder="Your Current address*" style="width: 100%;height: 32px;margin: 10px 0px;font-weight: bold;font-size: 15px;padding: 10px"/><br>
        <button style="cursor: pointer;font-size:20px;background-color:black;color:white;padding:10px 30px;text-align: center;margin-top:10px">Join us</button>
    </form> 
</div>
<div style="text-align: center">
    <div>Already a member?<a style="cursor: pointer;padding:30px 5px;text-decoration: underline;" onclick="dangnhap()">Sign in</a></div>
</div>