<?php
	if(!empty($_GET['id'])) $this->item = $this->model->store->getOne($_GET['id']);
?>
<div class="block">
	<form method="post" class="frm-post" action="/<?php echo HOME; ?>?page=store">
		<div class="row">
			<div class="col col-6">
				<div class="ipg"><label>Mã cửa hàng</label><input type="text" name="code" value="<?php echo $this->item->code; ?>" required></div>
				<div class="ipg"><label>Tên cửa hàng</label><input type="text" name="name" value="<?php echo $this->item->name; ?>" required></div>
				<div class="ipg"><label>Đường dẫn</label><input type="text" name="alias" value="<?php echo $this->item->alias; ?>"></div>
				<div class="ipg field"><label>Hình đại diện</label>
					<input type="text" name="image" value="<?php echo $this->item->image; ?>">
					<a class="btn-save" href="javascript:void(0);" onclick="openFM('image')">Chọn</a>
				</div>
				<div class="ipg"><label>Trạng thái</label>
					<span><input type="checkbox" name="published" value="1" <?php if(!empty($this->item->published))  echo 'checked'; ?>>Hiển thị</span>
				</div>
			</div>
			<div class="col col-6">
				<div class="ipg"><label>Điện thoại</label><input type="text" name="phone" value="<?php echo $this->item->phone; ?>"></div>
				<div class="ipg"><label>Email</label><input type="email" name="email" value="<?php echo $this->item->email; ?>"></div>
				<div class="ipg"><label>Địa chỉ</label><input type="address" name="address" value="<?php echo $this->item->address; ?>"></div>
				<div class="ipg"><label>Tỉnh/thành</label>
					<select name="id_province" required>
						<option value="">Chọn tỉnh/thành</option>
					<?php foreach($this->provinces as $province){ if($this->item->id_province == $province->id) echo '<option value="'.$province->id.'" selected>'.$province->name.'</option>';
					else echo '<option value="'.$province->id.'">'.$province->name.'</option>'; } ?>
					</select>
				</div>
				<div class="ipg"><label>Sắp xếp</label><input type="text" name="sort" value="<?php echo $this->item->sort; ?>"></div>
			</div>
		</div>
		<label class="forTextarea">Mô tả</label>
		<textarea class="areaCKE" name="description" placeholder="Mô tả"><?php echo $this->item->description; ?></textarea>
		<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
		<button style="margin-top: 10px;" class="btn-submit" type="submit" name="task" value="confirm">Xác nhận</button>
	</form>
</div>