<?php
    function checkSoluong($foodid){
        $sql = "SELECT soluong FROM sanpham WHERE ma_sanpham =  '$foodid'";
        return executeQuery($sql);
    }
    function sumSP(){
        $sql = "SELECT COUNT(*) AS soluong FROM sanpham WHERE soluong>=0";
        return executeQuery($sql);
    }
    function sumOutSP(){
        $sql = "SELECT COUNT(*) AS soluong FROM sanpham WHERE soluong>=0 AND soluong < 5";
        return executeQuery($sql);
    }
    function get_SanPham($masp){
        $sql = "SELECT * FROM sanpham WHERE ma_sanpham = $masp";
        return executeQuery($sql);
    }
    function taoMaSP(){
        $sql = "SELECT ma_sanpham FROM sanpham ORDER BY ma_sanpham DESC LIMIT 1";
        return executeQuery($sql);
    }
    function XoaSP($maFood){
        $sql = "UPDATE sanpham SET soluong = -1 WHERE ma_sanpham = '$maFood'";
        return executeStatement($sql);
    }
?>