<?php
    $datenow = date('Y-m-d'); 
    $rowsPerPage = 5;

    if (isset($_GET['page'])) {
        $currentPage = $_GET['page'];
    } else {
        $currentPage = 1;
    }
    $countResult = sumAllHoaDon($datenow);
    $countRow = mysqli_fetch_assoc($countResult);
    $totalRows = $countRow['total'];
    $totalPages = ceil($totalRows / $rowsPerPage);
    $startRow = ($currentPage - 1) * $rowsPerPage;

    $result = showHoaDon($datenow,$startRow,$rowsPerPage);
    if ($result->num_rows >0 )
    while ($row = mysqli_fetch_assoc($result)) { 
        echo '
        <tr>
            <td>#'.$row['ma_hoadon'].'</td>
            <td>'.$row['tenkh'].'</td>
            <td>'.$row['tennv'].'</td>
            <td>'.$row['ma_banan'].'</td>
            <td>'.number_format($row['tongtien']).' VNĐ</td>
            <td>'.$row['trangthai'].'</td>
        </tr>
        ';
    }
    echo '<tr><td colspan="6">';
    echo '<div class="pagination"> ';
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo '<a class="active" href="?page=' . $i . '">' . $i . '</a>';
        } else {
            echo '<a href="?page=' . $i . '">' . $i . '</a>';
        }
    } 
    echo '</div>';
    echo '</td></tr>';
    $data->close();
?>