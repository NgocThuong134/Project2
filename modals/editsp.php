<?php
    echo '
    <div class="group">
                        <label for="ten_sanpham">Tên sản phẩm</label><br>
                        <input type="text" name="" id="ten_sanpham" required><br>
                    </div>
                    <div class="group">
                        <label for="soluong">Số lượng</label><br>
                        <input type="number" name="" id="soluong" min="0" max="2147483647" required><br>
                    </div>

                    <div class="group">
                        <label for="danhmuc">Danh mục</label><br>
                        <select name="danhmuc" id="danhmuc">';
                        $resultDanhMuc = get_DanhMuc();
                        if ($resultDanhMuc) {
                            echo '<option value="0">Chọn danh mục</option>';
                            while ($rowDanhMuc = mysqli_fetch_assoc($resultDanhMuc)) {
                                $maDanhMuc = $rowDanhMuc['ma_danhmuc'];
                                $tenDanhMuc = $rowDanhMuc['tendanhmuc'];
                                echo '<option value="' . $maDanhMuc . '">' . $tenDanhMuc . '</option>';
                            }
                            mysqli_free_result($resultDanhMuc);
                        } 
                    echo '</select><br>
                    </div>

                    <div class="group">
                        <label for="donvitinh">Đơn vị tính</label><br>
                        <input type="text" name="donvitinh" id="donvitinh" ><br>
                    </div>
                    <div class="group">
                        <label for="giaban">Giá bán</label><br>
                        <input type="number" name="" id="giaban" min="0" max="2147483647" required><br>
                    </div>
                    <div class="group">
                        <label for="giavon">Giá vốn</label><br>
                        <input type="number" name="" id="giavon" min="0" max="2147483647" required><br>
                    </div>
                    <div class="group">
                        <label for="giamgia">Giảm giá</label><br>
                        <select name="giamgia" id="giamgia">';
                        $resultGiamGia = get_GiamGia();
                        if ($resultGiamGia) {
                            echo '<option value="0">Chọn mã giảm giá</option>';
                            while ($rowGiamGia = mysqli_fetch_assoc($resultGiamGia)) {
                                $maGiamGia = $rowGiamGia['ma_giamgia'];
                                $giaTri = $rowGiamGia['giatri'];
                                $donVi = $rowGiamGia['donvi'];
                                $tenGiamGia = $giaTri ." ". $donVi;
                                echo '<option value="' . $maGiamGia . '">' . $tenGiamGia . '</option>';
                            }
                            mysqli_free_result($resultGiamGia);
                        } else {
                            echo 'Lỗi truy vấn giảm giá: ' . mysqli_error($data);
                        }
                    echo '</select><br>
                    </div>
                </div>
                <div class="anhsp">
                    <label for="anhsp">Ảnh sản phẩm</label><br>
                    <div class="taianh" onclick="selectFile()">
                        <i id="upload-icon" class="bx bxs-cloud-upload"></i>
                        <p id="label-anhsp">Tải ảnh lên</p>
                        <input type="file" name="anhsp" id="anhsp" accept="image/*" onchange="displayImage(event)"
                            hidden>
                    </div>
                    <span id="image-container"></span>
                </div>
                <div class="motasp">
                    <label for="motasp">Mô tả sản phẩm</label><br>
                    <textarea name="motasp" id="motasp" rows="10"></textarea>
                </div>
    ';
?>