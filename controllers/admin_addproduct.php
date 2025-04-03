<?php
include('../Model/data.php');
$maSanPham = $_GET['ma_sanpham'];
$tenSanPham = $_GET['ten_sanpham'];
$soLuong = $_GET['soluong'];
$danhMuc = $_GET['danhmuc'];
$donViTinh = $_GET['donvitinh'];
$giaBan = $_GET['giaban'];
$giaVon = $_GET['giavon'];
$giamGia = $_GET['giamgia'];
$moTaSanPham = trim($_GET['motasp']);
if (isset($_GET['anhsp']))
    $anhSanPham = $_GET['anhsp'];
else $anhSanPham = "";

$sql = "SELECT * FROM sanpham WHERE ma_sanpham = $maSanPham";
$result = executeStatement($sql);

if ($result->num_rows > 0) {
    if ($anhSanPham == "") {
    $sql = "UPDATE sanpham SET tensanpham = '$tenSanPham', soluong = $soLuong, ma_danhmuc = '$danhMuc', donviTinh = '$donViTinh', giaban = $giaBan, giavon = $giaVon, ma_giamgia = $giamGia, mota = '$moTaSanPham' WHERE ma_sanpham = $maSanPham";
    }
    else {
        $sql = "UPDATE sanpham SET tensanpham = '$tenSanPham', soluong = $soLuong, ma_danhmuc = '$danhMuc', donviTinh = '$donViTinh', giaban = $giaBan, giavon = $giaVon, ma_giamgia = $giamGia, mota = '$moTaSanPham', hinhanh = '$anhSanPham' WHERE ma_sanpham = $maSanPham";

    }
    if (executeStatement($sql) === TRUE) {
        echo "Cập nhật sản phẩm thành công";
    } else {
        echo "Lỗi cập nhật sản phẩm: ";
    }
} else {
    $sql = "INSERT INTO sanpham (ma_sanpham, ma_danhmuc, tensanpham, giaban, soluong, donvitinh, mota, giavon, hinhanh) VALUES ($maSanPham, $danhMuc, '$tenSanPham', $giaBan, $soLuong, '$donViTinh', '$moTaSanPham', $giaVon, '$anhSanPham')";
    if (executeStatement($sql) === TRUE) {
        echo "Thêm sản phẩm thành công";
    } else {
        echo "Lỗi thêm sản phẩm: ";
    }
}

?>