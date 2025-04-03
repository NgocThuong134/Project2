<?php

if (isset($_SESSION["tendangnhap"])) {
    $tendangnhap = $_SESSION['tendangnhap'];
    $sql = "SELECT * FROM khachhang WHERE email = '$tendangnhap'";
    $result = executeQuery($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
<h2>Thông tin đơn hàng</h2>
<form class="form-muahang">
    <div class="form-group">
        <label for="">Họ và tên <span>(*)</span></label>
        <input type="text" name="fullname" id="fullname" value="<?php echo htmlspecialchars($row['hovaten']); ?>"
            required>
    </div>
    <div class="form-group">
        <label for="">Số điện thoại <span>(*)</span></label>
        <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($row['sodienthoai']); ?>"
            required>
    </div>
    <div class="form-group">
        <label for="">Địa chỉ <span>(*)</span></label>
        <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($row['diachi']); ?>" required>
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($row['email']); ?>">
    </div>
    <div class="form-group">
        <label for="">Chú thích</label>
        <textarea name="note" id="note" cols="10" rows="7" placeholder="Ghi chú thích nếu có..."></textarea>
    </div>
    <span style="color: red;">(*) Bắt buộc</span>
    <div class="hinhthucthanhtoan">
        <button type="submit" onclick="thongtin()" style="border: none;" class="thanhtoan nhanhang">Thanh toán khi nhận
            hàng</button>
        <button type="submit" style="border: none;" class="thanhtoan nganhang">Thanh toán qua ngân hàng</button>
    </div>
</form>
<?php
    }
} else {
    ?>
<h2>Thông tin đơn hàng</h2>
<form class="form-muahang">
    <div class="form-group">
        <label for="">Họ và tên <span>(*)</span></label>
        <input type="text" name="fullname" id="fullname" required>
    </div>
    <div class="form-group">
        <label for="">Số điện thoại <span>(*)</span></label>
        <input type="text" name="phone" id="phone" required>
    </div>
    <div class="form-group">
        <label for="">Địa chỉ <span>(*)</span></label>
        <input type="text" name="address" id="address" required>
    </div>
    <div class="form-group">
        <label for="">Email <span>(*)</span></label>
        <input type="email" name="email" id="email" required>
    </div>
    <div class="form-group">
        <label for="">Chú thích</label>
        <textarea name="note" id="note" cols="10" rows="7" placeholder="Ghi chú thích nếu có..."></textarea>
    </div>
    <span style="color: red;">(*) Bắt buộc</span>
    <div class="hinhthucthanhtoan">
        <button type="submit" onclick="thongtin()" style="border: none;" class="thanhtoan nhanhang">Thanh toán khi nhận
            hàng</button>
        <button type="submit" style="border: none;" class="thanhtoan nganhang">Thanh toán qua ngân hàng</button>
    </div>
</form>
<?php
}
?>