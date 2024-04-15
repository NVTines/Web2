<script>
    function resetSupForm(){
        document.getElementsByClassName("sup-create-input")[0].value="";
        document.getElementsByClassName("sup-create-input")[1].value="";
        document.getElementsByClassName("sup-create-input")[2].value="";
        document.getElementsByClassName("sup-create-input")[3].value="";
    }
</script>
<div class="col-div-8" style="margin:20px 0px;">
    <div class="box-8">
        <div class="manage-name-btn" onclick="invinbox()">&#9776;QUẢN LÝ NHÀ CUNG CẤP</div>
        <a href="admin.php?key=ncc" id="back-btn-supplier">QUAY LẠI</a>
    </div>
</div>
<div class="col-div-8">
    <div class="box-8" style="display:flex;justify-content:center; width:50%;">
        <form id="supplier-create-form" method="POST" action="functions/processAddSup.php">
            <div><h1>THÔNG TIN NHÀ CUNG CẤP</h1></div>
            <div id="sup-input-wrapper" style="margin-left:25%;margin-right:25%;margin-top:100px;">
                <div class="sup-input">
                    <label class="sup-create-label">Tên:</label>
                    <input name="name" class="sup-create-input" placeholder="...." />
                </div>
                <div class="sup-input">
                    <label class="sup-create-label">Địa chỉ:</label>
                    <input name="address" class="sup-create-input" placeholder="...." />
                </div>
                <div class="sup-input">
                    <label class="sup-create-label">SĐT:</label>
                    <input name="phone" class="sup-create-input" placeholder="...." />
                </div>
                <div class="sup-input">
                    <label class="sup-create-label">Fax:</label>
                    <input name="fax" class="sup-create-input" placeholder="...."/>
                </div>
                <div class="sup-btn">
                    <a type="submit" id="sup-submit-btn">Xác nhận</a> 
                    <a onclick="resetSupForm()" id="sup-reset-btn">Refresh</a> 
                </div>        
            </div>  
            
        </form>
    </div>
</div>
