<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm ưu đãi</title>
    <link rel="stylesheet" href="../css/style_admineditproduct.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style_admin.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        echo "<script>
                alert('Vui lòng đăng nhập!');
                window.location.href = 'admin_dangnhap.php';
            </script>";
        exit();
    }
    ?>
    <section class="left">
        <p id="admin">Admin</p>
        <div class="avatar-admin">
            <img src="../images/banhchuoi.jpg" alt="anh dai dien">
            <p class="name">Nguyen Ngoc Thuong</p>
        </div>
        <div class="chucnang">
            <a href="">
                <i class='bx bxs-cart-alt'></i>
                POS bán hàng
            </a>
            <a href="admin.php">
                <i class='bx bxs-dashboard'></i>
                Bảng điều khiển
            </a>
            <a href="admin_staff.php">
                <i class='bx bxs-user-detail'></i>
                Quản lý nhân viên
            </a>
            <a href="admin_customer.php">
                <i class='bx bxs-group'></i>
                Quản lý khách hàng
            </a>
            <a href="adminproduct.php">
                <i class='bx bxs-box'></i>
                Quản lý sản phẩm
            </a>
            <a href="admin_donhang.php">
                <i class='bx bx-check-square'></i>
                Quản lý đơn hàng
            </a>
            <a href="admin_voucher.php">
                <i class='bx bxs-gift'></i>
                Quản lý ưu đãi
            </a>
            <a href="">
                <i class='bx bxs-news'></i>
                Quản lý bài viết
            </a>
            <a href="">
                <i class='bx bxs-conversation'></i>
                Quản lý đánh giá
            </a>
            <a href="">
                <i class='bx bx-dollar'></i>
                Bảng kê lương
            </a>
            <a href="">
                <i class='bx bxs-pie-chart-alt-2'></i>
                Báo cáo doanh thu
            </a>
            <a href="">
                <i class='bx bxs-cog'></i>
                Cài đặt hệ thống
            </a>
            <a href="../controllers/dangxuat.php">
                <i class='bx bx-log-out'></i>
                Đăng xuất
            </a>
        </div>
    </section>
    <section class="right">
        <div class="bar">
            <i class='bx bx-bell'></i>
            <i class='bx bx-flag'></i>
            <img src="../images/banhchuoi.jpg" alt="anh dai dien">
            <p id="name">Thuong</p>
        </div>
        <div class="tieude">
            <p><a href="admin_voucher.php" style="color:black">Danh sách ưu đãi</a> > Thêm ưu đãi</p>
        </div>
        <div class="phan-vung">
            <form method="post">
                <hr class="line">
                <div class="thongtin">
                    <?php
                    if (isset($_GET['maUD'])){
                            include("../controllers/editud.php");
                    } else  
                    {
                        include('../controllers/taomaud.php');
                        include('../modals/editud.php');
                    }
                    ?>
                    <div class="capnhat">
                        <button type="button" class="luulai" onclick="showSuccessMessage()">Lưu lại</button>
                        <button type="button" class="huybo" onclick="confirmCancellation()">Hủy bỏ</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
<script src="../js/editud.js">
</script>

</html>