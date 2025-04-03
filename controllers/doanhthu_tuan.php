<?php

$currentYear = date('Y');
$currentMonth = date('n');
$currentDay = date('j');

$fromDate = date('Y-m-d', strtotime("-6 days")); 
$toDate = date('Y-m-d'); 

$result = doanhThuTuan($fromDate,$toDate);
$weeklyData = array_fill(1, 7, 0);

if ($result != NULL) {
    $date = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $date++; 
        $dailyTotal = $row['daily_total'];
        $weeklyData[$date] = $dailyTotal;
    }
}
?>