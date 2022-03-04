<?php
	if(!empty($_GET['id'])) $this->item = $this->model->manufacturer->getOne($_GET['id']);
?>
<div class="block">
	<form method="post" class="frm-post" action="/<?php echo HOME; ?>?page=manufacturer">
		<div class="row">
			<div class="col col-6">
				<div class="ipg"><label>Tên thương hiệu</label><input type="text" name="name" value="<?php echo $this->item->name; ?>" required></div>
				<div class="ipg"><label>Đường dẫn</label><input type="text" name="alias" value="<?php echo $this->item->alias; ?>"></div>
				<div class="ipg"><label>Thứ tự</label><input type="number" name="sort" value="<?php echo $this->item->sort; ?>"></div>
				<div class="ipg"><label>Tiêu đề</label><input type="text" name="title" value="<?php echo $this->item->title; ?>"></div>
			</div>
			<div class="col col-6">
				<div class="ipg field"><label>Hình đại diện</label>
					<input type="text" name="image" value="<?php echo $this->item->image; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('image')">Chọn</a>
				</div>
				<div class="ipg field"><label>Hình Icon</label>
					<input type="text" name="icon" value="<?php echo $this->item->icon; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('icon')">Chọn</a>
				</div>
				<div class="ipg field"><label>Ảnh Banner</label>
					<input type="text" name="banner" value="<?php echo $this->item->banner; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('banner')">Chọn</a>
				</div>
				<div class="ipg"><label>Trạng thái</label>
					<span><input type="checkbox" name="published" value="1" <?php if($this->item->published == 1)  echo 'checked'; ?>>Hiển thị</span>
					<span><input type="checkbox" name="featured" value="1" <?php if($this->item->featured == 1)  echo 'checked'; ?>>Nổi bật</span>
				</div>
				
			</div>
			
		</div>
		
		<label class="forTextarea">Mô tả</label>
		<textarea name="description" placeholder="Mô tả"><?php echo $this->item->description; ?></textarea>
		<label class="forTextarea">Chi tiết</label>
		<textarea class="areaCKE" name="content" placeholder="Chi tiết"><?php echo $this->item->content; ?></textarea>
		<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
		<button class="btn-submit" type="submit" name="task" value="confirm">Xác nhận</button>
	</form>
</div>