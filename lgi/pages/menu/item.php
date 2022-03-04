<?php
	$this->list = array();
	$this->model->menu->getAll($this->list,0,'');
	if(!empty($_GET['id'])) $this->item = $this->model->menu->getOne($_GET['id']);
?>
<div class="block">
	<form method="post" class="frm-post" action="/<?php echo HOME; ?>?page=menu">
		<div class="row">
			<div class="col col-6">
				<div class="ipg"><label>Kiểu menu</label>
					<select name="type" required>
						<option value="link" <?php if($this->item->type == "link") echo 'selected'?>>Link nội dung</option>
						<option value="home" <?php if($this->item->type == "home") echo 'selected'?>>Trang chủ</option>
						<option value="product_all" <?php if($this->item->type == "product_all") echo 'selected'?>>Tất cả sản phẩm</option>
						<option value="service_all" <?php if($this->item->type == "service_all") echo 'selected'?>>Tất cả dịch vụ</option>
						<option value="contact" <?php if($this->item->type == "contact") echo 'selected'?>>Thông tin liên hệ</option>
						<option value="custom" <?php if($this->item->type == "custom") echo 'selected'?>>Trang tùy chỉnh</option>
					</select>
				</div>
				<div class="ipg"><label>Menu cha</label>
					<select name="id_parent" required><option value="0">Không có</option>
					<?php foreach($this->list as $menu){ if($this->item->id != $menu->id && $this->item->id_parent == $menu->id) echo '<option value="'.$menu->id.'" selected>'.$menu->prefix.$menu->name.'</option>';
					else if($this->item->id != $menu->id) echo '<option value="'.$menu->id.'">'.$menu->prefix.$menu->name.'</option>'; } ?>
					</select>
				</div>
				<div class="ipg"><label>Tên menu</label><input type="text" name="name" value="<?php echo $this->item->name; ?>" required></div>
				<div class="ipg"><label>Đường dẫn</label><input type="text" name="link" value="<?php echo $this->item->link; ?>"></div>
				<div class="ipg"><label>Tiêu đề</label><input type="text" name="title" value="<?php echo $this->item->title; ?>"></div>
				
				
			</div>
			<div class="col col-6">
				<div class="ipg"><label>Vị trí</label>
					<select name="position" required>
					<?php foreach($this->theme->menu->children() as $position => $name){ 
					if($this->item->position == $position) echo '<option value="'.$position.'" selected>'.$name.'</option>';
					else echo '<option value="'.$position.'">'.$name.'</option>'; } ?>
					</select>
				</div>
				<div class="ipg field"><label>Icon đại diện</label>
				<input type="text" name="icon" value="<?php echo $this->item->icon; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('icon')">Chọn</a></div>
				<div class="ipg field"><label>Hình đại diện</label>
				<input type="text" name="image" value="<?php echo $this->item->image; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('image')">Chọn</a></div>
				<div class="ipg"><label>Sắp xếp</label><input type="number" name="sort" value="<?php echo $this->item->sort; ?>"></div>
				<div class="ipg"><label>Trạng thái</label>
					<span><input type="checkbox" name="published" value="1" <?php if($this->item->published == 1)  echo 'checked'; ?>>Hiển thị</span>
					<span><input type="checkbox" name="featured" value="1" <?php if(!empty($this->item->featured))  echo 'checked'; ?>>Nổi bật</span>
				</div>
			</div>
		</div>
	
		<label class="forTextarea">Mô tả</label>
		<textarea name="description" placeholder="Mô tả"><?php echo $this->item->description; ?></textarea>
		<label class="forTextarea">Nội dung</label>
		<textarea class="areaCKE" name="content" placeholder="Nội dung"><?php echo $this->item->content; ?></textarea>
		<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
		<button class="btn-submit" type="submit" name="task" value="confirm">Xác nhận</button>
	</form>
</div>