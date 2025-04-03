<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khách hàng</title>
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
            <p>Danh sách sản phẩm</p>
        </div>
        <div class="phan-vung">
            <div class="thanhtieude">
                <div class="item themsp">
                    <i class='bx bx-plus'></i>
                    <a href="editkh.php">Thêm khách hàng</a>
                </div>
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
                <div class="category">
                    <label for="category-input">Hiện </label>
                    <input type="number" id="category-input" min="1"
                        value="<?php echo isset($_GET['category']) ? $_GET['category'] : '5'; ?>" />
                    <p>khách hàng</p>
                </div>
                <div class="sapxep">
                    <label for="sapxem">Điểm tích lũy: </label>
                    <select id="sapxem" name="sapxem" onchange="SapXepDiemTichLuy()">
                        <option value="0">Mặc định</option>
                        <option value="tang_dan">Tăng dần</option>
                        <option value="giam_dan">Giảm dần</option>
                    </select>
                </div>
                <div class="timkiem">
                    <label for="search">Tìm kiếm: </label>
                    <input type="search" id="search" name="search" onchange="TimkiemKH()" />
                </div>
            </div>
            <div class="bangdulieu">
                <table>
                    <thead>
                        <tr>
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Ảnh đại diện</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Địa chỉ</th>
                            <th>Điểm tích lũy</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody id="product-list">
                        <?php
                        include("../controllers/hienkh.php");
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
<script src="../js/customer.js"> </script>

</html>