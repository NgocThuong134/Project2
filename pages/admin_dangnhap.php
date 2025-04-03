<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_dangnhap.css">
    <title>Admin login</title>
</head>

<body>
    <div class="dangnhap">
        <img src="../images/Logo.png" alt="logo">
        <form action="../model/dangnhap.php" method="post">
            <div class="form-group">
                <label for="Dangnhap">Tên đăng nhập</label>
                <input type="text" name="tendangnhap" id="tendangnhap" required>
            </div>
            <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="password" name="password" required>
            </div>
            <div class="login">
                <button type="submit">Đăng nhập</button>
            </div>
        </form>
    </div>
</body>

</html>