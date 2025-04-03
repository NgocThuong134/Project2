<section class="right">
    <div class="bar">
        <i class='bx bx-bell'></i>
        <i class='bx bx-flag'></i>
        <img src="../images/banhchuoi.jpg" alt="anh dai dien">
        <p id="name">Thuong</p>
    </div>
    <div class="tieude">
        <p><a href="controllers.php?act=sanpham" style="color:black">Danh sách sản phẩm</a> > Thêm sản phẩm</p>
    </div>
    <div class="phan-vung">
        <form method="post">
            <div class="themchucnang">
                <div class="item" onclick="HienThiDanhMuc()">
                    <i class='bx bxs-folder-plus file'></i>
                    <p>Thêm danh mục</p>
                </div>
                <div class="item" onclick="HienThiMaGiamGia()">
                    <i class='bx bxs-folder-plus file'></i>
                    <p>Thêm mã giảm giá</p>
                </div>
            </div>
            <hr class="line">
            <div class="thongtin">
                <?php
                    if (isset($_GET['maSP'])){
                            include("../controllers/editsp.php");
                    } else  
                    {
                        include('../controllers/taoma.php');
                        include('../modals/editsp.php');
                    }
                ?>
                <div class="capnhat">
                    <button type="button" class="luulai" onclick="showSuccessMessage()">Lưu lại</button>
                    <button type="button" class="huybo" onclick="confirmCancellation()">Hủy bỏ</button>
                </div>
            </div>
        </form>
    </div>
</section>
<div class="themdanhmuc hide">
    <i class='bx bx-x close' onclick="DongDM()"></i>
    <div class="group-dm">
        <label for="tendanhmuc">Tên danh mục</label>
        <input type="text" name="tendanhmuc" id="tendanhmuc" placeholder="Nhập tên danh mục...">
    </div>
    <div class="group-dm">
        <label for="mota">Mô tả</label>
        <input type="text" name="mota" id="mota" placeholder="Mô tả danh mục...">
    </div>
    <div class="group-dm">
        <button type="button" onclick="ThemDanhMuc()">Thêm</button>
    </div>
</div>
<div class="themgiamgia hide">
    <i class='bx bx-x close' onclick="DongGG()"></i>
    <div class="group-dm">
        <label for="giatri">Giá trị</label>
        <input type="number" name="giatri" id="giatri" placeholder="Nhập giá trị giảm giá...">
    </div>
    <div class="group-dm">
        <label for="donvi">Đơn vị</label>
        <select name="donvi" id="donvi">
            <option value="VNĐ">VNĐ</option>
            <option value="%">%</option>
        </select>
    </div>
    <div class="group-dm">
        <button type="button" onclick="ThemGiamGia()">Thêm</button>
    </div>
</div>
</body>
<script src="../js/admineditsp.js">
</script>

</html>