<?php
echo '<div id="shows">
<div id="main">
  <div class="head">
    <div class="col-div-6">
      <span  onclick="invinbox()"
        style="font-size: 30px; cursor: pointer; color: white"
        class="nav2"
        >&#9776;Dashboard</span
      >
    </div>

    <div class="col-div-6">
        
      <div class="profile">
        <img src="user.png" class="pro-img" />
        <p class="profile">MBKT<span>DESIGNER</span></p>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="col-div-3">
    <div class="box">
      <p id="customers"></p>
      <i class="fa fa-users box-icon"></i>
    </div>
  </div>
  <div class="col-div-3">
    <div class="box">
      <p id="products"></p>
      <i class="fas fa-list box-icon"></i>
    </div>
  </div>
  <div class="col-div-3">
    <div class="box">
      <p id="orders"></p>
      <i class="fa fa-shopping-bag box-icon"></i>
    </div>
  </div>
  <div class="col-div-3">
    <div class="box">
      <p id="soldproducts"></p>
      <i class="fa fa-tasks box-icon"></i>
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
        <p>Total Sale<span>View All</span></p>

        <div class="circle-wrap">
        <div class="circle">
          <div class="mask full">
            <div class="fill"></div>
          </div>
          <div class="mask half">
            <div class="fill"></div>
          </div>
          <div class="inside-circle">70%</div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
</div>
</div>';
