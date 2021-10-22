console.log(",best");

if (document.title != "Amazing | Sign Up") {
  const content = document.querySelector("#main-content-container");
  const dropdown = document.querySelector(".log-in-container");
  const dropdownContent = document.querySelector(".log-in-content");

  dropdown.addEventListener("mouseenter", function () {
    content.classList.add("blur");
  });
  dropdownContent.addEventListener("mouseenter", function () {
    content.classList.add("blur");
  });
  dropdown.addEventListener("mouseleave", function () {
    content.classList.remove("blur");
  });

  dropdownContent.addEventListener("mouseleave", function () {
    content.classList.remove("blur");
  });
}
