<?php
include('../Model/data.php');
include('../Model/khachhang.php');
include('../Model/product.php');
include('../Model/hoadon.php');
include('../Model/binhluan.php');
include('../Model/danhmuc.php');
include('../Model/giamgia.php');
session_start();
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        echo "<script>
                alert('Vui lòng đăng nhập!');
                window.location.href = 'admin_dangnhap.php';
            </script>";
        exit();
    }
    include('left.php');
    if (isset($_GET['act'])){
        $act = $_GET['act'];
        switch ($act):
            case 'sanpham':
                $result = showDanhMuc();
                include('sanpham/listSP.php');
                break;
            case 'themsp':
                if (isset($_GET['maSP']))
                {
                    $maSP = $_GET['maSP'];
                    $result = get_SanPham($maSP); 
                }
                $resultDanhMuc = get_DanhMuc();
                $resultGiamGia = get_GiamGia();
                include('sanpham/addSP.php');
                break;
            case 'xoasp':
                if (isset($_GET['mafood'])){
                        $masp = $_GET['mafood'];
                        
                        if (XoaSP($masp)){
                        echo "<script>alert('Xóa sản phẩm có mã $masp thành công')</script>";

                        }
                        else echo "<script>alert('Xóa sản phẩm có mã $masp thất bại')</script>";   
                    }
                    $result = showDanhMuc();
                    include('sanpham/listSP.php');
                break;
            default:
                include('right.php');
                break;
        endswitch;
    }
    else include('right.php');
?>