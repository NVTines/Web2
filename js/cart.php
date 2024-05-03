<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function alertCustom(type, msg, position = 'body') {
        console.log(msg)
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
                <strong class="me-3">${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> 
        `;
        if (position == 'body') {
            document.body.append(element);
            element.classList.add('custom-alert');
        } else {
            document.getElementById(position).appendChild(element);
        }
        setTimeout(remAlert, 2000);
    }

    function remAlert() {
        document.getElementsByClassName('alert')[0].remove();
    }

    function checkLoginToCart(product_id, user_id) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "pages/functions/addToCart.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.responseText == 1) {
                // alertCustom('success', 'Cart Added!', 'cart-alert');
                console.log(this.responseText);
                //get_product_cart(user_id);
            } else {
                // alertCustom('error', 'Add cart failed!', 'cart-alert');
                console.log(this.responseText);
            }
        }
        xhr.send('add_cart&product_id=' + product_id + '&user_id=' + user_id);
    }


    let userhoadon_form = document.getElementById('hoadon');
    userhoadon_form.addEventListener('submit', (e) => {
        e.preventDefault();
        if (userhoadon_form.elements['pttt'].value == 0) {
            alertCustom('warning', "Chưa chọn phương thức thanh toán");

        } else if (userhoadon_form.elements['delivery'].value == '') {
            alertCustom('warning', "Mời nhập địa chỉ giao hàng");
        } else {
            let data = new FormData();
            let paymentValue = userhoadon_form.elements['pttt'].value;
            let paymentText = getVpttt(paymentValue);
            data.append('pttt', paymentText);
            data.append('delivery', userhoadon_form.elements['delivery'].value);;
            data.append('note', userhoadon_form.elements['note'].value);;
            data.append('add_bill', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "pages/functions/bill.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById('checkoutModal');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                if (this.responseText == "GHR") {
                    alertCustom('warning', "Giỏ hàng rỗng!");
                } else if (this.responseText == 1) {
                    userhoadon_form.reset();
                    alertCustom('success', "Đơn hàng đã được đặt!");
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else if (this.responseText == "Server Down!") {
                    alertCustom('danger', "Server lỗi!");
                }
            }
            xhr.send(data);
        }

    })

    function getVpttt(value) {
        switch (value) {
            case '1':
                return 'VisaCard';
            case '2':
                return 'Paypal';
            case '3':
                return 'Internet Banking';
            case '4':
                return 'Cash';
            default:
                return '';
        }
    }


    function get_product_cart(cart_id) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "pages/functions/addToCart.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
        let response = JSON.parse(this.responseText);
        document.getElementById('cart-data').innerHTML = response.cartData;
        document.getElementById('thanhtoan').innerHTML = response.thanhtoan;
        }
        xhr.send('get_product_cart' + '&cart_id=' + cart_id);
    }

    window.onload = function() {
        get_product_cart(<?php echo isset($_SESSION['cart_idUser']) ? $_SESSION['cart_idUser'] : -1 ?>);
    }

    function remove_product(product_id, cartID, sizeID) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "pages/functions/addToCart.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.responseText == 1) {
                alertCustom('success', 'Xóa Thành Công!');
                get_product_cart(cartID);
            } else {
                alertCustom('danger', 'Server lỗi!');
            }
        }
        xhr.send('remove_product' + '&product_id=' + product_id + '&cart_id=' + cartID + '&size_id='+sizeID);
    }

    function setQuantityPlus(cartID, product_id,max_quantity,sizeID) {
        let quantity = document.getElementById('quantity' + product_id + sizeID).value;
        quantity = parseInt(quantity);
        if(max_quantity < quantity +1){
            alertCustom('danger', 'Không đủ số lượng hàng');
        }
        else {
            quantity = quantity + 1;
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "pages/functions/addToCart.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.responseText == 1) {
                    alertCustom('success', 'Câp nhật thành công!');
                    get_product_cart(cartID);
                } else {
                    alertCustom('danger', 'Server lỗi!');
                }
            }
            xhr.send('update_quantity' + '&product_id=' + product_id + '&quantity=' + quantity +'&size_id='+sizeID);
        }
    }

    function setQuantityMinus(cartID, product_id, sizeID) {
        let quantity = document.getElementById('quantity' + product_id +sizeID).value;
        quantity = parseInt(quantity);

        if (quantity > 0) {
            quantity = quantity - 1;
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "pages/functions/addToCart.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.responseText == 1) {
                    alertCustom('success', 'Câp nhật thành công!');
                    get_product_cart(cartID);
                } else {
                    alertCustom('danger', 'Server lỗi!');
                }
            }
            xhr.send('update_quantity' + '&product_id=' + product_id + '&quantity=' + quantity +'&size_id='+sizeID);
        }
    }
</script>