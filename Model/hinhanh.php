<?php
    function showBanner (){
        $sql = "SELECT banner FROM lienhe";
        return executeQuery($sql);
    }
    function showImg($start,$end){
        $query = "SELECT * FROM sanpham LIMIT $start,$end";
        return executeQuery($query);
    }
    function giamGia($discount) {
        $query = "SELECT giatri,donvi FROM giamgia WHERE ma_giamgia=$discount";
        return executeQuery($query);
    }
    function danhMuc($madm){
        $query = "SELECT * FROM sanpham where ma_danhmuc = $madm";
        return executeQuery($query);
    }
?>