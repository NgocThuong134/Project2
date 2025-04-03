<?php
include("../database/data.php");

$category = isset($_GET['category']) ? $_GET['category'] : 5;

$productsPerPage = $category;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $productsPerPage;
$limit = $productsPerPage;
$query = "SELECT * FROM khachhang";
$where = "  WHERE email IS NOT NULL ";

if (isset($_GET['tukhoa'])) {
    $tukhoa = $_GET['tukhoa'];
    $where .= " AND (hovaten LIKE '%$tukhoa%' OR gioitinh LIKE '%$tukhoa%' OR email LIKE '%$tukhoa%' OR sodienthoai LIKE '%$tukhoa%' OR diachi LIKE '%$tukhoa%')";
}


if (isset($_GET['orderby'])) {
    $orderby = $_GET['orderby'];
    $where .= " $orderby";
}

$query .= $where; 
$query .= " LIMIT $start, $limit";

$result = $data->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $makh = $row['ma_khachhang'];
        if ($row['gioitinh'] == 0)
         $gioitinh = 'Nữ';
        else $gioitinh = 'Nam';

        echo "<tr>";
        echo "<td>#" . $row['ma_khachhang']. "</td>";
        echo "<td>" . $row['hovaten'] . "</td>";
        echo "<td><img src='../avatars/" . $row['anhdaidien'] . "' alt='" . $row['hovaten'] . "'></td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['sodienthoai'] . "</td>";
        echo "<td>" . $row['ngaysinh'] . "</td>";
        echo "<td>" . $gioitinh . "</td>";
        echo "<td>" . $row['diachi'] . "</td>";
        echo "<td>" . $row['diemtichluy'] . "</td>";
        echo "<td class='chucnang-sanpham'>";
        echo "<i class='bx bxs-trash-alt nutxoa' onclick=\"XoaKH('$makh')\"></i>";
        echo "<i class='bx bxs-edit nutsua' onclick=\"window.location.href='editkh.php?maKH=$makh'\"></i>";
        echo "</td>";
        echo "</tr>";
    }

    $countQuery = "SELECT COUNT(*) AS total FROM khachhang ";
    $countResult = $data->query($countQuery);
    $countRow = $countResult->fetch_assoc();
    $totalProducts = $countRow['total'];

    // Tính toán tổng số trang
    $totalPages = ceil($totalProducts / $productsPerPage);

    // Hiển thị phân trang
    echo "<tr><td colspan='10'>";
    echo "<ul class='phantrang'>";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<li><a href='?category=$category&per_page=$productsPerPage&page=$i'>$i</a></li>";
    }
    echo "</ul>";
    echo "</td></tr>";
} else {
    echo "<tr><td colspan='10'>Không tìm thấy.</td></tr>";
}