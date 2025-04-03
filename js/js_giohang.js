var closeButton = document.querySelector(".close-icon");
closeButton.addEventListener("click", function () {
  closeSession();
});
function closeSession() {
  document.querySelector(".xacnhan").style.visibility = "hidden";
  location.reload();
}
function limitInput(input) {
  input.value = input.value.replace(/[^0-9]/g, "");

  if (input.value.length > 6) {
    input.value = input.value.slice(0, 6);
  } else {
    document.getElementById("thongbao-xacnhan").textContent = "";
  }
}
function thanhtoan() {
  var tongTienGiamGia = parseInt(
    document.querySelector(".tongtien-giamgia p").textContent.replace(/\./g, "")
  );
  var tongTienThanhToan = parseInt(
    document
      .querySelector(".tongtien-thanhtoan p")
      .textContent.replace(/\./g, "")
  );

  var xhr = new XMLHttpRequest();
  var url = "../controllers/thanhtoan.php";
  var params =
    "tongTienGiamGia=" +
    encodeURIComponent(tongTienGiamGia) +
    "&tongTienThanhToan=" +
    encodeURIComponent(tongTienThanhToan);
  console.log(params);
  xhr.open("GET", url + "?" + params, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200 && xhr.readyState === 4) {
      console.log(xhr.responseText);
      if (xhr.responseText === "true") {
        window.history.back();
      } else {
        alert("Thanh toán thất bại!");
      }
    } else {
      alert("Đã xảy ra lỗi trong quá trình gửi yêu cầu.");
    }
  };

  xhr.send();
}
function XacNhanDonHang(email) {
  fetch("../controllers/guimail-xacnhan.php", {
    method: "POST",
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      console.log(data);
      document.querySelector(".xacnhan").style.visibility = "visible";
      document.getElementById("thongbao-mail").textContent =
        "Mã xác nhận đã được gửi tới: " + maskEmail(email);
      CountDown();
      var maXN = data.maXN;
      document
        .getElementById("xacnhan-button")
        .addEventListener("click", function () {
          var maxacnhanValue = document.getElementById("maxacnhan-input").value;
          if (maXN == maxacnhanValue) {
            alert(
              "Bạn đã xác nhận đơn hàng thành công.\n Đơn hàng của bạn sẽ xử lý và gửi tới bạn sớm nhất.\n Cảm ơn bạn!"
            );
            thanhtoan();
          } else {
            document.getElementById("thongbao-xacnhan").textContent =
              "Mã xác nhận không đúng! Vui lòng thử lại!";
            return;
          }
        });
    })
    .catch(function (error) {
      console.log(error);
    });
}
function CountDown() {
  var remainingSeconds = 60;
  var countdownElement = document.getElementById("countdown");

  var countdown = setInterval(function () {
    if (remainingSeconds < 0) {
      clearInterval(countdown);
      var confirmResend = confirm(
        "Hết thời gian xác nhận đơn hàng. Bạn có muốn gửi lại mã xác nhận không?"
      );
      if (confirmResend) {
        XacNhanDonHang();
      } else {
        location.reload();
      }
    }
    if (remainingSeconds >= 0) {
      countdownElement.innerHTML =
        "Thời gian còn lại: <span style='color:red; font-size:20px; font-weight:bold;'>" +
        remainingSeconds +
        "</span> giây";
    }
    remainingSeconds--;
  }, 1000);
}
document
  .querySelector(".form-muahang")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    var tongTienThanhToan = document.querySelector(
      ".tongtien-thanhtoan p"
    ).textContent;

    if (parseInt(tongTienThanhToan) > 0) {
      var email = thongtin();
      XacNhanDonHang(email);
    } else {
      alert("Giỏ hàng của bạn đang trống!");
    }
  });
function maskEmail(email) {
  var parts = email.split("@");
  var username = parts[0];
  var domain = parts[1];

  var usernameLength = username.length;
  var maskedUsername =
    username[0] + "*".repeat(usernameLength - 2) + username[usernameLength - 1];

  return maskedUsername + "@" + domain;
}
var notes = {};

function validateInput(input, maxLength, foodid) {
  var inputValue = input.value;
  if (inputValue.length >= maxLength) {
    document.getElementById("chuthich-error-" + foodid).style.display = "block";
    input.value = notes[foodid] || "";
  } else {
    notes[foodid] = inputValue;
    document.getElementById("chuthich-error-" + foodid).style.display = "none";
  }
}

function handleBlur(event) {
  var foodid = event.target.getAttribute("data-foodid");
  var xhr = new XMLHttpRequest();
  var url = "../controllers/chuthichmonan.php";
  var params =
    "maFood=" +
    encodeURIComponent(foodid) +
    "&note=" +
    encodeURIComponent(notes[foodid]);
  xhr.open("GET", url + "?" + params, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.readyState == 4 && xhr.status == "200") {
    }
  };
  xhr.send();
}

var inputElements = document.querySelectorAll(".chuthichmonan");
inputElements.forEach(function (inputElement) {
  inputElement.addEventListener("blur", handleBlur);
});

function checkCoupon() {
  var couponInput = document.getElementById("mauudai");
  var couponCode = couponInput.value;
  var tongtien = parseInt(
    document.querySelector(".tongtientatca p").textContent.replace(/\./g, "")
  );
  var giamgiasanpham = parseInt(
    document.querySelector(".giamgia-sanpham p").textContent.replace(/\./g, "")
  );

  if (couponCode != "") {
    var xhr = new XMLHttpRequest();
    var url = "../controllers/uudai.php";
    var params =
      "maUd=" +
      encodeURIComponent(couponCode) +
      "&tongtien=" +
      encodeURIComponent(tongtien);
    xhr.open("GET", url + "?" + params, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200 && xhr.readyState === 4) {
        var response = JSON.parse(xhr.responseText);
        if ("error" in response) {
          // Xử lý khi có lỗi
          var chitietuudai = document.querySelector(".chitietuudai");
          chitietuudai.textContent = response.error;
          chitietuudai.style.color = "red";
          chitietuudai.style.paddingBottom = "5px";
          updateTotalAmounts(
            tongtien,
            giamgiasanpham,
            0,
            giamgiasanpham,
            tongtien - giamgiasanpham
          );
        } else if ("discount" in response) {
          // Xử lý khi có thông tin giảm giá
          var chitietuudai = document.querySelector(".chitietuudai");
          document.querySelector(".giamgia-uudai p").textContent =
            formatCurrency(parseInt(response.discount)) + " VNĐ";
          chitietuudai.innerHTML =
            response.description +
            "<br>Bạn được giảm giá: " +
            formatCurrency(parseInt(response.discount)) +
            " VNĐ";
          chitietuudai.style.color = "blue";
          var giamgiauudai = parseInt(
            document
              .querySelector(".giamgia-uudai p")
              .textContent.replace(/\./g, "")
          );
          document.querySelector(".tongtien-giamgia p").textContent =
            formatCurrency(giamgiauudai + giamgiasanpham) + " VNĐ";
          updateTotalAmounts(
            tongtien,
            giamgiasanpham,
            giamgiauudai,
            giamgiasanpham + giamgiauudai,
            tongtien - (giamgiasanpham + giamgiauudai)
          );
        } else {
          // Xử lý khi không có kết quả hợp lệ
          var chitietuudai = document.querySelector(".chitietuudai");
          chitietuudai.textContent = "Kết quả không hợp lệ.";
          chitietuudai.style.color = "red";
          chitietuudai.style.padding = "5px";
        }
      }
    };
    xhr.send();
  } else {
    var chitietuudai = document.querySelector(".chitietuudai");
    chitietuudai.innerHTML = "";
    chitietuudai.style.padding = "0";
  }
}

function checkCoupon2(mauudai) {
  var couponInput = document.getElementById("mauudai").value;
  if (couponInput != mauudai) {
    var couponCode = couponInput;
  } else {
    var couponCode = mauudai;
  }
  var tongtien = parseInt(
    document.querySelector(".tongtientatca p").textContent.replace(/\./g, "")
  );
  var giamgiasanpham = parseInt(
    document.querySelector(".giamgia-sanpham p").textContent.replace(/\./g, "")
  );

  if (couponCode != "") {
    var xhr = new XMLHttpRequest();
    var url = "../controllers/uudai.php";
    var params =
      "maUd=" +
      encodeURIComponent(couponCode) +
      "&tongtien=" +
      encodeURIComponent(tongtien);
    xhr.open("GET", url + "?" + params, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200 && xhr.readyState === 4) {
        var response = JSON.parse(xhr.responseText);
        if ("error" in response) {
          // Xử lý khi có lỗi
          var chitietuudai = document.querySelector(".chitietuudai");
          chitietuudai.textContent = response.error;
          chitietuudai.style.color = "red";
          chitietuudai.style.paddingBottom = "5px";
          updateTotalAmounts(
            tongtien,
            giamgiasanpham,
            0,
            giamgiasanpham,
            tongtien - giamgiasanpham
          );
        } else if ("discount" in response) {
          // Xử lý khi có thông tin giảm giá
          var chitietuudai = document.querySelector(".chitietuudai");
          document.querySelector(".giamgia-uudai p").textContent =
            formatCurrency(parseInt(response.discount)) + " VNĐ";
          chitietuudai.innerHTML =
            response.description +
            "<br>Bạn được giảm giá: " +
            formatCurrency(parseInt(response.discount)) +
            " VNĐ";
          chitietuudai.style.color = "blue";
          var giamgiauudai = parseInt(
            document
              .querySelector(".giamgia-uudai p")
              .textContent.replace(/\./g, "")
          );
          document.querySelector(".tongtien-giamgia p").textContent =
            formatCurrency(giamgiauudai + giamgiasanpham) + " VNĐ";
          updateTotalAmounts(
            tongtien,
            giamgiasanpham,
            giamgiauudai,
            giamgiasanpham + giamgiauudai,
            tongtien - (giamgiasanpham + giamgiauudai)
          );
        } else {
          // Xử lý khi không có kết quả hợp lệ
          var chitietuudai = document.querySelector(".chitietuudai");
          chitietuudai.textContent = "Kết quả không hợp lệ.";
          chitietuudai.style.color = "red";
          chitietuudai.style.paddingBottom = "5px";
        }
      }
    };
    xhr.send();
  } else {
    var chitietuudai = document.querySelector(".chitietuudai");
    chitietuudai.innerHTML = "";
    chitietuudai.style.padding = "0";
  }
}
function thongtin() {
  var fullnameInput = document.getElementById("fullname");
  var phoneInput = document.getElementById("phone");
  var addressInput = document.getElementById("address");
  var emailInput = document.getElementById("email");
  var noteTextarea = document.getElementById("note");

  var fullname = fullnameInput.value;
  var phone = phoneInput.value;
  var address = addressInput.value;
  var email = emailInput.value;
  var note = noteTextarea.value;
  var xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "../controllers/thongtin_nhanhang.php?fullname=" +
      encodeURIComponent(fullname) +
      "&phone=" +
      encodeURIComponent(phone) +
      "&address=" +
      encodeURIComponent(address) +
      "&email=" +
      encodeURIComponent(email) +
      "&note=" +
      encodeURIComponent(note)
  );
  xhr.onload = function () {
    if (xhr.status === 200) {
    }
  };
  xhr.send();
  return email;
}
