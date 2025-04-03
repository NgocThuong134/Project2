function sendData(status, sort, datestart, dateend, search) {
  var data =
    "trangthai=" +
    status +
    "&sapxep=" +
    sort +
    "&tungay=" +
    datestart +
    "&denngay=" +
    dateend +
    "&timkiem=" +
    search;
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "controllers/lichsumuahang.php?" + data, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200 && xhr.readyState === 4) {
      document.getElementById("show-table").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}
window.addEventListener("DOMContentLoaded", function () {
  var status = "";
  var sort = "";
  var datestart = "";
  var dateend = "";
  var search = "";
  sendData(status, sort, datestart, dateend, search);
  document.getElementById("status").addEventListener("change", function () {
    status = this.value;
    sendData(status, sort, datestart, dateend, search);
  });

  document.getElementById("sort").addEventListener("change", function () {
    sort = this.value;
    sendData(status, sort, datestart, dateend, search);
  });

  document.getElementById("date-start").addEventListener("change", function () {
    datestart = this.value;
    sendData(status, sort, datestart, dateend, search);
  });

  document.getElementById("date-end").addEventListener("change", function () {
    dateend = this.value;
    sendData(status, sort, datestart, dateend, search);
  });

  document
    .getElementById("search-input")
    .addEventListener("input", function () {
      search = this.value;
      sendData(status, sort, datestart, dateend, search);
    });
});
