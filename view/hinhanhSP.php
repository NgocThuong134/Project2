<?php

if ($resultSP->num_rows > 0) {
    while ($row = $resultSP->fetch_assoc()) {
        $foodId = $row['ma_sanpham'];
        $soluong = $row['soluong'];
        $foodname = $row['tensanpham'];
        $image = $row['hinhanh'];
        $price = $row['giaban'];
        $discount = $row['ma_giamgia'];

        echo '<div class="item">';
        echo '<div class="quality">';
        echo '<i class="bx bxs-star"></i>';
        echo '<p style="color: white; padding-left: 5px;">'.$row['danhgia'].'</p>';
        echo '</div>';
        echo '<a href="index.php?act=chitietmonan&foodid=' . $foodId . '"><img class="hinhanh" src="images/' . $image . '" alt="' . $foodname . '"></a>';
        echo '<strong class="name-food">' . $foodname . '</strong>';
        echo '<div class="price">';
        echo '<div class="discount">';
        echo '<p class="gia">Giá: </p>';
        if (empty($discount)) {
            echo '<div class="giamgia" style="margin-bottom: 15px">';
            echo '</div>';
            echo '<span class="giaban">' . number_format($price) . ' VNĐ</span>';
        } else {
            $results = giamGia($discount);
            $rows = $results->fetch_assoc();
            $giatri = $rows['giatri'];
            $donvi = $rows['donvi'];
            if ($donvi === 'VNĐ') {
                $GiamGia = ($giatri / $price) * 100;
                $giaBan = $price - $giatri;
                echo '<div class="giamgia">';
                echo '<strike class="giagoc">' . number_format($price) . ' VNĐ</strike>';
                echo '<p class="giagiam"><i class="bx bx-caret-down"></i>' . number_format($GiamGia, 0) . ' %</p>';
                echo '</div>';
                echo '<p class="giaban">' . number_format($giaBan) . ' VNĐ</p>';
            } elseif ($donvi === '%') {
                $giaBan = $price * (1 - ($giatri / 100));
                echo '<div class="giamgia">';
                echo '<strike class="giagoc">' . number_format($price) . ' VNĐ</strike>';
                echo '<p class="giagiam"><i class="bx bx-caret-down"></i>' . number_format($giatri, 0) . ' %</p>';
                echo '</div>';
                echo '<p class="giaban">' . number_format($giaBan) . ' VNĐ</p>';
            }
        }
        echo '</div>';
        echo '<button class="Btn" >';
        if ($soluong > 0) {
            echo '
                <div class="sign">
                    <i class="bx bxs-cart-add" onclick="addToCart(' . $foodId . ',this)"></i>
                </div>
                <div class="text">
                    <input type="number" min="0" value="' . getFoodQuantity($foodId) . '">
                </div>'; }
                else{
                    echo '
                    <div class="sign" style="color:red; font-weight:bold">
                        Hết hàng
                    </div>
                    ';
                }
        echo  '</button>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'Không có dữ liệu món ăn.';
}
?>