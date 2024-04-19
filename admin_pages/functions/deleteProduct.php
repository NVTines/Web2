<?php
// Check if the product ID is received via POST
if (isset($_POST['id'])) {
    // Include your database connection file
    require_once __DIR__ . "/../../database.php";

    $db = new database();
    // Sanitize the input
    $productID = intval($_POST['id']);
    // Prepare the SQL query
    $query = "DELETE FROM product WHERE ProductID = $productID";
    $result = $db->modify_data($query);

    // Check if the query was successful
    if ($result) {
        // Send a success response
        http_response_code(200);
        echo json_encode(array('status' => 'success'));
    } else {
        // If the query was not successful, send an error response
        http_response_code(500);
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting record'));
    }
} else {
    // If product ID is not provided, send an error response
    http_response_code(400);
    echo json_encode(array('status' => 'error', 'message' => 'Product ID is required'));
}
