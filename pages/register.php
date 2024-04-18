<script type="text/javascript">
    function usernameCheck(){
        var username = document.getElementById("username").value;
        var regex = /^(?=.*[a-zA-Z])(?=.*[0-9])(?!.*[^\w]).{5,}$/;
        if(username.match(regex)){
            document.getElementById("username-validate-regis").style.display="none";
            document.getElementById("username").style.border="solid 1px black";
            document.getElementById("username").style.border="black";
            return true;
        }else{
            document.getElementById("username-validate-regis").style.display="block";
            document.getElementById("username").style.border="solid 1px red";
            document.getElementById("username").style.color="red";
            return false;
        }
    }
    function emailCheck(){
        var email = document.getElementById("email").value;
        var regex = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]+$/;
        if(email.match(regex)){
            document.getElementById("email-validate-regis").style.display="none";
            document.getElementById("email").style.border="solid 1px black";
            document.getElementById("email").style.border="black";
            return true;
        }else{
            document.getElementById("email-validate-regis").style.display="block";
            document.getElementById("email").style.border="solid 1px red";
            document.getElementById("email").style.color="red";
            return false;
        }
    }
    function phoneCheck(){
        var phone = document.getElementById("phone").value;
        var regex = /^0[0-9]{9}$/;
        if(phone.match(regex)){
            document.getElementById("phone-validate-regis").style.display="none";
            document.getElementById("phone").style.border="solid 1px black";
            document.getElementById("phone").style.color="black";
            return true;
        }else{
            document.getElementById("phone-validate-regis").style.display="block";
            document.getElementById("phone").style.border="solid 1px red";
            document.getElementById("phone").style.color="red";
            return false;
        }
    }
    function pwdCheck(){
        var password = document.getElementById("password").value;
        var regex=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
        pwdrpCheck();
        if(password.match(regex)){
            document.getElementById("pwd-validate-regis").style.display="none";
            document.getElementById("password").style.border="solid 1px black";
            document.getElementById("password").style.color="black";
            return true;
        }else{
            document.getElementById("pwd-validate-regis").style.display="block";
            document.getElementById("password").style.border="solid 1px red";
            document.getElementById("password").style.color="red";
            return false;
        }
    }
    function pwdrpCheck(){
        if(document.getElementById("password").value != document.getElementById("passwordrp").value){
            document.getElementById("pwdrp-validate-regis").style.display="block";
            document.getElementById("passwordrp").style.border="solid 1px red";
            document.getElementById("passwordrp").style.color="red";
            return false;
        }else{
            document.getElementById("pwdrp-validate-regis").style.display="none";
            document.getElementById("passwordrp").style.border="solid 1px black";
            document.getElementById("passwordrp").style.color="black";
            return true;
        }
    }
    function validateForm(){
        if(usernameCheck() && pwdCheck() && pwdrpCheck() && phoneCheck() && emailCheck()){
            return true;
        }else{
            return false;
        }
    }
    $(document).ready(function() {
        $("#regis-form").submit(function(e) {
            e.preventDefault();
            if (validateForm()){
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
                                    text: 'Username đã tồn tại.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById('username').focus();
                                    }
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
            }else{
                Swal.fire({
                title: 'Đăng ký thất bại!',
                text: 'Thông tin không hợp lệ.',
                icon: 'error',
                confirmButtonText: 'OK'
                });
            }
            
        });
    });

</script>
<style>

</style>
<div style="border-bottom: #CDCDCD solid 1px">
    <a onclick="out_2();"><input type="button"  style="padding:0 3px;float: right;font-size:30px;background: #FFFFFF;border: #FFFFFF;cursor: pointer" class="material-icons" value="backspace"></a>
    <h2 style="text-align: center;padding: 40px">BECOME A MEMBER</h2>
</div>
<div style="padding: 20px;text-align: center;font-size: 16px; ">
    <form id="regis-form" class="regis-form" method="POST">
        <p style="padding:20px 0px;">Create your Member profile and get first access to the very best of our products, inspiration and community.</p>
        
        <label class="label-for-regis">Username:</label>
        <input required onblur="usernameCheck();" class="regis-input" id="username" type="text" placeholder="Username*"/><br>
        <div class="box-validate-regis" id="username-validate-regis">Username gồm ít nhất 5 kí tự (ít nhất 1 chữ, 1 số), không có khoảng trắng, kí tự đặc biệt.</div>
        
        <label class="label-for-regis">Password:</label>
        <input require onblur="pwdCheck();" class="regis-input" id="password" type="password" placeholder="Password*"/><br>
        <div class="box-validate-regis" id="pwd-validate-regis">Password gồm 8 - 15 kí tự (ít nhất 1 số, 1 chữ thường, 1 chữ hoa, 1 kí tự đặc biệt) không có khoảng trắng.</div>

        <label class="label-for-regis">Confirmpass:</label>
        <input required onblur="pwdrpCheck();" class="regis-input" id="passwordrp" type="password" placeholder="Fill in password again*"/><br>
        <div class="box-validate-regis" id='pwdrp-validate-regis'>Mật khẩu không đúng !</div>

        <label class="label-for-regis">Surname:</label>
        <input required id="surname" class="regis-input" type="text" placeholder="Surname*"/><br>

        <label class="label-for-regis">Firstname:</label>
        <input required id="name" class="regis-input" type="text" placeholder="Name*"/><br>

        <label class="label-for-regis">Email:</label>
        <input required onblur="emailCheck();" class="regis-input" id="email" type="text" placeholder="Email address*"/><br>
        <div class="box-validate-regis" id='email-validate-regis'>Email không hợp lệ (ex: abc@gmail.com).</div>

        <label class="label-for-regis">Phone:</label>
        <input required onblur="phoneCheck();" class="regis-input" id="phone" type="text" placeholder="Phone number*"/><br>
        <div class="box-validate-regis" id='phone-validate-regis'>Số điện thoại không hợp lệ (gồm 10 chữ số, bắt đầu từ số 0).</div>

        <label class="label-for-regis">Address:</label>
        <input required id="address" class="regis-input" type="text" placeholder="Your Current address*"/><br>

        <button style="cursor: pointer;font-size:20px;background-color:black;color:white;padding:10px 30px;text-align: center;margin-top:20px">Join us</button>
    </form> 
</div>
<div style="text-align: center">
    <div>Already a member?<a style="cursor: pointer;padding:30px 5px;text-decoration: underline;font-size:15px;" onclick="dangnhap()">Sign in</a></div>
</div>