var count = 0;
function invinbox() {
    if (count == 0) {

        document.getElementById('nav').style.animation = "navside_2 2s forwards";
        document.getElementById('shows').style.animation = "full 2s forwards";
        count++;
        return 0;
    }
    if (count == 1) {

        document.getElementById('nav').style.animation = "navside 2s forwards";
        document.getElementById('shows').style.animation = "full_2 2s forwards";
        count++;
        return 0;
    }
    if (count == 2) {
        count = 0;
        invinbox();
    }
}

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
      document.getElementById('percent').innerHTML = parseInt(response.percent);
      document.documentElement.style.setProperty("--change", parseFloat(response.percent)*1.8+"deg");
  }
  xhr.send('countAll');
}

function static_product(){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "functions/dashboard.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
      let response = JSON.parse(this.responseText);
      document.getElementById('static-product').innerHTML = response;
  }
  xhr.send('static_product');
}


function filterDate() {
  let DateBD = document.getElementById('DateBD').value;
  let DateKT = document.getElementById('DateKT').value;
  if (DateBD == '' || DateKT == '') {
    alert("Thiếu Thông Tin, mời nhập lại!")
  } else {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "functions/dashboard.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      let response = JSON.parse(this.responseText);
      document.getElementById('static-product').innerHTML = response;
    }
    xhr.send('fill_date'+'&DateBD=' + DateBD +'&DateKT=' + DateKT);
  }
}

function deleteOneProduct(id){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "functions/deleteProduct.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
      let response = JSON.parse(this.responseText);
      if(response.status == "success"){
        Swal.fire({
          title: 'Thành công',
          text: 'Yêu cầu xóa thành công!.',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.isConfirmed) {
            invthongbaobox();
            window.location.reload();
          }
        });
      }else{
        Swal.fire({
          title: 'Thất bại',
          text: 'Có gì đó sai sai.',
          icon: 'error',
          confirmButtonText: 'OK'
        })
      }
  }
  xhr.send("id="+id);
}

function deleteOneSup(id){
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "functions/deleteSup.php", true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
      let response = JSON.parse(this.responseText);
      if(response.status == "success"){
        document.getElementById("sup"+id).remove();
        Swal.fire({
          title: 'Thành công',
          text: 'Yêu cầu xóa thành công!.',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.isConfirmed) {
            invthongbaobox();
          }
        });
      }else{
        Swal.fire({
          title: 'Thất bại',
          text: 'Có gì đó sai sai.',
          icon: 'error',
          confirmButtonText: 'OK'
        })
      }
  }
  xhr.send("data="+id);
}
function showForm() {
  document.getElementsByClassName('block-mid')[0].style.zIndex = "1";
  document.getElementsByClassName('block-mid')[0].style.opacity = "0.2";
}
function hideForm() {
  document.getElementsByClassName('block-mid')[0].style.zIndex = "-1";
  document.getElementsByClassName('block-mid')[0].style.opacity = "0";
} 

//  function thongbaobox(namedelete){
//    document.getElementById('boxtb').style.animation="tb 1s forwards";
//    document.getElementById('boxtb').innerHTML='<h1 style="margin-left:20px">XÁC NHẬN XÓA:</h1><a href="#" style="margin-left:40px;line-height:50px" onclick="deletee(\''+namedelete+'\')"><h2 >YES</h2></a><a href="#" style="margin-left:60px;line-height:50px" onclick="invthongbaobox()"><h2>NO</h2></a>';
//  }
//  function deletee(namedelete){//Xóa một sản phẩm
//    var arr=JSON.parse(localStorage.getItem('products'));
//    for(var i=0;i<arr.length;i++){
//    if(arr[i].product == namedelete){
//      arr.splice(i, 1);
//      }
//    }
//    localStorage.setItem('products',JSON.stringify(arr));
//    document.getElementById('boxtb').style.animation="tb_2 1s forwards";
//    show();
//  }
//  function filterOf(){//Search sản phẩm cơ bản, theo tên và theo ID sản phẩm
//      var s='<tr><th>ID</th><th>name</th><th>Brand</th><th>Img</th><th>Price</th><th>Action</th></tr>';
//      var temp,temp_2;
//      var input=document.getElementById("search-box").value;
//      var filter= document.getElementById("search-box").value.toUpperCase();
//      var arr=JSON.parse(localStorage.getItem('products'));
//      for (var i = 0; i < arr.length; i++) {
//          temp=arr[i].name.toUpperCase();
//          temp_2=String(arr[i].product);
//          if (temp.indexOf(filter) > -1 || temp_2.indexOf(input) > -1 ) {
//          }
//      } 
//      document.getElementById('showlist').innerHTML=s;
//    }
 
