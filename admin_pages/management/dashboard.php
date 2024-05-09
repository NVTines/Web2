<?php
echo
'<div id="shows">
  <div id="main">
    <div class="head">
      <div class="col-div-6">
        <span  onclick="invinbox()"
          style="font-size: 30px; cursor: pointer; color: white"
          class="nav2"
          >&#9776;Dashboard</span
        >
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-div-3">
      <div class="box">
        <h4>Số lượng khách hàng</h4>
        <div class="flex">
        <p id="customers"></p>
        <i class="fa fa-users box-icon"></i>
        </div>
      </div>
    </div>
    <div class="col-div-3">
      <div class="box">
        <h4>Số Sản Phẩm</h4>
        <div class="flex">
        <p id="products"></p>
        <i class="fas fa-list box-icon"></i>
        </div>
      </div>
    </div>
    <div class="col-div-3">
    <div class="box">
        <h4>Đơn hàng thành công</h4>
        <div class="flex">
        <p id="orders"></p>
        <i class="fa fa-shopping-bag box-icon"></i>
        </div>
      </div>
    </div>
    <div class="col-div-3">
    <div class="box">
        <h4>Số lượng bán ra</h4>
        <div class="flex">
        <p id="soldproducts"></p>
        <i class="fa fa-tasks box-icon"></i>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <br />
    <div class="col-div-8">
      <div class="box-8" style="padding:15px;">
        <canvas id="myChart"></canvas>
      </div>
    </div>
    <div class="col-div-4">
      <div class="box-4">
        <div class="content-box">
          <p style="text-align:center;">Total Sale</p>

          <div class="circle-wrap">
          <div class="circle">
            <div class="mask full">
              <div class="fill"></div>
            </div>
            <div class="mask half">
              <div class="fill"></div>
            </div>
            <div id="percent" class="inside-circle"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div>
                    <div class="" style="width:100%; height:500px; overflow-y:scroll;">
                        <table class="" style="text-align:center;">
                            <thead class="sticky-top" style="background-color:blue;">
                                <tr class="bg-dark text-light">
                                    <th scope="col">Mã Sản Phẩm</th>
                                    <th scope="col">Tên Sản Phẩm</th>
                                    <th scope="col">Ngày Đặt Hàng</th>
                                    <th scope="col">Số lượng bán ra</th>
                                </tr>
                            </thead>
                            <tbody id="static-product">

                            </tbody>
                        </table>
                    </div>
    <div style="margin-top:30px;">
    <input type="date" id="DateBD" name="DateBD" style="width:15%; padding: 8px 12px; margin-right:15px;">
    <input type="date" id="DateKT" name="DateKT" style="width:15%; padding: 8px 12px; margin-right:15px;">
    <button onclick="filterDate()" class="" style="width:15%; margin-right:15px;">Xác Nhận</button>
    <button onclick="static_product()" class="" style="width:15%;">Refresh</button>
    </div>
  </div>

</div>';
?>
<script>
  var dataset_bill = new Array();
  var dataset_import = new Array();
  <?php
<<<<<<< HEAD
    $dtb = new database();
    for ($m = 1; $m <= 12; $m++){
      $query_bill = "SELECT sum(total) as Total from bill where MONTH(CreateTime) = '$m' AND YEAR(CreateTime) = '2024'";
      $query_import = "SELECT sum(Total) as Total from import where MONTH(CreateTime) = '$m' AND YEAR(CreateTime) = '2024'";
      if($result = $dtb->get_data($query_bill)){
        while($row = $result->fetch_assoc()){ ?>
          dataset_bill.push('<?php echo $row["Total"]; ?>')
  <?php
        }
      }
      if($result = $dtb->get_data($query_import)){
        while($row = $result->fetch_assoc()){ ?>
          dataset_import.push('<?php echo $row["Total"]; ?>')
  <?php
        }
      }
    }
    $dtb->close_dtb();
  ?>
  
  var xValues = ["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"];
=======
  $dtb = new database();
  for ($m = 1; $m <= 12; $m++) {
    $query_bill = "SELECT sum(total) as Total from bill where MONTH(CreateTime) = '$m' AND YEAR(CreateTime) = '2024'";
    $query_import = "SELECT sum(Total) as Total from import where MONTH(CreateTime) = '$m' AND YEAR(CreateTime) = '2024'";
    if ($result = $dtb->get_data($query_bill)) {
      while ($row = $result->fetch_assoc()) { ?>
        dataset_bill.push('<?php echo $row["Total"]; ?>')
      <?php
      }
    }
    if ($result = $dtb->get_data($query_import)) {
      while ($row = $result->fetch_assoc()) { ?>
        dataset_import.push('<?php echo $row["Total"]; ?>')
  <?php
      }
    }
  }
  $dtb->close_dtb();
  ?>

  var xValues = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
>>>>>>> tuan
  const options = {
    type: 'line',
    data: {
      labels: xValues,
      datasets: [{
          label: 'Giá trị xuất',
          data: dataset_bill,
          borderColor: 'green'
        },
        {
          label: 'Giá trị nhập',
          data: dataset_import,
          borderColor: 'red'
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'THỐNG KẾ NHẬP/XUẤT CÁC THÁNG TRONG NĂM 2024'
      }
    }
  }

  new Chart("myChart", options);
  Chart.defaults.global.defaultFontColor = "white";

<<<<<<< HEAD
=======

>>>>>>> tuan
</script>