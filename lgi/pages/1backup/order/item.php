<script type="text/javascript">
function addProduct(e){
	var row = '<tr>';
	row += '<td><input type="text" name="sku[]" required></td>';
	row += '<td><input type="text" name="product[]" required></td>';
	row += '<td><input type="text" name="unit[]" required></td>';
	row += '<td><input class="isPrice" name="price[]" required></td>';
	row += '<td><input type="number" min="1" name="quantity[]" required></td>';
	row += '<td><input class="isPrice" name="amount[]"></td>';
	row += '<td><input class="isPrice" name="discount[]"></td>';
	row += '<td><a href="#" onclick="$(this).parent().parent().remove();return false;">Xóa</a></td>';
	row += '</tr>';
	$("#listProduct").append(row);
	issetIP();
}
function searchCustomer(input){
	$("#search-result").html('');
	let keyword = $(input).val();
	if(keyword != ""){
		$.post("#", {ajax: "searchCustomer", keyword: keyword}, function(json){
			let result = JSON.parse(json);
			if(result.status == "success"){
				var html = '';
				$.each(result.data, function(index, item){
					html += '<div class="item" onclick="chooseCustomer(\''+item.code+'\',\''+item.name+'\',\''+item.phone+'\',\''+item.address+'\')">'+item.code+' - '+item.name+' - '+item.phone+'</div>';
				});
				$("#search-result").html(html);
			}
		});
	}
}
function chooseCustomer(code, name, phone, address){
	$("#search-result").html('');
	$('input[name=user]').val(code);
	$('input[name=name]').val(name);
	$('input[name=phone]').val(phone);
	$('input[name=address]').val(address);
}
</script>
<div class="block">
	<form method="post" class="frm-post" action="?page=order">
			<div class="row">
				<div class="col col-3"><div class="ipg"><label>Mã khách hàng</label><input type="text" name="user" value="<?php echo $this->item->user; ?>" class="isAccount" required onkeyup="searchCustomer(this);">
				<div id="search-result"></div>
				</div></div>
				<div class="col col-3"><div class="ipg"><label>Tên khách hàng</label><input name="name" value="<?php echo $this->customer->name; ?>" readonly disabled></div></div>
				<div class="col col-3"><div class="ipg"><label>Số điện thoại</label><input name="phone" value="<?php echo $this->customer->phone; ?>" readonly disabled></div></div>
				<div class="col col-3"><div class="ipg"><label>Địa chỉ</label><input name="address" value="<?php echo $this->customer->address; ?>" readonly disabled></div></div>
				
				<div class="col col-4">
					<div class="ipg"><label>Số C.từ</label><input type="text" name="code" value="<?php echo $this->item->code; ?>" required></div>
					
				</div>
				<div class="col col-4">
					<div class="ipg"><label>Ngày C.từ</label><input type="date" name="created" value="<?=date('Y-m-d',$this->item->created)?>" required></div>
				</div>
				<div class="col col-4">
					<div class="ipg"><label>Bảo hành đến</label><input type="date" name="expired" value="<?=date('Y-m-d',$this->item->expired)?>" required></div>
				</div>
			</div>
			<table class="list-data">
				<tr>
					<th width="100">Mã hàng</th>
					<th>Tên hàng</th>
					<th width="100">ĐVT</th>
					<th width="150">Đơn giá</th>
					<th width="100">Số lượng</th>
					<th width="150">Thành tiền</th>
					<th width="150">Chiết khấu</th>
					<th width="50"><a href="#" onclick="addProduct();return false;">✛</a></th>
				</tr>
				<tbody id="listProduct">
				<?php foreach ($this->products as $item) : ?>
					<tr>
						<td><input type="text" name="sku[]" value="<?=$item->sku?>" required></td>
						<td><input type="text" name="product[]" value="<?=$item->name?>" required></td>
						<td><input type="text" name="unit[]" value="<?=$item->unit?>" required></td>
						<td><input class="isPrice" name="price[]" value="<?=number_format($item->price)?>" required></td>
						<td><input type="number" min="1" name="quantity[]" value="<?=$item->quantity?>" required></td>
						<td><input class="isPrice" name="amount[]" value="<?=number_format($item->amount)?>"></td>
						<td><input class="isPrice" name="discount[]" value="<?=number_format($item->discount)?>"></td>
						<td><a href="#" onclick="$(this).parent().parent().remove();return false;">Xóa</a></td>
					</tr>
				<?php endforeach; ?>
				
				</tbody>
				<tr>
					<th colspan="5" align="right">Tổng tiền</th>
					<th colspan="3"><input class="isPrice" name="total_price" value="<?=number_format($this->item->price)?>" required></th>
				</tr>
				<tr>
					<th colspan="5" align="right">Tổng chiết khấu</th>
					<th colspan="3"><input class="isPrice" name="total_discount" value="<?=number_format($this->item->discount)?>"></th>
				</tr>
				<tr>
					<td style="padding: 10px;" colspan="5" align="right">Phí giao hàng</td>
					<td style="padding: 10px;" colspan="3"><input class="isPrice" name="fee" value="<?=number_format($this->item->fee)?>"></td>
				</tr>
				<tr>
					<th colspan="5" align="right">Tổng thanh toán</th>
					<th colspan="3"><input class="isPrice" name="total" value="<?=number_format($this->item->total)?>" required></th>
				</tr>
				<tr>
					<th colspan="5" align="right">Đã thanh toán</th>
					<th colspan="3"><input class="isPrice" name="deposit" value="<?=number_format($this->item->deposit)?>" required></th>
				</tr>
				<tr>
					<th colspan="5" align="right">Còn nợ lại</th>
					<th colspan="3"><input class="isPrice" name="debt" value="<?=number_format($this->item->debt)?>"></th>
				</tr>
			</table>
			<textarea name="note" placeholder="Ghi chú"><?php echo $this->item->note; ?></textarea>
			<input type="hidden" name="id" value="<?php echo $this->item->id; ?>">
			<a class="btn-request btn-cancel" href="?page=order">Quay lại</a>
			<button class="btn-submit" type="submit" name="task" value="confirm">Xác nhận</button>
	</form>
</div>
<style>
table.list-data input {
    margin: 0;
    padding: 0;
    border: 0;
    float: left;
    width: 100%;
    border-bottom: 1px dotted #999;
    background: transparent;
}
#search-result {
    position: absolute;
    width: 100%;
    z-index: 99999;
}
#search-result .item {
    float: left;
    width: 100%;
    background: #fff;
    padding: 5px 10px;
	height: auto;
    border: 1px solid #dddddd;
    border-bottom: 0;
    cursor: pointer;
}
#search-result .item:last-child {
    border-bottom: 1px solid #dddddd;
}
</style>