<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/style_admin.css">
    <title>Admin</title>
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
            <p>Bảng điều khiển</p>
        </div>
        <div class="phanvung">
            <section class="phanvung-trai">
                <div class="phanvung-noidung">
                    <?php
                        include("../controllers/admin_noidung.php");
                    ?>
                </div>
                <div class="ttdonhang">
                    <h3>Đơn hàng trong ngày <?php echo date('d-m-Y'); ?></h3>
                    <hr>
                    <table>
                        <thead>
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Tên nhân viên</th>
                            <th>Số bàn</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </thead>
                        <?php
                            include("../controllers/admin_tinhtrangdonhang.php");
                        ?>
                    </table>
                </div>
                <div class="khachhangmoi">
                    <h3>Bình luận mới</h3>
                    <hr>
                    <table>
                        <thead>
                            <th>Mã bình luận</th>
                            <th>Tên khách hàng</th>
                            <th>Nội dung</th>
                            <th>Số sao</th>
                            <th>Trạng thái</th>
                        </thead>
                        <?php
                            include("../controllers/admin_binhluanmoi.php");
                        ?>
                    </table>
                </div>
            </section>

            <section class="phanvung-phai">
                <div class="bieudo1">
                    <?php
                        $firstDayOfWeek = date('d-m-Y', strtotime('this week'));
                        $lastDayOfWeek = date('d-m-Y', strtotime('this week +6 days'));
                        echo "<h3>Doanh thu tuần hiện tại <span style='color:gray; font-size:17px;'>($firstDayOfWeek - $lastDayOfWeek)</span></h3>";
                    ?>
                    <hr>
                    <?php
                        include("../controllers/doanhthu_tuan.php");
                    ?>
                    <canvas id="bieudo-tuan"></canvas>
                </div>
                <div class="bieudo2">
                    <?php
                        $firstDayOfMonth = date('m-Y');
                        $firstDayOfLastSixMonths = date('m-Y', strtotime('-5 months'));
            
                        echo "<h3>Dữ liệu doanh thu 6 tháng gần nhất <span style='color:gray; font-size:17px;'>($firstDayOfLastSixMonths - $firstDayOfMonth)</span></h3>";
                    ?>
                    <hr>
                    <?php
                        include("../controllers/doanhthu_thang.php");
                    ?>
                    <canvas id="bieudo-thang"></canvas>
                </div>
        </div>
    </section>
    </section>
</body>
<script type="text/javascript">
const labels = [];
const currentYear = new Date().getFullYear();
const currentMonth = new Date().getMonth() + 1;

const colors = [
    'rgba(255, 99, 132, 1)',
    'rgba(54, 162, 235, 1)',
    'rgba(255, 206, 86, 1)',
    'rgba(75, 192, 192, 1)',
    'rgba(153, 102, 255, 1)',
    'rgba(255, 159, 64, 1)',
    'rgba(255, 99, 132, 1)',
    'rgba(54, 162, 235, 1)',
    'rgba(255, 206, 86, 1)',
    'rgba(75, 192, 192, 1)',
    'rgba(153, 102, 255, 1)',
    'rgba(255, 159, 64, 1)'
];

const backgroundColors = [];
const borderColors = [];

for (let i = 0; i < 6; i++) {
    let month = currentMonth - i;
    let year = currentYear;

    if (month <= 0) {
        month += 12;
        year--;
    }
    labels.unshift(`Tháng ${month}`);
    backgroundColors.unshift(colors[i % colors.length]);
    borderColors.unshift(colors[i % colors.length]);
}

const myChart1 = new Chart(document.getElementById('bieudo-thang'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Doanh thu',
            data: <?php echo json_encode(array_values($arrayTotal)); ?>,
            backgroundColor: backgroundColors,
            borderColor: borderColors,
            borderWidth: 1
        }]
    },
});
const myChart2 = new Chart(document.getElementById('bieudo-tuan'), {
    type: 'bar',
    data: {
        labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
        datasets: [{
            label: 'Doanh thu',
            data: <?php echo json_encode(array_values($weeklyData)); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
});
</script>

</html>