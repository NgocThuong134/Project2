<?php
// Kết nối đến cơ sở dữ liệu (giả sử bạn đã có đoạn mã kết nối)
include("../database/data.php");
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    echo 'KEY: ' . $keyword;
    // Truy vấn cơ sở dữ liệu để tìm kiếm các món ăn theo từ khóa
    $sql = "SELECT * FROM foods WHERE 
        foodname LIKE '%$keyword%' OR 
        description LIKE '%$keyword%' OR 
        price LIKE '%$keyword%' OR 
        unit LIKE '%$keyword%' OR 
        image LIKE '%$keyword%' OR 
        imagelist LIKE '%$keyword%' OR 
        status LIKE '%$keyword%' OR 
        categoryid LIKE '%$keyword%' OR 
        discount LIKE '%$keyword%'";
    $result = mysqli_query($data, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $foodId = $row['foodid'];
                $foodname = $row['foodname'];
                $image = $row['image'];
                $price = $row['price'];
                echo '<section class="SP">';
                echo '<div class="item">';
                echo '<div class="quality">';
                echo '<i class="bx bxs-star"></i>';
                echo '<p style="color: white; padding-left: 5px;">4.8</p>';
                echo '</div>';
                echo '<a href="./pages/chitietmonan.php?foodid=' . $foodId . '"><img class="hinhanh" src="./images/' . $image . '" alt="' . $foodname . '"></a>';
                echo '<strong class="name-food">' . $foodname . '</strong>';
                echo '<div class="price">';
                echo '<p>Giá: <span style="color: red;">' . number_format($price) . ' VNĐ</span></p>';
                echo '<i class="bx bxs-cart-add" onclick="addToCart(' . $foodId . ',this)"></i>';
                echo '</div>';
                echo '</div>';
                echo '</section>';
            }
        } else {
            echo '<p>Không tìm thấy kết quả nào.</p>';
        }
    } else {
        echo '<p>Lỗi truy vấn cơ sở dữ liệu: ' . mysqli_error($data) . '</p>';
    }

    mysqli_free_result($result);
    mysqli_close($data);
} else {
    echo '<p>Không cung cấp từ khóa tìm kiếm.</p>';
}
?>