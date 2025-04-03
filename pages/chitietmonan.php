<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_chitiet.css">
    <script src="../js/js_indexdif.js"></script>
    <link rel="stylesheet" href="../css/style_dangnhap.css">
    <title>Chi tiết món ăn</title>
</head>

<body>
    <?php
    session_start();
    include("../controllers/added.php");
    $productsCount = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $productsCount += $item['soluong'];
        }
    }
    ?>
    <section class="navbar">
        <div class="logo" title="Đặc sản miền tây">
            <a href="../index.php">
                <img src="../images/Logo.png" alt="">
            </a>
        </div>
        <div class="search">
            <input type="search" name="search" id="search" placeholder="Từ khóa tìm kiếm..." required>
            <i class='bx bx-search'></i>
        </div>
        <div class="user">
            <i class='bx bx-user'></i>
            <p>Đăng nhập</p>
        </div>
        <div class="user hide">
            <img style="height: 50px; width:50px;" src="" alt="Anh dai dien">
            <p class="name"></p>
            <div class="dropdown-menu">
                <ul>
                    <li><a href="../controllers/logout.php">Đăng xuất</a></li>
                    <li class="doimatkhau"><a>Đổi mật khẩu</a></li>
                    <li><a href="../pages/lichsumuahang.php">Lịch sử mua hàng</a></li>
                </ul>
            </div>
        </div>
        <div class="cart">
            <span class='sodonhang'><?php echo $productsCount; ?></span>
            <i class='bx bxs-cart-alt'></i>
            <a href="../pages/giohang.php">
                <p>Giỏ hàng</p>
            </a>
        </div>
    </section>
    <section class="bodyy">
        <section class="tieude">
            <a href="../index.php">Trang chủ&nbsp;</a>
            <p>&nbsp;> Chi tiết món ăn</p>
        </section>
        <?php
        function getFoodQuantity($foodId)
        {
            if (isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    if ($item['foodid'] == $foodId) {
                        return $item['soluong'];
                    }
                }
            }
            return 1;
        }
        include("../controllers/chitietmonan.php");
        ?>
        <section class="danhgia">
            <h2 style="padding: 10px 10px 10px 0">Đánh giá</h2>
            <div class="danh_gia_container">
                <?php
                 include("../modals/ngoisao.php");
                ?>
            </div>
            <?php
                include("../modals/binhluan.php"); 
            ?>
            <div id="danhgia" class="andanhgia">
                <div class="chatluong">
                    <div class="chatluongdichvu">
                        <h4>Chất lượng dịch vụ: </h4>
                        <div class="rating1">
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                        </div>
                    </div>
                    <div class="chatluongmonan">
                        <h4>Chất lượng món ăn:</h4>
                        <div class="rating2">
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                        </div>
                    </div>
                </div>
                <h2 style="padding-bottom: 10px;">Nhận xét</h2>
                <textarea placeholder="Mô tả trải nghiệm của bạn..." required></textarea>
                <div class="chucnang">
                    <div class="themanh">
                        <label for="hinhanh" onclick="uploadImages()">
                            <i class='bx bx-camera'></i>
                            <p>Thêm ảnh</p>
                        </label>
                        <input type="file" name="hinhanh" id="hinhanh" style="display:none" accept="image/*" multiple>
                    </div>
                    <div class="themvideo">
                        <label for="video" onclick="uploadVideo()">
                            <i class='bx bxl-youtube'></i>
                            <p>Thêm video</p>
                        </label>
                        <input type="file" name="video" id="video" style="display:none" accept="video/*">
                    </div>
                    <div class="Addimage">
                    </div>
                    <div class="huy" onclick="location.reload()">
                        <p>Hủy</p>
                    </div>
                    <div class="dang" onclick="Dang(<?php echo $_GET['foodid']; ?>)">
                        <p>Đăng</p>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <section class="body hide">
        <form action="../controllers/login.php" method="POST" class="form-dangnhap">
            <?php
            include("../modals/modal_login.php");
            ?>
            <i class="bx bx-x close-icon"></i>
        </form>
    </section>
    <section class="body body2 hide">
        <form action="../controllers/register.php" method="post" class="form-dangky" enctype="multipart/form-data">
            <?php
            include("../modals/modal_register.php");
            ?>
            <i class="bx bx-x close-icon"></i>
        </form>
    </section>
    <section class="body body3 hide">
        <form action="../controllers/guimail.php" method="post" class="fogot-password">
            <?php
            include("../modals/quenmatkhau.php");
            ?>
            <i class="bx bx-x close-icon"></i>
        </form>
    </section>
    <section class="body body4 hide">
        <form class="change-password">
            <?php
            include("../modals/doimatkhau.php");
            ?>
            <i class="bx bx-x close-icon"></i>
        </form>
    </section>
    <?php
    include_once("../modals/show_avatardif.php");
    ?>
    <?php
    include("../modals/footer.php");
    ?>
</body>
<script src="../js/js_show.js"></script>
<script src="../js/js_anhien.js"></script>

</html>