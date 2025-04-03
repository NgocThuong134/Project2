<?php
    include("../database/data.php");
    $maKH = $_GET['maKH'];
    $sql = "SELECT * FROM khachhang WHERE ma_khachhang = $maKH";
    $result = mysqli_query($data, $sql);  
    if ($result){
        $rowSP = $result->fetch_assoc();
        echo '
        <div class="group">
        <label for="ma_khachhang">Mã khách hàng</label><br>
        <input type="text" name="ma_khachhang" readonly id="ma_khachhang" value="' . $rowSP['ma_khachhang'] . '"><br>
        </div>
        <div class="group">
                        <label for="ten_sanpham">Tên khách hàng</label><br>
                        <input type="text" name="" id="hovaten" value="'.$rowSP['hovaten'].'" required><br>
                    </div>
                    <div class="group">
                        <label for="soluong">Số điện thoại</label><br>
                        <input type="text" name="" id="sodienthoai" value="'.$rowSP['sodienthoai'].'" required><br>
                    </div>
                    
                    <div class="group">
                        <label for="emai">Email</label><br>
                        <input type="text" name="" id="email" value="'.$rowSP['email'].'" required><br>
                    </div>
                    <div class="group">
                        <label for="giaban">Ngày sinh</label><br>
                        <input type="date" name="" id="ngaysinh" value="'.$rowSP['ngaysinh'].'" required><br>
                    </div>
                    <div class="group">
                    <label for="giaban">Giới tính</label><br>
                    <select name="giotinh" id="giotinh">
                        <option value="0" ';  if ($rowSP['gioitinh'] == 0) echo 'selected';  echo '>Nữ</option>
                    <option value="1" '; if ($rowSP['gioitinh'] == 1) echo 'selected'; echo '>Nam</option>
                    </select>
                    </div>
                    <div class="group">
                        <label for="donvitinh">Địa chỉ</label><br>
                        <input type="text" name="donvitinh" id="diachi" value="'.$rowSP['diachi'].'"><br>
                    </div>
                    <div class="group">
                        <label for="giaban">Điểm tích lũy</label><br>
                        <input type="number" name="" id="diemtichluy" value="'.$rowSP['diemtichluy'].'" required><br>
                    </div>
                    <div class="anhsp">
                        <label for="anhsp">Ảnh đại diện</label><br>
                        <div class="taianh" onclick="selectFile()">
                            <i id="upload-icon" class="bx bxs-cloud-upload"></i>
                            <p id="label-anhsp">';
                                $hinhAnh = $rowSP['anhdaidien'];
                                if (empty($hinhAnh)){
                                echo 'Tải ảnh lên';}
                                else {echo $hinhAnh;}
                                echo '</p>
                            <input type="file" name="anhsp" id="anhsp" accept="image/*" onchange="displayImage(event)" value="'.$hinhAnh.'"
                                hidden>
                        </div>
                        <span id="image-container">';

                            if (!empty($hinhAnh)) {
                            echo '<img src="../avatars/' . $hinhAnh . '" alt="Ảnh sản phẩm">';
                            }
                            echo '</span>
                    </div>                    ';
                    }
                    $data->close();
                    ?>