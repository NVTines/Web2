<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="../css/admin.css" type="text/css" />
  <script src="../js/admin.js"></script>
  <script src="../js/Project.js"></script>
</head>

<body>
  <?php require_once "../database.php"; ?>
  <script>
    window.onload = function() {
      // CountCustomer();
      // CountOrder();
      // CountProduct();
      // CountSold();
      countAll();
    }
  </script>
  <div id="header">
    <?php require 'header.php';?>
  </div>
  <div id="content">
    <?php require 'content.php';?>
  </div>
</body>

</html>