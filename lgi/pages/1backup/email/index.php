<script>
function sendTest(a){
	$(a).html('...');
	var _POST = $(".frm-waiting").serializeArray();
	if(_POST.length > 1){
		_POST.push({name:"sendEmail", value: "test"});
		$(".frm-post").removeClass('frm-waiting');
		$.post("/<?=HOME?>?page=email", _POST, function(json){
			alert(json);
			$(".frm-post").addClass('frm-waiting');
			$(a).html('Gửi');
		});
	}
}
</script>
<div class="block">
	<form method="post" class="frm-post frm-waiting" action="/<?php echo HOME; ?>?page=email">
		<button class="btn-submit" id="frm-item-btn-submit" type="submit" name="task" value="confirm" style="display:none;">Xác nhận</button>
		<ul class="tab-label">
			<li class="active"><a href="javascript:void(0);" onclick="$('.tab-label li').removeClass('active'); $(this).parent().addClass('active'); $('.tab-content').fadeOut(0); $('#tab-1').fadeIn();">Cấu hình Email</a></li>
			<li><a href="javascript:void(0);" onclick="$('.tab-label li').removeClass('active'); $(this).parent().addClass('active'); $('.tab-content').fadeOut(0); $('#tab-2').fadeIn();">Email cơ bản</a></li>
			<li><a href="javascript:void(0);" onclick="$('.tab-label li').removeClass('active'); $(this).parent().addClass('active'); $('.tab-content').fadeOut(0); $('#tab-3').fadeIn();">Email chăm sóc</a></li>
			<li class="click-submit"><a href="javascript:void(0);" onclick="$('#frm-item-btn-submit').click();">Lưu lại</a></li>
		</ul>
		<div class="tab-content" id="tab-1" style="display:block;">
			<div class="row">
				<div class="col col-6">
					<div class="ipg"><label>Máy chủ email</label><input type="text" name="email[host]" value="<?=$this->model->setting->getOne("email","host")?>"></div>
					<div class="ipg"><label>Tài khoản email</label><input type="text" name="email[username]" value="<?=$this->model->setting->getOne("email","username")?>"></div>
					<div class="ipg"><label>Gửi từ email</label><input type="text" name="email[from]" value="<?=$this->model->setting->getOne("email","from")?>"></div>
					<div class="ipg field"><label>Email nhận thử</label><input type="text" name="email[test]" value="<?=$this->model->setting->getOne("email","test")?>">
					<a class="btn-save" href="javascript:void(0);" onclick="sendTest(this);">Gửi</a></div>
				</div>
				<div class="col col-6">
					<div class="ipg"><label>Cổng TLS</label><input type="text" name="email[port]" value="<?=$this->model->setting->getOne("email","port")?>"></div>
					<div class="ipg"><label>Mật khẩu email</label><input type="password" name="email[password]" value="<?=$this->model->setting->getOne("email","password")?>"></div>
					<div class="ipg"><label>Tên gọi email</label><input type="text" name="email[name]" value="<?=$this->model->setting->getOne("email","name")?>"></div>
					<div class="ipg"><label>Trạng thái</label>
						<span><input type="radio" name="email[active]" value="0" <?php if(empty($this->model->setting->getOne("email","active")))  echo 'checked'; ?>>Ngưng sử dụng</span>
						<span><input type="radio" name="email[active]" value="1" <?php if(!empty($this->model->setting->getOne("email","active")))  echo 'checked'; ?>>Sử dụng</span>
					</div>
				</div>
			</div>
			
		</div>
		<div class="tab-content" id="tab-2">

		</div>
		<div class="tab-content" id="tab-3">

		</div>

	</form>
</div>