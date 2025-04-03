<section>
    <div class="form-group">
        <label for="Dangnhap">Họ và tên <span>(*)</span></label>
        <input type="text" name="tendangnhap" id="ten" required>
    </div>
    <div class="form-group">
        <label for="gioitinh">Giới tính</label>
        <div class="radio-group">
            <input type="radio" name="gioitinh" id="nam" value="0">
            <label for="nam">Nam</label>
            <input type="radio" name="gioitinh" id="nu" value="1">
            <label for="nu">Nữ</label>
        </div>
    </div>
    <div class="form-group">
        <label for="ngaysinh">Ngày sinh</label>
        <input type="date" name="ngaysinh" id="date">
    </div>
    <div class="form-group">
        <label for="ngaysinh">Số điện thoại <span>(*)</span></label>
        <input type="text" name="sodienthoai" id="phone" required>
        <span class="err-sdt hide">Số điện thoại không hợp lệ!</span>
    </div>
    <div class="form-group">
        <label for="diachi">Địa chỉ <span>(*)</span></label>
        <input type="text" name="diachi" id="address" required>
    </div>
</section>
<section>
    <div class="form-group">
        <label for="ngaysinh">Email <span>(*)</span></label>
        <input type="email" name="email" id="email" required>
    </div>
    <div class="form-group">
        <label for="">Mật khẩu <span>(*)</span></label>
        <input type="password" name="password" id="password" required>
        <span class="err-pw hide">Mật khẩu không hợp lệ!</span>
    </div>
    <div class="form-group">
        <label for="">Xác nhận lại mật khẩu <span>(*)</span></label>
        <input type="password" name="repassword" id="repassword" required>
        <span class="err-rpw hide">Mật khẩu không khớp!</span>
    </div>
    <div class="form-group anhsp">
        <label for="anhsp">Ảnh đại diện</label>
        <div class="taianh" onclick="selectFile()">
            <i id="upload-icon" class='bx bxs-cloud-upload'></i>
            <p id="label-anhsp">Tải ảnh lên</p>
            <input type="file" name="avatar" id="avatar" accept="image/*" onchange="displayImage(event)" hidden>
        </div>
        <span id="image-container"></span>
    </div>
</section>
<section>
    <span> (*) Bắt buộc</span>
    <div class="login">
        <button type="submit" id="registerButton" onclick="Kiemtra()" style="background-color: #1877F2;">Đăng
            ký</button>
    </div>
</section>
<section></section>
<script>
function selectFile() {
    document.getElementById('avatar').click();
}

function displayImage(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        var img = document.createElement('img');
        img.src = e.target.result;

        var imageContainer = document.getElementById('image-container');
        imageContainer.appendChild(img);

        var label = document.getElementById('label-anhsp');
        label.textContent = file.name;

        var uploadIcon = document.getElementById('upload-icon');
        uploadIcon.style.display = 'none';
    }
    reader.readAsDataURL(file);
}

function Kiemtra() {
    var sodienthoai = document.getElementById('phone').value;

    if (!/^0\d{9,11}$/.test(sodienthoai)) {
        var errorElement = document.querySelector('.err-sdt');
        errorElement.classList.remove('hide');
    } else {
        var errorElement = document.querySelector('.err-sdt');
        errorElement.classList.add('hide');
    }
    var password = document.getElementById('password').value;

    if (!validatePassword(password)) {
        var errorElement = document.querySelector('.err-pw');
        errorElement.classList.remove('hide');
    } else {
        var errorElement = document.querySelector('.err-pw');
        errorElement.classList.add('hide');
    }
    var repassword = document.getElementById('repassword').value;

    if (password !== repassword) {
        var errorElement = document.querySelector('.err-rpw');
        errorElement.classList.remove('hide');
    } else {
        var errorElement = document.querySelector('.err-rpw');
        errorElement.classList.remove('hide');
    }
};

function validatePassword(password) {
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z\d!?@#$%^&*]{8,}$/;
    return passwordRegex.test(password);
}
</script>