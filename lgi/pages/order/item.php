<?php $this->item = $this->model->order->getOne($_GET["id"]);
$this->details = $this->model->order->getDetail($this->item->code); ?>
<script type="text/javascript">
function printOrder(id) {
	$("#loader").fadeIn(0);
	$.post("/<?php echo HOME; ?>?page=order", {ajax: "printOrder", id: id}, function(result){
		var newWin = window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print()" style="margin: 0;"><section style="font-size: 12px">'+result+'</section></body></html>');
		newWin.document.close();
		setTimeout(function(){newWin.close();},0);
	});
}
function getDistrict(e){
	$.post( "/", { ajax: "getDistrict", id_province: $(e).val()}, function(json){
		let districts = JSON.parse(json);
		var html = '<option value="">Chọn quận/huyện</option>';
		$.each(districts, function(stt, district){
			html += '<option value="'+district.id+'">'+district.name+'</option>';
		});
		$('select[name="id_district"]').html(html);
		$('select[name="id_ward"]').html('<option value="">Chọn phường/xã</option>');
	});
}
function getWard(e){
	$.post( "/", { ajax: "getWard", id_district: $(e).val()}, function(json){
		let wards = JSON.parse(json);
		var html = '<option value="">Chọn phường/xã</option>';
		if(wards.length == 0) html = '<option value="0">Không có</option>';
		else{
			$.each(wards, function(stt, ward){
				html += '<option value="'+ward.id+'">'+ward.name+'</option>';
			});
		}
		$('select[name="id_ward"]').html(html);
	});
}
</script>
<script type="text/javascript">     
function printOrder(id) {    
	$.get("?page=order&print="+id, function(html){		
		var newWin = window.open('','Print-Window');
		newWin.document.open();
		newWin.document.write('<html><body onload="window.print()" style="margin: 0;">' + html + '</body></html>');
		newWin.document.close();
		setTimeout(function(){newWin.close();},0);
	});
}
</script>
<div class="block" id="divToPrint">
	<form class="row" method="post">
			<div class="col col-6">
				<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
				<div class="ipg"><label>Mã đơn</label><input value="<?php echo $this->item->code; ?>" readonly></div>
				<div class="ipg"><label>Ngày đặt</label><input value="<?php echo date('H:i d-m-Y',$this->item->created); ?>" readonly></div>
				<div class="ipg"><label>Thanh toán</label><input value="<?=$orderPayment[$this->item->payment]?>" readonly></div>
				<div class="ipg"><label>Thay đổi</label><input value="<?php if(!empty($this->item->updated)){ $staff = $this->model->staff->getOne($this->item->updated_by, 'code'); echo 'Lúc '.date('H:i d/m/Y',$this->item->updated).' bởi '.$staff->name;} ?>" readonly></div>
				<div class="ipg"><label>Xác nhận</label><input value="<?php if(!empty($this->item->confirmed)){ $staff = $this->model->staff->getOne($this->item->confirmed_by, 'code'); echo 'Lúc '.date('H:i d/m/Y',$this->item->confirmed).' bởi '.$staff->name;} ?>" readonly></div>
				<div class="ipg"><label>Gửi hàng</label><input value="<?php if(!empty($this->item->sent)){ $staff = $this->model->staff->getOne($this->item->sent_by, 'code'); echo 'Lúc '.date('H:i d/m/Y',$this->item->sent).' bởi '.$staff->name;} ?>" readonly></div>
				<div class="ipg"><label>Giao hàng</label><input value="<?php if(!empty($this->item->delivered)){ $staff = $this->model->staff->getOne($this->item->delivered_by, 'code'); echo 'Lúc '.date('H:i d/m/Y',$this->item->delivered).' bởi '.$staff->name;} ?>" readonly></div>
				<div class="ipg"><label>Bị trả hàng</label><input value="<?php if(!empty($this->item->returned)){ $staff = $this->model->staff->getOne($this->item->returned_by, 'code'); echo 'Lúc '.date('H:i d/m/Y',$this->item->returned).' bởi '.$staff->name;} ?>" readonly></div>
				<div class="ipg"><label>Bị hủy</label><input value="<?php if(!empty($this->item->canceled)){ $staff = $this->model->staff->getOne($this->item->canceled_by, 'code'); echo 'Lúc '.date('H:i d/m/Y',$this->item->canceled).' bởi '.$staff->name;} ?>" readonly></div>
			</div>
			<div class="col col-6">
				<div class="ipg"><label>Nhân viên BH</label><input value="" readonly></div>
				<div class="ipg"><label>Họ tên</label><input name="name" value="<?php echo $this->item->name; ?>" required></div>
				<div class="ipg"><label>Điện thoại</label><input name="phone" value="<?php echo $this->item->phone; ?>" required></div>
				<div class="ipg"><label>Email</label><input name="email" value="<?php echo $this->item->email; ?>"></div>
				<div class="ipg"><label>Tỉnh thành</label>
					<select name="id_province" required onchange="getDistrict(this);">
						<option value="">Chọn tỉnh/thành</option>
					<?php $provinces = $this->model->province->getAll(); foreach($provinces as $province){ if($this->item->id_province == $province->id) echo '<option value="'.$province->id.'" selected>'.$province->name.'</option>';
					else echo '<option value="'.$province->id.'">'.$province->name.'</option>'; } ?>
					</select>
				</div>
				<div class="ipg"><label>Quận huyện</label>
					<select name="id_district" required onchange="getWard(this);">
						<option value="">Chọn quận/huyện</option>
					<?php $districts = $this->model->province->getDistrict($this->item->id_province); foreach($districts as $district){ if($this->item->id_district == $district->id) echo '<option value="'.$district->id.'" selected>'.$district->name.'</option>';
					else echo '<option value="'.$district->id.'">'.$district->name.'</option>'; } ?>
					</select>
				</div>
				<div class="ipg"><label>Phường xã</label>
					<select name="id_ward" required>
						<option value="">Chọn phường/xã</option>
					<?php $wards = $this->model->province->getWard($this->item->id_district); foreach($wards as $ward){ if($this->item->id_ward == $ward->id) echo '<option value="'.$ward->id.'" selected>'.$ward->name.'</option>';
					else echo '<option value="'.$ward->id.'">'.$ward->name.'</option>'; } ?>
					</select>
				</div>
				<div class="ipg"><label>Địa chỉ</label><input name="address" value="<?php echo $this->item->address; ?>" required></div>
				<div class="ipg field"><label>Yêu cầu khác</label><input name="note" value="<?php echo $this->item->note; ?>">
				<button class="btn-save" type="submit" name="task" value="update" onclick="return confirm('Bạn chắc chắn cập nhật!?')">Lưu</button></div>
			</div>
			
	</form>
	<form method="post" action="/<?php echo HOME; ?>?page=order">
	<table class="list-data" style=" border-top: 1px solid #ccc; ">
		<tr><th width="10">ID</th><th align="left">Sản phẩm</th><th width="100">Màu sắc</th><th width="100">Kích thước</th><th width="100">Phân loại</th><th width="100">Số lượng</th><th width="150">Đơn giá</th></tr>
		<?php foreach($this->details as $item) : 
		if(!empty($item->product)) $product = $this->model->product->getOne($item->product,'sku');
		else $product = $this->model->product->getOne($item->sku,'sku'); ?>
		<tr>
			<td><?php echo $item->id; ?></td>
			<td class="name"><a href="?page=product&id=<?php echo $product->id; ?>"><?php echo $product->name; ?></a></td>
			<td align="center"><?php echo $item->color; ?></td>
			<td align="center"><?php echo $item->size; ?></td>
			<td align="center"><?php echo $item->type; ?></td>
			<td align="center"><?php echo $item->quantity; ?></td>
			<td align="right"><?php echo number_format($item->price); ?></td>
		</tr>
		<?php endforeach; ?>
		<tr><th colspan="6" align="right" style=" border: 1px double #ccc;border-left: 0;">Tạm tính</th><th align="right" style=" border: 1px double #ccc; "><?php echo number_format($this->item->price); ?></th></tr>
		<tr><th colspan="6" align="right" style=" border: 1px double #ccc;border-left: 0;">Khuyến mãi</th><th align="right" style=" border: 1px double #ccc; "></th></tr>
		<tr><th colspan="6" align="right" style=" border: 1px double #ccc;border-left: 0;">Giảm giá</th><th align="right" style=" border: 1px double #ccc; "><?php echo number_format($this->item->discount); ?></th></tr>
		<tr><th colspan="6" align="right" style=" border: 1px double #ccc;border-left: 0;">Phí vận chuyển</th><th align="right" style=" border: 1px double #ccc; "><?php echo number_format($this->item->fee); ?></th></tr>
		<tr><th colspan="6" align="right" style=" border: 1px double #ccc;border-left: 0;">Tổng tiền</th><th align="right" style=" border: 1px double #ccc; "><?php echo number_format($this->item->total); ?></th></tr>
	</table>
	
		<div class="row">
			<div class="col col-6">
				<div class="ipg"><label>Ghi chú</label><input name="comment" value="<?php echo $this->item->comment; ?>"></div>
			</div>
			<div class="col col-6">
				<div class="ipg"><label>Phản ánh</label><input name="complaint" value="<?php echo $this->item->complaint; ?>"></div>
			</div>
		</div>
		<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
		<?php if($this->item->status == 0){ ?><button class="btn-submit" type="submit" name="task" value="confirm" onclick="return confirm('Bạn chắc chắn xác nhận!?')">Xác nhận</button><?php } ?>
		<?php if($this->item->status == 1){ ?><button class="btn-submit" type="submit" name="task" value="send" onclick="return confirm('Bạn chắc chắn gửi hàng!?')">Gửi hàng</button><?php } ?>
		<?php if($this->item->status == 2){ ?><button class="btn-submit" type="submit" name="task" value="delivery" onclick="return confirm('Bạn chắc chắn đã giao hàng!?')">Giao hàng</button><?php } ?>
		<?php if($this->item->status == 3){ ?><button class="btn-submit btn-cancel" type="submit" name="task" value="return" onclick="return confirm('Bạn chắc chắn trả hàng!?')">Trả hàng</button><?php } ?>
		<?php if($this->item->status >= 0 && $this->item->status < 3){ ?><button class="btn-submit btn-cancel" type="submit" name="task" value="cancel" onclick="return confirm('Bạn chắc chắn muốn hủy!?')">Hủy đơn</button><?php } ?>
		<a class="btn-request" href="javascript:void(0);" onclick="printOrder(<?php echo $this->item->id; ?>);">In Bill</a>
	</form>
</div>