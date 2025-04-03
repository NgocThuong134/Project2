<?php

    $maFood = $_GET['foodid'];

// Truy vấn dữ liệu từ bảng binhluan và khachhang
$sql = "SELECT bl.*, kh.hovaten
        FROM binhluan AS bl
        INNER JOIN khachhang AS kh ON bl.ma_khachhang = kh.ma_khachhang
        WHERE bl.trangthai = 1 AND bl.ma_sanpham = '$maFood'"; 
$result = executeQuery($sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $hovaten = $row['hovaten'];
        $ngaydang = $row['ngaydang'];
        $ngaydang_format = date('d-m-Y', strtotime($ngaydang));
        $sosao = $row['sosao'];
        $noidung = $row['noidung'];
        $hinhanh = $row['hinhanh'];
        $video = $row['video'];
        // Tạo phần tử HTML cho mỗi bình luận
        echo '<div class="binhluan">';
        echo '<div class="tieudebinhluan">';
        echo '<h4>' . $hovaten . '</h4>';
        echo '<p>' . $ngaydang_format . '</p>';
        echo '<p class="rate">';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $sosao) {
                echo '<i class="bx bxs-star"></i>';
            } else {
                echo '<i class="bx bx-star"></i>';
            }
        }
        echo '</p>';
        echo '</div>';
        echo '<p class="noidung">' . $noidung . '</p>';
        echo '<div class="hinhanh-video">';
        if (!empty($hinhanh)) {
            $hinhanhArr = explode(', ', $hinhanh);
            foreach ($hinhanhArr as $image) {
                echo '<img src="images/' . $image . '" alt="Hình ảnh">';
            }
        }

        // Kiểm tra và hiển thị video
        if (!empty($video)) {
            echo '<video src="images/' . $video . '.mp4" controls></video>';
        }
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'Không có bình luận.';
}

?>