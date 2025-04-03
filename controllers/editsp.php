<?php
    
    if ($result){
        $rowSP = $result->fetch_assoc();
        $maDM = $rowSP['ma_danhmuc'];
        echo '
        <div class="group">
        <label for="ma_sanpham">Mã sản phẩm</label><br>
        <input type="text" name="ma_sanpham" readonly id="ma_sanpham" value="' . $rowSP['ma_sanpham'] . '"><br>
        </div>
        <div class="group">
                        <label for="ten_sanpham">Tên sản phẩm</label><br>
                        <input type="text" name="" id="ten_sanpham" value="'.$rowSP['tensanpham'].'" required><br>
                    </div>
                    <div class="group">
                        <label for="soluong">Số lượng</label><br>
                        <input type="number" name="" id="soluong" min="0" max="2147483647" value="'.$rowSP['soluong'].'" required><br>
                    </div>
                    

                    <div class="group">
                        <label for="danhmuc">Danh mục</label><br>
                        <select name="danhmuc" id="danhmuc">';
                        if ($resultDanhMuc) {
                            while ($rowDanhMuc = mysqli_fetch_assoc($resultDanhMuc)) {
                                $maDanhMuc = $rowDanhMuc['ma_danhmuc'];
                                $tenDanhMuc = $rowDanhMuc['tendanhmuc'];
                                $selected = ($maDanhMuc == $maDM) ? 'selected' : '';
                                echo '<option value="' . $maDanhMuc . '" ' . $selected . '>' . $tenDanhMuc . '</option>';
                            }
                            mysqli_free_result($resultDanhMuc);
                        } 
                    echo '</select><br>
                    </div>

                    <div class="group">
                    <label for="donvitinh">Đơn vị tính</label><br>
                    <input type="text" name="donvitinh" id="donvitinh" value="'.$rowSP['donvitinh'].'"><br>
                    </div>
                    <div class="group">
                        <label for="giaban">Giá bán</label><br>
                        <input type="number" name="" id="giaban" min="0" max="2147483647" value="'.$rowSP['giaban'].'" required><br>
                    </div>
                    <div class="group">
                        <label for="giavon">Giá vốn</label><br>
                        <input type="number" name="" id="giavon" min="0" max="2147483647" value="'.$rowSP['giavon'].'" required><br>
                    </div>
                    <div class="group">
                        <label for="giamgia">Giảm giá</label><br>
                        <select name="giamgia" id="giamgia">';
                        if ($resultGiamGia) {
                            while ($rowGiamGia = mysqli_fetch_assoc($resultGiamGia)) {
                                $maGiamGia = $rowGiamGia['ma_giamgia'];
                                $giaTri = $rowGiamGia['giatri'];
                                $donVi = $rowGiamGia['donvi'];
                                $tenGiamGia = $giaTri ." ". $donVi;
                                $selected = ($maGiamGia == $rowSP['ma_giamgia']) ? 'selected' : '';
                                echo '<option value="' . $maGiamGia . '" ' . $selected . '>' . $tenGiamGia . '</option>';
                            }
                            mysqli_free_result($resultGiamGia);
                        } 
                    echo '</select><br>
                    </div>
                    </div>
                    <div class="anhsp">
                        <label for="anhsp">Ảnh sản phẩm</label><br>
                        <div class="taianh" onclick="selectFile()">
                            <i id="upload-icon" class="bx bxs-cloud-upload"></i>
                            <p id="label-anhsp">';
                            $hinhAnh = $rowSP['hinhanh'];
                            if  (empty($hinhAnh)){
                             echo 'Tải ảnh lên';}
                             else {echo $hinhAnh;}
                            echo '</p>
                            <input type="file" name="anhsp" id="anhsp" accept="image/*" onchange="displayImage(event)" value="'.$hinhAnh.'" hidden>
                        </div>
                        <span id="image-container">';
                        
                        if (!empty($hinhAnh)) {
                            echo '<img src="../images/' . $hinhAnh . '" alt="Ảnh sản phẩm">';
                        }
                        echo '</span>
                    </div>
                    <div class="motasp">
                        <label for="motasp">Mô tả sản phẩm</label><br>
                        <textarea name="motasp" id="motasp" rows="10"> '.$rowSP['mota'].'</textarea>
                    </div>
                    ';
                    }
?>