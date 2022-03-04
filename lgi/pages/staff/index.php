<div class="block">
	<form method="post" class="frm-post" action="/<?php echo HOME; ?>?page=staff">
		<div class="row">
			<div class="col col-3">
				<div class="ipg"><label>Họ tên</label><input type="text" name="name" required autocomplete="off"></div>
			</div>
			<div class="col col-3">
				<div class="ipg"><label>Điện thoại</label><input type="tel" name="phone" class="isPhone" required autocomplete="off"></div>
			</div>
			<div class="col col-3">
				<div class="ipg"><label>Mật khẩu</label><input type="password" name="password" required autocomplete="off"></div>
			</div>
			<div class="col col-3">
				<div class="ipg field"><label>Vai trò</label>
					<select name="permission" required>
					<?php foreach($this->json->permission as $key => $val){ echo '<option value="'.$key.'">'.$val.'</option>'; } ?>
					</select>
					<button class="btn-save" type="submit" name="task" value="create">Thêm</button>
				</div>
			</div>
		</div>
	</form>
</div>

<form method="post">
	<?php foreach($this->json->permission as $key => $val){ ?>
	<div class="block" style="padding-bottom: 0;"><table class="list-data" style="margin-bottom: 0;">
		<tr><th width="10">ID</th><th align="left" width="250"><?=$val?></th><th width="100">Điện thoại</th><th align="left">Email</th><th align="left">Địa chỉ</th><th width="150">Đăng nhập</th><th width="100">Trạng thái</th>
		<th width="150"></th></tr>
		<?php $list = $this->model->staff->getList($key); foreach($list as $item) : ?>
		<tr>
			<td align="center"><?php echo $item->id; ?></td>
			<td class="name"><?php echo $item->name; ?></td>
			<td><?php echo $item->phone; ?></td>
			<td><?php echo $item->email; ?></td>
			<td><?php echo $item->address; ?></td>
			<td align="center"><?php if($item->login) echo date('H:s d/m/Y',$item->login)?></td>
			<?php if($item->id != $this->staff->id){ ?>
			<td align="center"><button type="submit" name="status" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')">
			<i <?php if($item->status) echo ' class="ion-unlocked" title="Khóa tài khoản"'; else echo ' class="ion-locked" title="Mở khóa tài khoản"'; ?>></i></button></td>
			<td align="center">
				<button type="submit" name="reset" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')"><i class="ion-load-a"></i></button>
				<a href="javascript:void(0);" onclick="$('#staff_name').html('<?php echo $item->name; ?>');$('#staff_id').val(<?php echo $item->id; ?>);$('#modal-change').fadeIn();"><i class="ion-compose"></i></a>
				<button type="submit" name="delete" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')"><i class="ion-trash-a"></i></button>
				
			</td>
			<?php } else echo '<td></td><td></td>';?>
		</tr>
		<?php endforeach; ?>
	</table></div>
	<?php } ?>
</form>
<div class="modal-block" id="modal-change">
			<div class="modal-dialog">
				<h3 class="dialog-title">Thay đổi vai trò của: <span id="staff_name"></span></h3>
				<form method="post" class="dialog-content">
						<input id="staff_id" name="id" type="hidden" required>
						<select name="permission">
							<?php foreach($this->json->permission as $key => $val){ ?>
							<option value="<?=$key?>"><?=$val?></option>
							<?php } ?>
						</select>

						<div class="clr"></div>
						<div class="dialog-actions">
							<a href="javascript:void(0);" onclick="$('.modal-block').fadeOut();">Đóng</a>
							<button class="btnConfirm" type="submit" name="task" value="permission">Đổi</button>
						</div>
					</form>
				
			</div>
		</div>