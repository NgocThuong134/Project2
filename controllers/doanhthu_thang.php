<?php
$monthlyData = array_fill(1, 12, 0);
$arrayTotal = [];
$currentYear = date('Y');
$currentMonth = date('n');

for ($i = 0; $i < 6; $i++) {
    $month = $currentMonth - $i;
    $year = $currentYear;

    if ($month <= 0) {
        $month += 12;
        $year--;
    }

    $fromdate = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01 00:00:00';
    $todate = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-31 23:59:59';
            
    $result = doanhThuThang($fromdate,$todate);

    if ($result != NULL) {
        $row = mysqli_fetch_assoc($result);
        $monthlyTotal = $row['monthly_total'];
        $monthlyData[$month] = $monthlyTotal;
        array_unshift($arrayTotal,$monthlyData[$month]); 
    }
}

?>