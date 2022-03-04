<div class="module-login" style="background-image: url('/<?php echo HOME; ?>layout/images/background.jpg');">
	<form method="post">
		<img src="/<?php echo HOME; ?>eso.png">
		<h1>Đăng nhập</h1>
		<input name="account" placeholder="Tài khoản hoặc số điện thoại" required class="isAccount" autocomplete="off">
		<input type="password" name="password" placeholder="Mật khẩu" required class="isPwd" autocomplete="off">
		<p>Bạn <a>quên mật khẩu?</a></p>
		<button class="btn fr" type="submit" name="task" value="login">Đăng nhập</button>
	</form>
</div>