<?php
include("../database/data.php");
$sql = "SELECT ma_khachhang FROM khachhang ORDER BY ma_khachhang DESC LIMIT 1";
$result = $data->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastProductCode = $row['ma_khachhang'];
    $newProductCode = $lastProductCode + 1;
} else {
    $newProductCode = 1;
}

echo '<div class="group">';
echo '<label for="ma_sanpham">Mã khách hàng</label><br>';
echo '<input type="text" name="ma_sanpham" readonly id="ma_khachhang" value="' . $newProductCode . '"><br>';
echo '</div>';

$data->close();
?>