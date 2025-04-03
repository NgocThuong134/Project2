<?php
    $mafood = $_GET['foodid'];
    $sql = "SELECT sosao, COUNT(*) AS total_danhgia
        FROM danhgia
        WHERE ma_sanpham = $mafood AND trangthai = 1
        GROUP BY sosao";
        $result = executeQuery($sql);
        $percentages = array();
        if ($result->num_rows > 0) {
            $totalCount = 0;
            $starCounts = array();
            
            while ($row = $result->fetch_assoc()) {
                $sosao = $row["sosao"];
                $total_danhgia = $row["total_danhgia"];
            
                $totalCount += $total_danhgia;
                $starCounts[$sosao] = $total_danhgia;
            }
            
           
            for ($i = 1; $i <= 5; $i++) {
                $percentages[$i] = 0;
            }

            foreach ($starCounts as $sosao => $count) {
                $percentage = round(($count / $totalCount) * 100);
                $percentages[$sosao] = $percentage;
            }
        }
        if ($percentages){
    echo '<div class="danh_gia_left">
    <div class="sao">
        <p>5</p>
        <span class="sao5">
            <span class="asao5" style="width:'.$percentages[5].'%"></span>
        </span>
    </div>
    <div class="sao">
        <p>4</p>
        <span class="sao4">
            <span class="asao4" style="width:'.$percentages[4].'%"></span>
        </span>
    </div>
    <div class="sao">
        <p>3</p>
        <span class="sao3">
            <span class="asao3" style="width:'.$percentages[3].'%"></span>
        </span>
    </div>
    <div class="sao">
        <p>2</p>
        <span class="sao2">
            <span class="asao2" style="width:'.$percentages[2].'%"></span>
        </span>
    </div>
    <div class="sao">
        <p>1</p>
        <span class="sao1">
            <span class="asao1" style="width:'.$percentages[1].'%"></span>
        </span>
    </div>
</div>';
}
$sql = "SELECT danhgia FROM sanpham WHERE ma_sanpham = $mafood";
$result = executeQuery($sql);
if ($result->num_rows>0){
    $row = $result->fetch_assoc();
    $danhgia = $row['danhgia'];
}
else $danhgia = 0;
$nguyen = floor($danhgia);
$sodu = ($danhgia - $nguyen) * 10;

echo '<div class="danh_gia_right">';
echo '<p>' . $danhgia . '</p>';
echo '<div class="ngoisao">';
for ($i = 1; $i <= 5; $i++) {
    if ($i <= $nguyen) {
        echo '<i class="bx bxs-star"></i>';
    } elseif ($i == ($nguyen + 1) && ($sodu >= 4 && $sodu <= 8)) {
        echo '<i class="bx bxs-star-half"></i>';
    } elseif ($i == ($nguyen + 1) && $sodu >8) {
        echo '<i class="bx bxs-star"></i>';
    }
    else {
        echo '<i class="bx bx-star"></i>';
    }
}
echo '</div>';
echo '</div>';
?>