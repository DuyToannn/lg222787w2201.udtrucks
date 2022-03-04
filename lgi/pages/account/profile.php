<div class="block">
	<form method="post" class="frm-post">
		<div class="row">
			<div class="col col-6">
				<div class="ipg"><label>Họ tên</label><input type="text" name="name" value="<?php echo $this->staff->name; ?>" required></div>
				<div class="ipg"><label>Giới tính</label><span><input type="radio" name="gender" value="1" <?php if($this->staff->gender == 1)  echo 'checked'; ?>>Nam</span>
				<span><input type="radio" name="gender" value="0" <?php if($this->staff->gender == 0)  echo 'checked'; ?>>Nữ</span></div>
				<div class="ipg"><label>Điện thoại</label><input type="text" name="phone" value="<?php echo $this->staff->phone; ?>" required></div>
				<div class="ipg"><label>Địa chỉ</label><input type="text" name="address" value="<?php echo $this->staff->address; ?>" required></div>
			</div>
			<div class="col col-6">
				<div class="ipg field"><label>Hình đại diện</label>
				<input type="text" name="avatar" value="<?php echo $this->staff->avatar; ?>">
				<a class="btn-save" href="javascript:void(0);" onclick="openFM('avatar');">Chọn</a></div>
				<div class="ipg"><label>Ngày sinh</label><input type="date" name="dob" value="<?php echo date('Y-m-d',$this->staff->dob); ?>" required></div>
				<div class="ipg"><label>Email</label><input type="email" name="email" value="<?php echo $this->staff->email; ?>" required></div>
				<div class="ipg"><label>Tỉnh thành</label>
					<select name="id_province">
					<?php $provinces = $this->model->province->getAll(); foreach($provinces as $item){ if($this->staff->id_province == $item->id) echo '<option value="'.$item->id.'" selected>'.$item->name.'</option>';
					else echo '<option value="'.$item->id.'">'.$item->name.'</option>'; } ?>
					</select>
				</div>
			</div>
		</div>
		<button class="btn-submit" type="submit" name="task" value="confirm" onclick="return confirm('Bạn đã chắc chắn!?')">Xác nhận</button>
	</form>
</div>