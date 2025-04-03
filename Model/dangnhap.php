<?php
session_start();
include('data.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tendangnhap = $_POST["tendangnhap"];
    $password = $_POST["password"];

    // Mã hóa mật khẩu
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM nhanvien WHERE email = '$tendangnhap'";
    $result = executeQuery($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["matkhau"];

        if (password_verify($password, $storedPassword)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $tendangnhap;
            echo "<script>
                    alert('Đăng nhập thành công');
                    window.location.href = '../admin/controllers.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Sai tên đăng nhập hoặc mật khẩu!');
                    window.location.href = '../pages/admin_dangnhap.php';
                </script>";
        }
    } else {
        echo "<script>
                alert('Sai tên đăng nhập hoặc mật khẩu!');
                window.location.href = '../pages/admin_dangnhap.php';
            </script>";
    }
}
?>