<?php

$result = taoMaSP();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastProductCode = $row['ma_sanpham'];
    $newProductCode = $lastProductCode + 1;
} else {
    $newProductCode = 1;
}

echo '<div class="group">';
echo '<label for="ma_sanpham">Mã sản phẩm</label><br>';
echo '<input type="text" name="ma_sanpham" readonly id="ma_sanpham" value="' . $newProductCode . '"><br>';
echo '</div>';

$data->close();
?>