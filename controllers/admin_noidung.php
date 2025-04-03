<?php
    $result = soLuongKH();
    $row = mysqli_fetch_assoc($result);
    echo '
    <div class="tongquat">
    <div class="icon icon1">
        <i class="bx bx-user-circle"></i>
    </div>
    <div class="noidung">
        <p class="noidung1">TỔNG KHÁCH HÀNG</p>
        <p class="noidung2">'.$row['soluong'].' khách hàng</p>
        <hr>
        <p class="noidung3">Tổng số khách hàng quản lý</p>
    </div>
    </div>
    ';
    $result = sumSP();
    $row = mysqli_fetch_assoc($result);
    echo '
    <div class="tongquat">
        <div class="icon icon2">
            <i class="bx bxs-dish"></i>
        </div>
        <div class="noidung">
            <p class="noidung1">TỔNG SẢN PHẨM</p>
            <p class="noidung2">'.$row['soluong'].' sản phẩm</p>
            <hr>
            <p class="noidung3">Tổng số sản phẩm quản lý</p>
        </div>
    </div>
    ';
    $ngayhientai = date('Y-m-d'); 
    $result = sumHoaDon($ngayhientai);
    $row = mysqli_fetch_assoc($result);
    echo '
    <div class="tongquat">
    <div class="icon icon3">
        <i class="bx bxs-shopping-bag-alt"></i>
    </div>
    <div class="noidung">
        <p class="noidung1">TỔNG ĐƠN HÀNG</p>
        <p class="noidung2">'.$row['soluong'].' đơn hàng</p>
        <hr>
        <p class="noidung3">Tổng đơn hàng trong ngày '.date('d-m-Y').'</p>
    </div>
    </div>
    ';
    $result = sumOutSP();
    $row = mysqli_fetch_assoc($result);
    echo '
    <div class="tongquat">
        <div class="icon icon4">
            <i class="bx bxs-error"></i>
        </div>
        <div class="noidung">
            <p class="noidung1">SẮP HẾT HÀNG</p>
            <p class="noidung2">'.$row['soluong'].' sản phẩm</p>
            <hr>
            <p class="noidung3">Số sản phẩm  (<5) cần nhập thêm</p>
        </div>
    </div>
    ';
    $result = sumMoneyHoaDon0($ngayhientai);
    $row = mysqli_fetch_assoc($result);
    echo '
    <div class="tongquat">
        <div class="icon icon5">
        <i class="bx bxs-coin-stack"></i>
        </div>
        <div class="noidung">
            <p class="noidung1">DOANH THU ONLINE</p>
            <p class="noidung2">'.number_format($row['doanhthu']).' VNĐ</p>
            <hr>
            <p class="noidung3">Doanh thu đơn hàng online ngày '.date('d-m').'</p>
        </div>
    </div>
    ';
    $result = sumMoneyHoaDon1($ngayhientai);
    $row = mysqli_fetch_assoc($result);
    echo '
    <div class="tongquat">
        <div class="icon icon5">
        <i class="bx bxs-coin-stack"></i>
        </div>
        <div class="noidung">
            <p class="noidung1">DOANH THU TẠI QUÁN</p>
            <p class="noidung2">'.number_format($row['doanhthu']).' VNĐ</p>
            <hr>
            <p class="noidung3">Doanh thu đơn hàng tại quán ngày '.date('d-m').'</p>
        </div>
    </div>
    ';
?>