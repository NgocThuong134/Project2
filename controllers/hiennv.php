<?php
include("../database/data.php");

$category = isset($_GET['category']) ? $_GET['category'] : 5;

$productsPerPage = $category;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($page - 1) * $productsPerPage;
$limit = $productsPerPage;
$query = "SELECT * FROM nhanvien";
$where = "  WHERE trangthai = 0 ";

if (isset($_GET['tukhoa'])) {
    $tukhoa = $_GET['tukhoa'];
    $where .= " AND (hovaten LIKE '%$tukhoa%' OR gioitinh LIKE '%$tukhoa%' OR email LIKE '%$tukhoa%' OR sodienthoai LIKE '%$tukhoa%' OR chucvu LIKE '%$tukhoa%')";
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
        $manv = $row['ma_nhanvien'];
        if ($row['gioitinh'] == 0)
         $gioitinh = 'Nữ';
        else $gioitinh = 'Nam';

        echo "<tr>";
        echo "<td><input type='checkbox' id='" . $row['ma_nhanvien'] . "'></td>";
        echo "<td>#" . $row['ma_nhanvien']. "</td>";
        echo "<td>" . $row['hovaten'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['sodienthoai'] . "</td>";
        echo "<td>" . $row['ngaysinh'] . "</td>";
        echo "<td>" . $gioitinh . "</td>";
        echo "<td>" . $row['chucvu'] . "</td>";
        echo "<td>" . $row['luong'] . "</td>";
        echo "<td class='chucnang-sanpham'>";
        echo "<i class='bx bxs-trash-alt nutxoa' onclick=\"XoaNV('$manv')\"></i>";
        echo "<i class='bx bxs-edit nutsua' onclick=\"window.location.href='editnv.php?maNV=$manv'\"></i>";
        echo "</td>";
        echo "</tr>";
    }

    $countQuery = "SELECT COUNT(*) AS total FROM nhanvien ";
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