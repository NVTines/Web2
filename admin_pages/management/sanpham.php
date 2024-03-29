<?php
    echo '<div id="boxtb" style="background-color:white;height:-100px;width:500px;position:fixed;z-index:10;right:20%;display:flex">
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
        <div class="col-div-6">
          <div class="profile">
            <img src="user.png" class="pro-img" />
            <p class="profile">MBKT<span>DESIGNER</span></p>
          </div>
        </div>
    <a href="#" style="text-decoration: none;" onclick="hideAddSP()"><h2 style="color: white">THÊM SẢN PHẨM>></h2></a>
    <div id="clearfix" style="display:none">    
    <div style="color: white; font-size: 20px;">ID:</div>
    <input style="height:20px" type="number" id="product">
    <div style="color: white; font-size: 20px;">Name:</div>
    <input style="height:20px" type="text" id="name"/>
    
    <div style="color: white; font-size: 20px;">Image:</div>
    <input style="height:20px" type="file"  id="imgg"/>
    <div style="color: white; font-size: 20px;">Price:</div>
    <input style="height:20px" type="number" id="price" />
    <div style="color: white; font-size: 20px;">Brand:</div>
    <select style="height:20px" id="brand">
      <option value="">Choose</option>
      <option value="nike">Nike</option>
      <option value="puma">Puma</option>
      <option value="adidas">Adidas</option>
    </select>
    <div style="color: white; font-size: 20px;">Gender:</div>
    <select style="height:20px" id="gender">
      <option value="">Choose</option>
      <option value="man">Man</option>
      <option value="woman">Woman</option>
      <option value="kid">Kid</option>
    </select>
    <div style="margin-top:20px"><a href="#" style="background-color:white;text-decoration: none;font-weight:bold;padding:10px;padding-left:68px;padding-right:68px" onclick="addproduct()">THÊM</a></div>
      </div>
      </div>
    </div>
    <div class="col-div-8">
      <div class="box-8">
        <div class="content-box">
          
        <input style="width:100%;height:40px;font-size:15px;padding-left:20px" type="text" id="search-box" placeholder="searching..."  onkeyup="filterOf()"/>
          
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