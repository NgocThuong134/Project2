<div class="group">
    <label for="ten_sanpham">Tên khách hàng</label><br>
    <input type="text" name="hovaten" id="hovaten" value="" required><br>
</div>
<div class="group">
    <label for="soluong">Số điện thoại</label><br>
    <input type="text" name="sodienthoai" id="sodienthoai" required><br>
</div>
<div class="group">
    <label for="emai">Email</label><br>
    <input type="text" name="email" id="email" required><br>
</div>
<div class="group">
    <label for="giaban">Ngày sinh</label><br>
    <input type="date" name="ngaysinh" id="ngaysinh" required><br>
</div>
<div class="group">
    <label for="giaban">Giới tính</label><br>
    <select name="giotinh" id="giotinh">
        <option value="0">Nữ</option>
        <option value="1">Nam</option>
    </select>
</div>
<div class="group">
    <label for="donvitinh">Địa chỉ</label><br>
    <input type="text" name="donvitinh" id="diachi"><br>
</div>
<div class="group">
    <label for="giaban">Điểm tích lũy</label><br>
    <input type="number" name="diemtichluy" id="diemtichluy" value="0" min="0" required><br>
</div>
<div class="anhsp">
    <label for="anhsp">Ảnh đại diện</label><br>
    <div class="taianh" onclick="selectFile()">
        <i id="upload-icon" class="bx bxs-cloud-upload"></i>
        <p id="label-anhsp">
        </p>
        <input type="file" name="anhsp" id="anhsp" accept="image/*" onchange="displayImage(event)" hidden>
    </div>
    <span id="image-container">
    </span>
</div>