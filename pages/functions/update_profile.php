<?php
    session_start();
    require_once __DIR__.'/../../database.php';

    $dtb = new database();
    $response = array();

    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['surname']) && isset($_POST['firstname']) && isset($_POST['address']) && isset($_POST['phone'])){
        $username = trim($_POST['username']);
        $email = $_POST['email'];
        $surname = $_POST['surname'];
        $firstname = $_POST['firstname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        if(str_contains($username,' ')){
            $response['status']= "username_error";
        }else{
            $check_error = 0;
            if($username != (string)$_SESSION["username"]){
                $sql = "SELECT * FROM account WHERE UserName = '".$username."'";
                $checkUserName = $dtb->get_data($sql);
                if($checkUserName && $checkUserName->num_rows > 0){
                    $response['status'] = "username_error";
                    $check_error = 1;
                }
            }
            if($check_error == 0){
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $response['status'] = "email_error";
                }else{
                    $phone_format = preg_match('/^[0-9]{10}+$/', $phone);
                    if(!$phone_format){
                        $response['status'] = "phone_error";
                    }else{
                        $sql = "UPDATE account SET UserName = '$username', Email = '$email' where UserName = '".(string)$_SESSION["username"]."'";
                        if($dtb->modify_data($sql)){
                            $_SESSION['username']=$username;
                            $_SESSION['Email']=$email;
                            if(isset($_FILES['fileToUpload'])){
                                $file_tmp_name=$_FILES['fileToUpload']['tmp_name'];
                                $file_name=$_FILES["fileToUpload"]["name"];
                                $allowed = array('jpg','jpeg','png','pdf','jfif');
                                $fileExt = explode('.', $file_name);
                                $fileActualExt = strtolower(end($fileExt));
                                if($_FILES['fileToUpload']['size']>1000000){
                                    $response['status']="upload_error";
                                }else if(!in_array($fileActualExt, $allowed)){
                                    $response['status']="fileMatch_error";
                                }else{
                                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"../../img/upload_img/".$_FILES["fileToUpload"]["name"]);
                                    $img_full_path = __DIR__."/../../img/upload_img/".$file_name;
                                    if((string)$_SESSION['RoleID']==="1"){
                                        $sql = "UPDATE Customer SET CustomerSurname = '$surname', CustomerName = '$firstname', Phone = '$phone', Address = '$address', IMG = :img where UserID = '".(string)$_SESSION['UserID']."'";
                                    }else{
                                        $sql = "UPDATE Staff SET LastName = '$surname', FirstName = '$firstname', Phone = '$phone', Address = '$address', IMG = :img where UserID = '".(string)$_SESSION['UserID']."'";
                                    }
                                    if($dtb->changeImgByPDO($img_full_path, $sql)){
                                        $_SESSION['Phone'] = $phone;
                                        $_SESSION['Address'] = $address;
                                        $_SESSION['IMG'] = base64_encode(file_get_contents($img_full_path));
                                        $_SESSION['Surname'] = $surname;
                                        $_SESSION['FirstName'] = $firstname;
                                        $response['status']="success";
                                    }
                                }
                            }else{
                                if((string)$_SESSION['RoleID']==="1"){
                                    $sql = "UPDATE Customer SET CustomerSurname = '$surname', CustomerName = '$firstname', Phone = '$phone', Address = '$address' where UserID = '".(string)$_SESSION['UserID']."'";
                                }else{
                                    $sql = "UPDATE Staff SET LastName = '$surname', FirstName = '$firstname', Phone = '$phone', Address = '$address' where UserID = '".(string)$_SESSION['UserID']."'";
                                }
                                if($dtb->modify_data($sql)){
                                    $_SESSION['Phone'] = $phone;
                                    $_SESSION['Address'] = $address;
                                    $_SESSION['Surname'] = $surname;
                                    $_SESSION['FirstName'] = $firstname;
                                    $response['status']="success";
                                }
                            }
                            
                        }
                    }                   
                } 
            }            
        }
    }else{
        $response['status']="undefined_error";
    }
    $dtb->close_dtb();
    header('Content-Type: application/json');
    echo json_encode($response);
