<?php
session_start();
include('../Model/data.php');
$status = $_GET['trangthai'];

switch ($status) {
    case 'all':
        $status = '';
        break;
    case 'dangxuly':
        $status = 'Đang xử lý';
        break;
    case 'vanchuyen':
        $status = 'Vận chuyển';
        break;
    case 'danggiaohang':
        $status = 'Đang giao hàng';
        break;
    case 'hoanthanh':
        $status = 'Hoàn thành';
        break;
    case 'dahuy':
        $status = 'Đã hủy';
        break;
    case 'trahang':
        $status = 'Trả hàng';
        break;
}

$maKH = $_SESSION['makhachhang'];
$sort = $_GET['sapxep'];
$dateStart = $_GET['tungay'];
$dateEnd = $_GET['denngay'];
$searchInput = $_GET['timkiem'];

$sql = "SELECT h.ma_hoadon,h.thoigiannhap,h.tongtiengiamgia,h.trangthai, h.tongtien,h.chuthich as hoadon_chuthich,h.uudai,c.ma_sanpham, c.tensanpham, c.gia, c.soluong,c.giamgia,c.chuthich
        FROM hoadon AS h
        LEFT JOIN chitiethoadon AS c ON h.ma_hoadon = c.ma_hoadon
        WHERE h.ma_khachhang = '$maKH'";

if (!empty($status)) {
    $sql .= " AND h.trangthai = '$status'";
}

if (!empty($dateStart) && !empty($dateEnd)) {
    $sql .= " AND h.thoigiannhap BETWEEN '$dateStart' AND '$dateEnd'";
}

if (!empty($searchInput)) {
    $sql .= " AND (c.chuthich LIKE '%$searchInput%' OR c.tensanpham LIKE '%$searchInput%' OR c.ma_sanpham LIKE '%$searchInput%')";
}

if (!empty($sort)) {
    $sql .= " ORDER BY h.tongtien $sort";
}

$result = executeQuery($sql);

if (mysqli_num_rows($result) > 0) {
    $tongtienHD = 0;
    $totalRows = mysqli_num_rows($result);
    $dem = 0;
    $previousMaHoadon = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $dem++;
        $thoigiannhap = $row['thoigiannhap'];
        $thoigiannhap_formatted = date('d-m-Y h:m', strtotime($thoigiannhap));
        $thoigiandanhgia = strtotime($thoigiannhap);
        $thoigiandanhgia = strtotime("+15days",$thoigiandanhgia);
        $thoigiandanhgia = date('d-m-Y',$thoigiandanhgia);
        if ($previousMaHoadon == "") {
            echo '<tr class="highlighted-row">';
            echo '<td colspan="8" style="font-weight: bold;">#' . $row['ma_hoadon'] . ' <span style="font-style: italic; color: gray;">' . $thoigiannhap_formatted . '</span> '.$row['trangthai']. '</td>';
            echo '</tr>';   
            $previousMaHoadon = $row['ma_hoadon'];
            $tongtienHD = $row['tongtien'];
        } elseif ($row['ma_hoadon'] != $previousMaHoadon) {
            echo '<tr>';
            echo '<td colspan="8" style="text-align: right;">';
            if ($row['hoadon_chuthich'] != "") {
                echo '<p>Chú thích: ' . $row['hoadon_chuthich'] . '</p>';
            }
            echo '<p>Ưu đãi: <span style="color:orange">' . $row['uudai'] . '</span></p>';
            echo '<p>Tổng tiền giảm giá: <span style="color:orange">' . number_format($row['tongtiengiamgia']) . ' VNĐ </span></p>';
            echo '<span style="font-style: italic; color:black; margin-right:10%;">Đánh giá sản phẩm trước ngày '.$thoigiandanhgia.'</span>';
            echo '<span style="font-weight:bold; color:black; font-size: 22px;">Thành tiền:</span> ';
            echo '<span style="color:red; font-size:20px; font-weight:bold;">' . number_format($tongtienHD) . ' VNĐ </span>';
            echo '</td>';
            echo '</tr>';
            echo '<tr class="highlighted-row">';
            echo '<td colspan="8" style="font-weight: bold;">#' . $row['ma_hoadon'] . ' <span style="font-style: italic; color: gray;">' . $thoigiannhap_formatted . '</span></td>';
            echo '</tr>';
            $previousMaHoadon = $row['ma_hoadon'];
            $tongtienHD = $row['tongtien'];
        }
        $tongtien = 0;
        $soluong = $row['soluong'];
        $gia = $row['gia'];
        $giamgia = $row['giamgia'];

        // Xử lý giá trị của giamgia
        if (strpos($giamgia, '%') !== false) {
            $giamgia = (float) str_replace('%', '', $giamgia);
            $giamgia = $gia * $giamgia / 100;
        } else {
            $giamgia = (float) str_replace('VNĐ', '', $giamgia);
         }

         $tongtien += $soluong * $gia - $giamgia;
         $masp = $row['ma_sanpham'];
         $sqlAnh = "SELECT hinhanh FROM sanpham WHERE ma_sanpham = '$masp'";
         $anhSP = executeQuery($sqlAnh);
         $rowAnh = mysqli_fetch_assoc($anhSP);
        echo '<tr style="line-height:10px;">';
        echo '<td></td>';
        echo '<td colspan="8">';
        echo '<table>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td id="ten">';
        echo '<div class="tensp">';
        echo '<img style="height:50px; width:50px;" src="images/'.$rowAnh['hinhanh'].'" alt="Hình ảnh sản phẩm"><p>' . $row['tensanpham'] . '</p>';
        echo '</div>';
        echo '</td>';
        echo '<td id="soluong">' . $soluong . '</td>';
        echo '<td id="dongia">' . number_format($gia) . ' VNĐ</td>';
        echo '<td id="giamgia">' . $row['giamgia'] . '</td>';
        echo '<td id="chuthich">' . $row['chuthich'] . '</td>';
        echo '<td id="tongtien">' . number_format($tongtien) . ' VNĐ</td>';
        echo '<td id="chucnang">';
        echo '<div class="chucnang">';
        $currentDate = new DateTime();
        $thoigiandanhgiaDateTime = DateTime::createFromFormat('d-m-Y', $thoigiandanhgia);
        if ($thoigiandanhgiaDateTime >= $currentDate) {
            echo '<button type="button" onclick="redirectToDanhGia('.$masp.');">Đánh giá</button>';            
            echo '<button type="button" onclick="addToCart2(\''.$masp.'\', 1);">Mua lại</button>';
        } else {
            echo '<button type="button">Mua lại</button>';
        }
        echo '</div>';
        echo '</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '</td>';
        echo '</tr>';
        if ($dem == $totalRows) {
            echo '<tr>';
            echo '<td colspan="8" style="text-align: right;">';
            if ($row['hoadon_chuthich'] != "") {
                echo '<p>Chú thích: ' . $row['hoadon_chuthich'] . '</p>';
            }
            echo '<p>Ưu đãi: <span style="color:orange">' . $row['uudai'] . '</span></p>';
            echo '<p>Tổng tiền giảm giá: <span style="color:orange">' . number_format($row['tongtiengiamgia']) . ' VNĐ </span></p>';
            echo '<span style="font-style: italic; color:black; margin-right:10%;">Đánh giá sản phẩm trước ngày '.$thoigiandanhgia.'</span>';
            echo '<span style="font-weight:bold; color:black; font-size: 22px;">Thành tiền:</span> ';
            echo '<span style="color:red; font-size:20px; font-weight:bold;">' . number_format($tongtienHD) . ' VNĐ </span>';
            echo '</td>';
            echo '</tr>';
        }
    }
} else {
    echo 'Không có dữ liệu.';
}

?>