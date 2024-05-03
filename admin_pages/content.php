<?php
if (isset($_GET['key'])) {
  $key = $_GET['key'];
  $error = 
  "<div style='text-align:center;color:white;margin-top:150px;'>
    <h1>You don't have permission to access</h1>
    <a href='admin.php' style='padding:15px;font-size:20px;font-weight:bold;border:none;background-color:#272c4a;color:white;text-decoration:none;border-radius:15px;'>Back</a>
  </div>";
  switch ($key) {
    case 'users':
      if(isset($_SESSION["function4"])){
        echo '<link rel="stylesheet" href="../css/user.css" type="text/css" />';
        require 'management/users.php';
      }else 
        echo $error;
      break;
    case 'sp':
      if(isset($_SESSION["function3"])){
        echo '<link rel="stylesheet" href="../css/user.css" type="text/css" />';
        require 'management/products.php';
      }else 
        echo $error;
      break;
    case 'dh':
      if(isset($_SESSION["function7"])){
        echo '<link rel="stylesheet" href="../css/user.css" type="text/css" />';
        require 'management/donhang.php';
      }else 
        echo $error;
      break;
    case 'nh':
      if(isset($_SESSION["function6"])){
        echo '<link rel="stylesheet" href="../css/user.css" type="text/css" />';
        require 'management/import.php';
      }else 
        echo $error;
      break;
    case 'ncc':
      if(isset($_SESSION["function2"])){
        echo '<link rel="stylesheet" href="../css/user.css" type="text/css" />';
        require 'management/supplier.php';
      }else 
        echo $error;
      break;
    case 'q':
      if(isset($_SESSION["function5"])){
        echo '<link rel="stylesheet" href="../css/user.css" type="text/css" />';
        require 'management/role.php';
      }else 
        echo $error;
      break;
    case 'stt':
      if(isset($_SESSION["function1"]))
        require 'management/dashboard.php';
      else
        echo $error;
  }
}
