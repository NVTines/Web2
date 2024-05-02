<?php
include_once "../../database.php";
$db = new database();

// Add a new account
$username = $_POST["username"];
$password = hash('sha256', $_POST['password']);
$role = $_POST["role"];
$email = $_POST["email"];
$addAccountSql = "INSERT INTO account (Username, Password, RoleID, Email, Enable) VALUES ('$username', '$password', '$role', '$email', '1')";
// echo "Adding a new account: " . $addAccountSql;
$db->insert_data($addAccountSql);


// Add a new staff
$userid = getLastID($db);
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$yob = $_POST["yob"];
$gender = $_POST["gender"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$salary = $_POST["salary"];
$img_full_path = __DIR__ . "/../../img/default.jpg";
if (isset($_FILES['fileToUpload'])) {
    $file_name = $_FILES['fileToUpload']['name'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_destination = "uploads/" . $file_name;
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../../img/upload_img/" . $_FILES["fileToUpload"]["name"]);
    $img_full_path = __DIR__ . "/../../img/upload_img/" . $file_name;
}

$addStaffSql = "
    INSERT INTO staff (UserID, FirstName, LastName, YearOfBirth, Gender, Phone, Address, Salary, IMG)
    VALUES ('$userid', '$firstname', '$lastname', '$yob', '$gender', '$phone', '$address', '$salary', :img)";
// echo "<br>";
// echo "Adding a new staff: " . $addStaffSql;
$db->changeImgByPDO($img_full_path, $addStaffSql);

header("Location: ../admin.php?key=users");






function getLastID($db)
{
    $sql = "SELECT MAX(account.UserID) as ID FROM account";
    $result = $db->get_data($sql);
    $row = $result->fetch_assoc();
    return $row["ID"];
}
