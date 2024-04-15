<?php
  echo 
  '<div id="boxtb" style="background-color:white;height:-100px;width:500px;position:fixed;z-index:10;right:20%;display:flex">
  </div>
  <div id="shows">
    <div id="main">
      <div class="head">
        <div class="col-div-6">
          <span  onclick="invinbox()"
            style="font-size: 30px; cursor: pointer; color: white"
            class="nav2"
            >&#9776;QUẢN LÝ SẢN PHẨM</span
          >
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
    <div class="col-div-8">
      <div class="box-8">
        <div class="content-box">
          <table id="showlist">
            <tr><th>ID</th><th>name</th><th>Brand</th><th>Img</th><th>Price</th><th>Action</th></tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <img src="" style="width:80px;height:80px"/>
              </td>
              <td>$</td>
              <td>
                <button class="delete" onclick="thongbaobox()">&times;</button>
                <button style="margin-left:10px" onclick="hideFixSP()">&#9881;</button>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>';
?>