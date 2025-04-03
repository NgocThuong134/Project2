function CapnhatTrangthai(selectElement) {
  var madh = selectElement.getAttribute("data-madh");
  var selectedValue = selectElement.value;

  var trangthai;
  switch (selectedValue) {
    case "da_xu_ly":
      trangthai = "Đã xử lý";
      break;
    case "van_chuyen":
      trangthai = "Vận chuyển";
      break;
    case "dang_giao_hang":
      trangthai = "Đang giao hàng";
      break;
    case "hoan_thanh":
      trangthai = "Hoàn thành";
      break;
    case "da_huy":
      trangthai = "Đã hủy";
      break;
    case "tra_hang":
      trangthai = "Trả hàng";
      break;
  }
  var query =
    "UPDATE hoadon SET trangthai='" +
    trangthai +
    "' WHERE ma_hoadon='" +
    madh +
    "' ";
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "true") {
        alert("Cập nhật trạng thái thành công!");
        location.reload();
      } else {
        alert("Cập nhật trạng thái thất bại!");
      }
    }
  };
  xhttp.open("GET", "../controllers/delete.php?sql=" + query, true);
  xhttp.send();
}
var checkAll = document.getElementById("check-all");
var checkboxes = document.querySelectorAll(
  "#product-list input[type='checkbox']"
);

checkAll.addEventListener("change", function () {
  var isChecked = checkAll.checked;

  checkboxes.forEach(function (checkbox) {
    checkbox.checked = isChecked;
  });
});
document
  .getElementById("category-input")
  .addEventListener("change", function () {
    var category = this.value;
    console.log(category);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("product-list").innerHTML = this.responseText;
      }
    };
    xhttp.open(
      "GET",
      "../controllers/hienhoadon.php?category=" + category,
      true
    );
    xhttp.send();
  });
function SapXepTongTien() {
  var sapxemOption = document.getElementById("sapxep").value;
  var orderBy = "";
  switch (sapxemOption) {
    case "tang_dan":
      orderBy = "ORDER BY tongtien ASC";
      break;
    case "giam_dan":
      orderBy = "ORDER BY tongtien DESC";
      break;
    default:
      orderBy = "";
  }

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("product-list").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "../controllers/hienhoadon.php?orderby=" + orderBy, true);
  xhttp.send();
}
function SapXepTrangThai() {
  var sapxepOption = document.getElementById("sapxeptrangthai").value;
  var trangthai;
  switch (sapxepOption) {
    case "da_xu_ly":
      trangthai = "Đã xử lý";
      break;
    case "van_chuyen":
      trangthai = "Vận chuyển";
      break;
    case "dang_giao_hang":
      trangthai = "Đang giao hàng";
      break;
    case "hoan_thanh":
      trangthai = "Hoàn thành";
      break;
    case "da_huy":
      trangthai = "Đã hủy";
      break;
    case "tra_hang":
      trangthai = "Trả hàng";
      break;
    default:
      trangthai = "";
      break;
  }
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("product-list").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "../controllers/hienhoadon.php?tukhoa=" + trangthai, true);
  xhttp.send();
}

function TimkiemHoaDon() {
  var searchText = document.getElementById("search").value;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("product-list").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "../controllers/hienhoadon.php?tukhoa=" + searchText, true);
  xhttp.send();
}
