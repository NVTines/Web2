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

    function remove_bill(bill_id, bill_status) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "pages/functions/bill.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.responseText == 1) {
                alertCustom('success', 'Hủy đơn thành công!');
                setTimeout(function() {
                    location.reload();
                }, 2000);
            } else {
                alertCustom('danger', 'Server lỗi!');
            }
        }
        xhr.send('remove_bill' + '&bill_id=' + bill_id + '&bill_status=' + bill_status);
    }
</script>