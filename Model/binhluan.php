<?php
        function sumBinhLuan1(){
            $countSql = "SELECT COUNT(*) AS total FROM binhluan WHERE trangthai = 1";
            return executeQuery($countSql);
        }
        function showBinhLuan($start, $end){
            $sql = "SELECT bl.*,kh.hovaten AS tenkh FROM binhluan AS bl
            LEFT JOIN khachhang AS kh ON bl.ma_khachhang = kh.ma_khachhang ORDER BY DATE(ngaydang) DESC
            LIMIT $start, $end";
            return executeQuery($sql);
        }
?>