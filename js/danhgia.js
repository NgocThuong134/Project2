function CapnhatTrangthai(selectElement) {
  var mabl = selectElement.getAttribute("data-mabl");
  var selectedValue = selectElement.value;

  var query =
    "UPDATE binhluan SET trangthai='" +
    selectedValue +
    "' WHERE ma_binhluan='" +
    mabl +
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
      "../controllers/hiendanhgia.php?category=" + category,
      true
    );
    xhttp.send();
  });
function TrangThai() {
  var TrangThaiSelect = document.getElementById("sapxep");
  var trangthai = TrangThaiSelect.value;
  if (trangthai != null) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        document.getElementById("product-list").innerHTML = this.responseText;
      }
    };
    xhttp.open(
      "GET",
      "../controllers/hiendanhgia.php?trangthai=" + trangthai,
      true
    );
    xhttp.send();
  } else location.reload();
}
function TimkiemDanhGia() {
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
      "../controllers/hiendanhgia.php?tukhoa=" + searchText,
      true
    );
    xhttp.send();
  }
}
