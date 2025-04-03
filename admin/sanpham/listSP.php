<section class="right">
    <div class="bar">
        <i class='bx bx-bell'></i>
        <i class='bx bx-flag'></i>
        <img src="../images/banhchuoi.jpg" alt="anh dai dien">
        <p id="name">Thuong</p>
    </div>
    <div class="tieude">
        <p>Danh sách sản phẩm</p>
    </div>
    <div class="phan-vung">
        <div class="thanhtieude">
            <div class="item themsp">
                <i class='bx bx-plus'></i>
                <a href="controllers.php?act=themsp">Thêm sản phẩm</a>
            </div>
            <div class="item taifile">
                <i class='bx bxs-file-plus'></i>
                <p>Tải file</p>
            </div>
            <div class="item indulieu">
                <i class='bx bxs-printer'></i>
                <p>In dữ liệu</p>
            </div>
            <div class="item saochep">
                <i class='bx bxs-copy'></i>
                <p>Sao chép</p>
            </div>
            <div class="item xuatpdf">
                <i class='bx bxs-file-pdf'></i>
                <p>Xuất PDF</p>
            </div>
            <div class="item xoa">
                <i class='bx bxs-trash-alt'></i>
                <p>Xóa</p>
            </div>
        </div>
        <hr class="line">
        <div class="thanhbar">
            <div class="category">
                <label for="category-input">Hiện </label>
                <input type="number" id="category-input" min="1"
                    value="<?php echo isset($_GET['category']) ? $_GET['category'] : '5'; ?>" />
                <p>sản phẩm</p>
            </div>
            <div class="danhmuc">
                <label for="danhmuc">Danh mục: </label>
                <select id="danhmuc" name="danhmuc" onchange="DanhMuc()">
                    <option value="0">Mặc định</option>
                    <?php
                             if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                  echo '<option value="' . $row["ma_danhmuc"] . '">' . $row["tendanhmuc"] . '</option>';
                              }
                             }
                        ?>
                </select>
            </div>
            <div class="sapxep">
                <label for="sapxem">Sắp xếp: </label>
                <select id="sapxem" name="sapxem" onchange="SapXep()">
                    <option value="0">Mặc định</option>
                    <option value="tensanpham">Tên sản phẩm</option>
                    <option value="gia_tang">Giá tăng dần</option>
                    <option value="gia_giam">Giá giảm dần</option>
                    <option value="soluong_tang">Số lượng tăng dần</option>
                    <option value="soluong_giam">Số lượng giảm dần</option>
                </select>
            </div>
            <div class="timkiem">
                <label for="search">Tìm kiếm: </label>
                <input type="search" id="search" name="search" onchange="Timkiem()" />
            </div>
        </div>
        <div class="bangdulieu">
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox" id="check-all"></th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Số lượng</th>
                        <th>Đơn vị tính</th>
                        <th>Tình trạng</th>
                        <th>Giá tiền</th>
                        <th>Danh mục</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody id="product-list">
                    <?php
                        include("../controllers/hiensp.php");
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
</body>
<script src="../js/product.js"> </script>

</html>