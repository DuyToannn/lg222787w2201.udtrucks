<?php 
$this->item = $this->model->ticket->getOne($_GET["id"]);
if(!empty($this->item)) $this->model->ticket->check($_GET['id']);
?>
<div class="block">
	<form class="row frm-post" method="post">
		<div class="col col-6">
			<div class="ipg"><label>Họ tên</label><input readonly value="<?php echo $this->item->name; ?>" required></div>
			<div class="ipg"><label>Điện thoại</label><input readonly value="<?php echo $this->item->phone; ?>" required></div>
			<div class="ipg"><label>Email</label><input readonly value="<?php echo $this->item->email; ?>"></div>
			<div class="ipg"><label>Yêu cầu</label><input readonly value="<?php echo $this->item->subject; ?>" required></div>
		</div>
		<div class="col col-6">
			<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
			<div class="ipg"><label>Ngày tạo</label><input value="<?php echo date('H:i d-m-Y',$this->item->created); ?>" readonly></div>
			<div class="ipg"><label>Tiếp nhận</label><input value="<?php if(!empty($this->item->checked)){ $staff = $this->model->staff->getOne($this->item->checked_by, 'code'); echo 'Lúc '.date('H:i d/m/Y',$this->item->checked).' bởi '.$staff->name;} ?>" readonly></div>
			<div class="ipg"><label>Cập nhật</label><input value="<?php if(!empty($this->item->updated)){ $staff = $this->model->staff->getOne($this->item->updated_by, 'code'); echo 'Lúc '.date('H:i d/m/Y',$this->item->updated).' bởi '.$staff->name;} ?>" readonly></div>
			<div class="ipg"><label>Hoàn tất</label><input value="<?php if(!empty($this->item->completed)){ $staff = $this->model->staff->getOne($this->item->completed_by, 'code'); echo 'Lúc '.date('H:i d/m/Y',$this->item->completed).' bởi '.$staff->name;} ?>" readonly></div>
		</div>
		<div class="col col-12">
			<label class="forTextarea">Nội dung yêu cầu</label>
			<textarea readonly disabled><?php echo $this->item->content; ?></textarea>
			<label class="forTextarea">Ghi chú</label>
			<textarea name="comment"><?php echo $this->item->comment; ?></textarea>
			<?php if($this->item->status == 0 || $this->item->status == 1){ ?><button class="btn-submit" type="submit" name="task" value="complete" onclick="return confirm('Bạn chắc chắn hoàn tất!?')">Hoàn tất</button><?php } ?>
			<?php if($this->item->status == 2){ ?><button class="btn-submit" type="submit" name="task" value="delete" onclick="return confirm('Bạn chắc chắn muốn xóa yêu cầu!?')">Xóa yêu cầu</button><?php } ?>
			<button class="btn-request" type="submit" name="task" value="update" onclick="return confirm('Bạn chắc chắn muốn cập nhật!?')">Cập nhật</button>
		</div>
	</form>
</div>