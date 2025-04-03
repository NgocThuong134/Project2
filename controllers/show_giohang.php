<?php
include('Model/giohang.php');
if (isset($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];

    foreach ($cartItems as $cartItem) {
        $foodId = $cartItem['foodid'];
        $soLuong= $cartItem['soluong'];
        $result = sanPham($foodId);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $foodId = $row['ma_sanpham'];

            $giamGiaResult = giamGiaSP($row['ma_giamgia']);
            $giamGiaRow = $giamGiaResult->fetch_assoc();
?>
<tr data-foodid="<?php echo $foodId; ?>">
    <td class="sanpham">
        <img src="images/<?php echo $row['hinhanh']; ?>" alt="Hình ảnh sản phẩm"
            onclick="window.location.href = '../pages/chitietmonan.php?foodid=<?php echo $foodId; ?>';">
        <span class="chuthich">
            <?php echo $row['tensanpham']; ?>
            <input type="text" class="chuthichmonan" data-foodid="<?php echo $foodId; ?>"
                placeholder="Nhập chú thích (nếu có)..." oninput="validateInput(this, 50, '<?php echo $foodId; ?>');" />
            <p id="chuthich-error-<?php echo $foodId; ?>" style="color: red; display: none;">Chú thích tối đa 50 ký tự!
            </p>
        </span>
    </td>
    <td>
        <div class="gia">
            <?php
    if (!is_null($giamGiaRow)) {
        if ($giamGiaRow['donvi'] === '%') {
            $giaban = $row['giaban'] * (1 - $giamGiaRow['giatri'] / 100);
            $giamgia = $giamGiaRow['giatri'];
        } else if ($giamGiaRow['donvi'] === 'VNĐ') {
            $giaban = $row['giaban'] - $giamGiaRow['giatri'];
            $giamgia = ($giamGiaRow['giatri'] / $row['giaban']) * 100;
        }
    } else {
        $giaban = $row['giaban'];
        $giamgia = 0;
    }
    ?>
            <span><?php echo number_format($giaban); ?> VNĐ</span>
            <?php if (!is_null($giamGiaRow)): ?>
            <span class="giamgia2">
                <strike><?php echo number_format($row['giaban']); ?> VNĐ</strike>
                &nbsp;
                <i class='bx bx-down-arrow-alt'></i>
                <p><?php echo number_format($giamgia,0);  ?> % </p>
            </span>
            <?php else: ?>
            <span class="giamgia2">
                <strike></strike>
            </span>
            <?php endif; ?>
        </div>
    </td>
    <td class="soluong">
        <input type="number" min="0" max="10" class="quantity-input" data-foodid="<?php echo $foodId; ?>"
            value="<?php echo $soLuong ?>">
        <i class='bx bxs-trash-alt'></i>
    </td>
    <td></td>
</tr>
<?php
        }
    }
} else {
    $cartItems = array();
}
$data->close();
?>