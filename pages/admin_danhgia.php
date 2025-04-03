<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đánh giá</title>
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
            <a href="admin_voucher.php">
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
            <a href="baocaodoanhthu.php">
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
            <p>Danh sách đánh giá</p>
        </div>
        <div class="phan-vung">
            <div class="thanhtieude">
            </div>
            <hr class="line">
            <div class="thanhbar">
                <div class="category">
                    <label for="category-input">Hiện </label>
                    <input type="number" id="category-input" min="1"
                        value="<?php echo isset($_GET['category']) ? $_GET['category'] : '5'; ?>" />
                    <p>đánh giá</p>
                </div>
                <div class="sapxep">
                    <label for="sapxep">Trạng thái: </label>
                    <select id="sapxep" name="sapxep" onchange="TrangThai()">
                        <option value="">Mặc định</option>
                        <option value="1">Đã duyệt</option>
                        <option value="0">Chưa duyệt</option>
                    </select>
                </div>
                <div class="timkiem">
                    <label for="search">Tìm kiếm: </label>
                    <input type="search" id="search" name="search" onchange="TimkiemDanhGia()" />
                </div>
            </div>
            <div class="bangdulieu">
                <table>
                    <thead>
                        <tr>
                            <th>Mã bình luận</th>
                            <th>Tên khách hàng</th>
                            <th>Tên tin tức</th>
                            <th>Tên món ăn</th>
                            <th>Nội dung</th>
                            <th>Số sao</th>
                            <th>Hình ảnh</th>
                            <th>Video</th>
                            <th>Ngày đăng</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody id="product-list">
                        <?php
                        include("../controllers/hiendanhgia.php");
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
<script src="../js/danhgia.js"> </script>

</html>