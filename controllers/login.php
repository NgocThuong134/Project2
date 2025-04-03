<?php
session_start();
include("../Model/data.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tendangnhap = $_POST["tendangnhap"];
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM khachhang WHERE email = '$tendangnhap'";
    $result = executeQuery($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["matkhau"];

        if (password_verify($password, $storedPassword)) {
            $tennguoidung = $row["hovaten"];
            $hinhanh = $row["anhdaidien"];
            $makhachhang = $row['ma_khachhang'];
            $_SESSION['makhachhang'] = $makhachhang;
            $_SESSION["tendangnhap"] = $tendangnhap;
            $_SESSION["tennguoidung"] = $tennguoidung;
            $_SESSION["hinhanh"] = $hinhanh;
            echo "<script>alert('Đăng nhập thành công!'); window.history.back();</script>";
            exit();
        } else {
            echo "<script>alert('Đăng nhập thất bại!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Đăng nhập thất bại!'); window.history.back();</script>";
    }
   
}
?>