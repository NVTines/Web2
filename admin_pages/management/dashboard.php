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
      <div class="box-8">
        <div class="content-box">
          <p>Managers<span>View All</span></p>
          <br />
          <table>
            <tr>
              <th>Name</th>
              <th>Contact</th>
              <th>Country</th>
            </tr>
            <tr>
                <td>Ngô Văn Tín</td>
                <td>ngovantin113@gmail.com</td>
                <td>VIETNAM</td>
            </tr>
            <tr>
                <td>Huỳnh Gia Bảo</td>
                <td>huynhgiabao113@gmail.com</td>
                <td>VIETNAM</td>
            </tr>
            <tr>
                <td>Nguyễn Tuấn Kiệt</td>
                <td>nguyentuankiet1309@gmail.com</td>
                <td>VIETNAM</td>
            </tr>
            <tr>
                <td>Quang Minh</td>
                <td>quangminh@gmail.com</td>
                <td>VIETNAM</td>
            </tr>
          </table>
        </div>
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
</div>';
