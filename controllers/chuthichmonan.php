<?php
    $mafood = $_GET['maFood'];
    $notefood = $_GET['note'];
    session_start();
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['foodid'] == $mafood) {
            $item['note'] = $notefood;
            break; 
        }
    }
?>