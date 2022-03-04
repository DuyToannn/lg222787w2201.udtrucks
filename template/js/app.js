$(document).ready(function () {
  $("#detail-product-content").submit(function (event) {
    event.preventDefault();
    $("#thanks-modal").fadeIn("fast");
  });
});
// Accordions
const accordionHeaders = document.querySelectorAll(".accordion-header");
[...accordionHeaders].forEach((item) =>
  item.addEventListener("click", handleClickAccordion)
);

function handleClickAccordion(e) {
  const content = e.target.nextElementSibling;
  content.style.height = `${content.scrollHeight}px`;
  content.classList.toggle("isActive");
  if (!content.classList.contains("isActive")) {
    content.style.height = 0;
  }
}

// Menu
const menuBtn = document.querySelector(".menu-toggle");
const menu = document.querySelector("#menu");
const overlay = document.querySelector(".overlay");
function handleToggleMenu() {
  menu.classList.toggle("isShow");
  overlay.classList.toggle("isShow");
}
