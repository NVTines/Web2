<?php
if (isset($_GET['key'])) {
  echo '<link rel="stylesheet" href="../css/user.css" type="text/css" />';
  $key = $_GET['key'];
  switch ($key) {
    case 'users':
      require 'management/users.php';
      break;
    case 'sp':
      require 'management/products.php';
      break;
    case 'dh':
      require 'management/donhang.php';
      break;
    case 'nh':
      require 'management/import.php';
      break;
    case 'ncc':
      require 'management/supplier.php';
      break;
    case 'q':
      require 'management/role.php';
      break;
  }
} else {
  require 'management/dashboard.php';
}
