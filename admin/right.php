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