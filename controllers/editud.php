<?php
    include("../database/data.php");
    $maUD = $_GET['maUD'];
    $sql = "SELECT * FROM uudai WHERE ma_uudai = $maUD";
    $result = mysqli_query($data, $sql);
    
    if ($result) {
        $rowUD = $result->fetch_assoc();
        echo '
            <div class="group">
                <label for="ma_uudai">Mã ưu đãi</label><br>
                <input type="number" name="ma_uudai" readonly id="ma_uudai" value="' . $rowUD['ma_uudai'] . '"><br>
            </div>
            <div class="group">
            <label for="email">Tên ưu đãi</label><br>
            <input type="text" name="tenuudai" id="tenuudai" value="'.$rowUD['tenuudai'].'" required><br>
            </div>
            <div class="group">
                <label for="thoigianbatdau">Thời gian bắt đầu</label><br>
                <input type="datetime-local" name="thoigianbatdau" id="timestart" value="'.$rowUD['thoigianbatdau'].'" required><br>
            </div>
            <div class="group">
                <label for="thoigianketthuc">Thời gian kết thúc</label><br>
                <input type="datetime-local" name="thoigianketthuc" id="timeend" value="'.$rowUD['thoigianketthuc'].'"><br>
            </div>
            <div class="group">
                <label for="dieukien">Điều kiện</label><br>
                <input type="number" name="dieukien" id="dieukien" value="'.$rowUD['dieukien'].'" required><br>
            </div>
            <div class="group">
                <label for="giatri">Giá trị</label><br>
                <input type="number" name="giatri" id="giatri" value="'.$rowUD['giatri'].'" required><br>
            </div>
            <div class="group">
                <label for="donvitinh">Đơn vị tính</label><br>
                <select name="donvitinh" id="donvitinh">
                <option value="VNĐ" ';  if ($rowUD['donvitinh'] == 'VNĐ') echo 'selected';  echo '>VNĐ</option>
                <option value="%" '; if ($rowUD['donvitinh'] == '%') echo 'selected'; echo '>%</option>
                </select>
            </div>
            <div class="group">
                <label for="mota">Mô tả</label><br>
                <input type="text" name="mota" id="mota" value="'.$rowUD['mota'].'"><br>
            </div>
            <div class="group">
                <label for="diemtichluy">Điểm tích lũy</label><br>
                <input type="number" min="0" name="diemtichluy" id="diemtichluy" value="'.$rowUD['diemtichluy'].'"><br>
            </div>';
                }
    
    $data->close();
?>