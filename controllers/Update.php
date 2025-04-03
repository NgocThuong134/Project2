<?php
    include_once('../Model/data.php');
    $query = $_GET['sql'];
    $result = executeStatement($query);
    if ($result){
        echo "Thêm thành công!";
    } else echo "Thêm thất bại!";
?>