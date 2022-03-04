<section id="product">
        <div class="container">
            <div class="detail-product">
                <div class="detail-product-img">
                    <div class="swiper mySwiper2">
                        <div class="swiper-wrapper">
                        <?php if(!empty($this->item->photo)){
		                    $photos = substr(dirname($this->item->photo),1).'/';
							foreach (glob($photos."*.{jpg,png,gif,webp}", GLOB_BRACE) as $image) {
								echo '<div class="swiper-slide"><img class="zoomsl" src="/'.$image.'" alt="'.$this->item->name.'"/></div>';
							}}else echo '<div class="swiper-slide"><img class="zoomsl" src="'.$this->item->image.'" alt="'.$this->item->name.'" /></div>';
							?>
                            <!--<div class="swiper-slide">
                                <img class="zoomsl" id="cart_product_image" src="<?=$this->item->image?>" alt="<?=$this->item->name?>" />
                            </div>
                            <div class="swiper-slide">
                                <img class="zoomsl" src="/template/images/pro2_1.jpeg" alt="" />
                            </div>
                            <div class="swiper-slide">
                                <img class="zoomsl" src="/template/images/pro2.jpeg" alt="" />
                            </div>
                            <div class="swiper-slide">
                                <img class="zoomsl" src="/template/images/pro2_1.jpeg" alt="" />
                            </div>-->
                        </div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                        <?php if(!empty($this->item->photo)){
		                    $photos = substr(dirname($this->item->photo),1).'/';
							foreach (glob($photos."*.{jpg,png,gif,webp}", GLOB_BRACE) as $image) {
								echo '<div class="swiper-slide"><img src="/'.$image.'" alt="'.$this->item->name.'"/></div>';
							}}else echo '<div class="swiper-slide"><img src="'.$this->item->image.'" alt="'.$this->item->name.'" /></div>';
							?>
                             <!--<div class="swiper-slide">
                                <img src="<?=$this->item->image?>" alt="<?=$this->item->name?>" />
                            </div>
                           
                           <div class="swiper-slide">
                                <img src="/template/images/pro2_1.jpeg" alt="" />
                            </div>
                            <div class="swiper-slide">
                                <img src="/template/images/pro2.jpeg" alt="" />
                            </div>
                            <div class="swiper-slide">
                                <img src="/template/images/pro2_1.jpeg" alt="" />
                            </div>-->
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <form class="detail-product-content" id="detail-product-content">
                    <h1 id="cart_product_name"><?=$this->item->name?></h1>
                    <p id="cart_product_price" class="detail-product-price"><?=number_format($this->item->price)?> VND</p>
                    <span>Bảng size</span>
                    <div class="detail-product-option">
                        <div class="detail-product-size">
                            <label>Size</label>
                            <select id="cart_product_size" class="size-options" name="size" required>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                            </select>
                        </div>
                        <div class="detail-product-quantity">
                            <label>Số lượng</label>
                            <input name="quantity" id="cart_product_quantity" type="number" min="1" value="1"
                                required />
                        </div>
                    </div>
                    <button onclick="addToCart()" type="submit" class="add-to-cart-btn">Thêm vào giỏ</button>
                    <input id="cart_product_id" type="hidden" value="<?=$this->item->id?>" />
                    <div class="detail-product-desc">
                        <span>Mô tả</span>
                         <div class="product-highlight"> <?=$this->item->highlight?></div>
                    </div>
                </form>
            </div>
			 <div class="clr"> </div>
			 <article class="product-article"> <?=$this->item->content?></article>
        </div>
</section>

<div id="thanks-modal">
        <div class="thanks-modal-container">
            <div class="thanks-modal-title">
                <h2>Tuyệt vời!</h2>
                <svg onclick="$('#thanks-modal').fadeOut('fast');" aria-hidden="true" focusable="false"
                    data-prefix="far" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 320 512" class="svg-inline--fa fa-times fa-w-10 fa-2x">
                    <path fill="currentColor"
                        d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z"
                        class=""></path>
                </svg>
            </div>
            <div class="thanks-modal-content">
                <p>Cám ơn bạn đã đặt hàng!
                </p>
                <p>Sản phẩm bạn đặt đã được thêm vào giỏ hàng, bạn có thể xem giỏ hàng hoặc tiếp tục xem thêm sản phẩm
                    khác.</p>
            </div>
            <div class="thanks-modal-btn">
                <button onclick="$('#thanks-modal').fadeOut('fast');" type="button">Tiếp tục mua sắm</button>
                <a onclick="contextCart()" href="/cart">Xem giỏ hàng</a>
            </div>
        </div>
</div>

<script>
$(window).load(function() {
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });
    
    
    // Zoom
    
$(function(){
    $('.zoomsl').imagezoomsl({ 
        zoomrange: [2, 12],
        scrollspeedanimate: 10,
        loopspeedanimate: 5,
        magnifiereffectanimate: "slideIn"
    });  
});
})

</script>