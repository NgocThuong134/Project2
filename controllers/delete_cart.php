<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['foodid'])) {
        $foodid = $_GET['foodid'];

        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            // Kiểm tra xem $_SESSION['cart'] có phải là một mảng hợp lệ
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['foodid'] == $foodid) {
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    
                    break;
                }
            }
        } 
    }
} else {
    echo 'Phương thức không hợp lệ.';
}
?>