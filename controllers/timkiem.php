<?php
    include_once('../Model/data.php');
    $keyword = $_POST['keyword'];
    $query = "SELECT ma_sanpham,tensanpham,hinhanh FROM sanpham 
              WHERE ma_sanpham LIKE '%$keyword%'  
              OR tensanpham LIKE '%$keyword%' 
              OR giaban LIKE '%$keyword%' 
              OR donvitinh LIKE '%$keyword%' 
              OR mota LIKE '%$keyword%' 
              OR hinhanh LIKE '%$keyword%' 
              OR danhsachhinhanh LIKE '%$keyword%'";
    
    $result = executeQuery($query);
    
    if ($result->num_rows > 0) {
        $searchResults = array();
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }
        echo json_encode($searchResults);
    } else {
        echo "";
    }
?>