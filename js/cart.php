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

    let register_form = document.getElementById('register-form');
    register_form.addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData();
        data.append('surname', register_form.elements['surname'].value);
        data.append('name', register_form.elements['name'].value);
        data.append('gender', register_form.elements['gender'].value);
        data.append('email', register_form.elements['email'].value);
        data.append('phonenum', register_form.elements['phonenum'].value);
        data.append('profile', register_form.elements['profile'].value);
        data.append('address', register_form.elements['address'].value);
        data.append('username', register_form.elements['username'].value);
        data.append('pass', register_form.elements['pass'].value);
        data.append('cpass', register_form.elements['cpass'].value);
        data.append('profile', register_form.elements['profile'].files[0]);
        data.append('register', '');

        var myModal = document.getElementById('registerModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            if (this.responseText == "pass_mismatch") {
                alert('error', "Password Mismatch");
            } else if (this.responseText == "email_already") {
                alert('error', "Email is already registered!");
            } else if (this.responseText == "phone_already") {
                alert('error', "Phone number is already registered!");
            } else if (this.responseText == "inv_img") {
                alert('error', "Only JPG,WEPB & PNG images are allowed!");
            } else if (this.responseText == "upd_failed") {
                alert('error', "Image upload failed!");
            } else if (this.responseText == "ins_failed") {
                alert('error', "Registration failed! Server down!");
            } else if (this.responseText == 11) {
                alert('success', "Registration successful. Confirmation link sent to email!")
                register_form.reset();
            }
        }
        xhr.send(data);

    })


    let login_form = document.getElementById('login-form');
    login_form.addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData();
        data.append('email_mob', login_form.elements['email_mob'].value);
        data.append('pass', login_form.elements['pass'].value);
        data.append('login', '');

        var myModal = document.getElementById('loginModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function() {
            if (this.responseText == "inv_email_mob") {
                alert('error', "Invalid Email or Mobile Number!");
            } else if (this.responseText == "inactive") {
                alert('error', "Account Suspended! Please contact Admin.");
            } else if (this.responseText == "invalid_pass") {
                alert('error', "Incorrect Password!");
            } else if (this.responseText == 11) {
                window.location = window.location.pathname;
            }
        }
        xhr.send(data);

    })


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


    let Nouserhoadon_form = document.getElementById('hoadon');
    Nouserhoadon_form.addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData();

        let genderValue=Nouserhoadon_form.elements['nngioitinh'].value;
        let genderText = getVnngioitinh(genderValue);
        let paymentValue=Nouserhoadon_form.elements['pttt'].value;
        let paymentText = getVpttt(paymentValue);


        data.append('surname', Nouserhoadon_form.elements['surname'].value);
        data.append('name', Nouserhoadon_form.elements['name'].value);
        data.append('nnsdt', Nouserhoadon_form.elements['nnsdt'].value);
        data.append('nnmail', Nouserhoadon_form.elements['nnmail'].value);
        data.append('nncity', Nouserhoadon_form.elements['nncity'].value);
        data.append('nndiachi', Nouserhoadon_form.elements['nndiachi'].value);
        data.append('nngioitinh', genderText);
        data.append('nnngaysinh', Nouserhoadon_form.elements['nnngaysinh'].value);
        data.append('pttt', paymentText);
        data.append('note', Nouserhoadon_form.elements['note'].value);;
        data.append('add_billnouser', '');

        var myModal = document.getElementById('checkoutModal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/bill.php", true);

        xhr.onload = function() {
            if (this.responseText == "error") {

            } else if (this.responseText == 1) {
                get_product_cart(<?php $_SESSION['cart_idNoUser'] ?>)
                alert('success', "Registration successful. Confirmation link sent to email!")
                Nouserhoadon_form.reset();
            }
        }
        xhr.send(data);

    })



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