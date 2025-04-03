<div class="group">
    <label for="email">Tên ưu đãi</label><br>
    <input type="text" name="tenuudai" id="tenuudai" onchange="KiemTraUuDai()" value="" required><br>
</div>
<div class="group">
    <label for="thoigianbatdau">Thời gian bắt đầu</label><br>
    <input type="datetime-local" name="thoigianbatdau" id="timestart" step="1" value="" required><br>
</div>
<div class="group">
    <label for="thoigianketthuc">Thời gian kết thúc</label><br>
    <input type="datetime-local" name="thoigianketthuc" step="1" id="timeend" value=""><br>
</div>
<div class="group">
    <label for="dieukien">Điều kiện</label><br>
    <input type="number" name="dieukien" id="dieukien" value="" required><br>
</div>
<div class="group">
    <label for="giatri">Giá trị</label><br>
    <input type="number" name="giatri" id="giatri" value="" required><br>
</div>
<div class="group">
    <label for="donvitinh">Đơn vị tính</label><br>
    <select name="donvitinh" id="donvitinh">
        <option value="VNĐ">VNĐ</option>
        <option value="%">%</option>
    </select>
</div>
<div class="group">
    <label for="mota">Mô tả</label><br>
    <input type="text" name="mota" id="mota" value=""><br>
</div>
<div class="group">
    <label for="diemtichluy">Điểm tích lũy</label><br>
    <input type="number" min="0" name="diemtichluy" id="diemtichluy" value=""><br>
</div>