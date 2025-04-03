<?php
session_start();
$maUudai = $_GET['maUd'];
$tongtien = $_GET['tongtien'];
$tongtien = intval($tongtien); 
include("../database/data.php");
if ($data->connect_error) {
    die(json_encode(['error' => 'Failed to connect to database']));
}
$sql = "SELECT * FROM uudai WHERE BINARY tenuudai = '$maUudai'";
$result = $data->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $mota = $row['mota'];
    $dieukien = $row['dieukien'];
    $giatri = $row['giatri'];
    $donvitinh = $row['donvitinh'];
    $thoigianketthuc = $row['thoigianketthuc'];
    $thoigianbatdau = $row['thoigianbatdau'];
    $now = date("Y-m-d H:i:s");
    if ($thoigianbatdau > $now) {
        unset($_SESSION['uudai']); 
        echo json_encode(['error' => 'Thời gian chưa đến.']);
    } elseif ($thoigianketthuc > $now) {
        if ($tongtien >= $dieukien) {
            if ($donvitinh === 'VNĐ') {
                $giamGia = $giatri;
            } elseif ($donvitinh === '%') {
                $giamGia = $tongtien * ($giatri / 100);
            } 
            $_SESSION['uudai'] = $maUudai;
            echo json_encode(['discount' => $giamGia, 'description' => $mota]);
        } else {
            unset($_SESSION['uudai']); 
            echo json_encode(['error' => 'Không đạt điều kiện để áp dụng mã ưu đãi.']);
        }
    } else {
        unset($_SESSION['uudai']); 
        echo json_encode(['error' => 'Thời gian đã hết hạn.']);
    }
} else {
    unset($_SESSION['uudai']); 
    echo json_encode(['error' => 'Mã ưu đãi không tồn tại.']);
}
?>