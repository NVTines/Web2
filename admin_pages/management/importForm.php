<script>
    // Khi thay đổi nhà cung cấp, hiển thị danh sách sản phẩm của nhà cung cấp đó
    
    $(document).ready(function() {
        $("#supplier").change(function() {
            var supplier = $("#supplier").val();
            $.ajax({
                type: 'POST',
                url: 'functions/getProductsBySupplier.php',
                data: {
                    supplier: supplier
                },
                success: function(response) {
                    $(".table-hover").html(response);
                }
            });
        });
    });
</script>
<div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776;NHẬP HÀNG</div>
        <a href="admin.php?key=nh" class="back-btn">QUAY LẠI</a>
    </div>
</div>
<div class="col-div-8">
    <div class="box-8">
        <div class="box-8-body">
            <form action="./functions/importProducts.php" class="info-manage-form" method="POST">
                <div style="margin-left:25%;margin-right:25%;margin-top:100px;">
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label" for="supplier">Nhà cung cấp:</label>
                        <select class="info-manage-input" id="supplier" name="supplier">
                            <option value="">--Chọn nhà cung cấp</option>
                            <?php
                            $sql = "SELECT * FROM supplier";
                            if ($results = $db->get_data($sql)) {
                                while ($rows = $results->fetch_assoc()) {
                                    echo '<option value="' . $rows["SupplierID"] . '">' . $rows["SupplierName"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="info-manage-wrapper">
                        <table class="table-fill">
                            <thead>
                                <tr>
                                    <th class="text-left"></th>
                                    <th class="text-left">Mã sản phẩm</th>
                                    <th class="text-left">Tên sản phẩm</th>
                                    <th class="text-left">Size</th>
                                    <th class="text-left">Giá nhập</th>
                                    <th class="text-left">Số lượng</th>
                                </tr>
                            </thead>
                            <tbody class="table-hover">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="info-btn-wrapper">
                    <input type="submit" id="sup-submit-btn" value="Xác nhận">
                    <input id="sup-reset-btn" type="reset" value="Refresh">
                </div>
            </form>
        </div>
    </div>
</div>