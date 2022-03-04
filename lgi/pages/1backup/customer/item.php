<script type="text/javascript">
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
<?php 
	$orders = $this->model->order->getByCustomer($this->item->code); 
?>
<div class="block">
	<form method="post" class="frm-post">
			<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
			<div class="row">
				<div class="col col-6">
					<div class="ipg"><label>Mã khách hàng</label><input readonly disabled value="<?php echo $this->item->code; ?>" required></div>
					<div class="ipg"><label>Khách hàng</label><input type="text" name="name" value="<?php echo $this->item->name; ?>" required></div>
				</div>
				<div class="col col-6">
					
					
					<div class="clr"></div>
					<div class="row">
						
						<div class="col col-6">
							<div class="ipg"><label>Điện thoại</label><input type="text" name="phone" value="<?php echo $this->item->phone; ?>" required></div>
							<div class="ipg"><label>Địa chỉ</label><input type="text" name="address" value="<?php echo $this->item->address; ?>"></div>
						</div>
						<div class="col col-6">
							<div class="ipg"><label>Email</label><input type="email" name="email" value="<?php echo $this->item->email; ?>"></div>
							<div class="ipg">
								<label>Tỉnh thành</label>
								<select name="id_province" onchange="getDistrict(this);">
									<option value="">Chọn tỉnh/thành</option>
									<?php foreach ($this->provinces as $item) {
										if ($this->item->id_province == $item->id) echo '<option value="' . $item->id . '" selected>' . $item->name . '</option>';
										else echo '<option value="' . $item->id . '">' . $item->name . '</option>';
									} ?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<textarea name="comment" placeholder="Ghi chú"><?php echo $this->item->comment; ?></textarea>
			<?php if(empty($orders)){ ?>
			<button class="btn-request btn-cancel" type="submit" name="task" value="delete" onclick="return confirm('Bạn đã chắc chắn!?')">Xóa tài khoản</button>
			<?php } ?>
			<?php if($this->item->status == 1){ ?>
			<button class="btn-request btn-cancel" type="submit" name="task" value="status">Tạm khóa</button>
			<?php }else{ ?>
			<button class="btn-request" type="submit" name="task" value="status">Kích hoạt</button>
			<?php } ?>
			<button class="btn-submit" type="submit" name="task" value="update">Cập nhật</button>
	</form>
</div>
<div class="block">
	
		<ul class="tab-label">
			<li class="active"><a href="javascript:void(0);" onclick="$('.tab-label li').removeClass('active'); $(this).parent().addClass('active'); $('.tab-content').fadeOut(0); $('#tab-ticket').fadeIn();">Yêu cầu hỗ trợ</a></li>
		</ul>

		<div class="tab-content" id="tab-ticket" style="display:block;">
			<table class="list-data" style=" margin-bottom: -10px; ">
					<tr>
					<th width="130">Thời gian</th>
					<th width="200">Vấn đề</th>
					<th align="left">Nội dung</th>
					<th width="200">Phụ trách</th>
					<th width="150">Tình trạng</th>
				</tr>
				<?php $ticketStatus = json_decode(file_get_contents(ROOT.'config/ticket.json'), true);
				$list = $this->model->ticket->getByCustomer($this->item->code);
				foreach($list as $item) : ?>
					<tr>
						<td align="center"><?php echo date('d/m/Y', $item->created); ?></td>
						<td align="center"><a href="?page=ticket&id=<?=$item->id?>"><?php echo $item->subject; ?></a></td>
						<td class="name"><?php echo $item->content; ?></td>
						<td class="center"><?php echo $item->staff; ?></td>
						<td class="center"><?=$ticketStatus[$item->status]?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	
</div>