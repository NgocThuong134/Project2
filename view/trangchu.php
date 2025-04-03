<div class="task">
    <div class="color-red"></div>
    <p>SẢN PHẨM BÁN CHẠY</p>
</div>
<section class="SP">
    <?php
        $start = 1;
        $end = 4;
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
        $resultSP = showImg($start,$end);
        include('hinhanhSP.php');
        ?>
</section>
<div class="task">
    <div class="color-red"></div>
    <p>SẢN PHẨM NỔI BẬT</p>
</div>
<section class="SP">
    <?php
        $start = 2;
        $end = 10;
        $resultSP = showImg($start,$end);
        include('hinhanhSP.php');
        ?>
</section>