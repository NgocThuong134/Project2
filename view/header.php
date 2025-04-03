<section class="navbar">
    <div class="logo" title="Đặc sản miền tây">
        <a href="#">
            <img src="images/Logo.png" alt="">
        </a>
    </div>
    <div class="search">
        <input type="search" name="search" id="search" placeholder="Từ khóa tìm kiếm..." oninput="Search()">
        <i class='bx bx-search'></i>
        <div id="searchResults" class="search-results"></div>
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
                <li><a href="#" onclick="logout()">Đăng xuất</a></li>
                <li class="doimatkhau"><a>Đổi mật khẩu</a></li>
                <li><a href="index.php?act=lsmh">Lịch sử mua hàng</a></li>
            </ul>
        </div>
    </div>
    <div class="cart">
        <span class='sodonhang'><?php echo $productsCount; ?></span>
        <i class='bx bxs-cart-alt'></i>
        <a href="index.php?act=giohang">
            <p>Giỏ hàng</p>
        </a>
    </div>
</section>
<section class="panner">
    <div class="slide-show">
        <div class="list-images">
            <?php
                    include 'showimg/showbanner.php';
                    $row = $result->fetch_assoc();
                    $banners =explode(",", $row['banner']);
                    foreach ($banners as $banner) {
                        echo '<img src="banner/' . $banner . '" alt="">';
                    }
            ?>
        </div>
        <div class="btns">
            <div class="btn-left btn"><i class='bx bx-chevron-left'></i></div>
            <div class="btn-right btn"><i class='bx bx-chevron-right'></i></div>
        </div>
        <div class="index-images">
            <div class="index-item index-item-0 active"></div>
            <div class="index-item index-item-1"></div>
            <div class="index-item index-item-2"></div>
            <div class="index-item index-item-3"></div>
        </div>
    </div>
</section>
<section class="task-menu">
    <div class="home">
        <a href="index.php">
            <i class='bx bxs-home'></i>
            <p>Trang chủ</p>
        </a>
    </div>
    <div class="menu">
        <a href="index.php?act=thucdon">
            <i class='bx bx-menu'></i>
            <p>Thực đơn</p>
        </a>
    </div>
    <div class="information">
        <a href="index.php?act=tintuc">
            <i class='bx bxs-info-circle'></i>
            <p>Tin tức</p>
        </a>
    </div>
    <div class="contact">
        <a href="index.php?act=lienhe">
            <i class='bx bxs-phone'></i>
            <p>Liên hệ</p>
        </a>
    </div>
</section>