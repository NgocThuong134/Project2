<?php
    function sumHoaDon($ngay){
        $sql = "SELECT COUNT(*) AS soluong FROM hoadon where trangthai = 'Hoàn thành' AND DATE(thoigianxuat) = '$ngay'";
        return executeQuery($sql);
    }

    function sumAllHoaDon($ngay){
        $countSql = "SELECT COUNT(*) AS total FROM hoadon WHERE DATE(thoigiannhap)='$ngay'";
        return executeQuery($countSql);
    }
    function sumMoneyHoaDon0($ngay){
        $sql = "SELECT SUM(tongtien) AS doanhthu FROM hoadon WHERE trangthai = 'Hoàn thành' AND loaihoadon = 0 AND DATE(thoigianxuat) = '$ngay'";
        return executeQuery($sql);
    }
    function sumMoneyHoaDon1($ngay){
        $sql = "SELECT SUM(tongtien) AS doanhthu FROM hoadon WHERE trangthai = 'Hoàn thành' AND loaihoadon = 1 AND DATE(thoigianxuat) = '$ngay'";
        return executeQuery($sql);
    }

    function showHoaDon($day,$start,$end){
        $sql = "SELECT h.*,kh.hovaten AS tenkh, nv.hovaten AS tennv FROM hoadon AS h
    LEFT JOIN khachhang AS kh ON h.ma_khachhang = kh.ma_khachhang 
    LEFT JOIN nhanvien AS nv ON h.ma_nhanvien = nv.ma_nhanvien 
    WHERE DATE(thoigiannhap)='$day' ORDER BY thoigiannhap DESC
    LIMIT $start, $end";
    return executeQuery($sql);
    }
    function doanhThuTuan($from,$to){
        $sql = "SELECT SUM(`tongtien`) AS daily_total 
        FROM `hoadon` 
        WHERE trangthai='Hoàn thành' 
        AND `thoigianxuat` >= '{$from} 00:00:00' 
        AND `thoigianxuat` <= '{$to} 23:59:59'
        GROUP BY DATE(`thoigianxuat`)";
        return executeQuery($sql);
    }
    function doanhThuThang($from,$to){
        $sql = "SELECT SUM(`tongtien`) AS monthly_total 
        FROM `hoadon` 
        WHERE trangthai='Hoàn thành' AND `thoigianxuat` >= '{$from}' AND `thoigianxuat` <= '{$to}'";
        return executeQuery($sql);
    }
?>