// Lấy danh sách các nút xóa
var deleteButtons = document.querySelectorAll(".bx.bxs-trash-alt");

// Gắn sự kiện xóa hàng khi nhấn nút xóa
deleteButtons.forEach(function (button) {
  button.addEventListener("click", function () {
    var confirmed = confirm("Bạn có chắc chắn muốn xóa hàng này?");
    if (!confirmed) {
      return;
    }
    var row = this.parentNode.parentNode;
    row.parentNode.removeChild(row);
    calculateTotal();
    var foodId = row.dataset.foodid;
    DeletePhp(foodId);
  });
});

// Lấy danh sách các ô số lượng
var quantityInputs = document.querySelectorAll(".soluong input");

// Gắn sự kiện tính tổng tiền khi số lượng thay đổi
quantityInputs.forEach(function (input) {
  input.addEventListener("input", function () {
    var quantity = parseInt(this.value);
    if (quantity === 0) {
      var confirmed = confirm("Bạn có chắc chắn muốn xóa hàng này?");
      if (!confirmed) {
        this.value = 1;
        return;
      }
      var row = this.parentNode.parentNode;
      row.parentNode.removeChild(row);
      var foodId = row.dataset.foodid;
      DeletePhp(foodId);
    } else {
      var row = this.parentNode.parentNode;
      var foodId = row.dataset.foodid;
      addToCart2(foodId, quantity);
      calculateTotal();
    }
  });
});

// Lấy danh sách các ô số lượng
var quantityInputs = document.querySelectorAll(".quantity-input");

// Gắn sự kiện lưu giá trị số lượng khi thay đổi
quantityInputs.forEach(function (input) {
  var foodId = input.dataset.foodid;
  var storedValue = sessionStorage.getItem("quantity_" + foodId);
  if (storedValue) {
    input.value = storedValue;
  }
  input.addEventListener("input", function () {
    var quantity = parseInt(this.value);

    sessionStorage.setItem("quantity_" + foodId, quantity);
    calculateTotal();
  });
});

window.addEventListener("DOMContentLoaded", function () {
  quantityInputs.forEach(function (input) {
    var foodId = input.dataset.foodid;
    var storedValue = sessionStorage.getItem("quantity_" + foodId);
    if (storedValue) {
      input.value = storedValue;
    }
  });
  calculateTotal();
});

// Hàm cập nhật tổng tiền
function updateTotalAmounts(total, discount, voucher, totaldiscount, sumtotal) {
  var totalElements = document.querySelectorAll(".bottom-table .tongtien p");
  totalElements[0].textContent = formatCurrency(total) + " VNĐ";
  totalElements[1].textContent = formatCurrency(discount) + " VNĐ";
  totalElements[2].textContent = formatCurrency(voucher) + " VNĐ";
  totalElements[3].textContent = formatCurrency(totaldiscount) + " VNĐ";
  totalElements[4].textContent = formatCurrency(sumtotal) + " VNĐ";
}

// Hàm định dạng số tiền thành chuỗi có dấu phẩy
function formatCurrency(amount) {
  return amount.toLocaleString();
}

// Hàm tính tổng tiền
function calculateTotal() {
  var rows = document.querySelectorAll("tbody tr");
  var total = 0;
  var totaldiscount = 0;

  rows.forEach(function (row) {
    var discount = 0;
    var priceString = row.querySelector("td:nth-child(2) span").textContent;
    var price = parseInt(priceString.replace(/[^0-9]/g, ""));
    var quantity = parseInt(row.querySelector(".soluong input").value);
    var discountString = row.querySelector(".giamgia2 strike").textContent;
    if (discountString !== "") {
      discount +=
        (parseInt(discountString.replace(/[^0-9]/g, "")) - price) * quantity;
    }
    var subTotal = price * quantity;
    total += subTotal;
    totaldiscount += discount;
    row.querySelector("td:nth-child(4)").textContent =
      formatCurrency(subTotal) + " VNĐ";
  });
  total += totaldiscount;
  var sumtotal = total - totaldiscount;
  updateTotalAmounts(total, totaldiscount, 0, totaldiscount, sumtotal);
}

calculateTotal();
