<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function alert(type, msg, position = 'body') {
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

    let uId = "";

    function setActive() {
        let navbar = document.getElementById('dashboard-menu');
        let a_tags = navbar.getElementsByTagName('a');

        for (i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop(); // example.php
            let file_name = file.split('.')[0];

            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }

    function setActive() {
        let navbar = document.getElementById('navbar');
        let a_tags = navbar.getElementsByTagName('a');

        for (i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop(); // example.php
            let file_name = file.split('.')[0];

            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }

    function checkLoginToCart(product_id, user_id) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/cart.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.responseText == 1) {
                // alert('success', 'Cart Added!', 'cart-alert');
                console.log(this.responseText);
                //get_product_cart(user_id);
            } else {
                // alert('error', 'Add cart failed!', 'cart-alert');
                console.log(this.responseText);
            }
        }
        xhr.send('add_cart&product_id=' + product_id + '&user_id=' + user_id);
    }

    function checkNoLoginToCart(product_id) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/cart.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.responseText == 1) {
                // alert('success', 'Cart Added!', 'cart-alert');
                console.log(this.responseText);
                //get_product_cart(user_id);
            } else {
                // alert('error', 'Add cart failed!', 'cart-alert');
                console.log(this.responseText);
            }
        }
        xhr.send('add_cart_nouser&product_id=' + product_id);
    }

    // function checkCart(product_id) {

    //         let xhr = new XMLHttpRequest();
    //         xhr.open("POST", "ajax/cart.php", true);
    //         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //         xhr.onload = function() {
    //             if (this.responseText == 1) {
    //                 // alert('success', 'Cart Added!', 'cart-alert');
    //                 console.log(this.responseText);
    //                 //get_product_cart(user_id);
    //             } else {
    //                 // alert('error', 'Add cart failed!', 'cart-alert');
    //                 console.log(this.responseText);
    //             }
    //         }
    //         xhr.send('add_cart&product_id=' + product_id + '&user_id=' + -1);
    // }

    function checkLoginToBill(status, user_id) {
        if (status) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/bill.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.responseText == 1) {
                    // alert('success', 'Cart Added!', 'cart-alert');
                    console.log(this.responseText);
                    get_product_cart(user_id);
                } else {
                    // alert('error', 'Add cart failed!', 'cart-alert');
                    console.log(this.responseText);
                }
            }
            xhr.send('add_bill' + '&user_id=' + user_id);
        } else {
            alert('error', 'Please login to book room!');
        }
    }



    function getVnngioitinh(value) {
        switch (value) {
            case '0':
                return 'Male';
            case '1':
                return 'Female';
            case '2':
                return 'Prefer Not to Say';
            default:
                return '';
        }
    }


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
        xhr.open("POST", "ajax/cart.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            let response = JSON.parse(this.responseText);
            document.getElementById('cart-data').innerHTML = response.data;
            document.getElementById('thanhtoan').innerHTML = response.thanhtoan;
        }
        xhr.send('get_product_cart' + '&cart_id=' + cart_id);
    }

    setActive();
    window.onload = function() {
        get_product_cart(<?php echo isset($_SESSION['cart_idUser']) ? $_SESSION['cart_idUser'] : $_SESSION['cart_idNoUser'] ?>);
    }
</script>