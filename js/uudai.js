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
      "../controllers/hienuudai.php?category=" + category,
      true
    );
    xhttp.send();
  });
function SapXepUuDai() {
  var sapxepOption = document.getElementById("sapxep").value;
  console.log(sapxepOption);
  var orderBy = "";
  switch (sapxepOption) {
    case "tang_dan":
      orderBy = "ORDER BY giatri ASC";
      break;
    case "giam_dan":
      orderBy = "ORDER BY giatri DESC";
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
  xhttp.open("GET", "../controllers/hienuudai.php?orderby=" + orderBy, true);
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

function TimkiemUuDai() {
  var searchText = document.getElementById("search").value;
  console.log(searchText);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("product-list").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "../controllers/hienuudai.php?tukhoa=" + searchText, true);
  xhttp.send();
}
function XoaUD(maUD) {
  var confirmed = confirm(
    "Bạn có chắc chắn muốn xóa ưu đãi có mã " + maUD + " không?"
  );
  if (confirmed) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "true") {
          alert("Xóa ưu đãi có mã " + maUD + " thành công");
          location.reload();
        } else alert("Xóa ưu đãi có mã " + maUD + " thất bại!");
      }
    };
    var query = "UPDATE uudai SET giatri = 0 WHERE ma_uudai=" + maUD + ";";
    xhttp.open("GET", "../controllers/delete.php?sql=" + query, true);
    xhttp.send();
  }
}
