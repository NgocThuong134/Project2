<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
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
            <p><a href="adminproduct.php" style="color:black">Danh sách sản phẩm</a> > Thêm sản phẩm</p>
        </div>
        <div class="phan-vung">
            <form method="post">
                <div class="themchucnang">
                    <div class="item" onclick="HienThiDanhMuc()">
                        <i class='bx bxs-folder-plus file'></i>
                        <p>Thêm danh mục</p>
                    </div>
                    <div class="item" onclick="HienThiMaGiamGia()">
                        <i class='bx bxs-folder-plus file'></i>
                        <p>Thêm mã giảm giá</p>
                    </div>
                </div>
                <hr class="line">
                <div class="thongtin">
                    <?php
                    if (isset($_GET['maSP'])){
                            include("../controllers/editsp.php");
                    } else  
                    {
                        include('../controllers/taoma.php');
                        include('../modals/editsp.php');
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
    <div class="themdanhmuc hide">
        <i class='bx bx-x close' onclick="DongDM()"></i>
        <div class="group-dm">
            <label for="tendanhmuc">Tên danh mục</label>
            <input type="text" name="tendanhmuc" id="tendanhmuc" placeholder="Nhập tên danh mục...">
        </div>
        <div class="group-dm">
            <label for="mota">Mô tả</label>
            <input type="text" name="mota" id="mota" placeholder="Mô tả danh mục...">
        </div>
        <div class="group-dm">
            <button type="button" onclick="ThemDanhMuc()">Thêm</button>
        </div>
    </div>
    <div class="themgiamgia hide">
        <i class='bx bx-x close' onclick="DongGG()"></i>
        <div class="group-dm">
            <label for="giatri">Giá trị</label>
            <input type="number" name="giatri" id="giatri" placeholder="Nhập giá trị giảm giá...">
        </div>
        <div class="group-dm">
            <label for="donvi">Đơn vị</label>
            <select name="donvi" id="donvi">
                <option value="VNĐ">VNĐ</option>
                <option value="%">%</option>
            </select>
        </div>
        <div class="group-dm">
            <button type="button" onclick="ThemGiamGia()">Thêm</button>
        </div>
    </div>
</body>
<script src="../js/admineditsp.js">
</script>

</html>