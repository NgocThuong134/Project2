<?php
session_start();
include('../Model/data.php');
include('../Model/product.php');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['foodid'])) {
        $foodid = $_GET['foodid'];
        $soluong = $_GET['soluong'];
        
        $result = checkSoluong($foodid);
        $row = mysqli_fetch_assoc($result);
        $soluongFood = $row['soluong'];
        if ($soluongFood >= $soluong) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $found = false;
        foreach ($_SESSION['cart'] as $key => $item) {
            // Nếu foodid trùng khớp, cập nhật số lượng
            if ($item['foodid'] == $foodid) {
                $_SESSION['cart'][$key]['soluong'] = $soluong;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = array(
                'foodid' => $foodid,
                'soluong' => $soluong,
                'note' => ''
            );
        }

        $_SESSION['cart'] = array_unique($_SESSION['cart'], SORT_REGULAR);} 
        else{
            echo "false";
        }
    }
} else {
    echo 'Phương thức không hợp lệ.';
}
?>