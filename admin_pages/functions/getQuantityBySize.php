<?php
require_once "../../database.php";
$id = $_POST["id"];
$size = $_POST["size"];
$db = new Database();
$sql =
    "
SELECT size.value, sizedetail.Quantity
FROM sizedetail
JOIN size ON sizedetail.SizeID = size.SizeID
WHERE ProductID = $id
AND size.value = '$size'
;
";
if ($results = $db->get_data($sql)){
    while ($rows = $results->fetch_assoc()){
        echo $rows["Quantity"];
    }
}
