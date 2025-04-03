<?php
include("../database/data.php");
$sql = "SELECT ma_nhanvien FROM nhanvien ORDER BY ma_nhanvien DESC LIMIT 1";
$result = $data->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastProductCode = $row['ma_nhanvien'];
    $newProductCode = $lastProductCode + 1;
} else {
    $newProductCode = 1;
}

echo '<div class="group">';
echo '<label for="ma_nhanvien">Mã nhân viên</label><br>';
echo '<input type="text" name="ma_nhanvien" readonly id="ma_nhanvien" value="' . $newProductCode . '"><br>';
echo '</div>';

$data->close();
?>