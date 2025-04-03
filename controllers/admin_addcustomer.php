<?php
include("../database/data.php");

if ($data->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $data->connect_error);
}

$maKhachHang = $_GET['ma_khachhang'];
$hoVaTen = $_GET['hovaten'];
$soDienThoai = $_GET['sodienthoai'];
$email = $_GET['email'];
$ngaySinh = $_GET['ngaysinh'];
$gioiTinh = $_GET['giotinh'];
$diaChi = $_GET['diachi'];
$diemTichLuy = $_GET['diemtichluy'];
if (isset($_GET['anhsp']))
    $anh = $_GET['anhsp'];
else $anh = "";

$sql = "SELECT * FROM khachhang WHERE ma_khachhang = $maKhachHang";
$result = $data->query($sql);

if ($result->num_rows > 0) {
    if ($anh != "") {
    $sql = "UPDATE khachhang SET hovaten = '$hoVaTen', sodienthoai = '$soDienThoai', email = '$email', ngaysinh = '$ngaySinh', gioitinh = '$gioiTinh', diachi = '$diaChi', diemtichluy = '$diemTichLuy', anhdaidien = '$anh' WHERE ma_khachhang = $maKhachHang";
    }
    else {
        $sql = "UPDATE khachhang SET hovaten = '$hoVaTen', sodienthoai = '$soDienThoai', email = '$email', ngaysinh = '$ngaySinh', gioitinh = '$gioiTinh', diachi = '$diaChi', diemtichluy = '$diemTichLuy' WHERE ma_khachhang = $maKhachHang";
    }
    if ($data->query($sql) === TRUE) {
        echo "Cập nhật khách hàng thành công";
    } else {
        echo "Lỗi cập nhật khách hàng: " . $data->error;
    }
} else {
    if ($anh != ""){
    $sql = "INSERT INTO khachhang (hovaten, sodienthoai, email, ngaysinh, gioitinh, diachi, diemtichluy,anhdaidien) VALUES ('$hoVaTen', '$soDienThoai', '$email', '$ngaySinh', '$gioiTinh', '$diaChi', '$diemTichLuy','$anh')";
    }
    else {
        $sql = "INSERT INTO khachhang (hovaten, sodienthoai, email, ngaysinh, gioitinh, diachi, diemtichluy) VALUES ('$hoVaTen', '$soDienThoai', '$email', '$ngaySinh', '$gioiTinh', '$diaChi', '$diemTichLuy')";
    }
    if ($data->query($sql) === TRUE) {
        echo "Thêm khách hàng thành công";
    } else {
        echo "Lỗi thêm khách hàng: " . $data->error;
    }
}

$data->close();
?>