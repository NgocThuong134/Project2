<?php
    include("../database/data.php");
    $maNV = $_GET['maNV'];
    $sql = "SELECT * FROM nhanvien WHERE ma_nhanvien = $maNV";
    $result = mysqli_query($data, $sql);
    
    if ($result) {
        $rowNV = $result->fetch_assoc();
        echo '
        <div class="group">
            <label for="ma_nhanvien">Mã nhân viên</label><br>
            <input type="text" name="ma_nhanvien" readonly id="ma_nhanvien" value="' . $rowNV['ma_nhanvien'] . '"><br>
        </div>
        <div class="group">
            <label for="email">Email</label><br>
            <input type="text" name="email" id="email" value="' . $rowNV['email'] . '" required><br>
        </div>
        <div class="group">
            <label for="hovaten">Họ và tên</label><br>
            <input type="text" name="hovaten" id="hovaten" value="' . $rowNV['hovaten'] . '" required><br>
        </div>
        <div class="group">
            <label for="ngaysinh">Ngày sinh</label><br>
            <input type="date" name="ngaysinh" id="ngaysinh" value="' . $rowNV['ngaysinh'] . '"><br>
        </div>
        <div class="group">
            <label for="gioitinh">Giới tính</label><br>
            <select name="gioitinh" id="gioitinh">
                <option value="0" ';  if ($rowNV['gioitinh'] == 0) echo 'selected';  echo '>Nữ</option>
                <option value="1" '; if ($rowNV['gioitinh'] == 1) echo 'selected'; echo '>Nam</option>
            </select>
        </div>
        <div class="group">
            <label for="sodienthoai">Số điện thoại</label><br>
            <input type="text" name="sodienthoai" id="sodienthoai" value="' . $rowNV['sodienthoai'] . '" required><br>
        </div>
        <div class="group">
            <label for="chucvu">Chức vụ</label><br>
            <input type="text" name="chucvu" id="chucvu" value="' . $rowNV['chucvu'] . '" required><br>
        </div>
        <div class="group">
            <label for="luong">Lương</label><br>
            <input type="number" name="luong" id="luong" value="' . $rowNV['luong'] . '" required><br>
        </div>';
    }
    
    $data->close();
?>