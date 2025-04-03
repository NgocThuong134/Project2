<section class="bodyy">
    <section class="tieude">
        <a href="index.php">Trang chủ&nbsp;</a>
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
        include('Model/giohang.php');
        include("controllers/chitietmonan.php");
        ?>
    <section class="danhgia">
        <h2 style="padding: 10px 10px 10px 0">Đánh giá</h2>
        <div class="danh_gia_container">
            <?php
                 include("modals/ngoisao.php");
                ?>
        </div>
        <?php
                include("modals/binhluan.php"); 
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