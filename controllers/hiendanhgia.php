<?php
include("../database/data.php");

$category = isset($_GET['category']) ? $_GET['category'] : 5;

$productsPerPage = $category;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $productsPerPage;
$limit = $productsPerPage;
$query = "SELECT bl.*,kh.hovaten,tt.tentintuc,sp.tensanpham FROM binhluan AS bl LEFT JOIN khachhang AS kh ON bl.ma_khachhang = kh.ma_khachhang
            LEFT JOIN tintuc AS tt ON bl.ma_tintuc = tt.ma_tintuc
            LEFT JOIN sanpham AS sp ON bl.ma_sanpham = sp.ma_sanpham";
$where = "";
$tam ="";
if (isset($_GET['tukhoa'])) {
    $tukhoa = $_GET['tukhoa'];
    $tam .= "&tukhoa=$tukhoa";
    $where .= " WHERE (bl.noidung LIKE '%$tukhoa%' OR tt.tentintuc LIKE '%$tukhoa%' OR sp.tensanpham LIKE '%$tukhoa%' OR kh.hovaten LIKE '%$tukhoa%' OR bl.sosao LIKE '%$tukhoa%')";
}

if (isset($_GET['trangthai'])) {
    $trangthai = $_GET['trangthai'];
    $tam .= "&trangthai=$trangthai";
    $where .= " WHERE bl.trangthai = $trangthai";
}

$query .= $where;
$query .= " LIMIT $start, $limit";
$result = $data->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $trangthai = $row['trangthai'];
        $idbinhluan = $row['ma_binhluan'];
        echo "<tr>";
        echo "<td>#" . $idbinhluan. "</td>";
        echo "<td>" . $row['hovaten'] . "</td>";
        echo "<td>" . $row['tentintuc'] . "</td>";
        echo "<td>" . $row['tensanpham'] . "</td>";
        echo "<td>" . $row['noidung'] . "</td>";
        echo "<td>" . $row['sosao'] . "</td>";
        echo "<td>";
        $hinhanh_arr = explode(', ', $row['hinhanh']);
        if ($row['hinhanh'] != null)
         foreach ($hinhanh_arr as $hinhanh) {
            echo "<img style='height:40px; width:40px;' src='../images/$hinhanh' alt='Hình ảnh'>";
        }
        echo '</td>';
        echo '<td>';
        if ($row['video'] != null)
        echo "<video style='height:60px; width:90px;' src='../images/" . $row['video'] . "' controls></video>";
        echo "</td>";
        echo "<td>" . date('d-m-y h:m:s', strtotime($row['ngaydang'])) . "</td>";
        echo "<td>";
        echo '<select name="trangthai" id="danhgia" onchange="CapnhatTrangthai(this)" data-mabl="' . $idbinhluan . '">';
        echo "<option value='1' " . ($trangthai == 1 ? 'selected' : '') . ">Đã duyệt</option>";
        echo "<option value='0' " . ($trangthai == 0 ? 'selected' : '') . ">Chưa duyệt</option>";
        echo "</select>";
        echo "</td>";
        echo "</tr>";
    }

    $countQuery = "SELECT COUNT(*) AS total FROM binhluan AS bl LEFT JOIN khachhang AS kh ON bl.ma_khachhang = kh.ma_khachhang
    LEFT JOIN tintuc AS tt ON bl.ma_tintuc = tt.ma_tintuc
    LEFT JOIN sanpham AS sp ON bl.ma_sanpham = sp.ma_sanpham ".$where;
    $countResult = $data->query($countQuery);
    $countRow = $countResult->fetch_assoc();
    $totalProducts = $countRow['total'];

    // Tính toán tổng số trang
    $totalPages = ceil($totalProducts / $productsPerPage);

    // Hiển thị phân trang
    echo "<tr><td colspan='11'>";
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
    echo "<tr><td colspan='11'>Không có đánh giá.</td></tr>";
}