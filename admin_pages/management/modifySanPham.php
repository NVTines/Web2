<style>

</style>
<div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ SẢN PHẨM</div>
        <a href="admin.php?key=sp" class="back-btn">QUAY LẠI</a>
    </div>
</div>
<div class="col-div-8">
    <div class="box-8" style="display:flex;justify-content:center;">
        <form class="info-manage-form" method="POST">
            <?php 
                $id=isset($_GET['supid'])?$_GET['supid']:"";
                echo '<input id="supp-id" style="display:none;" value="'.$id.'"/>';
            ?>
            <div><h1>THÔNG TIN SẢN PHẨM</h1></div>
            <div style="margin-left:20%;margin-right:20%;margin-top:50px;">
                <div class="right-form-info">
                    <img alt="" class="avt-info" src="data:image/png;base64,<?php echo $_SESSION['IMG']; ?>" /><br>
                    <label for="uploadProductImage" class="choose-img-btn" >Choose picture</label>
                    <input id="uploadProductImage" accept="image/*" style="display:none" onchange="previewImage(event)" type="file" name="fileToUpload" class="fileToUpload" id="" />
                </div>
                <div class="left-form-info">
                    <?php
                        $supname=isset($_GET['supname'])?$_GET['supname']:"";
                        $supaddress=isset($_GET['supaddress'])?$_GET['supaddress']:"";
                        $supphone=isset($_GET['supphone'])?$_GET['supphone']:"";
                        $supfax=isset($_GET['supfax'])?$_GET['supfax']:"";
                        echo
                        '<div class="info-manage-wrapper">
                            <label class="info-manage-label">Tên:</label>
                            <input required type="text" name="name" id="supp-name" class="info-manage-input" placeholder="...." value="'.$supname.'"/>
                        </div>
                        <div class="info-manage-wrapper">
                            <label class="info-manage-label">Địa chỉ:</label>
                            <input required type="text" name="address" id="supp-address" class="info-manage-input" placeholder="...." value="'.$supaddress.'"/>
                        </div>
                        <div class="info-manage-wrapper">
                            <label class="info-manage-label">SĐT:</label>
                            <input required type="text" name="phone" id="supp-phone" class="info-manage-input" placeholder="...." value="'.$supphone.'"/>
                        </div>
                        <div class="info-manage-wrapper">
                            <label class="info-manage-label">SĐT:</label>
                            <input required type="text" name="phone" id="supp-phone" class="info-manage-input" placeholder="...." value="'.$supphone.'"/>
                        </div>
                        <div class="info-manage-wrapper">
                            <label class="info-manage-label">SĐT:</label>
                            <input required type="text" name="phone" id="supp-phone" class="info-manage-input" placeholder="...." value="'.$supphone.'"/>
                        </div>
                        <div class="info-manage-wrapper">
                            <label class="info-manage-label">SĐT:</label>
                            <input required type="text" name="phone" id="supp-phone" class="info-manage-input" placeholder="...." value="'.$supphone.'"/>
                        </div>
                        <div class="info-manage-wrapper">
                            <label class="info-manage-label">Fax:</label>
                            <input required type="text" name="fax" id="supp-fax" class="info-manage-input" placeholder="...." value="'.$supfax.'"/>
                        </div>';
                    ?>
                </div>
                <div style="clear:both"></div>
                <div class="info-btn-wrapper">
                    <input type="submit" id="sup-submit-btn" value="Xác nhận"> 
                    <input id="sup-reset-btn" type="reset" value="Refresh">
                </div>        
            </div>  
            
        </form>
    </div>
</div>
