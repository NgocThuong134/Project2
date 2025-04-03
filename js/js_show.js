var closeButtons = document.querySelectorAll(".close-icon");
var bodies = document.querySelectorAll(".body, .body2, .body3, .body4");
var dangnhap = document.querySelector(".user");
var dangky = document.querySelector(".dangky-link");
var quenmk = document.querySelector(".forgot-pw");
var doimk = document.querySelector(".doimatkhau");

doimk.addEventListener("click", function () {
  bodies[3].classList.remove("hide");
});

quenmk.addEventListener("click", function () {
  bodies[0].classList.add("hide");
  bodies[1].classList.add("hide");
  bodies[2].classList.remove("hide");
});

dangky.addEventListener("click", function () {
  bodies[0].classList.add("hide");
  bodies[1].classList.remove("hide");
});

dangnhap.addEventListener("click", function () {
  bodies[0].classList.remove("hide");
});

closeButtons.forEach(function (closeButton) {
  closeButton.addEventListener("click", function () {
    closeSession();
  });
});
function closeAllBodies() {
  bodies.forEach(function (body) {
    body.classList.add("hide");
  });
}

function closeSession() {
  closeAllBodies();
}
//--------------------------------------------------------------

window.addEventListener("DOMContentLoaded", function () {
  var anhchinh = document.querySelector(".anhchinh");
  var anhchinhImage = anhchinh.querySelector("img");

  var anhThumbnails = document.querySelectorAll(".hinh_anh p:not(.anhchinh)");

  anhThumbnails.forEach(function (anhThumbnail) {
    anhThumbnail.addEventListener("click", function (event) {
      var previousAnhchinhImageSrc = anhchinhImage.getAttribute("src");
      var previousAnhchinhImageAlt = anhchinhImage.getAttribute("alt");

      var clickedImage = event.target;
      var clickedImageSrc = clickedImage.getAttribute("src");
      var clickedImageAlt = clickedImage.getAttribute("alt");

      anhchinhImage.setAttribute("src", clickedImageSrc);
      anhchinhImage.setAttribute("alt", clickedImageAlt);

      clickedImage.setAttribute("src", previousAnhchinhImageSrc);
      clickedImage.setAttribute("alt", previousAnhchinhImageAlt);
    });
  });
});
let selectedRating1 = 0;
let selectedRating2 = 0;
document.addEventListener("DOMContentLoaded", function () {
  const rating1 = document.querySelector(".rating1");
  const rating2 = document.querySelector(".rating2");

  const stars1 = rating1.querySelectorAll("i");
  const stars2 = rating2.querySelectorAll("i");

  stars1.forEach((star, index) => {
    star.addEventListener("mouseover", () => {
      for (let i = 0; i <= index; i++) {
        stars1[i].style.color = "yellow";
      }
    });

    star.addEventListener("mouseout", () => {
      for (let i = 0; i < stars1.length; i++) {
        if (i < selectedRating1) {
          stars1[i].style.color = "yellow";
        } else {
          stars1[i].style.color = "";
        }
      }
    });

    star.addEventListener("click", () => {
      selectedRating1 = index + 1;
    });
  });

  stars2.forEach((star, index) => {
    star.addEventListener("mouseover", () => {
      for (let i = 0; i <= index; i++) {
        stars2[i].style.color = "yellow";
      }
    });

    star.addEventListener("mouseout", () => {
      for (let i = 0; i < stars2.length; i++) {
        if (i < selectedRating2) {
          stars2[i].style.color = "yellow";
        } else {
          stars2[i].style.color = "";
        }
      }
    });

    star.addEventListener("click", () => {
      selectedRating2 = index + 1;
    });
  });
});

function kiemTraDanhSachHinhAnh(danhSach) {
  var count = 0;

  for (var i = 0; i < danhSach.length; i++) {
    if (isImage(danhSach[i].src)) {
      count++;
    }
  }

  return count === 4;
}

function kiemTraDanhSachVideo(danhSach) {
  var hasVideo = false;

  for (var i = 0; i < danhSach.length; i++) {
    if (!isImage(danhSach[i].src)) {
      hasVideo = true;
      break;
    }
  }

  return hasVideo;
}
function demHinhAnh(danhSach) {
  var dem = 0;
  for (var i = 0; i < danhSach.length; i++) {
    if (isImage(danhSach[i].src)) {
      dem++;
    }
  }
  return dem;
}
function updateAddAnhHTML() {
  var addAnhHTML = "";

  if (
    !kiemTraDanhSachHinhAnh(hinhAnhList) &&
    !kiemTraDanhSachVideo(hinhAnhList)
  ) {
    addAnhHTML = `
      <div class="addanh">           
        <label for="hinhanh" onclick="uploadImages()">               
          <i class='bx bx-camera'></i>               
          <p>${4 - demHinhAnh(hinhAnhList)}/4</p>           
        </label>            
        <input type="file" name="hinhanh" id="hinhanh" style="display:none" accept="image/*" multiple>       
      </div>       
      <div class="addvideo">           
        <label for="video" onclick="uploadVideo()">               
          <i class='bx bxl-youtube'></i>               
          <p>1/1</p>           
        </label>           
        <input type="file" name="video" id="video" style="display:none" accept="video/*">       
      </div>`;
  } else if (
    !kiemTraDanhSachHinhAnh(hinhAnhList) &&
    kiemTraDanhSachVideo(hinhAnhList)
  ) {
    addAnhHTML = `
      <div class="addanh">           
        <label for="hinhanh" onclick="uploadImages()">               
          <i class='bx bx-camera'></i>               
          <p>${4 - demHinhAnh(hinhAnhList)}/4</p>           
        </label>            
        <input type="file" name="hinhanh" id="hinhanh" style="display:none" accept="image/*" multiple>       
      </div>`;
  } else if (
    kiemTraDanhSachHinhAnh(hinhAnhList) &&
    !kiemTraDanhSachVideo(hinhAnhList)
  ) {
    addAnhHTML = `
      <div class="addvideo">           
        <label for="video" onclick="uploadVideo()">               
          <i class='bx bxl-youtube'></i>               
          <p>1/1</p>           
        </label>           
        <input type="file" name="video" id="video" style="display:none" accept="video/*">       
      </div>`;
  }

  return addAnhHTML;
}
function isImage(filename) {
  var extension;
  if (filename.startsWith("data:image/")) {
    extension = filename.split("/")[1].split(";")[0];
  } else {
    extension = filename.split(".").pop().toLowerCase();
  }

  return ["jpg", "jpeg", "png", "gif"].includes(extension);
}
function renderHinhAnhList() {
  anhTaiLenDiv.innerHTML = "";
  videoTaiLenDiv.innerHTML = "";

  hinhAnhList.forEach(function (imgObj, index) {
    var src = imgObj.src;
    var alt = imgObj.alt;
    if (isImage(src)) {
      var imgWrapper = document.createElement("div");
      imgWrapper.classList.add("anh-item");
      var imgElement = document.createElement("img");
      imgElement.src = src;
      imgElement.alt = alt;
      imgWrapper.appendChild(imgElement);

      var deleteIcon = document.createElement("span");
      deleteIcon.classList.add("delete-icon");
      deleteIcon.textContent = "x";
      imgWrapper.appendChild(deleteIcon);

      anhTaiLenDiv.appendChild(imgWrapper);

      deleteIcon.addEventListener("click", function () {
        var imageContainer = deleteIcon.parentNode;
        imageContainer.parentNode.removeChild(imageContainer);
        hinhAnhList.splice(index, 1);
        renderHinhAnhList();
      });
    } else {
      var videoWrapper = document.createElement("div");
      videoWrapper.classList.add("anh-item");
      var videoElement = document.createElement("video");
      videoElement.src = src;
      videoElement.alt = alt;
      videoWrapper.appendChild(videoElement);

      var deleteIcon = document.createElement("span");
      deleteIcon.classList.add("delete-icon");
      deleteIcon.textContent = "x";
      videoWrapper.appendChild(deleteIcon);

      anhTaiLenDiv.appendChild(videoWrapper);

      deleteIcon.addEventListener("click", function () {
        var videoContainer = deleteIcon.parentNode;
        videoContainer.parentNode.removeChild(videoContainer);
        hinhAnhList.splice(index, 1);
        renderHinhAnhList();
      });
    }
  });
  var themAnhDiv = document.querySelector(".chucnang");
  themAnhDiv.style.alignItems = "center";
  themAnhDiv.style.position = "relative";
  var nutHuy = document.querySelector(".huy");
  nutHuy.style.position = "absolute";
  nutHuy.style.right = "115px";
  var nutDang = document.querySelector(".dang");
  nutDang.style.position = "absolute";
  nutDang.style.right = "5px";
  addAnh.innerHTML = updateAddAnhHTML();
}
var hinhAnhList = [];
var anhTaiLenDiv = document.querySelector(".themanh");
var videoTaiLenDiv = document.querySelector(".themvideo");
var addAnh = document.querySelector(".Addimage");
var loadFun = true;
function uploadImages() {
  if (loadFun) {
    var inputHinhAnh = document.getElementById("hinhanh");

    inputHinhAnh.addEventListener("change", function (event) {
      var files = event.target.files;
      if (files.length > 4 || demHinhAnh(hinhAnhList) + files.length > 4) {
        alert("Bạn chỉ được tải lên tối đa 4 ảnh.");
        loadFun = false;
        return;
      }

      for (var i = 0; i < files.length; i++) {
        var file = files[i];
        if (file) {
          var reader = new FileReader();

          reader.addEventListener("load", function (e) {
            var image = document.createElement("img");
            image.src = e.target.result;
            var fileName = file.name;
            var extension = fileName.split(".").pop();
            var imageName = fileName.substring(0, fileName.lastIndexOf("."));
            image.alt = "image_" + imageName + "." + extension;
            var imageObj = {
              src: e.target.result,
              alt: "image_" + imageName + "." + extension,
            };
            hinhAnhList.push(imageObj);
            renderHinhAnhList();
          });
          loadFun = true;
          reader.readAsDataURL(file);
        }
      }
    });
  }
}

function uploadVideo() {
  var inputVideo = document.getElementById("video");
  var video;
  inputVideo.addEventListener("change", function (event) {
    var file = event.target.files[0];
    if (file) {
      var reader = new FileReader();
      reader.addEventListener("load", function () {
        video = document.createElement("video");
        video.setAttribute("src", reader.result);
        var fileName = file.name;
        var videoName = fileName.substring(0, fileName.lastIndexOf("."));
        var videoObj = {
          src: reader.result,
          alt: videoName,
        };
        video.setAttribute("alt", videoName);
        video.setAttribute("controls", true);
        hinhAnhList.push(videoObj);
        renderHinhAnhList();
      });

      reader.readAsDataURL(file);
    }
  });
}
function Dang(foodid) {
  hinhAnhList.forEach(function (image) {
    var alt = image.alt;
    var imageName = alt.substring(0, alt.lastIndexOf("."));
  });
  var mota = document.querySelector("textarea").value;
  if (selectedRating1 > 0 && selectedRating2 > 0) {
    var xhr = new XMLHttpRequest();
    var url = "../controllers/binhluan.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var result = xhr.responseText;
        console.log(result);
        if (result == "chuadangnhap") {
          alert("Vui đăng nhập để bình luận!");
        } else if (result == "true") {
          alert("Bình luận của bạn đang được duyệt!\nCảm ơn bạn đánh giá!");
          location.reload();
        } else {
          alert("Bình luận của bạn thất bại!");
          location.reload();
        }
      }
    };

    var params =
      "foodid=" +
      encodeURIComponent(foodid) +
      "&mota=" +
      encodeURIComponent(mota) +
      "&hinhAnhList=" +
      encodeURIComponent(JSON.stringify(hinhAnhList)) +
      "&selectedRating1=" +
      encodeURIComponent(selectedRating1) +
      "&selectedRating2=" +
      encodeURIComponent(selectedRating2);

    xhr.send(params);
  } else {
    alert("Vui lòng đánh giá để được đăng !");
  }
}
// Lấy các phần tử cần sử dụng
var bottomTable = document.querySelector(".bottom-table");

var isDragging = false;
var offset = { x: 0, y: 0 };

// Xử lý sự kiện mouse down
bottomTable.addEventListener("mousedown", function (e) {
  isDragging = true;
  offset.x = e.clientX - bottomTable.offsetLeft;
  offset.y = e.clientY - bottomTable.offsetTop;
});

// Xử lý sự kiện mouse move
document.addEventListener("mousemove", function (e) {
  if (isDragging) {
    bottomTable.style.left = e.clientX - offset.x + "px";
    bottomTable.style.top = e.clientY - offset.y + "px";
  }
});

// Xử lý sự kiện mouse up
document.addEventListener("mouseup", function () {
  isDragging = false;
});
function redirectToDanhGia(masp) {
  var url = "../pages/chitietmonan.php?foodid=" + masp + "#danhgia";
  window.location.href = url;
}
