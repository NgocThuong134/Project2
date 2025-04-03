<section class="bodyy">
    <section class="tieude">
        <a href="../index.php">Trang chủ&nbsp;</a>
        <p>&nbsp;> Lịch sử mua hàng</p>
    </section>
    <section class="lichsu">
        <div class="trangthai">
            <label for="trangthai">Trạng thái:</label>
            <select name="status" id="status">
                <option value="all">Mặc định</option>
                <option value="dangxuly">Đang xử lý</option>
                <option value="vanchuyen">Vận chuyển</option>
                <option value="danggiaohang">Đang giao hàng</option>
                <option value="hoanthanh">Hoàn thành</option>
                <option value="dahuy">Đã hủy</option>
                <option value="trahang">Trả hàng</option>
            </select>
        </div>
        <div class="sapxep">
            <label for="sapxep">Sắp xếp:</label>
            <select name="sort" id="sort">
                <option value="default">Mặc định</option>
                <option value="ASC">Giá tăng dần</option>
                <option value="DESC">Giá giảm dần</option>
            </select>
        </div>
        <div class="ngay">
            <label for="tungay">Từ ngày: </label>
            <input type="date" name="date-start" id="date-start">
        </div>
        <div class="ngay">
            <label for="denngay">Đến ngày: </label>
            <input type="date" name="date-end" id="date-end">
        </div>
        <div class="search">
            <label for="timkiem">Tìm kiếm:</label>
            <input type="search" name="search" id="search-input" placeholder="Nhập tên, mã sản phẩm...">
        </div>
    </section>
    <section class="donhang">
        <table>
            <thead>
                <tr>
                    <th id="madohang">Mã đơn hàng</th>
                    <th id="ten">Tên món</th>
                    <th id="soluong">Số lượng</th>
                    <th id="dongia">Đơn giá</th>
                    <th id="giamgia">Giảm giá</th>
                    <th id="chuthich">Chú thích</th>
                    <th id="tongtien">Tổng tiền</th>
                    <th id="chucnang">Chức năng</th>
                </tr>
            </thead>
            <tbody id="show-table">
            </tbody>
        </table>
    </section>
</section>