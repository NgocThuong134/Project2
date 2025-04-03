<?php
include("../database/data.php");

$category = isset($_GET['category']) ? $_GET['category'] : 5;

$productsPerPage = $category;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $productsPerPage;
$limit = $productsPerPage;
$query = "SELECT * FROM uudai";
$where = " WHERE giatri > 0";
$tam ="";
if (isset($_GET['tukhoa'])) {
    $tukhoa = $_GET['tukhoa'];
    $tam .= "&tukhoa=$tukhoa";
    $where .= " AND (tenuudai LIKE '%$tukhoa%' OR mota LIKE '%$tukhoa%' OR donvitinh LIKE '%$tukhoa%' OR thoigianbatdau LIKE '%$tukhoa%' OR thoigianketthuc LIKE '%$tukhoa%')";
}

if (isset($_GET['orderby'])) {
    $orderby = $_GET['orderby'];
    $tam .= "&orderby=$orderby";
    $where .= " $orderby";
}

$query .= $where;

$query .= " LIMIT $start, $limit";
$result = $data->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $iduudai = $row['ma_uudai'];
        echo "<tr>";
        echo "<td><input type='checkbox' id='" . $iduudai . "'></td>";
        echo "<td>#" . $iduudai. "</td>";
        echo "<td>" . $row['tenuudai'] . "</td>";
        echo "<td>" . date('d-m-y h:m:s', strtotime($row['thoigianbatdau'])) . "</td>";
        echo "<td>" . date('d-m-y h:m:s', strtotime($row['thoigianketthuc'])) . "</td>";
        echo "<td>" . number_format($row['dieukien']) . "</td>";
        echo "<td>" . number_format($row['giatri']) . "</td>";
        echo "<td>" . $row['donvitinh'] . "</td>";
        echo "<td>" . $row['mota']. "</td>";
        echo "<td>" . $row['diemtichluy']. "</td>";
        echo "<td class='chucnang-sanpham'>";
        echo "<i class='bx bxs-trash-alt nutxoa' onclick=\"XoaUD('$iduudai')\"></i>";
        echo "<i class='bx bxs-edit nutsua' onclick=\"window.location.href='edit_uudai.php?maUD=$iduudai'\"></i>";
        echo "</td>";
        echo "</tr>";
    }

    $countQuery = "SELECT COUNT(*) AS total FROM uudai ".$where;
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
    echo "<tr><td colspan='11'>Không có sản phẩm.</td></tr>";
}