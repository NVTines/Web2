<!-- <form action="xuly.php" method="get" onsubmit="layttHD()" id="hoadon" style="position:fixed;background-color:whitesmoke;z-index: -1;opacity:0;height:100%;width:500px;border:solid black 2px">
    <a href="#" onclick="outHD();"><input type="button" style="padding:0 3px;float: right;font-size:30px;background: #FFFFFF;border: #FFFFFF;cursor: pointer" class="material-icons" value="backspace"></a>
    <h1 style="text-align: center;margin-bottom:10px"><i>Payment Form</i></h1>

    <table>
        <tr>
            <td>Name</td>
            <td>
                <input id="nnhoten" style="width:300px; height:20px;" type="text" placeholder="" name="" />
            </td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>
                <input id="nnsdt" style="width:300px; height:20px;" type="phone" placeholder="" />
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input id="nnmail" style="width:300px; height:20px;" type="email" placeholder="" />
            </td>
        </tr>
        <tr>
            <td>Province-City</td>
            <td>
                <input id="nncity" style="width:300px; height:20px;" type="" placeholder="" />
            </td>
        </tr>
        <tr>
            <td>Address</td>
            <td>
                <input id="nndiachi" style="width:300px; height:20px;" type="address" placeholder="" />
            </td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>
                <select id="nngioitinh">
                    <option value='' selected>Select gender</option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                    <option value="2">Prefer Not to Say</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Date of Birth</td>
            <td>
                <input id="nnngaysinh" style="width:300px; height:20px;" type="date" />
            </td>
        </tr>
        <tr>
            <td>Payments</td>
            <td>
                <select id="pttt">
                    <option selected value="">Select Option</option>
                    <option value="1">VisaCard</option>
                    <option value="2">Paypal</option>
                    <option value="3">Internet Banking</option>
                    <option value="4">Cash</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Note</td>
            <td>
                <textarea id="note" rows="2" col="17" placeholder=""></textarea>
            </td>
        </tr>
        <tr>
            <td style="text-align: center">
                <a style="color: white;background: #ff523b;padding: 10px;font-weight: bold;cursor: pointer;margin: 20px;border-radius: 20px;" onclick="layttHD()">
                    Submit
                </a>
            </td>

            <td style="text-align: center">
                <a style="
            color: white;
            background: #ff523b;
            padding: 10px;
            font-weight: bold;
            cursor: pointer;
            margin: 20px;
            border-radius: 20px;
            " onclick="reset()">
                    Reset
                </a>
            </td>
        </tr>
    </table>
</form> -->


<div class="small-container">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="table-responsive-md" style="height:300px; overflow-y:scroll; width: 100%;">
                <table class="table table-hover border text-cennter">
                    <thead class="">
                        <tr class="bg-dark text-light">
                            <th scope="col">Image</th>
                            <th scope="col">ProductName</th>
                            <th scope="col">Size</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Color</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="cart-data">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card m-4" style="width:35%; float:right;">
        <div class="card-header">
            Thanh Toán Đơn Hàng
        </div>
        <table class="table table-hover text-cennter">
            <tbody id="totalHoaDon">
                <tr>
                    <td>Subtotal</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>10%</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <button type="button" onclick="hienHD()" class='btn btn-sm text-white custom-bg shadow-none' style="background: #ff523b;">Thanh
            Toán</button>
    </div>

    <form action="xuly.php" method="get" onsubmit="layttHD()" id="hoadon" style="position:fixed;background-color:whitesmoke; top: 20%;z-index: -1;opacity:0;height:100%;width:500px;border:solid black 2px">
        <a href="#" onclick="outHD();"><input type="button" style="padding:0 3px;float: right;font-size:30px;background: #FFFFFF;border: #FFFFFF;cursor: pointer" class="material-icons" value="backspace"></a>
        <h1 style="text-align: center;margin-bottom:10px"><i>Payment Form</i></h1>

        <table>
            <tr>
                <td>Name</td>
                <td>
                    <input id="nnhoten" style="width:300px; height:30px;" type="text" placeholder="" name="" />
                </td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td>
                    <input id="nnsdt" style="width:300px; height:30px;" type="phone" placeholder="" />
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input id="nnmail" style="width:300px; height:30px;" type="email" placeholder="" />
                </td>
            </tr>
            <tr>
                <td>Province-City</td>
                <td>
                    <input id="nncity" style="width:300px; height:30px;" type="" placeholder="" />
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    <input id="nndiachi" style="width:300px; height:30px;" type="address" placeholder="" />
                </td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <select id="nngioitinh">
                        <option value='' selected>Select gender</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                        <option value="2">Prefer Not to Say</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td>
                    <input id="nnngaysinh" style="width:300px; height:30px;" type="date" />
                </td>
            </tr>
            <tr>
                <td>Payments</td>
                <td>
                    <select id="pttt">
                        <option selected value="">Select Option</option>
                        <option value="1">VisaCard</option>
                        <option value="2">Paypal</option>
                        <option value="3">Internet Banking</option>
                        <option value="4">Cash</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Note</td>
                <td>
                    <textarea id="note" rows="2" col="17" placeholder=""></textarea>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <a style="color: white;background: #ff523b;padding: 10px;font-weight: bold;cursor: pointer;margin: 20px;border-radius: 20px;" onclick="layttHD()">
                        Submit
                    </a>
                </td>

                <td style="text-align: center">
                    <a style="
            color: white;
            background: #ff523b;
            padding: 10px;
            font-weight: bold;
            cursor: pointer;
            margin: 20px;
            border-radius: 20px;
            " onclick="reset()">
                        Reset
                    </a>
                </td>
            </tr>
        </table>
    </form>





    <!-- <div style="margin-right: 40px;">
        <div class="total-price">
            <table id="totalHoaDon">
                <tr>
                    <td>Subtotal</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>10%</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="check">
            <table>
                <tr>
                    <td><a href="#" onclick="reloadHD()" style="color: white;background: #ff523b;padding: 10px;font-weight: bold;cursor: pointer;margin: 20px; text-decoration: none;">BACK</a></td>
                    <td style="text-align: center">
                        <a href="#" onclick="hienHD()" style="color: white;background: #ff523b;padding: 10px;font-weight: bold;cursor: pointer;margin: 20px; text-decoration: none;">
                            Proceed to checkout
                        </a>
                    </td>
                    <td><a href="#" onclick="bill()" style="color: white;background: #ff523b;padding: 10px;font-weight: bold;cursor: pointer;margin: 20px; text-decoration: none;">EXIT &#10004;</a></td>
                </tr>
            </table>
        </div>
    </div> -->


    <!-- <table id="dssp">
        <tr>
            <th>Product</th>
            <th>ID Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        <tr>
            <td>
                <div class="cart-info">
                    <img style="width:100px;height:100px" src="" alt="" />
                    <div style="font-size:23px">
                        <p></p><small></small><br /><a href="#" style="font-size:19px">Remove</a>
                    </div>
                </div>
            </td>
            <td></td>
            <td><input readOnly=true value="" /></td>
            <td></td>
        </tr>
    </table>
    
    <div class="total-price">
            <table id="totalHoaDon">
                <tr>
                    <td>Subtotal</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>10%</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="check">
            <table>
                <tr>
                    <td><a href="#" onclick="reloadHD()" style="color: white;background: #ff523b;padding: 10px;font-weight: bold;cursor: pointer;margin: 20px;">BACK</a></td>
                    <td style="text-align: center">
                        <a href="#" onclick="hienHD()" style="color: white;background: #ff523b;padding: 10px;font-weight: bold;cursor: pointer;margin: 20px;">
                            Proceed to checkout
                        </a>
                    </td>
                    <td><a href="#" onclick="bill()" style="color: white;background: #ff523b;padding: 10px;font-weight: bold;cursor: pointer;margin: 20px;">EXIT &#10004;</a></td>
                </tr>
            </table>
        </div> -->

</div>