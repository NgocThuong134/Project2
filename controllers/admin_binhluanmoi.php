<?php
    $rowsPerPage = 5;

    if (isset($_GET['page'])) {
        $currentPage = $_GET['page'];
    } else {
        $currentPage = 1;
    }
    
    $countResult = sumBinhLuan1();
    $countRow = mysqli_fetch_assoc($countResult);
    $totalRows = $countRow['total'];
    $totalPages = ceil($totalRows / $rowsPerPage);
    $startRow = ($currentPage - 1) * $rowsPerPage;

    $result = showBinhLuan($startRow,$rowsPerPage);
    if ($result->num_rows >0 )
    while ($row = mysqli_fetch_assoc($result)) { 
        if ($row['trangthai'] == 1 ){
            $trangthai = 'Đã duyệt';
        } else $trangthai = 'Chờ duyệt';
        echo '
        <tr>
            <td>#'.$row['ma_binhluan'].'</td>
            <td style="width:160px">'.$row['tenkh'].'</td>
            <td style="overflow-y:auto; width:200px; max-height: 30px">'.$row['noidung'].'</td>
            <td>'.$row['sosao'].'</td>
            <td>'.$trangthai.'</td>
        </tr>
        ';
    }
    echo '<tr><td colspan="5">';
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
?>