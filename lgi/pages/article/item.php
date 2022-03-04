<?php
	$blogs = array();
	$this->model->blog->getAll($blogs,0,'');
	if(!empty($_GET['id'])) $this->item = $this->model->article->getOne($_GET['id']);
?>
<div class="block">
	<form method="post" class="frm-post" action="/<?php echo HOME; ?>?page=article">
		<div class="row">
			<div class="col col-6">
				<div class="ipg"><label>Danh mục</label>
					<select name="id_blog">
						<option value="0">Không có</option>
					<?php foreach($blogs as $blog){ if($this->item->id_blog == $blog->id) echo '<option value="'.$blog->id.'" selected>'.$blog->prefix.$blog->name.'</option>';
					else echo '<option value="'.$blog->id.'">'.$blog->prefix.$blog->name.'</option>'; } ?>
					</select>
				</div>
				<div class="ipg"><label>Bài viết</label><input type="text" name="title" value="<?php echo $this->item->title; ?>" required></div>
				<div class="ipg"><label>Đường dẫn</label><input type="text" name="alias" value="<?php echo $this->item->alias; ?>"></div>
				
				
			</div>
			<div class="col col-6">
				
				<div class="ipg field"><label>Hình đại diện</label>
					<input type="text" name="image" value="<?php echo $this->item->image; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('image')">Chọn</a>
				</div>
				<div class="ipg"><label>Trạng thái</label>
					<span><input type="checkbox" name="published" value="1" <?php if(!empty($this->item->published))  echo 'checked'; ?>>Hiển thị</span>
					<span><input type="checkbox" name="featured" value="1" <?php if(!empty($this->item->featured))  echo 'checked'; ?>>Nổi bật</span>
					<span><input type="checkbox" name="hot" value="1" <?php if(!empty($this->item->hot))  echo 'checked'; ?>>Tiêu điểm</span>
				</div>
			</div>
		</div>
		<textarea name="summary" placeholder="Tóm tắc"><?php echo $this->item->summary; ?></textarea>
		<label class="forTextarea">Nội dung</label>
		<textarea class="areaCKE" name="content" placeholder="Nội dung"><?php echo $this->item->content; ?></textarea>
		<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
		<button style="margin-top: 10px;" class="btn-submit" type="submit" name="task" value="confirm">Xác nhận</button>
	</form>
</div>