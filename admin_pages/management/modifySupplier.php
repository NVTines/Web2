<script>
    function resetSupForm(){
        document.getElementsByClassName("sup-create-input")[0].value="";
        document.getElementsByClassName("sup-create-input")[1].value="";
        document.getElementsByClassName("sup-create-input")[2].value="";
        document.getElementsByClassName("sup-create-input")[3].value="";
    }
    $(document).ready(function() {
        $("#supplier-create-form").submit(function(e) {
          e.preventDefault();
          $.ajax({
                type: 'POST',
                url: 'functions/processSettingSup.php',
                data: {
                    id: $("#supp-id").val(),
                    name: $("#supp-name").val(),
                    address: $("#supp-address").val(),
                    phone: $("#supp-phone").val(),
                    fax: $("#supp-fax").val()
                },
                success: function(response) {
                    console.log(response);
                    switch(response['status']){
                        case "success":
                            Swal.fire({
                                title: 'THÀNH CÔNG',
                                text: 'Nhà cung cấp đã được thêm mới.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    resetSupForm();
                                }
                            });
                            break;
                        case "regex-error":
                            Swal.fire({
                                title: 'THẤT BẠI',
                                text: 'Số Fax / Số Phone không hợp lệ (10 chữ số bắt đầu là số 0).',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                            break;
                        case "error":
                            Swal.fire({
                                title: 'THẤT BẠI',
                                text: 'Có lỗi xảy ra.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                            break;
                        case "success-update":
                            Swal.fire({
                                title: 'THÀNH CÔNG',
                                text: 'Cập nhật thông tin thành công.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            })
                            break;
                    }   
                }   
            });
        });
    });
</script>

<div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ NHÀ CUNG CẤP</div>
        <a href="admin.php?key=ncc" id="back-btn-supplier">QUAY LẠI</a>
    </div>
</div>
<div class="col-div-8">
    <div class="box-8" style="display:flex;justify-content:center; width:50%;">
        <form id="supplier-create-form" method="POST">
            <?php 
                $id=isset($_GET['supid'])?$_GET['supid']:"";
                echo '<input id="supp-id" style="display:none;" value="'.$id.'"/>';
            ?>
            <div><h1>THÔNG TIN NHÀ CUNG CẤP</h1></div>
            <div id="sup-input-wrapper" style="margin-left:25%;margin-right:25%;margin-top:100px;">
                <?php
                    $supname=isset($_GET['supname'])?$_GET['supname']:"";
                    $supaddress=isset($_GET['supaddress'])?$_GET['supaddress']:"";
                    $supphone=isset($_GET['supphone'])?$_GET['supphone']:"";
                    $supfax=isset($_GET['supfax'])?$_GET['supfax']:"";
                    echo
                    '<div class="sup-input">
                        <label class="sup-create-label">Tên:</label>
                        <input required type="text" name="name" id="supp-name" class="sup-create-input" placeholder="...." value="'.$supname.'"/>
                    </div>
                    <div class="sup-input">
                        <label class="sup-create-label">Địa chỉ:</label>
                        <input required type="text" name="address" id="supp-address" class="sup-create-input" placeholder="...." value="'.$supaddress.'"/>
                    </div>
                    <div class="sup-input">
                        <label class="sup-create-label">SĐT:</label>
                        <input required type="text" name="phone" id="supp-phone" class="sup-create-input" placeholder="...." value="'.$supphone.'"/>
                    </div>
                    <div class="sup-input">
                        <label class="sup-create-label">Fax:</label>
                        <input required type="text" name="fax" id="supp-fax" class="sup-create-input" placeholder="...." value="'.$supfax.'"/>
                    </div>';
                ?>
                <div class="sup-btn">
                    <input type="submit" id="sup-submit-btn" value="Xác nhận"> 
                    <a onclick="resetSupForm()" id="sup-reset-btn">Refresh</a> 
                </div>        
            </div>  
            
        </form>
    </div>
</div>
