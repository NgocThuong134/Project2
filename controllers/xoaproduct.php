<?php
    
    $maFood = $_GET['mafood'];
    $sql = "UPDATE sanpham SET soluong = -1 WHERE ma_sanpham = '$maFood'";
    $result = $data->query($sql);
    if ($result){
        echo "Xóa sản phẩm có mã $maFood thành công";
    }
    else echo "Xóa sản phẩm có mã $maFood thất bại";
    $data->close();
?>