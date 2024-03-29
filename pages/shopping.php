<div style="margin-bottom: 60px;padding-top: 50px">
    <div><a href="index.php" style="float: left;padding-left: 100px;padding-top:10px;padding-right:10px;padding-bottom:10px;font-size:30px;" id="home-btn" class="home-btn"><b>HOME</b></a></div>
</div>
<div style="padding: 83px;">
    <div id="menu"><b>
            <div><a href="content.html?1" onclick="resetall()" style="float: left;padding-left: 50px;">ALL</a></div>
            <div><a href="#" style="float: left;padding-left: 50px;" onclick="brand('adidas')">ADIDAS</a></div>
            <div><a href="#" style="float: left;padding-left: 50px;" onclick="brand('nike')">NIKE</a></div>
            <div><a href="#" style="float: left;padding-left: 50px;" onclick="brand('puma')">PUMA</a></div>
            <div id="gdr" style="float:right;margin-right:20px">GENDER:<select id="slt2" onchange="searchF('slt2')">
                    <option value="" selected>ALL</option>
                    <option value="male">MALE</option>
                    <option value="female">FEMALE</option>
                    <option value="kid">KID</option>
                </select></div>
            <div id="brd" style="float:right;margin-right:20px">BRAND:<select id="slt1" onchange="searchF('slt1')">
                    <option value="" selected>ALL</option>
                    <option value="ad">ADIDAS</option>
                    <option value="ni">NIKE</option>
                    <option value="pu">PUMA</option>
                </select></div>
            <div id="pri" style="float:right;margin-right:20px">PRICE:<select id="slt3" onchange="searchF('slt3')">
                    <option value="" selected>ALL</option>
                    <option value="110">x110 $</option>
                    <option value="110200">110 ~ 200 $</option>
                    <option value="200">>200 $</option>
                </select></div>
        </b>
    </div>
    <div id="around">
        <div id="ndu">
        </div>
    </div>
</div>
<form id="trang" style="clear: both;padding-bottom: 30px;margin-bottom:20px;text-align: center">

</form>