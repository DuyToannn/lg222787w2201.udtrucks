<?php if(!empty($_GET['id'])) $this->item = $this->model->banner->getOne($_GET['id']); ?>
<div class="block">
	<form method="post" class="frm-post" action="/<?php echo HOME; ?>?page=banner">
		<div class="row">
			<div class="col col-6">
				<div class="ipg"><label>Tên banner</label><input type="text" name="name" value="<?php echo $this->item->name; ?>" required></div>
				<div class="ipg"><label>Liên kết</label><input type="text" name="link" value="<?php echo $this->item->link; ?>"></div>
				<div class="ipg"><label>Vị trí</label>
					<select name="position" required>
					<?php foreach($this->template->banner->children() as $position => $name){ 
					if($this->item->position == $position) echo '<option value="'.$position.'" selected>'.$name.'</option>';
					else echo '<option value="'.$position.'">'.$name.'</option>'; } ?>
					</select>
				</div>
			</div>
			<div class="col col-6">
				<div class="ipg field"><label>Hình ảnh</label>
					<input type="text" name="image" value="<?php echo $this->item->image; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('image')">Chọn</a>
				</div>
				<div class="clr"></div>
				<div class="row">
				<div class="col col-6">
				<div class="ipg"><label>Hành động</label><input type="text" name="button" value="<?php echo $this->item->button; ?>"></div>
				</div>
				<div class="col col-6">
				<div class="ipg"><label>Thứ tự</label><input type="number" name="sort" value="<?php echo $this->item->sort; ?>"></div>
				</div>
				</div>
				<div class="ipg"><label>Trạng thái</label>
					<span><input type="checkbox" name="published" value="1" <?php if($this->item->published == 1)  echo 'checked'; ?>>Hiển thị</span>
				</div>
			</div>
			<div class="col col-12">
				<label class="forTextarea">Mô tả</label>
				<textarea class="areaCKE" name="description" placeholder="Mô tả"><?php echo $this->item->description; ?></textarea>
			</div>
		</div>
		
		
		<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
		<button class="btn-submit" type="submit" name="task" value="confirm">Xác nhận</button>
	</form>
</div>