<?php
include("../database/data.php");

$category = isset($_GET['category']) ? $_GET['category'] : 5;

$productsPerPage = $category;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $productsPerPage;
$limit = $productsPerPage;
$query = "SELECT * FROM hoadon";
$where = "";
$tam = "";
if (isset($_GET['tukhoa'])) {
    $tukhoa = $_GET['tukhoa'];
    $tam .= "&tukhoa=$tukhoa";
    $where .= " WHERE (trangthai LIKE '%$tukhoa%' OR tongtien LIKE '%$tukhoa%' OR uudai LIKE '%$tukhoa%' OR ma_banan LIKE '%$tukhoa%' OR chuthich LIKE '%$tukhoa%' OR ma_nhanvien LIKE '%$tukhoa%')";
}


if (isset($_GET['orderby'])) {
    $orderby = $_GET['orderby'];
    $tam .= "&orderby=$orderby";
    $where .= " $orderby, DATE(thoigianxuat) DESC ";
} else {
    $where .= " ORDER BY DATE(thoigianxuat) DESC";
}

$query .= $where; 
$query .= " LIMIT $start, $limit";

$result = $data->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $manv = $row['ma_nhanvien'];
        $makh = $row['ma_khachhang'];
        $tennv = "";
        $tenkh ="";
        if ($manv != ""){
        $sqlNV = "SELECT hovaten FROM nhanvien WHERE ma_nhanvien = $manv";
            $resNV = mysqli_query($data,$sqlNV);    
            $rowNV = mysqli_fetch_array($resNV);    
            $tennv = $rowNV["hovaten"];  
        }
        if ($makh != ""){
        $sqlKH = "SELECT hovaten FROM khachhang WHERE ma_khachhang = $makh";
        $resKH = mysqli_query($data,$sqlKH);    
        $rowKH = mysqli_fetch_array($resKH);                
        $tenkh = $rowKH["hovaten"];            
        }
        $loaiHoaDon = $row['loaihoadon'];
        if ($loaiHoaDon == 0){
            $tenhoadon = "Online";
        } else $tenhoadon = "Trực tiếp";
        $madh = $row['ma_hoadon'];
        echo "<tr>";
        echo "<td><a href='chitietdonhang.php?ma_hoadon=" . $row['ma_hoadon'] . "' style='color: black; font-weight: bold;'>#" . $row['ma_hoadon']. "</a></td>";
        echo "<td>" . $row['thoigiannhap'] . "</td>";
        echo "<td>" . $row['thoigianxuat'] . "</td>";
        echo "<td>" . $tenhoadon . "</td>";
        echo "<td>" . $row['uudai'] . "</td>";
        echo "<td>" . number_format($row['tongtiengiamgia']) . "</td>";
        echo "<td>" .number_format($row['tongtien']) . "</td>";
        $trangThaiOptions = [
            'da_xu_ly' => 'Đã xử lý',
            'van_chuyen' => 'Vận chuyển',
            'dang_giao_hang' => 'Đang giao hàng',
            'hoan_thanh' => 'Hoàn thành',
            'da_huy' => 'Đã hủy',
            'tra_hang' => 'Trả hàng'
        ];
        
        echo '<td class="trangthaidonhang">';
        echo '<select name="trangthai" onchange="CapnhatTrangthai(this)" data-madh="' . $madh . '">';
        foreach ($trangThaiOptions as $value => $label) {
            $selected = ($row['trangthai'] == $label) ? 'selected' : '';
            echo '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
        }
        echo '</select>';
        echo '</td>';
        echo "<td>" . $tenkh. "</td>";
        echo "<td>" . $tennv . "</td>";
        echo "<td>" . $row['ma_banan'] . "</td>";
        echo "<td>" . $row['chuthich'] . "</td>";
        echo "</tr>";
    }

    $countQuery = "SELECT COUNT(*) AS total FROM hoadon ".$where;
    $countResult = $data->query($countQuery);
    $countRow = $countResult->fetch_assoc();
    $totalProducts = $countRow['total'];

    $totalPages = ceil($totalProducts / $productsPerPage);

    echo "<tr><td colspan='14'>";
    echo "<ul class='phantrang'>";
    if ($tam != "") {
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<li><a href='?category=$category&per_page=$productsPerPage&page=$i&$tam'>$i</a></li>";
        }
    }
    else {
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<li><a href='?category=$category&per_page=$productsPerPage&page=$i'>$i</a></li>";
        }
    }
    echo "</ul>";
    echo "</td></tr>";
} else {
    echo "<tr><td colspan='14'>Không tìm thấy.</td></tr>";
}