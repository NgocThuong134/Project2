<?php
  session_start();
  
  $tongTienGiamGia = intval($_GET['tongTienGiamGia']);
  $tongTienThanhToan = intval($_GET['tongTienThanhToan']);
  
  include("../database/data.php");
  if ($data->connect_error) {
    die("Failed connect: " . $data->connect_error);
    }
    $loaiHoaDon = 0; // 0: online 1: truc tiep 
    $thoiGianNhap = date('Y-m-d H:i:s'); 
    $thoiGianXuat = date('Y-m-d H:i:s'); 
    $trangThai = "Đang xử lý"; 
    $hinhThucThanhToan = "Tiền mặt";
    $chuthich = $_SESSION['note'];
    $uudai = "0 VNĐ";
    if (isset($_SESSION['uudai'])){
        $maUuDai = $_SESSION['uudai'];
        $sqlUudai = "SELECT CONCAT(giatri,' ',donvitinh) AS uudai FROM uudai WHERE tenuudai =  '$maUuDai'";
        $resultUudai = $data->query( $sqlUudai );
        $rowUuDai = $resultUudai->fetch_assoc();
        if ($resultUudai->num_rows > 0) {
            $uudai = $rowUuDai['uudai'];
        }
    }
    if (isset($_SESSION['makhachhang'])) {
        $maKhachHang = $_SESSION['makhachhang'];
        $sql = "INSERT INTO hoadon (loaihoadon, thoigiannhap, thoigianxuat, trangthai, tongtiengiamgia, tongtien, hinhthucthanhtoan, ma_khachhang, chuthich, uudai)
            VALUES ('$loaiHoaDon', '$thoiGianNhap', '$thoiGianXuat', '$trangThai', '$tongTienGiamGia', '$tongTienThanhToan', '$hinhThucThanhToan', '$maKhachHang','$chuthich','$uudai')";
    } else {
        $sql = "INSERT INTO hoadon (loaihoadon, thoigiannhap, thoigianxuat, trangthai, tongtiengiamgia, tongtien, hinhthucthanhtoan, chuthich, uudai)
            VALUES ('$loaiHoaDon', '$thoiGianNhap', '$thoiGianXuat', '$trangThai', '$tongTienGiamGia', '$tongTienThanhToan', '$hinhThucThanhToan','$chuthich','$uudai')";
    }
    if ($data->query($sql))
    {
        $maHoaDon = $data->insert_id;
        $cart = $_SESSION['cart']; 
        foreach ($cart as $item) 
            {
                $foodid = $item['foodid'];
                $soluong = $item['soluong'];
                $chuthich = isset($item['note']) ? $item['note'] : '';

                $sql = "UPDATE sanpham SET soluong = soluong-$soluong WHERE ma_sanpham = $foodid";
                $data->query($sql);

                $sql = "SELECT * FROM sanpham WHERE ma_sanpham = '$foodid'";
                $result = $data->query($sql);
                $row = $result->fetch_assoc();

                $maSanPham = $row['ma_sanpham'];
                $tenSanPham = $row['tensanpham'];
                $gia = $row['giaban'];
                $donViTinh = $row['donvitinh'];
                $maGiamGia = $row['ma_giamgia'];

                $sqlGiamGia = "SELECT CONCAT(giatri, ' ', donvi) AS giamgia FROM giamgia WHERE ma_giamgia = '$maGiamGia'";
                $resultGiamGia = $data->query($sqlGiamGia);
                $rowGiamGia = $resultGiamGia->fetch_assoc();

                $giamGia = '';

                if ($resultGiamGia->num_rows > 0) {
                    $giamGia = $rowGiamGia['giamgia'];
                }
                if ($chuthich ==  '') {
                $sql = "INSERT INTO chitiethoadon (ma_hoadon, ma_sanpham, tensanpham, gia, soluong, donvitinh, giamgia)
                        VALUES ('$maHoaDon', '$maSanPham', '$tenSanPham', '$gia', '$soluong', '$donViTinh', '$giamGia')";}
                else {
                    $sql = "INSERT INTO chitiethoadon (ma_hoadon, ma_sanpham, tensanpham, gia, soluong, donvitinh, giamgia, chuthich)
                            VALUES ('$maHoaDon', '$maSanPham', '$tenSanPham', '$gia', '$soluong', '$donViTinh', '$giamGia', '$chuthich')";
                }
                $data->query($sql);
            }
                 
        $_SESSION['note'] = "";       
        $_SESSION['cart'] = array();
        $_SESSION['uudai'] = ""; 
        echo "true";
    } 
    else echo "false";
?>