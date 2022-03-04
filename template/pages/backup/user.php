<div class="container">
	<aside id="user-menu" class="desktop">
		<div class="user-menu-header">
			<img src="/theme/images/user.png">
			<label>Tài khoản của</label>
			<strong><?=$this->user->name?></strong>
		</div>
		<ul class="user-menu-list">
			<li <?php if($this->item->view == "user") echo 'class="active"';?>><a href="/user">
				<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
				<span>Cài đặt thông tin</span>
			</a></li>
			<li <?php if($this->item->view == "order") echo 'class="active"';?>><a href="/user/order">
				<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M13 12h7v1.5h-7zm0-2.5h7V11h-7zm0 5h7V16h-7zM21 4H3c-1.1 0-2 .9-2 2v13c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 15h-9V6h9v13z"></path></svg>
				<span>Quản lý giao dịch</span>
			</a></li>
			<li><a href="/?logout">
				<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" ><path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z" class=""></path></svg>
				<span>Đăng xuất</span>
			</a></li>
		</ul>
	</aside>
	<nav class="mobile user-mobile-menu">
		<a href="/user">
				<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>
				<span>Thông tin</span>
			</a>
		<a href="/user/order">
				<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M13 12h7v1.5h-7zm0-2.5h7V11h-7zm0 5h7V16h-7zM21 4H3c-1.1 0-2 .9-2 2v13c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 15h-9V6h9v13z"></path></svg>
				<span>Giao dịch</span>
			</a>
		<a href="/?logout">
				<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" ><path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z" class=""></path></svg>
				<span>Đăng xuất</span>
			</a>
	</nav>
	<div id="user-content">
		<?php if($this->item->view == "user"){ ?>
		<div class="user-content-block">
			<div class="user-content-block-header user-verified-<?=$this->user->verified?>">
				<h2>Thông tin tài khoản</h2>
				<p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
			</div>
			<form class="user-content-form" method="post" enctype="multipart/form-data">
				<div class="ipg"><label>Họ và tên</label><input type="text" name="name" value="<?=$this->user->name?>" required=""></div>
				<div class="ipg"><label>Số điện thoại</label><input class="isPhone" pattern="[0-9]{10,11}" type="text" name="phone" value="<?=$this->user->phone?>" required=""></div>
				<div class="ipg"><label>Email</label><input type="email" name="email" value="<?=$this->user->email?>" required></div>
				<div class="ipg address"><label>Địa chỉ</label>
				<input type="text" name="address" value="<?=$this->user->address?>" required>
					<select name="id_province" required>
						<option value="">Tỉnh/Thành</option>
						<?php foreach($this->model->location->getProvince() as $item){
								if($item->id == $this->user->id_province) echo '<option value="'.$item->id.'" selected>'.$item->name.'</option>';
								else echo '<option value="'.$item->id.'">'.$item->name.'</option>';
							};
						?>
					</select>
				</div>
				<button type="submit" name="task" value="userUpdate">Cập nhật</button>
			</form>
		</div>
		<div class="user-content-block">
			<div class="user-content-block-header">
				<h2>Đổi mật khẩu</h2>
				<p>Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</p>
			</div>
			<form class="user-content-form" method="post">
				<div class="ipg"><label>Mật khẩu hiện tại</label><input class="isPwd" type="password" name="old" required=""></div>
				<div class="ipg"><label>Mật khẩu mới</label><input class="isPwd" type="password" name="new" required=""></div>
				<div class="ipg"><label>Xác nhận lại</label><input class="isPwd" type="password" name="password" required=""></div>
				<button type="submit" name="task" value="userChange">Xác nhận</button>
			</form>
		</div>
		<?php } else include_once("user.".$this->item->view);?>
	</div>
</div>