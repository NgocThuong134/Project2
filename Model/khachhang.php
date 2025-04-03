<?php
    function soLuongKH(){
        $sql = "SELECT COUNT(*) AS soluong FROM khachhang";
        return executeQuery($sql);
    }
?>