<?php
	$positions = array('head' => "Trong Head",'top' => "Đầu Body",'bottom' => "Cuối Body",'complete' => "Xác nhận thành công");
	if(!empty($_GET['id'])) $this->item = $this->model->script->getOne($_GET['id']);
?>
<div class="block">
	<form method="post" class="frm-post" action="/<?php echo HOME; ?>?page=script">
		<div class="row">
			<div class="col col-6">
				<div class="ipg"><label>Tên mã Script</label><input type="text" name="name" value="<?php echo $this->item->name; ?>" required></div>
			</div>
			<div class="col col-6">
				<div class="ipg"><label>Vị trí</label>
					<select name="position" required>
					<?php foreach($positions as $position => $name){ if($this->item->position == $position) echo '<option value="'.$position.'" selected>'.$name.'</option>';
					else echo '<option value="'.$position.'">'.$name.'</option>'; } ?>
					</select>
				</div>
			</div>
			<div class="col col-12">
				<label class="forTextarea">Nội dung</label>
				<textarea id="content" name="content" placeholder="Nội dung"><?php echo $this->item->content; ?></textarea>
			</div>
		</div>
		
		
		<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
		<button class="btn-submit" type="submit" name="task" value="confirm">Xác nhận</button>
	</form>
</div>