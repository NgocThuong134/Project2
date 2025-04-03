document.addEventListener("DOMContentLoaded", function () {
  var passwordInputs = document.querySelectorAll(".eye input[type='password']");
  var showIcons = document.querySelectorAll(".eye .show-icon");
  var hideIcons = document.querySelectorAll(".eye .hide-icon");

  for (var i = 0; i < passwordInputs.length; i++) {
    showIcons[i].addEventListener(
      "click",
      createTogglePasswordHandler(passwordInputs[i], showIcons[i], hideIcons[i])
    );
    hideIcons[i].addEventListener(
      "click",
      createTogglePasswordHandler(passwordInputs[i], hideIcons[i], showIcons[i])
    );
  }
});

function createTogglePasswordHandler(passwordInput, showIcon, hideIcon) {
  return function () {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      showIcon.classList.add("hide");
      hideIcon.classList.remove("hide");
    } else {
      passwordInput.type = "password";
      hideIcon.classList.add("hide");
      showIcon.classList.remove("hide");
    }
  };
}
