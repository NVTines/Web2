function countAll() {

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "functions/dashboard.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
      let response = JSON.parse(this.responseText);
      document.getElementById('customers').innerHTML = response.countKH;
      document.getElementById('products').innerHTML = response.countSP;
      document.getElementById('orders').innerHTML = response.countDHDD;
      document.getElementById('soldproducts').innerHTML = response.countSPBD;
      document.getElementById('percent').innerHTML = response.percent;
  }
  xhr.send('countAll');
}
function CountCustomer() {
    var c = JSON.parse(localStorage.getItem("user"));
    document.getElementById("customers").innerHTML = c.length - 1 + "</br><span>Customers</span>";
  }

  function CountOrder() {
    var c = JSON.parse(localStorage.getItem("HDKH"));
    document.getElementById("orders").innerHTML = c.length + "<br/><span>Orders</span>";
  }

  function CountProduct() {
    var c = JSON.parse(localStorage.getItem("products"));
    document.getElementById("products").innerHTML = c.length + "<br/><span>Products</span>";
  }
  var mid_3;

  function Quantity(temp, temp_1) {
    var s = 0;
    var arr = JSON.parse(localStorage.getItem('HDKH'));
    for (var i = 0; i < arr.length; i++)
      if (arr[i].IDhd == temp_1) {
        for (var j = 0; j < arr[i].cthoadon.length; j++) {
          if (temp == arr[i].cthoadon[j].product) {
            s++;
            mid_3 = arr[i].cthoadon[j].product;
          }
        }
        break;
      }
    return s;
  }

  function CountSold() {
    var c = JSON.parse(localStorage.getItem("HDKH"));
    var sum = 0;
    for (var i = 0; i < c.length; i++)
      for (var j = 0; j < c[i].cthoadon.length; j++)
        if (c[i].cthoadon[j].product == mid_3) continue;
        else {
          sum += Quantity(c[i].cthoadon[j].product, c[i].IDhd);
        }
    document.getElementById("soldproducts").innerHTML = sum + "<br/><span>Products Sold</span>";
  }


// San pham ========================================================================
  function show(){
    var arr = JSON.parse(localStorage.getItem('products'));
    var tr='<tr><th>ID</th><th>name</th><th>Brand</th><th>Img</th><th>Price</th><th>Action</th></tr>';
    for( var i=0;i<arr.length;i++){
       tr+='<tr><td>'+arr[i].product+'</td><td>'+arr[i].name+'</td><td>'+arr[i].brand+'</td><td><img src="'+arr[i].img+'" style="width:80px;height:80px"/></td><td>'+arr[i].price+'$</td><td><button class="delete" onclick="thongbaobox(\''+arr[i].product+'\')">&times;</button><button style="margin-left:10px" onclick="hideFixSP('+arr[i].product+')">&#9881;</button></td></tr>';
    }
    document.getElementById('showlist').innerHTML=tr;  
 }
 function thongbaobox(namedelete){
   document.getElementById('boxtb').style.animation="tb 1s forwards";
   document.getElementById('boxtb').innerHTML='<h1 style="margin-left:20px">XÁC NHẬN XÓA:</h1><a href="#" style="margin-left:40px;line-height:50px" onclick="deletee(\''+namedelete+'\')"><h2 >YES</h2></a><a href="#" style="margin-left:60px;line-height:50px" onclick="invthongbaobox()"><h2>NO</h2></a>';
 }
 function deletee(namedelete){//Xóa một sản phẩm
   var arr=JSON.parse(localStorage.getItem('products'));
   for(var i=0;i<arr.length;i++){
   if(arr[i].product == namedelete){
     arr.splice(i, 1);
     }
   }
   localStorage.setItem('products',JSON.stringify(arr));
   document.getElementById('boxtb').style.animation="tb_2 1s forwards";
   show();
 }
 function filterOf(){//Search sản phẩm cơ bản, theo tên và theo ID sản phẩm
     var s='<tr><th>ID</th><th>name</th><th>Brand</th><th>Img</th><th>Price</th><th>Action</th></tr>';
     var temp,temp_2;
     var input=document.getElementById("search-box").value;
     var filter= document.getElementById("search-box").value.toUpperCase();
     var arr=JSON.parse(localStorage.getItem('products'));
     for (var i = 0; i < arr.length; i++) {
         temp=arr[i].name.toUpperCase();
         temp_2=String(arr[i].product);
         if (temp.indexOf(filter) > -1 || temp_2.indexOf(input) > -1 ) {
             
             s+='<tr><td>'+arr[i].product+'</td><td>'+arr[i].name+'</td><td>'+arr[i].brand+'</td><td><img src="'+arr[i].img+'" style="width:80px;height:80px"/></td><td>'+arr[i].price+'$</td><td><button class="delete" onclick="thongbaobox(\''+arr[i].product+'\')">&times;</button><button style="margin-left:10px" onclick="hideFixSP('+arr[i].product+')">&#9881;</button></td></tr>';    

         }
     } 
     document.getElementById('showlist').innerHTML=s;
   }
 function addproduct(){//Thêm 1 sản phẩm
   var cut=document.getElementById('imgg').value.split("\\");
   var productArray=JSON.parse(localStorage.getItem('products'));
   var productadd={product:document.getElementById('product').value, name:document.getElementById('name').value, brand:document.getElementById('brand').value, gender:document.getElementById('gender').value, img:cut[2], price:document.getElementById('price').value};
   if(productadd.product=="" || productadd.name=="" || productadd.brand=="" || productadd.gender=="" || productadd.price==""){
     alert("Hãy nhập đầy đủ thông tin");
     return 0;
   }
   for(var i=0;i<productArray.length;i++)
     if(productadd.product==productArray[i].product){
       alert("ID sản phẩm đã tồn tại");
       return 0;
     }
   productArray.push(productadd);
   localStorage.setItem('products',JSON.stringify(productArray));
   alert("Thêm thành công");
   reset_1();//Reset lại thông tin điền trong box add sản phẩm
   show();//Reset lại trang
 }
 function Fixproduct(){//Sửa thông tin một sản phẩm
   var xd=0;
   var gtri=document.getElementById('change').value;
   var productArray=JSON.parse(localStorage.getItem('products'));
   var ID=document.getElementById('product_2').value;
   for(var i=0;i<productArray.length;i++)
     if(ID==productArray[i].product){
       xd=1;
       switch(document.getElementById('choose').value){
         case 'name'://Sửa tên sản phẩm
           productArray[i].name=gtri;
           break;
         case 'img'://Sửa hình ảnh
           var cut=gtri.split("\\");
           productArray[i].img=cut[2];
           break;
         case 'price'://Sửa giá 
           productArray[i].price=gtri;
           break;
         case 'brd'://Sửa hãng giày
           productArray[i].brand=gtri;
           break;
         default:
           break;
       }   
     }
   if(xd==0) alert('ID sản phẩm không tồn tại');
   localStorage.setItem('products',JSON.stringify(productArray));
   alert("Sửa thành công");
   cancelbox();//Đóng box chỉnh sửa sản phẩm
   document.getElementById('change').value="";
   document.getElementById('choose').value="";
   document.getElementById('capnhat').innerHTML='<input readonly style="height:20px" type="text" id="change"/>';

   show();//Reset lại trang
 }
 var addsp=0;
 function hideAddSP(){
   if(addsp==0){
     document.getElementById('clearfix').style.display="block";
     addsp++;
     return 0;
   } 
   if(addsp==1){
     document.getElementById('clearfix').style.display="none";
     addsp++;
     return 0;
   }
   if(addsp==2){
     addsp=0;
     hideAddSP();
   }
 }
 function hideFixSP(obj){
     document.getElementById('clearfix_2').style.display="block";
     document.getElementById('flat').style.zIndex="10";
     document.getElementById('flat').style.display="block";
     document.getElementById("ttsp").innerHTML="ID sản phẩm: <input style='text-align:center;font-size:18px;font-style:italic;' readonly id='product_2' value='"+obj+"'>";
     var productArray=JSON.parse(localStorage.getItem("products"));
     for(var i=0;i<productArray.length;i++){
       if(obj==productArray[i].product){
         document.getElementById("ttsp2").innerHTML="<img style='height:100px;width:100px' src='"+productArray[i].img+"'>";
         document.getElementById("ttsp3").innerHTML="Tên sản phẩm: "+productArray[i].name;
       }
     }
 }
 function reset_1(){
   document.getElementById('product').value="";
   document.getElementById('name').value="";
   document.getElementById('brand').value="";
   document.getElementById('gender').value="";
   document.getElementById('imgg').value="";
   document.getElementById('price').value="";
 }
 function cancelbox(){
   document.getElementById("clearfix_2").style.display="none";
   document.getElementById('flat').style.zIndex="-1";
   document.getElementById('flat').style.display="none";
   document.getElementById('change').value="";
   document.getElementById('choose').value="";
   document.getElementById('capnhat').innerHTML='<input readonly style="height:20px" type="text" id="change"/>';

 }
 function changetype(){
   var gtri=document.getElementById('change').value;
       switch(document.getElementById('choose').value){
         case 'name':
           document.getElementById('capnhat').innerHTML='<input style="height:20px" type="text" id="change"/>';
           break;
         case 'img':
           document.getElementById('capnhat').innerHTML='<input style="height:20px" type="file" id="change"/>';
           break;
         case 'price': 
           document.getElementById('capnhat').innerHTML='<input style="height:20px" type="text" id="change"/>';
           break;
         case 'brd':
           document.getElementById('capnhat').innerHTML='<input style="height:20px" type="text" id="change"/>';
           break;
         default:
           break;
       }   
 }

 // User ========================================================================
 function show(){
  var arr = JSON.parse(localStorage.getItem('user'));
  var tr='<tr><th>ID</th><th>Username</th><th>Password</th><th>Name</th><th>Phone</th><th>Email</th><th>Address</th><th>Delete</th></tr>';
  for( var i=0;i<arr.length;i++){
     if(arr[i].usertype!="admin")
       tr+='<tr><td>'+(i+1)+'</td><td>'+arr[i].username+'</td><td>'+arr[i].password+'</td><td>'+arr[i].fullname+'</td><td>'+arr[i].phone+'</td><td>'+arr[i].email+'</td><td>'+arr[i].address+'</td><td><button class="delete" onclick="thongbaobox(\''+arr[i].username+'\')">&times;</button></td></tr>';
  }
  document.getElementById('showlist').innerHTML=tr;  
}
function thongbaobox(namedelete){
 document.getElementById('boxtb').style.animation="tb 1s forwards";
 document.getElementById('boxtb').innerHTML='<h1 style="margin-left:20px">XÁC NHẬN XÓA:</h1><a href="#" style="margin-left:40px;line-height:50px" onclick="deletee(\''+namedelete+'\')"><h2 >YES</h2></a><a href="#" style="margin-left:60px;line-height:50px" onclick="invthongbaobox()"><h2>NO</h2></a>';
}

function deletee(namedelete){
 var arr=JSON.parse(localStorage.getItem('user'));
 for(var i=0;i<arr.length;i++){
 if(arr[i].username == namedelete){
   arr.splice(i, 1);
   }
 }
 localStorage.setItem('user',JSON.stringify(arr));
 document.getElementById('boxtb').style.animation="tb_2 1s forwards";
 show();

}

 // Don hang ========================================================================
 var mid;
 function checkQuantity(temp, temp_1) {
   var s = 0;
   var arr = JSON.parse(localStorage.getItem('HDKH'));
   for (var i = 0; i < arr.length; i++)
     if (arr[i].IDhd == temp_1) {
       for (var j = 0; j < arr[i].cthoadon.length; j++) {
         if (temp == arr[i].cthoadon[j].product) {
           s++;
           mid = arr[i].cthoadon[j].product;
         }
       }
       break;
     }
   return s;
 }
 function showcthd(temp) {//Show chi tiết từng hóa đơn 
   var tr = "";
   var arrs = JSON.parse(localStorage.getItem('HDKH'));
   for (var i = 0; i < arrs.length; i++) {
     if (temp == arrs[i].IDhd) {
       tr += '<tr><th>ID hóa đơn</th><th>IDSP</th><th>name</th><th>Brand</th><th>Img</th><th>Quantity</th><th>Price<a onclick="showdshd()" style="color:red;background-color:white;padding:0px 8px;border-radius:50%;cursor:pointer;margin-left:20px">-</a></th></tr>';
       for (var j = 0; j < arrs[i].cthoadon.length; j++) {
         if (mid == arrs[i].cthoadon[j].product) continue;
         else {
           tr += '<tr><td>' + arrs[i].IDhd + '</td><td>' + arrs[i].cthoadon[j].product + '</td><td>' + arrs[i].cthoadon[j].name + '</td><td>' + arrs[i].cthoadon[j].brand + '</td><td><img src="' + arrs[i].cthoadon[j].img + '" style="width:80px;height:80px"/></td><td>' + checkQuantity(arrs[i].cthoadon[j].product, arrs[i].IDhd) + '</td><td>' + arrs[i].cthoadon[j].price + '$</td></tr>';
         }
       }
       break;
     }
   }
   document.getElementById('showlist').innerHTML = tr;
 }
 function checkTT(temp) {
   var arrs = JSON.parse(localStorage.getItem('HDKH'));
   for (var i = 0; i < arrs.length; i++) {
     if (arrs[i].IDhd == temp) {
       if (document.getElementById(i).value == 'cxl') arrs[i].tthd = "Chưa xử lý";
       if (document.getElementById(i).value == 'xl') arrs[i].tthd = "Đang xử lý";
       if (document.getElementById(i).value == 'dxl') arrs[i].tthd = "Đã xử lý";
       break;
     }
   }
   localStorage.setItem('HDKH', JSON.stringify(arrs));
   showdshd();
 }
 function showdshd() {//Inner danh sách hóa đơn, tương ứng từng object trong mảng local HDKH
   var arrs = JSON.parse(localStorage.getItem('HDKH'));
   var tr = '<tr><th>ID hóa đơn</th><th>Tên người mua(Account đặt hàng)</th><th>Thời gian đặt hàng</th><th>SĐT</th><th>Địa chỉ</th><th>Gmail</th><th>PTTT</th><th>NOTE</th><th>Tình trạng</th><th>Tổng tiền</th></tr>';
   for (var i = 0; i < arrs.length; i++) {
     tr += '<tr><td>' + arrs[i].IDhd + '</td><td>' + arrs[i].tenkh + '(' + arrs[i].TK + ')</td><td>' + arrs[i].timehd + '</td><td>' + arrs[i].sdtkh + '</td><td>' + arrs[i].diachikh + ' ' + arrs[i].tpkh + '</td><td>' + arrs[i].mailkh + '</td><td>' + arrs[i].pttt + '</td><td>' + arrs[i].note + '</td><td>' + arrs[i].tthd + '</br><select id="' + i + '" onchange="checkTT(' + arrs[i].IDhd + ')"><option value="">Choose</option><option value="cxl">Chưa xử lý</option><option value="xl">Đang xử lý</option><option value="dxl">Đã xử lý</option></select></td><td>' + arrs[i].tongtienhd + '$<a onclick="showcthd(' + arrs[i].IDhd + ')" style="color:red;background-color:white;padding:3px 8px;border-radius:50%;cursor:pointer;margin-left:20px;font-weight:bold">+</a></td></tr>';

   }
   document.getElementById('showlist').innerHTML = tr;
 }
