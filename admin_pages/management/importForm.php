<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $(".info-manage-form").submit(function(e) {
                e.preventDefault();

                // Check if none of the checkboxes are checked
                var noneChecked = true;
                $('input[name="product[]"]').each(function() {
                    if ($(this).is(':checked')) {
                        noneChecked = false;
                        return false; // Exit the loop early since we found a checked checkbox
                    }
                });

                // If none of the checkboxes are checked, show an alert
                if (noneChecked) {
                    alert('Vui lòng chọn ít nhất một sản phẩm để nhập hàng!');
                    return; // Prevent form submission
                }

                // Retrieve selected items and their quantities
                var selectedItems = [];
                $('input[name="product[]"]:checked').each(function() {
                    var itemInfo = $(this).val().split(" ");
                    var productId = itemInfo[0];
                    var sizeId = itemInfo[1];
                    var importPrice = itemInfo[2];
                    var productName = $(this).closest('tr').find('td:eq(2)').text();
                    var size = $(this).closest('tr').find('td:eq(3)').text();
                    var quantity = $('input[name="quantity[' + productId + '_' + sizeId + ']"]').val();
                    selectedItems.push({
                        productId: productId,
                        productName: productName,
                        size: size,
                        importPrice: importPrice,
                        quantity: quantity
                    });
                });

                // Create HTML table to display selected items
                var tableHtml = "<table border='1' style='width: 100%; max-height: 300px; overflow-y: auto;'>";
                tableHtml += "<tr><th style='color: black;'>ID</th><th style='color: black;'>Tên</th><th style='color: black;'>Size</th><th style='color: black;'>Giá</th><th style='color: black;'>Số lượng</th></tr>";
                selectedItems.forEach(function(item) {
                    tableHtml += "<tr><td style='color: black;'>" + item.productId + "</td><td style='color: black;'>" + item.productName + "</td><td style='color: black;'>" + item.size + "</td><td style='color: black;'>$" + item.importPrice + "</td><td style='color: black;'>" + item.quantity + "</td></tr>";
                });
                tableHtml += "</table>";

                // Show Swal dialog with selected items in table view
                Swal.fire({
                    title: 'Xác nhận nhập hàng',
                    html: "Bạn đã chọn các sản phẩm sau:<br>" + tableHtml + "<br>Bạn có chắc chắn muốn nhập hàng không?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).unbind('submit').submit();
                    }
                });
            });
        });

        $("#supplier").change(function() {
            // If the choice is the first line (value = none), none of the products will be displayed
            if ($("#supplier").val() == "none") {
                $(".table-hover").empty();
            } else {
                // If the choice is a supplier, the products of that supplier will be displayed
                var supplier = $("#supplier").val();
                var supplierName = $("#supplier option:selected").text();
                $.ajax({
                    type: 'POST',
                    url: 'functions/getProductsBySupplier.php',
                    data: {
                        supplier: supplier
                    },
                    success: function(response) {
                        if (response == "") {
                            $(".table-hover").html("<tr><td colspan='6'>Nhà cung cấp " + "<b><u>" + supplierName + "</u></b>" + " không có sản phẩm nào</td></tr>");
                            return;
                        } else {
                            $(".table-hover").html(response);
                        }
                    }
                });
            }
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
                            <option value="none">--Chọn nhà cung cấp</option>
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