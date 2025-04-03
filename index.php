<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style_banner.css">
    <link rel="stylesheet" href="css/style_dangnhap.css">
    <link rel="stylesheet" href="css/style_thucdon.css">
    <link rel="stylesheet" href="css/style_tintuc.css">
    <link rel="stylesheet" href="css/style_lienhe.css">
    <link rel="stylesheet" href="css/style_banner.css">
    <link rel="stylesheet" href="css/style_giohang.css">
    <link rel="stylesheet" href="css/lichsumuahang.css">
    <link rel="stylesheet" href="css/style_chitiet.css">
    <title>Trang chủ</title>
</head>

<body>
    <?php
    session_start();
    include("controllers/added.php");
    $productsCount = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $productsCount += $item['soluong'];
        }
    }
    include('view/header.php');
    ?>
    <?php
        if (isset($_GET['act'])) {
            $act = $_GET['act'];
        
            switch ($act) {
                case 'thucdon':
                    include 'view/thucdon.php';
                    break;
                case 'lienhe':
                    include 'view/lienhe.php';
                    break;
                case 'tintuc':
                    include 'view/tintuc.php';
                    break;
                case 'lsmh':
                    include 'view/lichsumuahang.php';
                    break;
                case 'giohang':
                    include 'view/giohang.php';
                    break;
                case 'chitietmonan':
                    include 'view/chitietmonan.php';
                    break;
                default:
                    include 'view/trangchu.php';
                    break;
        
            }
        } else {
            include 'view/trangchu.php';
        }
    ?>

    <?php
    include('view/form.php');
    include('view/show_avatar.php');
    include('view/footer.php');
    ?>
</body>
<script src="js/js_index.js"></script>
<script src="js/js_show.js"></script>
<script src="js/js_anhien.js"></script>
<script src="js/banner.js"></script>
<script src="js/lichsumuahang.js"></script>
<script src="js/js_tinhtien.js"> </script>
<script src="js/js_giohang.js"></script>

</html>