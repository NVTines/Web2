<?php

?>
<div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776;THÊM NHÂN VIÊN</div>
        <a href="admin.php?key=users" class="back-btn">QUAY LẠI</a>
    </div>
</div>
<div class="col-div-8">
    <div class="box-8" style="display:flex;justify-content:center;">
        <form action="./functions/saveProduct.php?id=<?php echo $id ?>" class="info-manage-form" method="POST">
            <div style="margin-left:20%;margin-right:20%;margin-top:50px;">
                <div class="right-form-info">
                    <img alt="" class="avt-info" src="data:image/jpg;base64,<?php echo $encoded_image ?>" /><br>
                    <label for="uploadProductImage" class="choose-img-btn">Choose picture</label>
                    <input id="uploadProductImage" accept="image/*" style="display:none" onchange="previewImage(event)" type="file" name="fileToUpload" class="fileToUpload" id="" />
                </div>
                <div class="left-form-info">
                    <?php
                    echo
                    '
                        <div class="info-manage-wrapper">
                            <label class="info-manage-label">ID:</label>
                            <input readonly type="text" name="name" id="product-id" class="info-manage-input" placeholder="...." value="' . $productsRow['ProductID'] . '"/>
                        </div>

                        <div class="info-manage-wrapper">
                            <label class="info-manage-label">Tên:</label>
                            <input required type="text" name="product-name" id="product-name" class="info-manage-input" placeholder="...." value="' . $productsRow['ProductName'] . '"/>
                        </div>
                        <div class="info-manage-wrapper">
                            <label class="info-manage-label" for="brands">Hãng:</label>
                            <select class="info-manage-input" name="brands" id="brands">
                                ' . $brandOptions . '
                            </select>                   
                        </div>
                        <div class="info-manage-wrapper">
                            <label class="info-manage-label">Giá:</label>
                            <input type="number" name="price" class="info-manage-input" placeholder="...." value="' . $productsRow['Price'] . '"/>
                        </div>
                        <div class="info-manage-wrapper">
                            <label class="info-manage-label" for="status">Status:</label>
                            <select class="info-manage-input" name="status" id="status">
                                <option value="acti">ĐANG BÁN</option>
                                <option value="hidd">NGƯNG BÁN</option>
                            </select>
                        </div>
                    ';
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