var saving = false;

window.addEventListener("beforeunload", function (event) {
  if (!saving) {
    event.preventDefault();
    event.returnValue = "";
    return "";
  }
});

function selectFile() {
  document.getElementById("anhsp").click();
}

function showSuccessMessage() {
  var maSanPham = document.getElementById("ma_sanpham").value;
  var tenSanPham = document.getElementById("ten_sanpham").value;
  var soLuong = document.getElementById("soluong").value;
  var danhMuc = document.getElementById("danhmuc").value;
  var donViTinh = document.getElementById("donvitinh").value;
  var giaBan = document.getElementById("giaban").value;
  var giaVon = document.getElementById("giavon").value;
  var giamGia = document.getElementById("giamgia").value;
  var moTaSanPham = document.getElementById("motasp").value;
  var fileAnhSP = document.getElementById("anhsp").files[0];

  var errorMessages = [];

  if (tenSanPham === null || tenSanPham === "") {
    errorMessages.push("Vui lòng nhập tên sản phẩm.");
  }

  if (soLuong === null || soLuong === "0") {
    errorMessages.push("Vui lòng nhập số lượng sản phẩm.");
  }

  if (danhMuc === null || danhMuc === "0") {
    errorMessages.push("Vui lòng chọn danh mục sản phẩm.");
  }

  if (donViTinh === null || donViTinh === "") {
    errorMessages.push("Vui lòng nhập đơn vị tính sản phẩm.");
  }

  if (giaBan === null || giaBan == 0) {
    errorMessages.push("Vui lòng nhập giá bán sản phẩm.");
  }

  if (giaVon === null || giaVon == 0) {
    errorMessages.push("Vui lòng nhập giá vốn sản phẩm.");
  }

  if (errorMessages.length > 0) {
    var errorMessageString = "Có lỗi xảy ra:\n";
    for (var i = 0; i < errorMessages.length; i++) {
      errorMessageString += "- " + errorMessages[i] + "\n";
    }
    alert(errorMessageString);
  } else {
    var url = "../controllers/admin_addproduct.php";
    url += "?ma_sanpham=" + encodeURIComponent(maSanPham);
    url += "&ten_sanpham=" + encodeURIComponent(tenSanPham);
    url += "&soluong=" + encodeURIComponent(soLuong);
    url += "&danhmuc=" + encodeURIComponent(danhMuc);
    url += "&donvitinh=" + encodeURIComponent(donViTinh);
    url += "&giaban=" + encodeURIComponent(giaBan);
    url += "&giavon=" + encodeURIComponent(giaVon);
    url += "&giamgia=" + encodeURIComponent(giamGia);
    url += "&motasp=" + encodeURIComponent(moTaSanPham);
    if (fileAnhSP) {
      url += "&anhsp=" + encodeURIComponent(fileAnhSP.name);
    }
    fetch(url)
      .then(function (response) {
        return response.text();
      })
      .then(function (data) {
        alert(data);
        location.reload();
      })
      .catch(function (error) {
        alert(error);
      });
  }
}
function showSuccessMessage2() {
  // Lấy giá trị từ các trường nhập liệu
  var maKhachHang = document.getElementById("ma_khachhang").value;
  var hoVaTen = document.getElementById("hovaten").value;
  var soDienThoai = document.getElementById("sodienthoai").value;
  var email = document.getElementById("email").value;
  var ngaySinh = document.getElementById("ngaysinh").value;
  var gioiTinh = document.getElementById("giotinh").value;
  var diaChi = document.getElementById("diachi").value;
  var diemTichLuy = document.getElementById("diemtichluy").value;
  var fileAnhSP = document.getElementById("anhsp").files[0];

  var errorMessages = [];
  if (hoVaTen === null || hoVaTen === "") {
    errorMessages.push("Vui lòng nhập họ và tên.");
  }

  if (soDienThoai === null || soDienThoai === "") {
    errorMessages.push("Vui lòng nhập số điện thoại.");
  } else if (soDienThoai.length < 10 || soDienThoai.length > 11) {
    errorMessages.push("Số điện thoại phải có từ 10 đến 11 ký tự.");
  }

  if (email === null || email === "") {
    errorMessages.push("Vui lòng nhập email.");
  }

  if (ngaySinh === null || ngaySinh === "") {
    errorMessages.push("Vui lòng nhập ngày sinh.");
  } else {
    var today = new Date();
    var birthDate = new Date(ngaySinh);
    var age = today.getFullYear() - birthDate.getFullYear();
    var monthDiff = today.getMonth() - birthDate.getMonth();
    if (
      monthDiff < 0 ||
      (monthDiff === 0 && today.getDate() < birthDate.getDate())
    ) {
      age--;
    }
    if (age < 18) {
      errorMessages.push("Tuổi phải lớn hơn hoặc bằng 18.");
    }
  }

  if (gioiTinh === null || gioiTinh === "") {
    errorMessages.push("Vui lòng chọn giới tính.");
  }

  if (diaChi === null || diaChi === "") {
    errorMessages.push("Vui lòng nhập địa chỉ.");
  }

  if (diemTichLuy === null || diemTichLuy === "") {
    errorMessages.push("Vui lòng nhập điểm tích lũy.");
  }

  if (errorMessages.length > 0) {
    var errorMessageString = "Có lỗi xảy ra:\n";
    for (var i = 0; i < errorMessages.length; i++) {
      errorMessageString += "- " + errorMessages[i] + "\n";
    }
    alert(errorMessageString);
  } else {
    var url = "../controllers/admin_addcustomer.php";
    url += "?ma_khachhang=" + encodeURIComponent(maKhachHang);
    url += "&hovaten=" + encodeURIComponent(hoVaTen);
    url += "&sodienthoai=" + encodeURIComponent(soDienThoai);
    url += "&email=" + encodeURIComponent(email);
    url += "&ngaysinh=" + encodeURIComponent(ngaySinh);
    url += "&giotinh=" + encodeURIComponent(gioiTinh);
    url += "&diachi=" + encodeURIComponent(diaChi);
    url += "&diemtichluy=" + encodeURIComponent(diemTichLuy);
    if (fileAnhSP) {
      url += "&anhsp=" + encodeURIComponent(fileAnhSP.name);
    }
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
function showSuccessMessage3() {
  // Lấy giá trị từ các trường nhập liệu
  var maNhanVien = document.getElementById("ma_nhanvien").value;
  var hoVaTen = document.getElementById("hovaten").value;
  var soDienThoai = document.getElementById("sodienthoai").value;
  var email = document.getElementById("email").value;
  var ngaySinh = document.getElementById("ngaysinh").value;
  var gioiTinh = document.getElementById("gioitinh").value;
  var chucVu = document.getElementById("chucvu").value;
  var luong = document.getElementById("luong").value;

  var errorMessages = [];
  // Kiểm tra tính hợp lệ của các giá trị

  if (hoVaTen === null || hoVaTen === "") {
    errorMessages.push("Vui lòng nhập họ và tên.");
  }

  if (soDienThoai === null || soDienThoai === "") {
    errorMessages.push("Vui lòng nhập số điện thoại.");
  } else if (soDienThoai.length < 10 || soDienThoai.length > 11) {
    errorMessages.push("Số điện thoại phải có từ 10 đến 11 ký tự.");
  }

  if (email === null || email === "") {
    errorMessages.push("Vui lòng nhập email.");
  }

  if (ngaySinh === null || ngaySinh === "") {
    errorMessages.push("Vui lòng nhập ngày sinh.");
  } else {
    // Kiểm tra tuổi hợp lệ
    var today = new Date();
    var birthDate = new Date(ngaySinh);
    var age = today.getFullYear() - birthDate.getFullYear();
    var monthDiff = today.getMonth() - birthDate.getMonth();
    if (
      monthDiff < 0 ||
      (monthDiff === 0 && today.getDate() < birthDate.getDate())
    ) {
      age--;
    }
    if (age < 18) {
      errorMessages.push("Tuổi phải lớn hơn hoặc bằng 18.");
    }
  }

  if (gioiTinh === null || gioiTinh === "") {
    errorMessages.push("Vui lòng chọn giới tính.");
  }

  if (chucVu === null || chucVu === "") {
    errorMessages.push("Vui lòng nhập chức vụ.");
  }

  if (luong === null || luong === "") {
    errorMessages.push("Vui lòng nhập lương.");
  }

  if (errorMessages.length > 0) {
    var errorMessageString = "Có lỗi xảy ra:\n";
    for (var i = 0; i < errorMessages.length; i++) {
      errorMessageString += "- " + errorMessages[i] + "\n";
    }
    alert(errorMessageString);
  } else {
    // Gửi dữ liệu đến máy chủ
    var url = "../controllers/admin_addnv.php";
    url += "?ma_nhanvien=" + encodeURIComponent(maNhanVien);
    url += "&hovaten=" + encodeURIComponent(hoVaTen);
    url += "&sodienthoai=" + encodeURIComponent(soDienThoai);
    url += "&email=" + encodeURIComponent(email);
    url += "&ngaysinh=" + encodeURIComponent(ngaySinh);
    url += "&gioitinh=" + encodeURIComponent(gioiTinh);
    url += "&chucvu=" + encodeURIComponent(chucVu);
    url += "&luong=" + encodeURIComponent(luong);
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
function selectFile() {
  document.getElementById("anhsp").click();
}

function displayImage(event) {
  var file = event.target.files[0];
  var reader = new FileReader();
  reader.onload = function (e) {
    var img = document.createElement("img");
    img.src = e.target.result;

    var imageContainer = document.getElementById("image-container");
    imageContainer.appendChild(img);

    var label = document.getElementById("label-anhsp");
    label.textContent = file.name;

    var uploadIcon = document.getElementById("upload-icon");
    uploadIcon.style.display = "none";
  };
  reader.readAsDataURL(file);
}
function HienThiDanhMuc() {
  var danhMucDiv = document.querySelector(".themdanhmuc");
  danhMucDiv.classList.remove("hide");
  var rightSec = document.querySelector(".right");
  rightSec.style.backgroundColor = "gray";
}
function HienThiMaGiamGia() {
  var maGiamGiaDiv = document.querySelector(".themgiamgia");
  maGiamGiaDiv.classList.remove("hide");
  var rightSec = document.querySelector(".right");
  rightSec.style.backgroundColor = "gray";
}
function DongDM() {
  var themDanhMucDiv = document.querySelector(".themdanhmuc");
  themDanhMucDiv.classList.add("hide");
  var rightSec = document.querySelector(".right");
  rightSec.style.backgroundColor = "";
}
function DongGG() {
  var themGiamGia = document.querySelector(".themgiamgia");
  themGiamGia.classList.add("hide");
  var rightSec = document.querySelector(".right");
  rightSec.style.backgroundColor = "";
}
function ThemDanhMuc() {
  var tenDanhMucInput = document.getElementById("tendanhmuc");
  var moTaInput = document.getElementById("mota");

  var tenDanhMuc = tenDanhMucInput.value;
  var moTa = moTaInput.value;
  if (tenDanhMuc != "") {
    var url = "../controllers/kiemtra.php";
    var sql = "SELECT * FROM danhmuc WHERE  tendanhmuc='" + tenDanhMuc + "'";
    url += "?query=" + encodeURIComponent(sql);
    fetch(url)
      .then(function (response) {
        return response.text();
      })
      .then(function (data) {
        console.log(data);
        if (data == "false") alert("Đã tồn tại!");
        else {
          url = "../controllers/Update.php";
          sql =
            "INSERT INTO danhmuc(tendanhmuc,mota) VALUES ('" +
            tenDanhMuc +
            "','" +
            moTa +
            "')";
          url += "?sql=" + sql;
          fetch(url)
            .then(function (response) {
              return response.text();
            })
            .then(function (data) {
              alert(data);
              location.reload();
            })
            .catch(function (error) {
              alert(error);
            });
        }
      })
      .catch(function (error) {
        alert(error);
      });
  } else {
    alert("Vui lòng nhập tên danh mục!");
  }
}
function ThemGiamGia() {
  var giaTriInput = document.getElementById("giatri");
  var donViSelect = document.getElementById("donvi");

  var giaTri = giaTriInput.value;
  var donVi = donViSelect.value;
  if (giaTri != "" && donVi != "") {
    var url = "../controllers/Update.php";
    var sql =
      "INSERT INTO giamgia(giatri,donvi) VALUES ('" +
      giaTri +
      "','" +
      donVi +
      "')";
    url += "?sql=" + sql;
    console.log(url);
    fetch(url)
      .then(function (response) {
        return response.text();
      })
      .then(function (data) {
        alert(data);
        location.reload();
      })
      .catch(function (error) {
        alert(error);
      });
  } else {
    alert("Vui lòng nhập giá trị và đơn vị!");
  }
}
