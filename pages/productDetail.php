<?php

require_once "database.php";
$db = new database();
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Truy vấn để lấy thông tin sản phẩm từ ProductID
  $sql = "SELECT p.ProductID, p.ProductName, p.ProductPrice, p.Description, p.status, p.IMG, 
          b.ProducerName, c.TypeName FROM product AS p 
          INNER JOIN producer AS b ON p.ProducerID = b.ProducerID 
          INNER JOIN category AS c ON p.TypeID = c.TypeID WHERE p.ProductID = '$id' AND p.status = 'acti'";
  $sqlSize = "SELECT s.value FROM product AS p, size as s, sizedetail as sd WHERE p.ProductID = sd.ProductID AND sd.SizeID = s.SizeID AND p.ProductID = '$id' AND sd.Quantity > 0 order by s.value ASC";
  $result = $db->get_data($sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
?>

    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Product Details</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <script>
      document.querySelector("input").addEventListener("keypress", function(evt) {
        if (evt.which < 48 || evt.which > 57) {
          evt.preventDefault();
        }
      });
      function checkEmptyProductOrder() {
        if (document.getElementById("p-quantity").value == ""){
          document.getElementById("p-quantity").value = 1;
        }
      }
    </script>
    <style>
      .info-pdetail-wrapper {
        float: left;
        margin: 30px;
        border-right: #d1d1d1 1px solid;
        padding: 25px;
      }
      @media only screen and (max-width:1800px){
        .info-pdetail-wrapper{
          border-right: none;
        }
      }
      @media only screen and (max-width:1001px){
        .img-p-detail{
          width:100%;
        }
        .info-pdetail-wrapper{
          width:50%;
          border-right: #d1d1d1 1px solid;
        }
        .info-of-p{
          width:30%;
        }
      }
    </style>
    
    <div class="p-detail-wrapper">
      <div style="clear: both"></div>
      <nav aria-label="breadcrumb" >
        <ol class="breadcrumb" style="background-color:white;border-bottom:#d1d1d1 1px solid">
          <li class="breadcrumb-item"><a href="index.php?page=shopping">Store</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
      </nav>
      <div class="img-p-detail">
        <?php
        $image = $row['IMG'];
        $imageData = base64_encode($image);
        $src = 'data:image/jpeg;base64,' . $imageData;
        ?>
        <img class="img-fluid pb-2" src="<?php echo $src ?>" style="border-radius:15%;width:580px" />
      </div>
      <div class="info-pdetail-wrapper">
        <h5 style="color : orange"><?php echo $row['ProducerName'] ?></h5>
        <h1 class="py-4" style="color:cornflowerblue"><?php echo $row['ProductName'] ?></h1>
        <h3 style="margin:30px;border-bottom: #d1d1d1 1px solid;padding-bottom:20px;">Giá: <span style="color:orange;"><?php echo $row['ProductPrice'] ?> VNĐ</span></h3>
        <form method="POST" action="pages/functions/addToCart.php" style="margin:30px;margin-top:50px;">
          <h3>Size: </h3>
          <div>
            <?php
              $result = $db->get_data($sqlSize);
              $count = 1;
              if($result && $result->num_rows>0){
                while($rows = $result->fetch_assoc()){
                  echo 
                  '<input checked type="radio" id="size'.($count).'" value="'.$rows['value'].'" name="Size"><label class="label-for-size" for="size'.($count).'">'.$rows['value'].'</label>';
                  if(fmod($count,5)==0){
                    echo '<br>';
                  }
                  $count++;
                }          
              }
            ?>
          </div>
          <div style="margin-top:80px;">
            <input type="hidden" name="ProductID" value=<?php echo $row['ProductID'] ?> />
            <input type="hidden" name="ProductName" value='<?php echo $row['ProductName'] ?>' />
            <input type="hidden" name="ProductPrice" value='<?php echo $row['ProductPrice'] . " VNĐ " ?>' />
            <input type="hidden" name="ProductImage" value='<?php echo $src ?>' />
            <input type="hidden" name="ProducerName" value='<?php echo $row['ProducerName'] ?>' />
            <input onblur="checkEmptyProductOrder()" type="number" min="1" max="100" value="1" name="Quantity" id="p-quantity"/>
            <button type="submit" class="buy-btn" name="add_to_cart">Thêm vào giỏ hàng</button>
          </div>
        </form>
      </div>
      <div class="info-of-p" style="float:left;margin:30px;padding:20px;padding-top:0px;">
        <h2 class="my-5" style="border-bottom: #d1d1d1 1px solid;padding:20px;">Thông tin sản phẩm</h1>
        <?php echo $row['Description'] ?>
      </div>
      <div style="clear: both"></div>
    </div>

<?php
  } else {
    require 'pages/error/productdetailerror.php';
  }
}
?>