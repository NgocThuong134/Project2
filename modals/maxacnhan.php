<div class="form-group">
    <p id="thongbao-mail"></p>
    <p id="countdown"></p>

    <label for="Dangnhap">Mã xác nhận:</label>
    <input type="text" id="maxacnhan-input" placeholder="Vui lòng nhập mã xác nhận..." oninput="limitInput(this)"
        required>
    <h4 id="thongbao-xacnhan" style="color: red; text-align:center; padding:2px;"></h4>
</div>
<div class="login">
    <button id="xacnhan-button" type="button">Xác nhận</button>
</div>