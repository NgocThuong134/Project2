<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo cáo doanh thu</title>
    <link rel="stylesheet" href="../css/style_adminproduct.css">
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
            <a href="">
                <i class='bx bxs-gift'></i>
                Quản lý ưu đãi
            </a>
            <a href="">
                <i class='bx bxs-news'></i>
                Quản lý bài viết
            </a>
            <a href="admin_danhgia.php">
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
            <p>Doanh thu </p>
        </div>
        <div class="phan-vung">
            <div class="thanhtieude">
                <div class="item taifile">
                    <i class='bx bxs-file-plus'></i>
                    <p>Tải file</p>
                </div>
                <div class="item indulieu">
                    <i class='bx bxs-printer'></i>
                    <p>In dữ liệu</p>
                </div>
                <div class="item saochep">
                    <i class='bx bxs-copy'></i>
                    <p>Sao chép</p>
                </div>
                <div class="item xuatpdf">
                    <i class='bx bxs-file-pdf'></i>
                    <p>Xuất PDF</p>
                </div>
                <div class="item xoa">
                    <i class='bx bxs-trash-alt'></i>
                    <p>Xóa</p>
                </div>
            </div>
            <hr class="line">
            <div class="thanhbar">
                <div class="ngay" onchange="DoanhThu()">
                    <label for="tungay" style="font-weight:bold">Từ ngày: </label>
                    <input type="date" name="date-start" id="date-start">
                    <label for="denngay" style="font-weight:bold">Đến ngày: </label>
                    <input type="date" name="date-end" id="date-end">
                </div>
            </div>
            <div class="bangdulieu">
                <table>
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Thời gian vào</th>
                            <th>Thời gian ra</th>
                            <th>Loại hóa đơn</th>
                            <th>Ưu đãi</th>
                            <th>Tổng tiền giảm giá</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody id="product-list">
                        <?php
                        include("../controllers/hiendoanhthu.php");
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
<script src="../js/doanhthu.js"> </script>

</html>