<section class="bodyy">
    <section class="tieude">
        <a href="index.php">Trang chủ&nbsp;</a>
        <p>&nbsp;> Giỏ hàng</p>
    </section>
    <section class="body-gird">
        <div class="giohang">
            <h2>Giỏ hàng</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("controllers/show_giohang.php");
                        ?>
                </tbody>
            </table>
            <div class="bottom-table draggable">
                <div class="mauudai">
                    <label for="mauudai">Mã ưu đãi (nếu có):</label>
                    <input type="text" id="mauudai" name="maUd" placeholder="Mã ưu đãi..." <?php
                                    if (isset($_SESSION['uudai'])) {
                                        echo 'value="' . $_SESSION['uudai'] . '"';
                                        echo 'onchange="checkCoupon2(\'' . $_SESSION['uudai'] . '\')"';
                                    } else
                                        echo 'onchange="checkCoupon()"';
                                ?> />
                </div>
                <?php if (isset($_SESSION['uudai'])) { ?>
                <script>
                document.addEventListener("DOMContentLoaded", function() {
                    checkCoupon2('<?php echo $_SESSION['uudai']; ?>');
                });
                </script>
                <?php } ?>
                <p class="chitietuudai"></p>
                <div class="tongtien tongtientatca cochu">
                    <strong>Tổng tiền: </strong>
                    &nbsp;&nbsp;&nbsp;
                    <p style="color: green;"></p>
                </div>
                <div class="tongtien giamgia-sanpham cochu">
                    <strong>Tổng tiền giảm giá sản phẩm: </strong>
                    &nbsp;&nbsp;&nbsp;
                    <p style="color: #1da1f2;"></p>
                </div>
                <div class="tongtien giamgia-uudai cochu">
                    <strong>Tổng tiền giảm giá ưu đãi: </strong>
                    &nbsp;&nbsp;&nbsp;
                    <p style="color: #1da1f2;"></p>
                </div>
                <div class="tongtien tongtien-giamgia cochu">
                    <strong>Tổng tiền giảm giá: </strong>
                    &nbsp;&nbsp;&nbsp;
                    <p style="color: orange;"></p>
                </div>
                <div class="tongtien tongtien-thanhtoan">
                    <strong>Tổng tiền thanh toán: </strong>
                    &nbsp;&nbsp;&nbsp;
                    <p style="color: red;"></p>
                </div>
            </div>
        </div>
        <div class="thongtin">
            <?php
                include("thongtindonhang.php");
                ?>
        </div>
    </section>
</section>