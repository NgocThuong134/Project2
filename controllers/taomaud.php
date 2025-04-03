<?php
include("../database/data.php");
$sql = "SELECT ma_uudai FROM uudai ORDER BY ma_uudai DESC LIMIT 1";
$result = $data->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastProductCode = $row['ma_uudai'];
    $newProductCode = $lastProductCode + 1;
} else {
    $newProductCode = 1;
}

echo '<div class="group">';
echo '<label for="ma_uudai">Mã ưu đãi</label><br>';
echo '<input type="number" name="ma_uudai" readonly id="ma_uudai" value="' . $newProductCode . '"><br>';
echo '</div>';

$data->close();
?>