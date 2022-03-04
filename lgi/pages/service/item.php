<?php
	$categories = array();
	$this->model->category->getAll($categories,0,'');
	if(!empty($_GET['id'])) $this->item = $this->model->service->getOne($_GET['id']);
?>
<div class="block">
	<form method="post" class="frm-post" action="/<?php echo HOME; ?>?page=service">
		<div class="row">
			<div class="col col-6">
				<div class="ipg"><label>Danh mục</label>
					<select name="id_category">
						<option value="0">Không có</option>
					<?php foreach($categories as $category){ if($this->item->id_category == $category->id) echo '<option value="'.$category->id.'" selected>'.$category->prefix.$category->name.'</option>';
					else echo '<option value="'.$category->id.'">'.$category->prefix.$category->name.'</option>'; } ?>
					</select>
				</div>
				<div class="ipg"><label>Dịch vụ</label><input type="text" name="name" value="<?php echo $this->item->name; ?>" required></div>
				<div class="ipg"><label>Đường dẫn</label><input type="text" name="alias" value="<?php echo $this->item->alias; ?>"></div>
				<div class="ipg"><label>Thẻ Title</label><input type="text" name="title" value="<?php echo $this->item->title; ?>"></div>
				
			</div>
			<div class="col col-6">
				<div class="ipg field"><label>Hình đại diện</label>
					<input type="text" name="image" value="<?php echo $this->item->image; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('image')">Chọn</a>
				</div>
				<div class="ipg field"><label>Hình banner</label>
					<input type="text" name="banner" value="<?php echo $this->item->banner; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('banner')">Chọn</a>
				</div>
				<div class="ipg field"><label>Hình icon</label>
					<input type="text" name="icon" value="<?php echo $this->item->icon; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('icon')">Chọn</a>
				</div>
				<div class="ipg"><label>Trạng thái</label>
					<span><input type="checkbox" name="published" value="1" <?php if(!empty($this->item->published))  echo 'checked'; ?>>Hiển thị</span>
					<span><input type="checkbox" name="featured" value="1" <?php if(!empty($this->item->featured))  echo 'checked'; ?>>Nổi bật</span>
				</div>
			</div>
		</div>
		<textarea name="description" placeholder="Thẻ Description"><?php echo $this->item->description; ?></textarea>
		<label class="forTextarea">Nội dung</label>
		<textarea class="areaCKE" name="content" placeholder="Nội dung"><?php echo $this->item->content; ?></textarea>
		<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
		<button style="margin-top: 10px;" class="btn-submit" type="submit" name="task" value="confirm">Xác nhận</button>
	</form>
</div>