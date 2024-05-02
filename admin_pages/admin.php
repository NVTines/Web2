<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>   
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
  <script src="https://kit.fontawesome.com/54a12c09af.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <link rel="stylesheet" href="../css/admin.css" type="text/css" />
  <script src="../js/admin.js"></script>
  <script src="../js/Project.js"></script>
</head>

<body>
  <?php 
  require_once "../database.php"; 
  session_start();
  ?>
  <script>
    window.onload = function() {
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