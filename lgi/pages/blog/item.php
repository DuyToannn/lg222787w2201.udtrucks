<?php
	$this->list = array();
	$this->model->blog->getParent($this->list);
	if(!empty($_GET['id'])) $this->item = $this->model->blog->getOne($_GET['id']);
?>
<div class="block">
	<form method="post" class="frm-post" action="/<?php echo HOME; ?>?page=blog">
		<div class="row">
			<div class="col col-6">
				<div class="ipg"><label>Danh mục cha</label>
					<select name="id_parent" required><option value="0">Không có</option>
					<?php foreach($this->list as $item){ 
					if(!empty($this->item) && $this->item->id != $item->id && $this->item->id != $item->id_parent){
						if($this->item->id_parent == $item->id) echo '<option value="'.$item->id.'" selected>'.$item->prefix.$item->name.'</option>';
						else echo '<option value="'.$item->id.'">'.$item->prefix.$item->name.'</option>'; 
					}else if(empty($this->item)) echo '<option value="'.$item->id.'">'.$item->prefix.$item->name.'</option>'; } ?>
					</select>
				</div>
				<div class="ipg"><label>Tên danh mục</label><input type="text" name="name" value="<?php echo $this->item->name; ?>" required></div>
				<div class="ipg"><label>Đường dẫn</label><input type="text" name="alias" value="<?php echo $this->item->alias; ?>"></div>
				
				
				
				
			</div>
			<div class="col col-6">
				<div class="ipg field"><label>Hình đại diện</label>
					<input type="text" name="image" value="<?php echo $this->item->image; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('image')">Chọn</a>
				</div>
				<div class="ipg"><label>Sắp xếp</label>
					<input type="number" name="sort" value="<?php echo $this->item->sort; ?>">
				</div>
				<div class="ipg"><label>Trạng thái</label>
					<span><input type="checkbox" name="published" value="1" <?php if($this->item->published == 1)  echo 'checked'; ?>>Hiển thị</span>
					<span><input type="checkbox" name="featured" value="1" <?php if(!empty($this->item->featured))  echo 'checked'; ?>>Nổi bật</span>
				</div>
			</div>
		</div>
		<div class="ipg"><label>Tiêu đề</label><input type="text" name="title" value="<?php echo $this->item->title; ?>"></div>
		<textarea name="description" placeholder="Mô tả"><?php echo $this->item->description; ?></textarea>
		<label class="forTextarea">Nội dung</label>
		<textarea class="areaCKE" name="content" placeholder="Nội dung tiếng Việt"><?php echo $this->item->content; ?></textarea>
		<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
		<button class="btn-submit" type="submit" name="task" value="confirm">Xác nhận</button>
	</form>
</div>