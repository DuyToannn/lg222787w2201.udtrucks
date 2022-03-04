<div class="block">
	<form method="post" class="frm-post">
		<div class="row">
			<div class="col col-4">
				<div class="ipg"><label>Mật khẩu cũ</label><input type="password" name="old" required></div>
			</div>
			<div class="col col-4">
				<div class="ipg"><label>Mật khẩu</label><input type="password" name="password" required></div>
			</div>
			<div class="col col-4">
				<div class="ipg"><label>Xác nhận lại</label><input type="password" name="confirm" required></div>
			</div>
		</div>
		<button class="btn-submit" type="submit" name="task" value="change" onclick="return confirm('Bạn đã chắc chắn!?')">Xác nhận</button>
	</form>
</div>