<div class="task">
    <div class="color-red"></div>
    <p>LẨU</p>
</div>
<section class="SPP">
    <?php
        function getFoodQuantity($foodId)
        {
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    if ($item['foodid'] == $foodId) {
                        return $item['soluong'];
                    }
                }
            }
            return 1;
        }
        $categoryid = 1;
        $resultSP = danhMuc($categoryid);
        include('hinhanhSP.php');
        ?>
</section>
<div class="task">
    <div class="color-red"></div>
    <p>MÓN NƯỚNG</p>
</div>
<section class="SPP">
    <?php
        $categoryid = 2;
        $resultSP = danhMuc($categoryid);
        include('hinhanhSP.php');
        ?>
</section>
<div class="task">
    <div class="color-red"></div>
    <p>MÓN KHÁC</p>
</div>
<section class="SPP">
    <?php
        $categoryid = 5;
        $resultSP = danhMuc($categoryid);
        include('hinhanhSP.php');
        ?>
</section>
<div class="task">
    <div class="color-red"></div>
    <p>NƯỚC</p>
</div>
<section class="SPP">
    <?php
        $categoryid = 4;
        $resultSP = danhMuc($categoryid);
        include('hinhanhSP.php');
        ?>
</section>
<div class="task">
    <div class="color-red"></div>
    <p>MÓN TRÁNG MIỆNG</p>
</div>
<section class="SPP">
    <?php
        $categoryid = 3;
        $resultSP = danhMuc($categoryid);
        include('hinhanhSP.php');
    ?>
</section>