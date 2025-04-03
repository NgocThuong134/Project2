<?php
include_once('../Model/data.php');
$category = isset($_GET['category']) ? $_GET['category'] : 5;

$productsPerPage = $category;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $productsPerPage;
$limit = $productsPerPage;
$query = "SELECT * FROM sanpham";
$where = " WHERE soluong >= 0";
$tam ="";
if (isset($_GET['tukhoa'])) {
    $tukhoa = $_GET['tukhoa'];
    $tam .= "&tukhoa=$tukhoa";
    $where .= " AND (soluong LIKE '%$tukhoa%' OR mota LIKE '%$tukhoa%' OR donvitinh LIKE '%$tukhoa%' OR hinhanh LIKE '%$tukhoa%' OR tensanpham LIKE '%$tukhoa%')";
}

if (isset($_GET['danhmuc'])) {
    $danhMuc = $_GET['danhmuc'];
    $tam .=  "&danhmuc=$danhMuc";
    $where .= " AND ma_danhmuc = $danhMuc";
}

if (isset($_GET['orderby'])) {
    $orderby = $_GET['orderby'];
    $tam .= "&orderby=$orderby";
    $where .= " $orderby";
}

$query .= $where;

$query .= " LIMIT $start, $limit";
$result = executeQuery($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['soluong'] > 0) {
            $trangThai = 'Còn hàng';
        }
        else {
            $trangThai = 'Hết hàng';
        }
        $maDanhmuc = $row['ma_danhmuc'];
        $sql = "SELECT tendanhmuc FROM danhmuc WHERE ma_danhmuc = '$maDanhmuc'";
        $results = executeQuery($sql);
        $rows = $results->fetch_assoc();
        $tenDanhMuc = $rows['tendanhmuc'];
        $idfood = $row['ma_sanpham'];
        echo "<tr>";
        echo "<td><input type='checkbox' id='" . $idfood . "'></td>";
        echo "<td>#" . $idfood. "</td>";
        echo "<td>" . $row['tensanpham'] . "</td>";
        echo "<td><img src='../images/" . $row['hinhanh'] . "' alt='" . $row['tensanpham'] . "'></td>";
        echo "<td>" . $row['soluong'] . "</td>";
        echo "<td>" . $row['donvitinh'] . "</td>";
        echo "<td>" . $trangThai . "</td>";
        echo "<td>" . number_format($row['giaban']) . " VNĐ</td>";
        echo "<td>" . $tenDanhMuc . "</td>";
        echo "<td class='chucnang-sanpham'>";
        echo "<i class='bx bxs-trash-alt nutxoa' onclick=\"window.location.href='controllers.php?act=xoasp&mafood=$idfood'\"></i>";
        echo "<i class='bx bxs-edit nutsua' onclick=\"window.location.href='controllers.php?act=themsp&maSP=$idfood'\"></i>";
        echo "</td>";
        echo "</tr>";
    }

    $countQuery = "SELECT COUNT(*) AS total FROM sanpham ".$where;
    $countResult = executeQuery($countQuery);
    $countRow = $countResult->fetch_assoc();
    $totalProducts = $countRow['total'];

    // Tính toán tổng số trang
    $totalPages = ceil($totalProducts / $productsPerPage);

    // Hiển thị phân trang
    echo "<tr><td colspan='10'>";
    echo "<ul class='phantrang'>";
    if ($tam != "") {
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<li><a href='?act=sanpham&category=$category&per_page=$productsPerPage&page=$i&$tam'>$i</a></li>";
            }
        }
    else {
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<li><a href='?act=sanpham&category=$category&per_page=$productsPerPage&page=$i'>$i</a></li>";
        }
    }
    echo "</ul>";
    echo "</td></tr>";
} else {
    echo "<tr><td colspan='10'>Không có sản phẩm.</td></tr>";
}