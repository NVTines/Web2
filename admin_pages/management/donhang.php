<?php
    echo 
  '<div id="shows">
    <div id="main">
      <div class="head">
        <div class="col-div-6">
          <span onclick="invinbox()" style="font-size: 30px; cursor: pointer; color: white" class="nav2">&#9776;QUẢN LÝ
            ĐƠN HÀNG</span>
        </div>

        <div class="col-div-6">
          <div class="profile">
            <img src="user.png" class="pro-img" />
            <p class="profile">MBKT<span>DESIGNER</span></p>
          </div>
        </div>
        <div class="clearfix">

        </div>
      </div>
    </div>
    <div class="col-div-8">
      <div class="box-8">
        <div class="content-box">
          <table id="showlist">
            <tr><th>ID hóa đơn</th><th>Tên người mua(Account đặt hàng)</th><th>Thời gian đặt hàng</th><th>SĐT</th><th>Địa chỉ</th><th>Gmail</th><th>PTTT</th><th>NOTE</th><th>Tình trạng</th><th>Tổng tiền</th></tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></br>
                <select id="" onchange="checkTT()">
                  <option value="">Choose</option>
                  <option value="cxl">Chưa xử lý</option>
                  <option value="xl">Đang xử lý</option>
                  <option value="dxl">Đã xử lý</option>
                </select>
              </td>
              <td>$
                <a onclick="showcthd()" style="color:red;background-color:white;padding:3px 8px;border-radius:50%;cursor:pointer;margin-left:20px;font-weight:bold">+</a>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>';
?>