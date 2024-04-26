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
$brandOptions = "";
while ($brandRow = $brands->fetch_assoc()) {
    $brandOptions .= "<option value='" . $brandRow['ProducerID'] . "'>" . $brandRow['ProducerName'] . "</option>";
}
?>
<div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ SẢN PHẨM</div>
        <a href="admin.php?key=sp" id="back-btn-supplier">QUAY LẠI</a>
    </div>
</div>
<div class="col-div-8">
    <div class="box-8" style="display:flex;justify-content:center; width:50%;">
        <form id="supplier-create-form" method="POST">
            <div>
                <h1>THÔNG TIN SẢN PHẨM</h1>
            </div>
            <div id="sup-input-wrapper" style="margin-left:25%;margin-right:25%;margin-top:50px;">
                <?php
                echo
                '<div class="sup-input">
                        <label class="sup-create-label">ID:</label>
                        <input readonly type="text" name="name" id="product-id" class="sup-create-input" placeholder="...." value="' . $productsRow['ProductID'] . '"/>
                    </div>
                    <div class="sup-input">
                        <label class="sup-create-label">Tên:</label>
                        <input required type="text" name="address" id="product-name" class="sup-create-input" placeholder="...." value="' . $productsRow['ProductName'] . '"/>
                    </div>
                    <div class="sup-input">
                        <label class="sup-create-label" for="brands">Hãng:</label>
                        <select class="sup-create-input" name="brands" id="brands">
                            ' . $brandOptions . '
                        </select>                   
                    </div>
                    <div class="sup-input">
                        <label class="sup-create-label" for="status">Status:</label>
                        <select class="sup-create-input" name="status" id="status">
                            <option value="acti">ĐANG BÁN</option>
                            <option value="hidd">NGƯNG BÁN</option>
                        </select>
                    </div>'
                    ;
                ?>
                <div class="sup-btn">
                    <input type="submit" id="sup-submit-btn" value="Xác nhận">
                    <a onclick="resetSupForm()" id="sup-reset-btn">Refresh</a>
                </div>
            </div>

        </form>
    </div>
</div>
<script>
    var producerID = "<?= $productsRow['ProducerID']; ?>";
    console.log(producerID);
    if (producerID != '' && parseInt(producerID)){
        document.getElementById("brands").value = producerID;
    }
    var status = "<?= $productsRow['status']; ?>";
    if (status != '' && status != null) {
        document.getElementById("status").value = status;
    }
</script>