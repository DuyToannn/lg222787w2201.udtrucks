<?php 
$this->item = $this->model->comment->getOne($_GET["id"]);
$type = $this->item->type; $item = $this->model->$type->getOne($this->item->code);
$name = $item->name; if(empty($name)) $name = $item->title;
?>
<div class="block">
	<form class="row frm-post" method="post">
		<div class="col col-6">
			<div class="ipg"><label>Họ tên</label><input readonly value="<?php echo $this->item->name; ?>" required></div>
			<div class="ipg"><label>Điện thoại</label><input readonly value="<?php echo $this->item->phone; ?>" required></div>
			<div class="ipg"><label>Email</label><input readonly value="<?php echo $this->item->email; ?>"></div>
			<div class="ipg"><label>Tiêu đề</label><input readonly value="<?php echo $this->item->title; ?>" required></div>
		</div>
		<div class="col col-6">
			<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
			<div class="ipg"><label>Ngày tạo</label><input value="<?php echo date('H:i d-m-Y',$this->item->created); ?>" readonly></div>
			<div class="ipg field"><label>Bình luận trên</label><input value="<?=$name?>" readonly><a class="btn-save" href="?page=<?=$type?>&id=<?=$this->item->code?>">Xem</a></div>
			<div class="ipg"><label>Cập nhật</label><input value="<?php if(!empty($this->item->updated)){ $staff = $this->model->staff->getOne($this->item->updated_by, 'code'); echo 'Lúc '.date('H:i d/m/Y',$this->item->updated).' bởi '.$staff->name;} ?>" readonly></div>
			<div class="ipg"><label>Trạng thái</label>
					<span><input type="checkbox" name="published" value="1" <?php if(!empty($this->item->published))  echo 'checked'; ?>>Hiển thị</span>
					<span><input type="checkbox" name="featured" value="1" <?php if(!empty($this->item->featured))  echo 'checked'; ?>>Nổi bật</span>
				</div>
		</div>
		<div class="col col-12">
			<label class="forTextarea">Nội dung bình luận</label>
			<textarea readonly disabled><?php echo $this->item->content; ?></textarea>
			<label class="forTextarea">Phản hồi</label>
			<textarea name="comment"><?php echo $this->item->comment; ?></textarea>
			<button class="btn-submit" type="submit" name="task" value="delete" onclick="return confirm('Bạn chắc chắn muốn xóa bình luận!?')">Xóa bình luận</button>
			<button class="btn-request" type="submit" name="task" value="update" onclick="return confirm('Bạn chắc chắn muốn cập nhật!?')">Cập nhật</button>
		</div>
	</form>
</div>