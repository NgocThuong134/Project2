function addToCart(foodid, element) {
  foodid = parseInt(foodid);
  var inputElement =
    element.parentNode.nextElementSibling.querySelector("input");
  var soluong = inputElement.value;
  if (soluong > 0) {
    element.classList.add("added");
    AddPhp(foodid, soluong);
  } else {
    var confirmation = confirm("Bạn có muốn xóa mục hàng này khỏi giỏ hàng?");
    if (confirmation) {
      DeletePhp(foodid);
    }
  }
}
function addToCart2(foodid, soluong) {
  foodid = parseInt(foodid);
  AddPhp(foodid, soluong);
}
function AddPhp(foodid, soluong) {
  var xhr = new XMLHttpRequest();
  var url = "controllers/add_cart.php?foodid=" + foodid + "&soluong=" + soluong;
  xhr.open("GET", url, true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      if (xhr.responseText == "false") {
        alert("Món này không còn đủ số lượng bạn mua!");
      } else {
        location.reload();
      }
    }
  };
  xhr.send();
}
function DeletePhp(foodid) {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "./controllers/delete_cart.php?foodid=" + foodid, true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      location.reload();
    }
  };
  xhr.send();
}
function Search() {
  var keyword = document.getElementById("search").value.toLowerCase().trim();
  if (keyword != "") {
    var xhr = new XMLHttpRequest();
    var url = "controllers/timkiem.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var searchResultsContainer = document.getElementById("searchResults");
        var searchInput = document.getElementById("search");
        searchInput.style.borderRadius = "20px 20px 0 0";
        searchResultsContainer.classList.add("show-results");
        if (xhr.responseText !== "") {
          var searchResults = JSON.parse(xhr.responseText);

          if (searchResults.length > 0) {
            searchResultsContainer.innerHTML = "";
            for (var j = 0; j < searchResults.length; j++) {
              (function (j) {
                var searchResult = document.createElement("div");
                searchResult.classList.add("search-result");

                var productImage = document.createElement("img");
                var imagePath = "./images/" + searchResults[j].hinhanh;
                productImage.src = imagePath;
                productImage.alt = searchResults[j].tensanpham;

                searchResult.appendChild(productImage);
                searchResultsContainer.appendChild(searchResult);

                var productName = document.createElement("p");
                productName.textContent = searchResults[j].tensanpham;
                searchResult.appendChild(productName);

                searchResult.addEventListener("click", function (event) {
                  var foodId = searchResults[j].ma_sanpham;
                  window.location.href =
                    "index.php?act=chitietmonan&foodid=" + foodId;
                });
              })(j);
            }
          } else {
            searchResultsContainer.innerHTML =
              "<p>Không tìm thấy kết quả phù hợp.</p>";
          }
        } else {
          searchResultsContainer.innerHTML =
            "<p>Không tìm thấy kết quả phù hợp.</p>";
        }
      }
    };

    var tukhoa = "keyword=" + encodeURIComponent(keyword);
    xhr.send(tukhoa);
  } else {
    var searchResultsContainer = document.getElementById("searchResults");
    searchResultsContainer.classList.remove("show-results");
    var searchInput = document.getElementById("search");
    searchInput.style.borderRadius = "20px";
  }
}
function doimatkhau() {
  var password = document.querySelector(
    ".password-input[name='password-old']"
  ).value;
  var newPassword = document.querySelector(
    ".password-input[name='re-password']"
  ).value;
  var confirmNewPassword = document.querySelector(
    ".password-input[name='re2-password']"
  ).value;

  if (newPassword != confirmNewPassword) {
    var errorElements = document.querySelectorAll(".err-newpw");
    errorElements.forEach(function (element) {
      element.innerHTML = "Mật khẩu không khớp! Vui lòng nhập lại.";
    });
  } else {
    var xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      "./controllers/doimatkhau.php?pw=" + password + "&npw=" + newPassword,
      true
    );
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status == 200 && xhr.readyState === 4) {
        var response = xhr.responseText;
        if (response === "true") {
          alert("Cập nhật mật khẩu thành công.");
          window.location.href = "./index.php";
        } else {
          document.getElementById("err-pw").textContent =
            "Mật khẩu sai! Vui lòng nhập lại!";
        }
      }
    };
    xhr.send();
  }
}
function logout() {
  var xacnhan = confirm("Bạn có muốn đăng xuất không?");
  if (xacnhan) {
    window.location.href = "./controllers/logout.php";
  } else location.reload();
}
