<script type="text/javascript">
    $(document).ready(function() {
        $("#login-form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'pages/functions/process_login.php',
                data: {
                    tendn: $("#tendn").val(),
                    mk: $("#mk").val()
                },
                success: function(response) {
                    console.log(response);
                    if (response['status'] === "error") {
                        Swal.fire({
                            title: 'Đăng nhập không thành công',
                            text: 'Tài khoản/mật khẩu không đúng.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    }else if (response['status'] === "success") {
                        Swal.fire({
                            title: 'Đăng nhập thành công',
                            text: 'Bạn đã đăng nhập tài khoản thành công.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "index.php";
                            }
                        });
                    }

                }
            });
        });
    });
</script>

<div>
    <a onclick="out();"><input type="button"  style="padding:0 3px;float: right;font-size:30px;background: #FFFFFF;border: #FFFFFF;cursor: pointer" class="material-icons" value="backspace"></a>
    <h2>MY ACCOUNT</h2>
</div>
<div style="padding: 40px;border-bottom: #CDCDCD solid 1px;font-size:18px;">
    <div id="ttdn">
        <form id="login-form" class="login-form" method="POST" >
            <label for="tendn" class="label-usr" id="label-usr"><b>Username</b></label></br>
            <input required type="text" id="tendn" class="tendn" /></br>
            <label for="mk" class="label-pwd" id="label-pwd"><b>Password</b></label></br>
            <input required type="password" id="mk" class="mk"/></br>
            <button type="submit" class="login-btn" id="login-btn" style="cursor: pointer;font-size:20px;background-color:black;color:white;padding:10px 30px;text-align: center;display:block;margin-top:20px">Sign in</button>
        </form>
    </div>
</div>
<div style="padding:30px 40px; font-size:18px;">
    <div style="font-weight: bold">I DON'T HAVE AN ACCOUNT</div>
    <div style="margin-top: 20px;margin-bottom:50px">Enjoy added benefits and a richer experience by creating a personal account</div>
<div style="text-align: center	">
        <a style="cursor: pointer;font-size:20px;background-color:black;color:white;padding:10px 30px;text-align: center;display:block;font-weight:bold" onclick="CreateAccountBoard()">Create An Account</a>
    </div>
</div>