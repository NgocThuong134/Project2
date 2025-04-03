<?php
    include("../database/data.php");
    if ($data->connect_error) {
        die("Failed connected...");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tendangnhap = $_POST["tendangnhap"];
        $sodienthoai = $_POST["sodienthoai"];
        $diachi = $_POST["diachi"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $avatar = isset($_FILES["avatar"]["name"]) ? $_FILES["avatar"]["name"] : NULL;
        $birthday = isset($_POST["ngaysinh"]) ? $_POST["ngaysinh"] : NULL;
        $gender = isset($_POST["gioitinh"]) ? $_POST["gioitinh"] : NULL;
        $sql = "SELECT * FROM khachhang WHERE email = '$email'";
        $result = $data->query( $sql );
        if ($result->num_rows>0){
            echo "<script>alert('Tài khoản đã tồn tại!'); window.history.back()</script>";
        }
        else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO khachhang (hovaten, ngaysinh, sodienthoai, diachi, email, matkhau, anhdaidien, gioitinh) 
        VALUES ('$tendangnhap', '$birthday', '$sodienthoai', '$diachi', '$email', '$hashedPassword', '$avatar', '$gender')";

        if ($data->query($sql) === TRUE) {
            echo "<script>alert('Đăng ký thành công'); window.history.back()</script>";
            
        } else {
            echo "<script>alert('Đăng ký thất bại'); window.history.back();</script>";
        }
        }
    }

    $data->close();
?>