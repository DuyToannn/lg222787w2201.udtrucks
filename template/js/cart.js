$(document).ready(function () {
  contextCart();
});

function addToCart() {
  var json = localStorage.getItem("cart");
  if (json != null) {
    var cart = JSON.parse(json);
    var isAdd = true;
    $.each(cart, function (index, value) {
      if (
        value.cart_product_id == $("#cart_product_id").val() &&
        value.cart_product_size == $("#cart_product_size").val()
      ) {
        value.cart_product_quantity =
          parseInt(value.cart_product_quantity) +
          parseInt($("#cart_product_quantity").val());
        isAdd = false;
      }
    });
    if (isAdd) {
      cart.push({
        cart_product_id: $("#cart_product_id").val(),
        cart_product_name: $("#cart_product_name").text(),
        cart_product_size: $("#cart_product_size").val(),
        cart_product_price: $("#cart_product_price").text(),
        cart_product_quantity: $("#cart_product_quantity").val(),
        cart_product_image: $("#cart_product_image").attr("src"),
      });
    }
  } else {
    var cart = [
      {
        cart_product_id: $("#cart_product_id").val(),
        cart_product_name: $("#cart_product_name").text(),
        cart_product_size: $("#cart_product_size").val(),
        cart_product_price: $("#cart_product_price").text(),
        cart_product_quantity: $("#cart_product_quantity").val(),
        cart_product_image: $("#cart_product_image").attr("src"),
      },
    ];
  }
  json = JSON.stringify(cart);
  localStorage.setItem("cart", json);
  contextCart();
}
function contextCart() {
  $("#cart-body").html("");
  var sum = 0;
  var total = 0;
  var quantity  = 0;
  var fee = 0;
  var json = localStorage.getItem("cart");
  if (json != null && json != "" && json != "[]") {
    var cart = JSON.parse(json);
    $(".cart-sum").html("");
    $(".ship-fee").html("");
    $(".cart-total-end").html("");
    $("#cart-item-count").html("")
    $.each(cart, function (index, value) {
      let product = `
      <ul class="cart-table-content">
      <li>
          <svg onclick="delItemInCart(${index})" aria-hidden="true" focusable="false" data-prefix="far" data-icon="times" role="img"
              xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
              class="svg-inline--fa fa-times fa-w-10 fa-2x">
              <path fill="currentColor"
                  d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z"
                  class=""></path>
          </svg>
          <div class="cart-table-product">
              <div class="cart-table-product-img"><img src="${
                value.cart_product_image
              }" alt=""></div>
              <div><a href="product.html">${
                value.cart_product_name
              }</a> - <span>${value.cart_product_size.toUpperCase()}</span></div>
          </div>
      </li>
      <li>${parseInt(value.cart_product_price.replace(/\D/g, ""))
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</li>
      <li class="cart-quantity">${value.cart_product_quantity}</li>
      <li class="cart-total">${(
        parseInt(value.cart_product_price.replace(/\D/g, "")) *
        parseInt(value.cart_product_quantity)
      )
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</li>
  </ul>`;
      $(".cart-totals").css('display', 'block');
      sum +=
        parseInt(value.cart_product_price.replace(/\D/g, "")) *
        parseInt(value.cart_product_quantity);
      quantity +=  parseInt(value.cart_product_quantity);
      if(quantity > 0) {
        $("#cart-item-count").html(quantity).css('display', 'block');
        $("#empty-cart-notify").removeClass("has-empty-cart-notify");
        $(".cart-table-title li").css("visibility", "visible");
      } 

      $(".cart-sum").html(sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      total = sum + fee;
      $(".ship-fee").html(fee.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      $(".cart-total-end").html(
        total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      );
      $("#cart-body").append(product);
	  $("#cart_price").val(sum);
	  $("#cart_fee").val(fee);
	  $("#cart_total").val(total);
    });
  }
  $("#cart_product").val(json);
}

function delItemInCart(index) {
  var json = localStorage.getItem("cart");
  var cart = JSON.parse(json);
  for (let i = 0; i < cart.length; i++) {
    if (cart.indexOf(cart[i]) == index) {
      cart.splice(i, 1);
    }
  }
  if (cart.length == 0) {
    $(".cart-totals").css('display', 'none');
    $(".cart-table-title li").css("visibility", "hidden");
    $("#cart-item-count").css('display', 'none');
    $("#empty-cart-notify").addClass("has-empty-cart-notify")
  }
  json = JSON.stringify(cart);
  localStorage.setItem("cart", json);
  contextCart();
}
