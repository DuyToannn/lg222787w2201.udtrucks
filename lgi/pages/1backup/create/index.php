<?php $this->getCSS('create'); ?>
<form method="post">
<div id="order-product">
	<div id="order-product-search">
		<label>Tìm sản phẩm:</label>
		<input type="text" placeholder="Nhập mã hoặc tên sản phẩm" onkeyup="searchProduct(this);">
		<div id="order-product-search-result">

		</div>
	</div>
	<div id="order-product-list">

	</div>
</div>
<div id="order-info">
	<div class="row">
		<div class="col col-12">
			<div class="ipg">
				<select name="source">
							<?php foreach($this->json->source as $key => $value) {
								echo '<option value="' . $key . '">' . $value . '</option>';
							} ?>
						</select>
			</div>
		</div>
		<div class="col col-6"><div class="ipg"><input placeholder="Họ tên" name="name" required></div></div>
		<div class="col col-6"><div class="ipg"><input pattern="[0-9]{10,11}" maxlength="11" placeholder="Điện thoại" class="isPhone" name="phone" required></div></div>
	</div>
	<div class="ipg"><input placeholder="Ghi chú..." name="note"></div>
	<div class="ipg"><input type="checkbox" name="shipment" value="delivery" onchange="$('#order-delivery').slideToggle()">Giao hàng tận nơi</div>
	<div class="clr"></div>
	<div id="order-delivery" style="display: none">
		<div class="ipg"><input type="text" name="address" placeholder="Địa chỉ nhận hàng"></div>
		<div class="clr"></div>
		<div class="row">
			<div class="col col-6"><div class="ipg"><input id="freeship" type="radio" onchange="$('#feeship').val(0); updateTotal();" checked>Miễn phí giao hàng</div></div>
			<div class="col col-6"><div class="ipg"><input id="feeship" type="number" name="fee" value="0" min="0" onkeyup="updateTotal();" onchange="updateTotal();" placeholder="Phí giao hàng" onfocus="$('#freeship').prop('checked', false);"></div></div>
		</div>
		
	</div>
	<?php $i=0; foreach($this->json->pos["payment"] as $key => $val) { $i++; ?>
	<div class="ipg"><input type="radio" name="payment" value="<?= $key ?>" required <?php if($i==1) echo 'checked';?>><?= $val ?></div>
	<?php } ?>
	<div class="ipg">
		<?php foreach($this->json->pos["qrcode"] as $key => $val) { ?>
		<div class="qrcode"><input type="radio" name="payment" value="<?= $key ?>" required><?= $val ?></div>
		<?php } ?>
	</div>
	<div class="ipg field"><input type="hidden" data-percent="0" data-price="0" name="promotion">
	<input type="text" id="inputPromotion" placeholder="Mã khuyến mãi (Nếu có)" onkeyup="clearPromotion();"><a class="btn-save" href="javascript:void(0);" onclick="searchPromotion();">Dùng</a></div>
	<div class="ipg"><input placeholder="Giảm trực tiếp" name="discount" class="isPrice" onkeyup="updateTotal();" onchange="updateTotal();"></div>
	<p class="order-price">Tổng tiền<b class="fr" id="sum-price">0</b></p>
	<p class="order-price">Giảm giá<b class="fr" id="sum-discount">0</b></p>
	<p class="order-price">Phí ship<b class="fr" id="sum-fee">0</b></p>
	<p class="order-price">Thanh toán<b class="fr" id="sum-total">0</b></p>
	<input type="hidden" name="price" value="0" required>
	<input type="hidden" name="total" value="0" required>
	<div class="order-btn">
		<button class="btn-submit" type="submit" name="task" value="create">Tạo đơn</button>
		<button class="btn-submit" type="submit" name="task" value="print">Tạo & In</button>
		<a href="/<?=HOME?>?page=create">Làm lại</a>
	</div>
</div>
</form>
<script>
function updateTotal(){
	var sum = 0;
	var discount = 0;
	if($('input[name="discount"]').val() != '') discount = parseInt($('input[name="discount"]').val().replace(/\,/g, ''));
	let fee = parseInt($('input[name="fee"]').val());
	$("#order-product-list .item-quantity-price").each(function(){
		let price = $(this).attr("data-price");
		let quantity = $(this).val();
		sum += (price*quantity);
	});
	let percent = parseInt($('input[name="promotion"]').attr("data-percent"));
	let p_sum = parseInt(sum*percent/100);
	var p_price = parseInt($('input[name="promotion"]').attr("data-price"));
	if(p_price > p_sum) p_price = p_sum;
	var total = sum + fee - (discount + p_price);
	$('input[name="price"]').val(sum);
	$('input[name="total"]').val(total);
	$("#sum-price").html(sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	$("#sum-discount").html((discount+p_price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	$("#sum-fee").html(fee.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	$("#sum-total").html(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
}
function clearPromotion(){
	$('input[name="promotion"]').val('');
	$('input[name="promotion"]').attr("data-percent", 0);
	$('input[name="promotion"]').attr("data-price", 0);
	updateTotal();
}
function searchPromotion(){
	let phone = $('input[name="phone"]').val();
	let promotion = $('#inputPromotion').val();
	$('input[name="promotion"]').val('');
	$('input[name="promotion"]').attr("data-percent", 0);
	$('input[name="promotion"]').attr("data-price", 0);
	if(phone != "" && promotion != ""){
		$.post("#", {ajax: "searchPromotion", code: promotion, phone: phone}, function(json){
			let result = JSON.parse(json);
			if(result.status == "success"){
				$('input[name="promotion"]').val(promotion);
				$('input[name="promotion"]').attr("data-percent", result.data.percent);
				$('input[name="promotion"]').attr("data-price", result.data.price);
				updateTotal();
			}else alert(result.message);
			//console.log(result);
		});
	}else alert("Vui lòng điền số điện thoại và mã khuyến mãi.");
	updateTotal();
}
function chooseProduct(index){
	let json = sessionStorage.getItem('searchProduct');
	let result = JSON.parse(json);
	let item = result.data[index];
	var html = '<div class="order-product-item">';
	html += '<div class="info"><input type="hidden" name="detailSku[]" value="'+item.sku+'"><img src="'+item.image+'"><label>'+item.name+'</label><span>Mã sản phẩm: '+item.sku+'</span></div>';
	html += '<div class="option">';
	if(item.color != null){
		html += '<select name="detailColor[]" required><option value="">Chọn màu sắc</option>';
		let colors = JSON.parse(item.color);
		$.each(colors, function(i, color){
			html += '<option value="'+color.sku+'">'+color.name+'</option>';
		});
		html += '</select>';
	}else html += '<input type="hidden" name="detailColor[]" value="none">';
	if(item.size != null){
		html += '<select name="detailSize[]" required><option value="">Chọn size</option>';
		let sizes = JSON.parse(item.size);
		$.each(sizes, function(i, size){
			html += '<option value="'+size.sku+'">'+size.name+'</option>';
		});
		html += '</select>';
	}else html += '<input type="hidden" name="detailSize[]" value="none">';
	if(item.type != null){
		html += '<select name="detailType[]" required><option value="">Chọn loại</option>';
		let types = JSON.parse(item.type);
		$.each(types, function(i, type){
			html += '<option value="'+type.sku+'">'+type.name+'</option>';
		});
		html += '</select>';
	}else html += '<input type="hidden" name="detailType[]" value="none">';
	html += '</div>';
	html += '<div class="price"><input type="hidden" name="detailPrice[]" value="'+item.price+'">'+item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</div>';
	html += '<div class="quantity"><input class="item-quantity-price" name="detailQuantity[]" type="number" min="1" value="1" onchange="updateTotal();" data-price="'+item.price+'"></div>';
	html += '<a class="del" href="javascript:void(0)" onclick="$(this).parent().remove();updateTotal();">✕</a>';
	html += '</div>';
	$("#order-product-list").append(html);
	$("#order-product-search-result").html('');
	$("#order-product-search input").val('');
	sessionStorage.removeItem('searchProduct');
	updateTotal();
}
function searchProduct(input){
	$("#order-product-search-result").html('');
	sessionStorage.removeItem('searchProduct');
	let keyword = $(input).val();
	if(keyword != ""){
		$.post("#", {ajax: "searchProduct", keyword: keyword}, function(json){
			let result = JSON.parse(json);
			if(result.status == "success"){
				sessionStorage.setItem('searchProduct', json);
				var html = '';
				$.each(result.data, function(index, item){
					html += '<div class="item" onclick="chooseProduct('+index+')"><img src="'+item.image+'"><label>'+item.sku+' - '+item.name+'</label><span>'+item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</span></div>';
				});
				$("#order-product-search-result").html(html);
			}//else alert(result.message);
			//console.log(result);
		});
	}
}
</script>