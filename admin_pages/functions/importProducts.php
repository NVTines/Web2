<?php
include_once "../../database.php";
$db = new Database();
$supplierID = $_POST["supplier"];
$products = $_POST["product"];
$quantities = $_POST["quantity"];

// Get StaffID from session
if (isset($_SESSION["StaffID"])) {
    $staffID = $_SESSION["StaffID"];
} else {
    $staffID = 1;
}

// Add a new import record
$importSql = "
    INSERT INTO import 
    (SupplierID, StaffID, CreateTime, Total) VALUES
    ($supplierID, 1, NOW(), " . getTotal($products, $quantities) . ")
    ";

$db->insert_data($importSql);

$getLastImportID = $db->get_data("SELECT ImportID FROM import ORDER BY ImportID DESC LIMIT 1");
$lastImportID = $getLastImportID->fetch_assoc()["ImportID"];

foreach ($products as $product) {
    $product = explode(" ", $product);
    $productID = $product[0];
    $sizeID = $product[1];
    $price = $product[2];
    $quantityKey = $productID . '_' . $sizeID;
    $quantity = $quantities[$quantityKey];

    // Add a new import detail record
    $importDetailSql = "
        INSERT INTO importdetail 
        (ImportID, ProductID, SizeID, Quantity, Unitprice) VALUES
        ($lastImportID, $productID, $sizeID, $quantity, $price)
        ";
    $db->insert_data($importDetailSql);

    // Update quantity of the product
    $updateQuantitySql = "UPDATE sizedetail SET Quantity = Quantity + $quantity WHERE ProductID = $productID AND SizeID = $sizeID";
    $db->modify_data($updateQuantitySql);

    // Update price of the product
    if (hasNewPrice($productID, $price)) {
        $updatePriceSql = "UPDATE product SET ProductPrice = $price WHERE ProductID = $productID";
        $db->modify_data($updatePriceSql);
    }
}
header("Location: ../admin.php?key=nh");

function hasNewPrice($productID, $price)
{
    global $db;
    $sql = "SELECT ProductPrice FROM product WHERE ProductID = $productID";
    $results = $db->get_data($sql);
    $rows = $results->fetch_assoc();
    if ($rows["ProductPrice"] != $price) {
        return true;
    }
    return false;
}


function getTotal($products, $quantities)
{
    $total = 0;
    foreach ($products as $product) {
        $product = explode(" ", $product);
        $productID = $product[0];
        $sizeID = $product[1];
        $price = $product[2];
        $quantityKey = $productID . '_' . $sizeID;
        $quantity = $quantities[$quantityKey];
        $total += $price * $quantity;
    }
    return $total;
}
