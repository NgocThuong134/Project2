<?php
    include("../database/data.php");
    session_start();
    
    if (!isset($_SESSION['makhachhang'])){
        echo "chuadangnhap"; 
    }
    else {
    $makh = $_SESSION['makhachhang'];
    if ($data->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $data->connect_error);
    }
        $foodid = $_POST['foodid'];
        $mota = $_POST['mota'];
        $hinhAnhList = json_decode($_POST['hinhAnhList'],true);
        $selectedRating1 = $_POST['selectedRating1'];
        $selectedRating2 = $_POST['selectedRating2'];

        $imageAlts = array();
        $videoAlts = array();

        foreach ($hinhAnhList as $item) {
            if (strpos($item['alt'], 'image') === 0) {
                $alt = str_replace('image_', '', $item['alt']);
                $imageAlts[] = $alt;
                /* $srcPath = $item['src'];
                $dstPath = '../images/' . basename($srcPath);
                
                if (!file_exists($dstPath)) {
                    copy($srcPath, $dstPath);
                } */
            } elseif (strpos($item['alt'], 'video') === 0) {
                $videoAlts[] = $item['alt'];
                /* $srcPath = $item['src'];
                $dstPath = '../imges/' . basename($srcPath);
                
                if (!file_exists($dstPath)) {
                    copy($srcPath, $dstPath);
                } */
            }
        }

        $imageAltString = implode(', ', $imageAlts);
        $videoAltString = implode(', ', $videoAlts);
        $ngayDang = date('Y-m-d');
        
        $sql = "INSERT INTO binhluan (ma_khachhang, noidung, trangthai, sosao, hinhanh, video, ngaydang, ma_sanpham) 
        VALUES ('$makh', '$mota', 0, $selectedRating2, '$imageAltString', '$videoAltString', '$ngayDang','$foodid')";
        if ($data->query($sql) === TRUE) {
            $sqlDanhGia = "INSERT INTO danhgia(ma_sanpham,sosao,dichvu,trangthai) VALUES ('$foodid','$selectedRating2','$selectedRating1',1)";
            if ($data->query( $sqlDanhGia )===TRUE){
                $sqlSanPham = "SELECT AVG(sosao) AS tb FROM danhgia WHERE ma_sanpham = '$foodid'";
                $result = $data->query($sqlSanPham);
                $row = $result->fetch_assoc() ;
                $tbSoSao = $row['tb'];
                $sqlDichVu = "SELECT AVG(dichvu) AS dv FROM danhgia";
                $resultDv = $data->query($sqlDichVu);
                $rowDv = $resultDv->fetch_assoc();
                $tbDichVu = $rowDv['dv'];
                $sql = "UPDATE sanpham SET danhgia = $tbSoSao WHERE ma_sanpham = $foodid";
                $data->query( $sql );
                $sql = "UPDATE lienhe SET danhgia = $tbDichVu";
                $data->query($sql);
                echo "true";
            }
            else echo "false";
        } else {
            echo "false";
        }
    }
        $data->close();
?>