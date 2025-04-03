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
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        document.getElementById("product-list").innerHTML = xhttp.responseText;
      }
    };
    xhttp.open(
      "GET",
      "../controllers/hiensp.php?act=sanpham&category=" + category,
      true
    );
    xhttp.send();
  });
function Timkiem() {
  var searchText = document.getElementById("search").value;
  if (searchText != "") {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("product-list").innerHTML = this.responseText;
      }
    };
    xhttp.open(
      "GET",
      "../controllers/hiensp.php?act=sanpham&tukhoa=" + searchText,
      true
    );
    xhttp.send();
  }
}
function SapXep() {
  var sapxemOption = document.getElementById("sapxem").value;
  var orderBy = "";
  switch (sapxemOption) {
    case "gia_tang":
      orderBy = "ORDER BY giaban ASC";
      break;
    case "gia_giam":
      orderBy = "ORDER BY giaban DESC";
      break;
    case "soluong_tang":
      orderBy = "ORDER BY soluong ASC";
      break;
    case "soluong_giam":
      orderBy = "ORDER BY soluong DESC";
      break;
    case "tensanpham":
      orderBy = "ORDER BY tensanpham ASC";
      break;
    default:
      orderBy = "";
  }
  if (orderBy != "") {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("product-list").innerHTML = this.responseText;
      }
    };
    xhttp.open(
      "GET",
      "../controllers/hiensp.php?act=sanpham&orderby=" + orderBy,
      true
    );
    xhttp.send();
  }
}
function DanhMuc() {
  var danhMucSelect = document.getElementById("danhmuc");
  var maDanhMuc = danhMucSelect.value;
  if (maDanhMuc != 0) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("product-list").innerHTML = this.responseText;
      }
    };
    xhttp.open(
      "GET",
      "../controllers/hiensp.php?act=sanpham&danhmuc=" + maDanhMuc,
      true
    );
    xhttp.send();
  }
}
function XoaSP(maSP) {
  var confirmed = confirm(
    "Bạn có chắc chắn muốn xóa sản phẩm có mã " + maSP + " không?"
  );
  if (confirmed) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        location.reload();
      }
    };
    xhttp.open("GET", "?act=xoasp&mafood=" + maSP, true);
    xhttp.send();
  }
}
