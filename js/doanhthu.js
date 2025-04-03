function DoanhThu() {
  var dateStart = document.getElementById("date-start").value;
  var dateEnd = document.getElementById("date-end").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("product-list").innerHTML = this.responseText;
    }
  };
  xhttp.open(
    "GET",
    "../controllers/hiendoanhthu.php?datestart=" +
      dateStart +
      "&dateend=" +
      dateEnd,
    true
  );
  xhttp.send();
}
var currentDate = new Date().toISOString().split("T")[0];

document.getElementById("date-start").value = currentDate;

document.getElementById("date-end").value = currentDate;
