<?php
    function sanPham($masp){
        $sql = "SELECT * FROM sanpham WHERE ma_sanpham = $masp";
        return executeQuery($sql);
    }
    function giamGiaSP($giamgia){
        $giamGiaSql = "SELECT * FROM giamgia WHERE ma_giamgia = '" . $giamgia . "'";
        return executeQuery($giamGiaSql);
    }
?>