function showSuccessMessage() {
  // Lấy giá trị từ các trường nhập liệu
  var maUuDai = document.getElementById("ma_uudai").value;
  var tenUuDai = document.getElementById("tenuudai").value;
  var timestart = document.getElementById("timestart").value;
  var timeend = document.getElementById("timeend").value;
  var dieukien = document.getElementById("dieukien").value;
  var giatri = document.getElementById("giatri").value;
  var donvitinh = document.getElementById("donvitinh").value;
  var mota = document.getElementById("mota").value;
  var diemtichluy = document.getElementById("diemtichluy").value;

  var errorMessages = [];

  if (tenUuDai === null || tenUuDai === "") {
    errorMessages.push("Vui lòng nhập tên ưu đãi.");
  }

  if (timestart === null || timestart === "") {
    errorMessages.push("Vui lòng chọn thời gian bắt đầu.");
  }

  if (timeend === null || timeend === "") {
    errorMessages.push("Vui lòng chọn thời gian kết thúc.");
  }

  if (dieukien === null || dieukien === "") {
    errorMessages.push("Vui lòng nhập điều kiện.");
  }

  if (giatri === null || giatri === "") {
    errorMessages.push("Vui lòng nhập giá trị.");
  }

  if (donvitinh === null || donvitinh === "") {
    errorMessages.push("Vui lòng nhập đơn vị tính.");
  }

  if (errorMessages.length > 0) {
    var errorMessageString = "Có lỗi xảy ra:\n";
    for (var i = 0; i < errorMessages.length; i++) {
      errorMessageString += "- " + errorMessages[i] + "\n";
    }
    alert(errorMessageString);
  } else {
    // Gửi dữ liệu đến máy chủ
    var url = "../controllers/admin_addud.php";
    url += "?ma_uudai=" + encodeURIComponent(maUuDai);
    url += "&ten_uudai=" + encodeURIComponent(tenUuDai);
    url += "&thoigianbatdau=" + encodeURIComponent(timestart);
    url += "&thoigianketthuc=" + encodeURIComponent(timeend);
    url += "&dieukien=" + encodeURIComponent(dieukien);
    url += "&giatri=" + encodeURIComponent(giatri);
    url += "&donvitinh=" + encodeURIComponent(donvitinh);
    url += "&mota=" + encodeURIComponent(mota);
    url += "&diemtichluy=" + encodeURIComponent(diemtichluy);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        alert(this.responseText);
        location.reload();
      }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
  }
}
function confirmCancellation() {
  var confirmed = confirm("Bạn có chắc chắn muốn hủy bỏ?");
  if (confirmed) {
    location.reload();
  }
}
function KiemTraUuDai() {
  var tenuudai = document.getElementById("tenuudai").value;
  var query =
    "SELECT tenuudai FROM uudai WHERE tenuudai =" + "'" + tenuudai + "'";
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "false") {
        alert("Ưu đãi này đã tồn tại!\n Vui lòng nhập tên ưu đãi khác!");
        document.getElementById("tenuudai").value = "";
      }
    }
  };
  xhttp.open("GET", "../controllers/kiemtra.php?query=" + query, true);
  xhttp.send();
}
