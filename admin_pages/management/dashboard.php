<?php
echo
'<div id="shows" style="overflow:auto">
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
        <h4>Đơn hàng đã xác nhận</h4>
        <div class="flex">
        <p id="orders"></p>
        <i class="fa fa-shopping-bag box-icon"></i>
        </div>
      </div>
    </div>
    <div class="col-div-3">
    <div class="box">
        <h4>Đơn hàng chưa xác nhận</h4>
        <div class="flex">
        <p id="soldproducts"></p>
        <i class="fa fa-tasks box-icon"></i>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <br />
    <div class="col-div-6">
      <div class="box-6" style="padding:15px;">
        <div class="" style="width:100%; height:500px; overflow-y:scroll;">
          <table class="" style="text-align:center;">
              <thead class="sticky-top" style="background-color:#1b203d;">
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
    </div>
    <div class="col-div-6">
      <div class="box-6" style="padding:5px;">
        <canvas id="myChart"></canvas>
        <div class="content-box">
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
  
  

</div>';
?>
<script>
  var dataset_bill = new Array();
  var dataset_import = new Array();
  var today = new Date();
  <?php
  $dtb = new database();
  $year = date("Y");
  for ($m = 1; $m <= 12; $m++) {
    $query_bill = "SELECT sum(total) as Total from bill where MONTH(CreateTime) = '$m' AND YEAR(CreateTime) = '$year' AND `status`<>'Đã Hủy' AND `status`<>'Đã Đặt'";
    $query_import = "SELECT sum(Total) as Total from import where MONTH(CreateTime) = '$m' AND YEAR(CreateTime) = '$year'";
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
        text: 'THỐNG KẾ NHẬP/XUẤT CÁC THÁNG TRONG NĂM '+today.getFullYear()
      }
    }
  }

  new Chart("myChart", options);
  Chart.defaults.global.defaultFontColor = "white";
</script>