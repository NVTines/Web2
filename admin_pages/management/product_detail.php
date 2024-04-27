<?php
$id = $_GET["id"];

$productSql = "
SELECT 
    product.ProductID,
    product.ProductName,
    product.ProducerID,
    product.IMG AS Img,
    product.status AS Status,
    sizedetail.Quantity,
    size.value AS Size,
    product.ProductPrice AS Price,
    product.status
  FROM 
    product
  JOIN producer ON product.ProducerID = producer.ProducerID
  JOIN sizedetail ON product.ProductID = sizedetail.ProductID
  JOIN size ON sizedetail.SizeID = size.SizeID
  WHERE product.ProductID = '$id'
  ORDER BY product.status ASC;
";
$brandSql = "SELECT * from producer";

$products = $db->get_data($productSql);
$brands = $db->get_data($brandSql);


$productsRow = $products->fetch_assoc();
$encoded_image = base64_encode($productsRow['Img']);
$brandOptions = "";
while ($brandRow = $brands->fetch_assoc()) {
    $brandOptions .= "<option value='" . $brandRow['ProducerID'] . "'>" . $brandRow['ProducerName'] . "</option>";
}
?>
<div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ SẢN PHẨM</div>
        <a href="admin.php?key=sp" class="back-btn">QUAY LẠI</a>
    </div>
</div>
<div class="col-div-8">
    <div class="box-8" style="display:flex;justify-content:center;">
        <form action="../admin_pages/functions/saveProduct.php" class="info-manage-form" method="POST">
            <div>
                <h1>THÔNG TIN SẢN PHẨM</h1>
            </div>
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
                            <input required type="text" name="address" id="product-name" class="info-manage-input" placeholder="...." value="' . $productsRow['ProductName'] . '"/>
                        </div>
                        <div class="info-manage-wrapper">
                            <label class="info-manage-label" for="brands">Hãng:</label>
                            <select class="info-manage-input" name="brands" id="brands">
                                ' . $brandOptions . '
                            </select>                   
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
<script>
    var producerID = "<?= $productsRow['ProducerID']; ?>";
    console.log(producerID);
    if (producerID != '' && parseInt(producerID)) {
        document.getElementById("brands").value = producerID;
    }
    var status = "<?= $productsRow['status']; ?>";
    if (status != '' && status != null) {
        document.getElementById("status").value = status;
    }
</script>