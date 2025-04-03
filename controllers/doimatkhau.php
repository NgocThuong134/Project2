<?php
session_start();
include("../database/data.php");

if ($data->connect_error) {
    die("Failed connected...");
}

$makh = $_SESSION['makhachhang'];
$password = $_GET['pw'];
$newpassword = $_GET['npw'];
// Mã hóa mật khẩu
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT * FROM khachhang WHERE ma_khachhang = '$makh'";
$result = $data->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['matkhau'];

    if (password_verify($password, $storedPassword)) {
        $hashedNewPassword  = password_hash($newpassword, PASSWORD_DEFAULT);
        $updateSql = "UPDATE khachhang SET matkhau = '$hashedNewPassword' WHERE ma_khachhang = '$makh'";
        if ($data->query($updateSql) === true) {
            echo "true";
        } else {
            echo "false";
        }
    } else {
        echo "false";
    }
} else {
    echo "false";
}

?>