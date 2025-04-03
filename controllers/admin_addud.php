<?php
include("../database/data.php");

if ($data->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $data->connect_error);
}

$maUuDai = $_GET['ma_uudai'];
$tenUuDai = $_GET['ten_uudai'];
$timestart = $_GET['thoigianbatdau'];
$timeend = $_GET['thoigianketthuc'];
$dieukien = $_GET['dieukien'];
$giatri = $_GET['giatri'];
$donvitinh = $_GET['donvitinh'];
$mota = $_GET['mota'];
$diemtichluy = $_GET['diemtichluy'];

$sql = "SELECT * FROM uudai WHERE ma_uudai = $maUuDai";
$result = $data->query($sql);

if ($result->num_rows > 0) {
    $sql = "UPDATE uudai SET tenuudai = '$tenUuDai', thoigianbatdau = '$timestart', thoigianketthuc = '$timeend', dieukien = '$dieukien', giatri = '$giatri', donvitinh = '$donvitinh', mota = '$mota', diemtichluy = '$diemtichluy' WHERE ma_uudai = $maUuDai";

    if ($data->query($sql) === TRUE) {
        echo "Cập nhật thông tin ưu đãi thành công";
    } else {
        echo "Lỗi cập nhật thông tin ưu đãi: " . $data->error;
    }
} else {
    $sql = "INSERT INTO uudai (tenuudai, thoigianbatdau, thoigianketthuc, dieukien, giatri, donvitinh, mota, diemtichluy) VALUES ('$tenUuDai', '$timestart', '$timeend', '$dieukien', '$giatri', '$donvitinh', '$mota', '$diemtichluy')";

    if ($data->query($sql) === TRUE) {
        echo "Thêm ưu đãi thành công";
    } else {
        echo "Lỗi thêm ưu đãi: " . $data->error;
    }
}

$data->close();
?>