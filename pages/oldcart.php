<form action="xuly.php" method="get" onsubmit="layttHD()" id="hoadon" style="position:fixed;background-color:whitesmoke;z-index: -1;opacity:0;height:100%;width:500px;border:solid black 2px">
    <a href="#" onclick="outHD();"><input type="button" style="padding:0 3px;float: right;font-size:30px;background: #FFFFFF;border: #FFFFFF;cursor: pointer" class="material-icons" value="backspace"></a>
    <h1 style="text-align: center;margin-bottom:50px"><i>Payment Form</i></h1>

    <table>
        <tr>
            <td>Name</td>
            <td>
                <input id="nnhoten" style="width:300px" type="text" placeholder="" name="" />
            </td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td>
                <input id="nnsdt" style="width:300px" type="phone" placeholder="" />
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input id="nnmail" style="width:300px" type="email" placeholder="" />
            </td>
        </tr>
        <tr>
            <td>Province-City</td>
            <td>
                <input id="nncity" style="width:300px" type="" placeholder="" />
            </td>
        </tr>
        <tr>
            <td>Address</td>
            <td>
                <input id="nndiachi" style="width:300px" type="address" placeholder="" />
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
                <input id="nnngaysinh" style="width:300px" type="date" />
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
                <textarea id="note" rows="5" col="17" placeholder=""></textarea>
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
<div class="small-container">
    <table id="dssp">
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
                        PROCEED TO CHECKOUT
                    </a>
                </td>
                <td><a href="#" onclick="bill()" style="color: white;background: #ff523b;padding: 10px;font-weight: bold;cursor: pointer;margin: 20px;">VIEW &#10004;</a></td>
            </tr>
        </table>
    </div>
</div>