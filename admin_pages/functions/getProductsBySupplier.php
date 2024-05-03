<?php
require_once "../../database.php";
$db = new Database();
$sql = "
SELECT DISTINCT product.ProductID, product.ProductName,  product.ProductPrice, size.SizeID, size.value
FROM supplierdetail
JOIN product ON supplierdetail.ProductID = product.ProductID
JOIN sizedetail ON supplierdetail.ProductID = product.ProductID
JOIN size ON sizedetail.SizeID = size.SizeID
WHERE supplierdetail.SupplierID = '" . $_POST["supplier"] . "'
ORDER BY product.ProductID ASC
";
if ($results = $db->get_data($sql)) {
    while ($rows = $results->fetch_assoc()) {
        echo
        '<tr>
            <td>
                <input type="checkbox" class="larger-checkbox" name="product[]" value="' . $rows["ProductID"] . " " . $rows["SizeID"] . " " . round($rows["ProductPrice"] / (1 + 10 / 100)) . '">
            </td>
            <td>' . $rows["ProductID"] . '</td>
            <td>' . $rows["ProductName"] . '</td>
            <td>' . $rows["value"] . '</td>
            <td>' . "$" . round($rows["ProductPrice"] / (1 + 10 / 100)) . '</td>
            <td>
                <input class="larger-input" type="number" name="quantity[' . $rows["ProductID"] . '_' . $rows["SizeID"] . ']" value="1" min="1" max="50">
            </td>
        </tr>';
    }
}
