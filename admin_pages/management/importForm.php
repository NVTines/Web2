<div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776;NHẬP HÀNG</div>
        <a href="admin.php?key=nh" class="back-btn">QUAY LẠI</a>
    </div>
</div>
<div class="col-div-8">
    <div class="box-8">
        <div class="box-8-body">
            <form action="./functions/.php" class="info-manage-form" method="POST">
                <div style="margin-left:25%;margin-right:25%;margin-top:100px;">
                    <div class="info-manage-wrapper">
                        <label class="info-manage-label" for="supplier">Nhà cung cấp:</label>
                        <select class="info-manage-input" id="supplier" name="supplier">
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
                </div>
                <div class="info-btn-wrapper">
                    <input type="submit" id="sup-submit-btn" value="Xác nhận">
                    <input id="sup-reset-btn" type="reset" value="Refresh">