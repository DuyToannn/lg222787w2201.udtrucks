<?php
	if(!empty($_GET['id'])) $this->item = $this->model->library->getOne($_GET['id']);
?>
<div class="block">
	<form method="post" class="frm-post" action="/<?php echo HOME; ?>?page=library">
		<div class="row">
			<div class="col col-6">
				<div class="ipg"><label>Thư viện</label><input type="text" name="name" value="<?php echo $this->item->name; ?>" required></div>
				<div class="ipg"><label>Đường dẫn</label><input type="text" name="alias" value="<?php echo $this->item->alias; ?>"></div>
				<div class="ipg"><label>Trạng thái</label>
					<span><input type="checkbox" name="published" value="1" <?php if(!empty($this->item->published))  echo 'checked'; ?>>Hiển thị</span>
					<span><input type="checkbox" name="featured" value="1" <?php if(!empty($this->item->featured))  echo 'checked'; ?>>Nổi bật</span>
				</div>
			</div>
			<div class="col col-6">
				<div class="ipg field"><label>Hình đại diện</label>
					<input type="text" name="image" value="<?php echo $this->item->image; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('image')">Chọn</a>
				</div>
				<div class="ipg field"><label>Album ảnh</label>
					<input type="text" name="photo" value="<?php echo $this->item->photo; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('photo')">Chọn</a>
				</div>
				<div class="ipg"><label>Video</label><input type="text" name="video" value="<?php echo $this->item->video; ?>"></div>
			</div>
		</div>
		<label class="forTextarea">Mô tả</label>
		<textarea name="description"><?php echo $this->item->description; ?></textarea>
		<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
		<button style="margin-top: 10px;" class="btn-submit" type="submit" name="task" value="confirm">Xác nhận</button>
	</form>
</div>