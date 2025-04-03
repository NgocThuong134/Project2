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
    xhttp.open("GET", "../controllers/hiennv.php?category=" + category, true);
    xhttp.send();
  });
function SapXepLuong() {
  var sapxemOption = document.getElementById("sapxem").value;
  var orderBy = "";
  switch (sapxemOption) {
    case "tang_dan":
      orderBy = "ORDER BY luong ASC";
      break;
    case "giam_dan":
      orderBy = "ORDER BY luong DESC";
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
    xhttp.open("GET", "../controllers/hiennv.php?orderby=" + orderBy, true);
    xhttp.send();
  }
}
function TimkiemNV() {
  var searchText = document.getElementById("search").value;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("product-list").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "../controllers/hiennv.php?tukhoa=" + searchText, true);
  xhttp.send();
}
function XoaNV(maNV) {
  var confirmed = confirm(
    "Bạn có chắc chắn muốn xóa nhân viên có mã " + maNV + " không?"
  );
  if (confirmed) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "true") {
          alert("Xóa nhân viên có mã " + maNV + " thành công");
          location.reload();
        } else alert("Xóa nhân viên có mã " + maNV + " thất bại!");
      }
    };
    var query =
      "UPDATE nhanvien SET trangthai = 1 WHERE ma_nhanvien=" + maNV + ";";
    xhttp.open("GET", "../controllers/delete.php?sql=" + query, true);
    xhttp.send();
  }
}
