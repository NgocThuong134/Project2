<?php
include("../database/data.php");
if (isset($_GET['datestart']) && isset($_GET['dateend'])) {
    $date_start = $_GET['datestart'];  
    $date_end = $_GET['dateend'];
    $date_end = date('Y-m-d', strtotime($date_end . ' +1 day'));
}
else {
    $date_start = date( 'Y-m-d' );  
    $currentDate = date('Y-m-d');
    $date_end = date('Y-m-d', strtotime($currentDate . ' +1 day'));
}
$query = "SELECT * FROM hoadon WHERE trangthai = 'Hoàn thành' AND thoigianxuat BETWEEN '$date_start' AND '$date_end'";

$result = $data->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['loaihoadon'] == 0){
            $loaihoadon = 'Online';
        }
        else $loaihoadon = "Trực tiếp";
        echo "<tr>";
        echo "<td>#" . $row['ma_hoadon']. "</td>";
        echo "<td>" . $row['thoigiannhap'] . "</td>";
        echo "<td>" . $row['thoigianxuat'] . "</td>";
        echo "<td>" . $loaihoadon . "</td>";
        echo "<td>" . $row['uudai'] . "</td>";
        echo "<td>" .number_format($row['tongtiengiamgia']) . " VNĐ</td>";
        echo "<td>" . number_format($row['tongtien']) . " VNĐ</td>";
        echo "</tr>";
    }

   
    echo "<tr><td colspan='10'>";
    $sql = "SELECT SUM(tongtien) AS doanhthu FROM hoadon WHERE trangthai = 'Hoàn thành' AND thoigianxuat BETWEEN '$date_start' AND '$date_end'";
    $result = mysqli_query($data,$sql);
    $row = mysqli_fetch_assoc($result);
    $doanhthu = $row['doanhthu'];
    echo "<span style='font-weight:bold'>TỔNG TIỀN: </span> <span style='color:red; font-weight:bold; font-size:20px'>".number_format($doanhthu) . " VNĐ </span>";
    echo "</td></tr>";
} else {
    echo "<tr><td colspan='10'>Không tìm thấy.</td></tr>";
}