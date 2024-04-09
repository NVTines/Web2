var today = new Date();
var date = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date + ' ' + time;
function previewImage(event){
    var avt = document.getElementById("avt-info");
    avt.src = URL.createObjectURL(event.target.files[0]);
    avt.onload = function(){
        URL.revokeObjectURL(avt.src);
    }
}
function goToMain(){
    window.location.href="index.php";
}
function total() {//Tính tổng giá các sản phẩm của hóa đơn (kèm tax 10%)
    var totalprice = 0.0;
    var pricenottax = 0.0;
    var s = "";
    var arr = JSON.parse(localStorage.getItem('cart'));
    for (var i = 0; i < arr.length; i++) {
        pricenottax += arr[i].price;
    }
    totalprice = Math.ceil(pricenottax * 110 / 100);
    s = '<tr><td>Subtotal</td><td>$' + Math.ceil(pricenottax, 2) + '</td></tr><tr><td>Tax</td><td>10%</td></tr><tr><td>Total</td><td>$' + totalprice + '</td></tr>'
    document.getElementById('totalHoaDon').innerHTML = s;
    return totalprice;
}
function outHD() {
    document.getElementById('hoadon').style.zIndex = "-1";
    document.getElementById('hoadon').style.opacity = "0";
    document.getElementById('logbox_0').style.zIndex = "-1";
    document.getElementById('logbox_0').style.opacity = "0";
}

function hienHD() {
    document.getElementById('logbox_0').style.zIndex = "14";
    document.getElementById('logbox_0').style.opacity = "0.2";
    document.getElementById('hoadon').style.zIndex = "15";
    document.getElementById('hoadon').style.opacity = "1";
}
function reset() {
    document.getElementById('nnhoten').value = "";
    document.getElementById('nnsdt').value = "";
    document.getElementById('nnmail').value = "";
    document.getElementById('nncity').value = "";
    document.getElementById('nndiachi').value = "";
    document.getElementById('note').value = "";
    document.getElementById('nnngaysinh').value = "";
    document.getElementById('pttt').value = "";
    document.getElementById('nngioitinh').value = "";
}
function CheckHD() {//Kiểm tra hóa đơn đã điền đủ thông tin
    if (document.getElementById('nnhoten').value == "" ||
        document.getElementById('nnsdt').value == "" ||
        document.getElementById('nnmail').value == "" ||
        document.getElementById('nncity').value == "" ||
        document.getElementById('nndiachi').value == "" ||
        document.getElementById('nnsdt').value == "" ||
        document.getElementById('pttt').value == "" ||
        document.getElementById('nngioitinh').value == "") {
        alert('Hãy điền đầy đủ thông tin hóa đơn');
        return false;
    }
    else return true;
}
function invthongbaobox() {
    document.getElementById('boxtb').style.animation = "tb_2 1s forwards";
}
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
var myIndex = 0;
function slider() {
    var i;
    var x = document.getElementsByClassName("slideimg");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) { myIndex = 1 }
    x[myIndex - 1].style.display = "block";
    setTimeout(slider, 2000);
}


function CreateAccountBoard() {
    document.getElementById('logbox_2').style.zIndex = "10";
    document.getElementById('logbox_2').style.opacity = "1";
    document.getElementById('logbox').style.zIndex = "-1";
    document.getElementById('logbox').style.opacity = "0";
}
function out_2() {
    document.getElementById('logbox_2').style.opacity = "0";
    document.getElementById('logbox_2').style.zIndex = "-1";
    document.getElementById('wrapper').style.opacity = "1";
    document.getElementById('logbox_0').style.opacity = "0";
    document.getElementById('logbox_0').style.zIndex = "-1";
}
function dangnhap() {
    document.getElementById('wrapper').style.opacity = "0.2";
    document.getElementById('logbox').style.zIndex = "10";
    document.getElementById('logbox').style.opacity = "1";
    document.getElementById('logbox_2').style.opacity = "0";
    document.getElementById('logbox_2').style.zIndex = "-1";
    document.getElementById('logbox_0').style.zIndex = "8";
    document.getElementById('logbox_0').style.opacity = "0.2";
}
function out() {
    document.getElementById('logbox').style.opacity = "0";
    document.getElementById('logbox').style.zIndex = "-1";
    document.getElementById('wrapper').style.opacity = "1";
    document.getElementById('logbox_0').style.opacity = "0";
    document.getElementById('logbox_0').style.zIndex = "-1";
}




function createProducts() {
    var productarray = [];
    if (localStorage.getItem('products') == null) {
        productarray = [
            { product: 1001, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/ae8b1fa2-6988-4cf4-8416-ed82067ed52f/air-jordan-1-retro-high-og-shoe-a7Zzxm.png', name: 'Air Jordan 1 Retro High OG', price: 99.99 },
            { product: 1002, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/4f37fca8-6bce-43e7-ad07-f57ae3c13142/air-force-1-07-shoe-WrLlWX.png', name: 'Nike Air Force 1’07', price: 95.99 },
            { product: 1003, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/6991d7a9-be24-4ba4-ae20-b1f4690e6bf7/air-max-dawn-shoe-gq9GGH.png', name: 'Nike Air Max Dawn', price: 97.99 },
            { product: 1004, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/bf766eed-65b0-4c10-b922-4570192d5aa6/air-pegasus-83-shoes-dRccxf.png', name: 'Nike Air Pegasus 83 Premium', price: 105.99 },
            { product: 1005, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/9f5948f7-cf64-4865-9942-68d1fbba5601/blazer-low-shoes-PmgCt4.png', name: 'Nike Blazer Low X', price: 109.99 },
            { product: 1006, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/bf766eed-65b0-4c10-b922-4570192d5aa6/air-pegasus-83-shoes-dRccxf.png', name: 'Nike Air Pegasus 83 Premium', price: 107.99 },
            { product: 1007, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/9f5948f7-cf64-4865-9942-68d1fbba5601/blazer-low-shoes-PmgCt4.png', name: 'Nike Blazer Low X', price: 93.99 },
            { product: 1008, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/96559147-afe6-4a75-9b4a-db3dcf39b71e/air-zoom-pegasus-37-flyease-easy-on-off-road-running-shoes-bX39Rb.png', name: 'Nike Air Zoom Pegasus 37 FlyEase', price: 89.99 },
            { product: 1009, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/13fa7707-1529-4ab4-8a82-59fc37062863/kyrie-infinity-ep-basketball-shoes-QJ01t9.png', name: 'Kyrie Infinity EP', price: 96.99 },
            { product: 1010, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/c2db773f-985f-4676-88ec-4674abf99594/lebron-19-basketball-shoe-5dpw6F.png', name: 'LeBron 19', price: 96.99 },
            { product: 1011, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/916abc28-5981-493a-a577-0bf1481e437c/offline-2-mules-9Z1bhJ.png', name: 'Nike Offline 2.0', price: 94.99 },
            { product: 1012, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/769b0671-49af-408d-8de0-56e2640634fe/air-huarache-le-shoes-wCfbvV.png', name: 'Nike Air Huarache LE', price: 102.99 },
            { product: 1013, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/c4b233d3-bcdb-4e3a-a34f-47c3ca9a7016/asuna-2-slides-9CjWbM.png', name: 'Nike Asuna 2', price: 104.99 },
            { product: 1014, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/hhygtddz0xldtc82omn6/air-max-270-react-shoe-vtRNln.png', name: 'Nike Air Max 270 React', price: 101.99 },

            { product: 1015, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/9c4e6929-fbbc-495e-b8af-ec76d6e163fd/wio-8-road-running-shoes-S6jPM3.png', name: 'Nike Winflo 8', price: 108.99 },
            { product: 1016, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/5c276ba0-6b0a-463e-bd82-efa66a2c5e2d/custom-nike-react-miler-2-by-you.png', name: 'Nike React Miler 2 By You', price: 98.99 },
            { product: 1017, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/2681397e-d9f2-4eb4-ab2b-6f3a69d86c35/lebron-8-space-jam-a-new-legacy-shoe-tqkDTn.png', name: 'LeBron 8 x Space Jam: A New Legacy', price: 99.99 },
            { product: 1018, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/740da492-9bf7-4326-a2c9-47c5ab015f93/air-zoom-pegasus-38-road-running-shoes-t5mR6c.png', name: 'Nike Air Zoom Pegasus 38', price: 89.99 },
            { product: 1018, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/8b725117-f4cc-485e-9e8c-3f76104e64d5/custom-nike-phantom-gt-elite-by-you.png', name: 'Nike Phantom GT Elite By You', price: 97.99 },



            { product: 1019, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/f3d2797b-862d-4460-9511-c0d400f567b8/air-jordan-5-retro-shoe-CHQqM4.png', name: 'Jordan 5 Retro', price: 109.99 },

            { product: 1020, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/8f0ee7bd-f6e6-4c1f-a4cd-2770187df96e/mercurial-vapor-14-club-tf-football-shoe-W2Fgbt.png', name: 'Nike Mercurial Vapor 14 Club TF', price: 151.99 },
            { product: 1021, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/83078279-febb-45ac-b691-e6bbd4c4f360/acg-gore-tex-mountain-fly-shoe-45C8R2.png', name: 'Nike ACG Gore-TEX “Mountain Fly”', price: 109.99 },

            { product: 1022, gender: 'man', brand: 'nike', img: ' https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/71dd419c-30b1-4377-9187-9f62f4237691/air-zoom-pegasus-38-airnathan-bell-road-running-shoes-ndNHTP.png', name: 'Nike Air Zoom Pegasus 38 A.I.R.Nathan Bell', price: 119.99 },

            { product: 1023, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/8cb73898-47b4-401f-a84e-6b678f7e0a82/jordan-why-not-zer04-pf-basketball-shoe-P3c3Rp.png', name: 'Jordan “Why Not?” Ze0.4 PF', price: 199.99 },

            { product: 1024, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/5b9062c9-1410-4811-9ca3-1bacd7e01060/jordan-why-not-zer04-basketball-shoes-GNMwp9.png', name: 'Jordan “ Why Not?” Zer0.4', price: 189.99 },

            { product: 1025, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/739a63fc-8e7d-4003-b52d-99fd9cb2f513/air-force-1-07-shoes-lLn274.png', name: 'Nike Air Force 1’07', price: 123.42 },
            { product: 1026, gender: 'man', brand: 'nike', img: ' https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/6917e120-b105-48f9-801a-76e706e51f81/air-jordan-xxxvi-psychic-energy-pf-basketball-shoe-fjPfDg.png', name: 'Nike Jordan XXXVI ‘Psychic Energy’ PF', price: 122.33 },

            { product: 1027, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/68c95df7-1ae8-4c7b-ba94-94e5377bb12b/kd14-basketball-shoes-2W3tkH.png', name: 'KD14', price: 149.99 },

            { product: 1028, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/2ce5d243-e43f-4f45-ac4f-e3d96675a043/edcvghj-iuhbgfr-qwdcv.png', name: 'Nike Blazer Mid ’77 Cozi By You', price: 139.99 },

            { product: 1029, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/3c1e7743-80d1-4d60-8167-a0ed8850741e/giannis-immortality-force-field-basketball-shoe-7MLR3K.png', name: 'Giannis Immortallity “Force Field”', price: 128.99 },

            { product: 1030, gender: 'man', brand: 'nike', img: ' https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/630805bf-dd98-4005-a8cd-c20f96cf96b3/air-max-90-shoe-Rr3hDm.png', name: 'Nike Air Max 90 Premium', price: 113.99 },

            { product: 1031, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/be6f4f03-835b-4ed7-89ef-b90b933cc29a/zoomx-vaporfly-next-2-road-racing-shoes-D4ntS0.png', name: 'Nike ZoomX Vaporfly Next% 2', price: 125.99 },
            { product: 1032, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/b7577d05-eeaf-414d-8da8-d3c7d7f621a4/acg-mountain-fly-low-shoes-msGNPz.png', name: 'Nike ACG Mountain Fly Low', price: 117.99 },
            { product: 1033, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/a9b8bed7-d6fe-443e-9ae0-e1ff2b53ec76/air-max-bolt-shoe-qcn5kT.png', name: 'Nike Air Max Bolt', price: 126.99 },

            { product: 1034, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/f656e0b1-d88c-4e9f-815b-46763f71890f/kd14-ep-basketball-shoes-8xhLgp.png', name: 'KD14 EP', price: 143.99 },

            { product: 1035, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/dae83ec0-242f-4279-b704-8252ab82a787/city-rep-tr-training-shoe-djC0DF.png', name: 'Nike City Rep TR', price: 115.99 },

            { product: 1036, gender: 'man', brand: 'nike', img: ' https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/d6b21f68-1ebb-418b-9903-9c6b44d0bbf1/air-presto-shoes-QdhgZW.png', name: 'Nike Air Presto', price: 117.99 },

            { product: 1037, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/ab1fd708-f5a1-426a-b7b4-7f0ed590177f/kyrie-low-4-ep-basketball-shoe-gD2KLL.png', name: 'Kyrie Low 4 EP', price: 123.99 },

            { product: 1038, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/12828bb0-794b-4478-a5bd-62e2e7c74322/air-zoom-structure-24-road-running-shoes-9wCgmv.png', name: 'Nike Air Zoom Structure 24', price: 121.99 },

            { product: 1039, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/55e448bd-3e2a-4af9-81f9-d69a9947975e/waffle-one-shoes-1SFQwJ.png', name: 'Nike Waffile One', price: 178.99 },

            { product: 1040, gender: 'man', brand: 'nike', img: ' https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/f782cc48-728a-4211-a7e5-e47db2a217a8/mercurial-superfly-8-elite-km-fg-football-boot-sxX9Vh.png', name: 'Nike Mercurial Superfly 8 Elite KM FG ', price: 143.99 },

            { product: 1041, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/9ce3296a-ea97-4482-b16a-2c22195eb11d/court-vision-low-shoes-F6vqsg.png', name: 'Nike Blazer Mid’77 Vintage By You', price: 141.99 },

            { product: 1042, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/7243c3dc-4e7b-4aa7-b8fa-f23353b29de1/jordan-ma2-shoe-qw1Z6m.png', name: 'Jordan MA2', price: 123.99 },
            { product: 1043, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/d0b9ee24-cbb3-40a0-908f-a647f2e54724/air-huarache-shoes-fg69qQ.png', name: 'Nike Air Huarache', price: 125.99 },
            { product: 1044, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/6bd2ac45-d8d2-49c9-9fb1-da56aa7fe7c5/air-zoom-pegasus-38-flyease-easy-on-off-road-running-shoes-Rgcn09.png', name: 'Nike Air Zoom Pegasus 38 FlyEase', price: 164.99 },

            { product: 1045, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/ec050790-3a46-4d67-bccf-ac2f6346bb68/savaleos-weightlifting-shoe-MRtXkr.png', name: 'Nkie Savaleos', price: 157.99 },

            { product: 1046, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/87fccdca-92d9-4d64-a92f-7c1eda10a9ec/crater-remixa-shoes-fX2fDZ.png', name: 'Nike Crater Remixa', price: 115.99 },

            { product: 1047, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/a8c6ec47-3618-4846-a8e8-3d2eb6c04967/jordan-4-g-golf-shoes-lW4531.png', name: 'Jordan 4G', price: 89.99 },

            { product: 1048, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/5cedcafa-2818-4885-9335-6281623a5f18/tiempo-legend-9-academy-tf-football-shoe-FT9Mcp.png', name: 'Nike Tiempo Legend 9 Academy TF', price: 95.99 },

            { product: 1049, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/cff35764-02f5-464c-9bc6-0b4b6c3f5c24/retro-gts-shoe-rHcd47.png', name: 'Nike Retro GTS', price: 195.99 },

            { product: 1050, gender: 'man', brand: 'nike', img: 'https://static.nike.com/a/images/c_limit,w_318,f_auto/t_product_v1/20ef8b8d-743c-473b-a0fb-64c0c23faae7/pg-5-ps-ep-basketball-shoe-FDj7kn.png', name: 'PG 5PS EP', price: 99.99 },
            { product: 1051, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381517/05/sv01/fnd/GBR/fmt/png/Wild-Rider-Rollin-Sneakers', name: "Wild Rider Rollin' Sneakers", price: 109.99 },
            { product: 1053, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381517/07/sv01/fnd/GBR/fmt/png/Wild-Rider-Rollin-Sneakers', name: "Wild Rider Rollin' Sneakers", price: 186.99 },
            { product: 1054, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381517/08/sv01/fnd/GBR/fmt/png/Wild-Rider-Rollin-Sneakers', name: "Wild Rider Rollin' Sneakers", price: 205.99 },
            { product: 1055, gender: 'man', brand: 'puma', img: 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381517/06/sv01/fnd/GBR/fmt/png/Wild-Rider-Rollin-Sneakers', name: "Wild Rider Rollin' Sneakers", price: 209.99 },
            { product: 1056, gender: 'man', brand: 'puma', img: 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381117/01/sv01/fnd/GBR/fmt/png/RS-Z-College-Trainers', name: 'RS-Z College Trainers', price: 95.99 },
            { product: 1057, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381640/04/sv01/fnd/GBR/fmt/png/RS-Z-Trainers', name: 'RS-Z Trainers', price: 94.99 },
            { product: 1058, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/383232/01/sv01/fnd/GBR/fmt/png/RS-Z-LTH-Trainers', name: 'RS-Z LTH Trainers', price: 123.99 },
            { product: 1059, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381117/04/sv01/fnd/GBR/fmt/png/RS-Z-College-Trainers', name: 'RS-Z College Trainers', price: 128.99 },
            { product: 1060, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381117/03/sv01/fnd/GBR/fmt/png/RS-Z-College-Trainers', name: 'RS-Z College Trainers', price: 99.99 },
            { product: 1061, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381640/02/sv01/fnd/GBR/fmt/png/RS-Z-Trainers', name: 'RS-Z Trainers', price: 85.99 },
            { product: 1062, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381640/03/sv01/fnd/GBR/fmt/png/RS-Z-Trainers', name: 'RS-Z Trainers', price: 91.99 },
            { product: 1063, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381640/01/sv01/fnd/GBR/fmt/png/RS-Z-Trainers', name: 'RS-Z Trainers', price: 165.99 },
            { product: 1064, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381117/02/sv01/fnd/GBR/fmt/png/RS-Z-College-Trainers', name: 'RS-Z College Trainers', price: 171.99 },
            { product: 1065, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/383232/02/sv01/fnd/GBR/fmt/png/RS-Z-LTH-Trainers', name: 'RS-Z LTH Trainers', price: 201.99 },
            { product: 1066, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381640/07/sv01/fnd/GBR/fmt/png/RS-Z-Trainers', name: 'RS-Z Trainers', price: 181.99 },
            { product: 1067, gender: 'man', brand: 'puma', img: " https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/191097/01/sv01/fnd/GBR/fmt/png/NRGY-NEKO-ENGINEER-KNIT-Men's-Running-Shoes", name: "NRGY NEKO ENGINEER KNIT Men's Running Shoes", price: 98.99 },
            { product: 1068, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/373117/40/sv01/fnd/GBR/fmt/png/R78-Runner-Trainers', name: 'R78 Runner Trainers', price: 202.99 },
            { product: 1069, gender: 'man', brand: 'puma', img: 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/373117/41/sv01/fnd/GBR/fmt/png/R78-Runner-Trainers', name: 'R78 Runner Trainers', price: 103.99 },
            { product: 1070, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/373117/39/sv01/fnd/GBR/fmt/png/R78-Runner-Trainers', name: 'R78 Runner Trainers', price: 92.99 },
            { product: 1071, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/373117/01/sv01/fnd/GBR/fmt/png/R78-Runner-Trainers', name: 'R78 Runner Trainers', price: 88.99 },
            { product: 1072, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/373117/38/sv01/fnd/GBR/fmt/png/R78-Runner-Trainers', name: 'R78 Runner Trainers', price: 104.99 },
            { product: 1073, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/193826/02/sv01/fnd/GBR/fmt/png/RS-G-Golf-Shoes', name: 'RS-G Golf Shoes', price: 134.99 },
            { product: 1074, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/380173/01/sv01/fnd/GBR/fmt/png/SpeedCat-LS-Trainers', name: 'SpeedCat LS Trainers', price: 197.99 },
            { product: 1075, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/380173/04/sv01/fnd/GBR/fmt/png/SpeedCat-LS-Trainers', name: 'SpeedCat LS Trainers', price: 205.99 },
            { product: 1076, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/380173/10/sv01/fnd/GBR/fmt/png/SpeedCat-LS-Trainers', name: 'SpeedCat LS Trainers', price: 96.99 },
            { product: 1077, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/380173/03/sv01/fnd/GBR/fmt/png/SpeedCat-LS-Trainers', name: 'SpeedCat LS Trainers', price: 97.99 },
            { product: 1078, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/374915/01/sv01/fnd/GBR/fmt/png/Suede-Classic-XXI-Trainers', name: 'Suede Classic XXI Trainers', price: 187.99 },
            { product: 1079, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/374915/02/sv01/fnd/GBR/fmt/png/Suede-Classic-XXI-Trainers', name: 'Suede Classic XXI Trainers', price: 202.99 },
            { product: 1080, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/374915/06/sv01/fnd/GBR/fmt/png/Suede-Classic-XXI-Trainers', name: 'Suede Classic XXI Trainers', price: 109.99 },
            { product: 1081, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/374915/05/sv01/fnd/GBR/fmt/png/Suede-Classic-XXI-Trainers', name: 'Suede Classic XXI Trainers', price: 121.99 },
            { product: 1082, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/374915/12/sv01/fnd/GBR/fmt/png/Suede-Classic-XXI-Trainers', name: 'Suede Classic XXI Trainers', price: 193.99 },
            { product: 1083, gender: 'man', brand: 'puma', img: 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/374915/04/sv01/fnd/GBR/fmt/png/Suede-Classic-XXI-Trainers', name: 'Suede Classic XXI Trainers', price: 183.99 },
            { product: 1084, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/374915/03/sv01/fnd/GBR/fmt/png/Suede-Classic-XXI-Trainers', name: 'Suede Classic XXI Trainers', price: 98.99 },
            { product: 1085, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/374915/23/sv01/fnd/GBR/fmt/png/Suede-Classic-XXI-Trainers', name: 'Suede Classic XXI Trainers', price: 206.99 },
            { product: 1086, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381118/02/sv01/fnd/GBR/fmt/png/Mirage-Tech-Trainers', name: ' Mirage Tech Trainers', price: 206.99 },
            { product: 1087, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381118/03/sv01/fnd/GBR/fmt/png/Mirage-Tech-Trainers', name: 'Mirage Tech Trainers', price: 207.99 },
            { product: 1088, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381118/08/sv01/fnd/GBR/fmt/png/Mirage-Tech-Trainers', name: 'Mirage Tech Trainers', price: 186.99 },
            { product: 1089, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381118/09/sv01/fnd/GBR/fmt/png/Mirage-Tech-Trainers', name: 'Mirage Tech Trainers', price: 141.99 },
            { product: 1090, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381118/13/sv01/fnd/GBR/fmt/png/Mirage-Tech-Trainers', name: 'Mirage Tech Trainers', price: 151.99 },
            { product: 1091, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381118/07/sv01/fnd/GBR/fmt/png/Mirage-Tech-Trainers', name: 'Adizero Boston 10 Shoes', price: 87.99 },
            { product: 1092, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381118/06/sv01/fnd/GBR/fmt/png/Mirage-Tech-Trainers', name: 'Mirage Tech Trainers', price: 197.99 },
            { product: 1093, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381118/01/sv01/fnd/GBR/fmt/png/Mirage-Tech-Trainers', name: 'Mirage Tech Trainers', price: 145.99 },
            { product: 1094, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/382044/05/sv01/fnd/GBR/fmt/png/City-Rider-Trainers', name: 'City Rider Trainers', price: 137.99 },
            { product: 1095, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/382044/04/sv01/fnd/GBR/fmt/png/City-Rider-Trainers', name: 'City Rider Trainers', price: 209.99 },
            { product: 1096, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/382044/02/sv01/fnd/GBR/fmt/png/City-Rider-Trainers', name: 'City Rider Trainers', price: 165.99 },
            { product: 1097, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/375640/01/sv01/fnd/GBR/fmt/png/RS-Fast-Nano-Trainers', name: 'RS-Fast Nano Trainers', price: 96.99 },
            { product: 1098, gender: 'man', brand: 'puma', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/192593/01/sv01/fnd/GBR/fmt/png/Enzo-Sport-Men's-Running-Shoes", name: "Enzo Sport Men's Running Shoes", price: 172.98 },
            { product: 1099, gender: 'man', brand: 'puma', img: ' https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/371149/26/sv01/fnd/GBR/fmt/png/Future-Rider-Play-On-Sneakers', name: 'Future Rider Play On Sneakers', price: 207.99 },
            { product: 1100, gender: 'man', brand: 'puma', img: " https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/193148/01/sv01/fnd/GBR/fmt/png/Axelion-Block-Men's-Running-Shoes", name: "Axelion Block Men's Running Shoes", price: 89.99 },
            { product: 1111, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/ec439b0ad50d45a99fc9ad1a00ba8124_9366/Giay_Grand_Court_SE_trang_GV7154_01_standard.jpg", name: "GRAND COURT SE", price: 82.99 },
            { product: 1112, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/237685b5868c409b8390ab51013b8507_9366/Giay_Ultraboost_20_x_James_Bond_Xam_FY0647_01_standard.jpg", name: "ULTRABOOST 20 X JAMES BOND", price: 87.99 },
            { product: 1113, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/78187317e91d4587b586ad2600a21310_9366/Giay_Ultraboost_4.0_DNA_DJen_FZ4008_01_standard.jpg", name: "ULTRABOOST 4.0 DNA", price: 91.99 },
            { product: 1114, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/bb08cfc10d194e138ed4ab4400af98da_9366/Giay_Ultraboost_SUMMER.RDY_Tokyo_DJen_FX0030_01_standard.jpg", name: "ULTRABOOST SUMMER.RDY TOKYO", price: 156.99 },
            { product: 1115, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/010418303ef64552b17aad20002fe9d6_9366/Giay_Adizero_Adios_6_DJen_H67509_01_standard.jpg", name: "ADIZERO ADIOS 6", price: 159.99 },
            { product: 1116, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/43f112d12fea4c098b8aad8a00ebadda_9366/Giay_Forum_84_Hi_Marvel_trang_GW5451_01_standard.jpg", name: "FORUM 84 HI MARVEL", price: 189.99 },
            { product: 1117, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/2a0d2404e23c49dfac0cad5500a3e501_9366/Giay_Superstar_trang_GW5782_01_standard.jpg", name: "SUPERSTAR", price: 81.99 },
            { product: 1118, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/91bcd01f6dfa4a3690d2ad49006dd686_9366/Giay_Rod_Laver_Vintage_trang_H02901_01_standard.jpg", name: "ROD LAVER VINTAGE", price: 211.99 },
            { product: 1119, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/3b3fe645626949d38b3dad4901167df9_9366/Giay_NMD_R1_DJen_GV8422_01_standard.jpg", name: "NMD_R1", price: 207.99 },
            { product: 1120, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/6a89a4768a4b4f1787ebad4900915ff8_9366/Giay_adidas_4DFWD_Pulse_DJen_Q46452_01_standard.jpg", name: "4DFWD PULSE", price: 219.99 },
            { product: 1121, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/3aa540bc48ba47ef9b8aad5600b4175b_9366/ADIZERO_ADIOS_6_M_Mau_xanh_da_troi_H67510_01_standard.jpg", name: "ADIZERO ADIOS 6 M", price: 89.99 },
            { product: 1122, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/5c51ebfc5ade419ebc0face00105ccea_9366/Giay_Gazelle_Vintage_Mau_xanh_da_troi_H02897_01_standard.jpg", name: "GAZELLE VINTAGE", price: 95.99 },
            { product: 1123, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/46931bc4585d401db212ad5100fd1281_9366/Giay_Stan_Smith_Peter_Pan_and_Tinker_Bell_trang_GZ5988_01_standard.jpg", name: "STAN SMITH PETER PAN AND TINKER BELL", price: 92.99 },
            { product: 1124, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/f15832842d974d4ab0dfad5c00810fe9_9366/Giay_ZX_2K_Boost_2.0_DJen_GZ7743_01_standard.jpg", name: "ZX 2K BOOST 2.0", price: 92.99 },
            { product: 1125, gender: 'man', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/8df5ab4346d7475ebb08a91500a047d3_9366/Giay_Continental_80_trang_G27706_01_standard.jpg", name: "CONTINENTAL 80", price: 94.99 },



            { product: 1126, gender: 'woman', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/bdc2de5361784646989ead5100ece755_9366/Giay_X9000L4_trang_GW5841_01_standard.jpg", name: "X9000 KARLIE KLOSS", price: 174.99 },
            { product: 1127, gender: 'woman', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/000ac345a0c9473aa69bac9a01812d48_9366/Giay_Golf_DJinh_Lien_CodeChaos_21_Primeblue_trang_FW5630_01_standard.jpg", name: "CODECHAOS 21 PRIMEBLUE", price: 203.99 },
            { product: 1128, gender: 'woman', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/089c6c1faab0416aa7ddabdf0126f2ff_9366/ULTRABOOST_DNA_DJen_FZ2730_01_standard.jpg", name: "ULTRABOOST DNA", price: 86.99 },
            { product: 1129, gender: 'woman', brand: 'addidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/5d78e589646241b694baad18017012c1_9366/Giay_Bravada_trang_H00478_01_standard.jpg", name: "BRAVADA", price: 201.99 },
            { product: 1130, gender: 'woman', brand: 'addidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/85e7661dbf5b49c599c2ac7c012ffbf8_9366/Giay_Ventice_2.0_DJen_FY9608_01_standard.jpg", name: "VENTICE 2.0", price: 89.99 },
            { product: 1131, gender: 'woman', brand: 'addidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/03d285e051df422b89e6ac1600d5669d_9366/Giay_NMD_R1_Spectoo_Xam_FZ3200_01_standard.jpg", name: "NMD_R1 SPECTOO", price: 93.99 },
            { product: 1132, gender: 'woman', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/fe4e1d93bbc844a8a1f1ac7c013f3cb6_9366/Giay_OZWEEGO_Celox_trang_GZ7278_01_standard.jpg", name: "OZWEEGO CELOX", price: 204.99 },
            { product: 1133, gender: 'woman', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/5e687425bbb4410d875ead71007851e8_9366/Giay_Golf_DJinh_Lien_Solarthon_Primeblue_Limited_Edition_Xam_GV9750_01_standard.jpg", name: "SOLARTHON PRIMEBLUE LIMITED EDITION", price: 178.99 },
            { product: 1134, gender: 'woman', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/ebfd7fb927c046508f9bad1900d473cd_9366/Giay_Slip-On_Ultraboost_DNA_Hong_GZ3154_01_standard.jpg", name: "SLIP-ON ULTRABOOST DNA", price: 173.99 },
            { product: 1135, gender: 'woman', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/08708ff932c348c88654abbc00eefb42_9366/ZX_8000_LEGO_Mau_vang_FZ3482_01_standard.jpg", name: "ZX 8000 LEGO", price: 215.99 },
            { product: 1136, gender: 'woman', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/f66156d93f824de58061ad2100aa9abe_9366/Giay_The_Thao_QT_Racer_Xam_Q46322_01_standard.jpg", name: "QT RACER", price: 141.99 },
            { product: 1137, gender: 'woman', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/1f433c7bd3754fd9b944acad0136bce5_9366/SUPERSTAR_SIMPSONS_SQUISHEE_mau_xanh_la_H05789_01_standard.jpg", name: "SUPERSTAR SIMPSONS SQUISHEE", price: 191.99 },
            { product: 1138, gender: 'woman', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/ed13bf4d8aee4e05b648acb800f4e633_9366/Giay_X9000L4_trang_S23672_01_standard.jpg", name: "GOLF ZG21 BOA TOKYO", price: 207.99 },
            { product: 1139, gender: 'woman', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/fe0d214d114a443db365acc3008e5f19_9366/Giay_Golf_Co_Lung_ZG21_Motion_Primegreen_BOA_Xam_FZ2189_01_standard.jpg", name: "ZG21 MOTION PRIMEGREEN BOA", price: 203.99 },
            { product: 1140, gender: 'woman', brand: 'adidas', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/194849/02/sv01/fnd/PNA/fmt/png/RS-DREAMER-2-Basketball-Shoes", name: "RS-DREAMER 2 Basketball Shoes", price: 102.99 },
            { product: 1141, gender: 'woman', brand: 'puma', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/195660/05/sv01/fnd/PNA/fmt/png/Court-Rider-Team-Basketball-Shoes", name: "Court Rider Team Basketball Shoes", price: 109.99 },
            { product: 1142, gender: 'woman', brand: 'puma', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/195684/01/sv01/fnd/PNA/fmt/png/Fusion-Nitro-Spectra-Basketball-Shoes", name: "YEEZY BOOST 350 V2 ANTLIA", price: 117.99 },
            { product: 1143, gender: 'woman', brand: 'puma', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/383524/01/sv01/fnd/PNA/fmt/png/RS-Fast-Tipoff-Sneakers", name: "RS-Fast Tipoff Sneakers", price: 179.99 },
            { product: 1144, gender: 'woman', brand: 'puma', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/366613/06/sv01/fnd/PNA/fmt/png/GV-Special+-Sneakers", name: "GV Special+ Sneakers", price: 164.99 },
            { product: 1145, gender: 'woman', brand: 'puma', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/371808/01/sv01/fnd/PNA/fmt/png/RS-X-Unexpected-Mixes-Women's-Sneakers", name: "RS-X Unexpected Mixes Women's Sneakers", price: 184.99 },
            { product: 1146, gender: 'woman', brand: 'puma', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/381410/01/sv01/fnd/PNA/fmt/png/Suede-Classic-XXI-Women's-Sneakers", name: "Suede Classic XXI Women's Sneakers", price: 192.99 },
            { product: 1147, gender: 'woman', brand: 'puma', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/371202/03/sv01/fnd/PNA/fmt/png/Cali-Sport-Mix-Women's-Sneakers", name: "Cali Sport Mix Women's Sneakers", price: 154.99 },
            { product: 1148, gender: 'woman', brand: 'puma', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/371202/17/sv01/fnd/PNA/fmt/png/Cali-Sport-Mix-Women's-Sneakers", name: "Cali Sport Mix Women's Sneakers", price: 128.99 },
            { product: 1149, gender: 'woman', brand: 'puma', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/191667/02/sv01/fnd/PNA/fmt/png/Defy-Varsity-Mid-Women's-Sneakers", name: "Defy Varsity Mid Women's Sneakers", price: 131.99 },
            { product: 1150, gender: 'woman', brand: 'puma', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/369155/04/sv01/fnd/PNA/fmt/png/Cali-Women's-Sneakers", name: "Cali Women's Sneakers", price: 117.99 },
            { product: 1151, gender: 'woman', brand: 'puma', img: "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/369155/01/sv01/fnd/PNA/fmt/png/Cali-Women's-Sneakers", name: "Cali Women's Sneakers", price: 191.99 },


            { product: 1152, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/c054a94d7491467d8200ad6500ed58f8_9366/Giay_The_Thao_adidas_x_LEGO(r)_DJo_H01503_01_standard.jpg", name: "ADIDAS X LEGO", price: 69.99 },
            { product: 1153, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/862ea6328fd24d2cacf7ad4700fd874e_9366/Giay_Chay_Bo_Quai_Dan_Day_Co_Gian_FortaRun_Mau_xanh_da_troi_GY7599_01_standard.jpg", name: "FORTARUN", price: 77.99 },
            { product: 1154, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/62bd7dd25f334bfd992bad2600aa7d19_9366/Giay_adidas_Forta_Run_x_LEGO(r)_VIDIYOtm_DJen_G57946_01_standard.jpg", name: "FORTA RUN X LEGO® VIDIYO™", price: 59.99 },
            { product: 1155, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/5b5198f70cb04cc8aa92ad1f01272dfa_9366/Giay_adidas_Superstar_x_LEGO(r)_trang_H03957_01_standard.jpg", name: "SUPERSTAR X LEGO®", price: 89.99 },
            { product: 1156, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/5deedf56b82044699316ad2600bc173f_9366/Giay_adidas_RapidaZen_x_LEGO(r)_mau_xanh_la_H05282_01_standard.jpg", name: "ADIDAS RAPIDAZEN X LEGO®", price: 75.99 },
            { product: 1157, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/f74e2bccabf044838a86ad2e00fb53bb_9366/Giay_The_Thao_adidas_x_LEGO(r)_Mau_xanh_da_troi_FZ5440_01_standard.jpg", name: "ADIDAS X LEGO®", price: 51.99 },
            { product: 1158, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/526c5eda6cdb429a8a45ad2400c382e0_9366/Giay_The_Thao_adidas_x_LEGO(r)_Mau_vang_FZ5439_01_standard.jpg", name: "ADIDAS X LEGO®", price: 57.99 },
            { product: 1159, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/50f851bb21044c29a3c1ac7200cbc2b5_9366/Giay_DJa_Bong_Predator_Freak.3_Turf_DJen_FW7533_01_standard.jpg", name: "PREDATOR FREAK.3 TURF", price: 52.99 },
            { product: 1160, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/74789c8ae7114210999cac6400caba08_9366/Giay_chay_bo_EQ21_DJen_FX2254_01_standard.jpg", name: "GIÀY CHẠY BỘ EQ21", price: 67.99 },
            { product: 1161, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/72a92570a1244df28980ad2600c33512_9366/Giay_The_Thao_adidas_x_LEGO(r)_Mau_xanh_da_troi_FZ5437_06_standard.jpg", name: "ADIDAS X LEGO®", price: 57.99 },
            { product: 1162, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/1a7e73da0b7f4035a728ad480156b5ac_9366/Giay_Chay_Bo_EQ21_DJen_H01876_01_standard.jpg", name: "ADIDAS X LEGO®", price: 65.99 },
            { product: 1163, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/ec1032a3aeaa417990c9ad0a01481d2d_9366/Giay_adidas_Superstar_x_LEGO(r)_trang_H03958_01_standard.jpg", name: "ADIDAS SUPERSTAR X LEGO®", price: 69.99 },
            { product: 1164, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/45d0734894d943dda4e1ac5a012e3a75_9366/Giay_Cham_Bi_FortaRun_X_DJen_FY1487_01_standard.jpg", name: "FORTARUN X", price: 56.99 },
            { product: 1165, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/084c6de078aa49de83ecac0800c48129_9366/Giay_Stan_Smith_DJen_FY0969_01_standard.jpg", name: "STAN SMITH", price: 59.99 },
            { product: 1166, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/e7171492c9394bc79552ac5300acb7c3_9366/Giay_chay_bo_EQ21_DJen_FX2248_01_standard.jpg", name: "GIÀY CHẠY BỘ EQ21", price: 67.99 },
            { product: 1167, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/267c6e2d2e69430b8d0aac0800cd5ec1_9366/Giay_Cham_Bi_RapidaZen_trang_FY1663_01_standard.jpg", name: "GIÀY CHẤM BI RAPIDAZEN", price: 63.99 },
            { product: 1168, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/043e55806cf845e4b70fac0800c57f00_9366/Giay_ActiveFlex_Boa_Star_Wars_DJen_FY1241_01_standard.jpg", name: "ACTIVEFLEX BOA STAR WARS", price: 61.99 },
            { product: 1169, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/92db2d70a12d4d8cbf6bac0800cc3b71_9366/Giay_RapidaZen_Mickey_Mouse_trang_FY1246_01_standard.jpg", name: "RAPIDAZEN MICKEY MOUSE", price: 69.99 },
            { product: 1170, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/b4a5abe2d54b4d32bb9bad210092c6e8_9366/Giay_NY_90_trang_H05275_01_standard.jpg", name: "GIÀY NY 90", price: 51.99 },
            { product: 1171, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/be267c0d2b55486f98beacfd01049bfc_9366/Giay_Forum_Low_trang_FY7978_01_standard.jpg", name: "GIÀY ZX 2K BOOST", price: 54.99 },
            { product: 1172, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/e5e4b0ea0f4d497c8854acbf00788a21_9366/Giay_DJa_Bong_San_Co_Nhan_Tao_X_Speedflow.3_DJo_FY3321_01_standard.jpg", name: "GIÀY ĐÁ BÓNG SÂN CỎ NHÂN TẠO X SPEEDFLOW.3", price: 59.99 },
            { product: 1173, gender: 'kid', brand: 'adidas', img: "https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy,c_fill,g_auto/605f5b0528a84ca2b5dbad2b00c4f91f_9366/Giay_Superstar_adidas_x_Kevin_Lyons_trang_H05268_01_standard.jpg", name: "GIÀY SUPERSTAR ADIDAS X KEVIN LYONS", price: 71.99 }
        ];
        // localStorage.setItem('products', JSON.stringify(productarray));
    }
}
