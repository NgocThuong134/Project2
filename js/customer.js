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
    xhttp.open("GET", "../controllers/hienkh.php?category=" + category, true);
    xhttp.send();
  });
function SapXepDiemTichLuy() {
  var sapxemOption = document.getElementById("sapxem").value;
  var orderBy = "";
  switch (sapxemOption) {
    case "tang_dan":
      orderBy = "ORDER BY diemtichluy ASC";
      break;
    case "giam_dan":
      orderBy = "ORDER BY diemtichluy DESC";
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
    xhttp.open("GET", "../controllers/hienkh.php?orderby=" + orderBy, true);
    xhttp.send();
  }
}
function TimkiemKH() {
  var searchText = document.getElementById("search").value;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("product-list").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "../controllers/hienkh.php?tukhoa=" + searchText, true);
  xhttp.send();
}
function XoaKH(maKH) {
  var confirmed = confirm(
    "Bạn có chắc chắn muốn xóa khách hàng có mã " + maKH + " không?"
  );
  if (confirmed) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "true") {
          alert("Xóa khách hàng có mã " + maKH + " thành công");
          location.reload();
        } else alert("Xóa khách hàng có mã " + maKH + " thất bại!");
      }
    };
    var query =
      "UPDATE khachhang SET email = NULL WHERE ma_khachhang=" + maKH + ";";
    xhttp.open("GET", "../controllers/delete.php?sql=" + query, true);
    xhttp.send();
  }
}
