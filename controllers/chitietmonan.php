<?php
    if (isset($_GET['foodid'])) {
        $foodId = $_GET['foodid'];
        $result = sanPham($foodId);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $foodname = $row['tensanpham'];
                $description = $row['mota'];
                $price = $row['giaban'];
                $unit = $row['donvitinh'];
                $image = $row['hinhanh'];
                $discount = $row['ma_giamgia'];
                $status = $row['soluong'];
                $images = $row['danhsachhinhanh'];
                if ($status <> 0) {
                    $trangthai = 'Còn hàng';
                } else $trangthai = 'Hết hàng';
                echo '<section class="mon_an">';
                echo '<div class="hinh_anh">';
                echo '<p class="anhchinh">';
                echo '<img src="images/' . $image . '" alt="' . $image . '">';
                echo '</p>';

                $imageArray = explode(',', $images);

                foreach ($imageArray as &$image) {
                    $image = trim($image);
                }
                for ($i = 0; $i < min(4, count($imageArray)); $i++) {
                    $image = $imageArray[$i];
                    echo '<p class="anh' . ($i + 1) . '">';
                    echo '<img src="images/' . $image . '" alt="' . $image . '">';
                    echo '</p>';
                }

                echo '</div>';
                echo '<div class="thuoctinh_mon_an">';
                echo '<p class="ten">' . $foodname . '</p>';
                echo '<hr>';
                if (empty($discount))
                {
                    echo '<p class="gia" style="color: red; font-weight:bold;">' . number_format($price) . ' VNĐ</p>';
                }
                else {
                    $results = giamGia($discount);
                    $rows = mysqli_fetch_assoc($results);
                    $giatri = $rows['giatri'];
                    $donvi = $rows['donvi'];
                    if ($donvi === 'VNĐ') {
                        $giamgia = ($giatri / $price) * 100;
                        $giaban = $price - ($price * ($giamgia / 100));
                    } else {
                        $giamgia = $giatri;
                        $giaban = $price - ($price * ($giatri / 100));
                    }
                    echo '<div class="gia">';
                    echo '<div class="gia_bandau">';
                    echo '<strike class="gia_goc">'. number_format($price) .' VNĐ</strike>';
                    echo '<p class="giam_gia"><i class="bx bx-caret-down"></i>'. number_format($giamgia, 0) .' %</p>';
                    echo '</div>';
                    echo '<p class="gia_ban">' . number_format($giaban) . ' VNĐ</p>';
                    echo '</div>';
                }
                echo '<p class="trang_thai">' . $trangthai . '</p>';
                echo '<div class="chon_so_luong">';
                echo '<input class="center-text" id="soluong" type="number" min="1" value="'. getFoodQuantity($foodId) .'">';
                echo '<p class="themvaogiohang" onclick="addToCart3('. $foodId.')">Thêm vào giỏ hàng</p>';
                echo '<a onclick="addToCartNgay('. $foodId.')">';
                echo '<p class="muangay">Mua ngay</p>';
                echo '</a>';
                echo '</div>';
                echo '</div>';
                echo '</section>';
                echo '<section class="mota">';
                echo '<h2>Giới thiệu</h2>';
                echo '<p>' . $description . '</p>';
                echo '</section>';
            } 
        } 
       
    } else {
        echo 'Không cung cấp foodid trong URL.';
    }
   
?>