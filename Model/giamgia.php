<?php
    function get_GiamGia(){
        $sqlGiamGia = "SELECT * FROM giamgia";
        return executeQuery($sqlGiamGia);
    }
?>