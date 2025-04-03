<?php
    function showDanhMuc(){
        $sql = "SELECT ma_danhmuc, tendanhmuc FROM danhmuc";
        return executeQuery($sql);
    }
    function get_DanhMuc(){
        $sql = "SELECT * FROM danhmuc";
        return executeQuery($sql);
    }
?>