<section id="cart">
        <div class="container">
            <div class="detail-product">
                <h1 class="page-heading">Giỏ hàng</h1>
                <div class="cart-table">
                    <ul class="cart-table-title">
                        <li>Sản phẩm</li>
                        <li>Đơn giá</li>
                        <li class="cart-quantity">Số lượng</li>
                        <li class="cart-total">Thành tiền</li>
                    </ul>
                    <p id="empty-cart-notify" class="has-empty-cart-notify">
                        <i class="far fa-window-maximize"></i>
                        Không có sản phẩm trong giỏ hàng.
                        <a href="/">Tiếp tục mua hàng</a>
                    </p>
                    <div id="cart-body">
                        <!-- <ul class="cart-table-content">
                            <li>
                                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="times" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                    class="svg-inline--fa fa-times fa-w-10 fa-2x">
                                    <path fill="currentColor"
                                        d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z"
                                        class=""></path>
                                </svg>
                                <div class="cart-table-product">
                                    <div class="cart-table-product-img"><img src="./assets/images/pro2.jpg" alt=""></div>
                                    <div><a href="product.html">Medusa on throne</a> - <span>M</span></div>
                                </div>
                            </li>
                            <li>890,000</li>
                            <li class="cart-quantity">1</li>
                            <li class="cart-total">890,000</li>
                        </ul> -->
                    </div>
                </div>
                <div class="cart-totals">
                    <p class="cart-totals-title">Tổng thanh toán</p>
                    <div class="cart-totals-row">
                        <span>Tổng tiền</span>
                        <div class="cart-sum"></div>
                    </div>
                    <div class="cart-totals-row">
                        <span>Vận chuyển</span>
                        <div class="cart-totals-ship">
                            <span>Miễn phí</span>
                        </div>
                    </div>
                    <div class="cart-totals-row">
                        <span>Tổng cộng</span>
                        <div class="cart-total-end"></div>
                    </div>
                    <input onclick="$('#detail-product-modal').css('display', 'flex')" class="cart-totals-btn"
                        type="submit" value="Tiến hành đặt hàng">
                </div>
            </div>
        </div>
</section>

<div id="detail-product-modal">
        <form class="detail-product-modal-container" method="post">
            <div class="modal-title">
                <p>Thanh toán</p>
                <i onclick="$('#detail-product-modal').fadeOut('fast')" class="fas fa-times"></i>
            </div>
            <div class="modal-row">
                <label>Tên người nhận</label>
                <input type="text" name="name" required />
            </div>
            <div class="modal-row">
                <label>Số điện thoại</label>
                <input type="tel" name="phone" required />
            </div>
            <div class="modal-row">
                <label>Địa chỉ</label>
                <input type="text" name="address" required />
            </div>
            <div class="modal-row">
                <label>Email</label>
                <input type="email" name="email" />
            </div>
            <div class="modal-row-last">
                <input checked type="radio" name="payment" value="cod" />
                <label>Thanh toán khi giao hàng (COD)</label>
            </div>
            <!--<div class="modal-row-last">
                <input type="radio" name="payment" />
                <label>Chuyển khoản ngân hàng (BANK)</label>
            </div>-->
			<input type="hidden" name="product" value="" id="cart_product">
			<input type="hidden" name="price" value="" id="cart_price">
			<input type="hidden" name="fee" value="" id="cart_fee">
			<input type="hidden" name="total" value="" id="cart_total">
            <div class="pay-modal-btn">
               
				<button type="submit" name="task" value="orderNow">Đặt hàng</button>
            </div>
			
        </form>
</div>
