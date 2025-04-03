<?php
include("../database/data.php");

if ($data->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $data->connect_error);
}

$maNhanVien = $_GET['ma_nhanvien'];
$hoVaTen = $_GET['hovaten'];
$soDienThoai = $_GET['sodienthoai'];
$email = $_GET['email'];
$ngaySinh = $_GET['ngaysinh'];
$gioiTinh = $_GET['gioitinh'];
$chucVu = $_GET['chucvu'];
$luong = $_GET['luong'];


$sql = "SELECT * FROM nhanvien WHERE ma_nhanvien = $maNhanVien";
$result = $data->query($sql);

if ($result->num_rows > 0) {
    
    $sql = "UPDATE nhanvien SET hovaten = '$hoVaTen', sodienthoai = '$soDienThoai', email = '$email', ngaysinh = '$ngaySinh', gioitinh = '$gioiTinh', chucvu = '$chucVu', luong = '$luong' WHERE ma_nhanvien = $maNhanVien";
    
    if ($data->query($sql) === TRUE) {
        echo "Cập nhật nhân viên thành công";
    } else {
        echo "Lỗi cập nhật nhân viên: " . $data->error;
    }
} else {
    $sql = "INSERT INTO nhanvien (hovaten, sodienthoai, email, ngaysinh, gioitinh, chucvu, luong) VALUES ('$hoVaTen', '$soDienThoai', '$email', '$ngaySinh', '$gioiTinh', '$chucVu', '$luong')";

    if ($data->query($sql) === TRUE) {
        echo "Thêm nhân viên thành công";
    } else {
        echo "Lỗi thêm nhân viên: " . $data->error;
    }
}

$data->close();
?>