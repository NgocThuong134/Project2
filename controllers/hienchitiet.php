<?php
include("../database/data.php");

$query = "SELECT * FROM chitiethoadon WHERE ma_hoadon = $maHoaDon";

$result = $data->query($query);

if ($result->num_rows > 0) {

while ($row = $result->fetch_assoc()) {
    $tongTien = 0;
    echo "<tr>";
    echo "<td>" . $row['tensanpham'] . "</td>";
    echo "<td>".number_format($row['gia'])."  VNĐ</td>";
    echo "<td>" . $row['soluong'] . "</td>";
    echo "<td>" . $row['donvitinh'] . "</td>";
    echo "<td>" . $row['giamgia'] . "</td>";
    echo "<td>" . $row['chuthich'] . "</td>";

    // Tính tổng tiền
    $donGia = $row['gia'];
    $soLuong = $row['soluong'];
    $giamGia = $row['giamgia'];

    // Xử lý giá trị của giamgia
    if (strpos($giamGia, '%') !== false) {
        $giamGia = (float) str_replace('%', '', $giamGia);
        $giamGia = $donGia * $giamGia / 100;
    } else {
        $giamGia = (float) str_replace('VNĐ', '', $giamGia);
    }

    $thanhTien = ($donGia * $soLuong) - $giamGia;
    $tongTien += $thanhTien;
    echo "<td>" . number_format($tongTien) . " VNĐ </td>";
    echo "</tr>";
}
}
?>