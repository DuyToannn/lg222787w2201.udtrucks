
<div class="block">
	<form method="post" class="frm-post" action="/<?php echo HOME; ?>?page=setting">
		<div class="row">
			<div class="col col-6">
				<div class="ipg"><label>Tên website</label><input type="text" name="setting[name]" value="<?=$this->model->setting->getOne("setting","name")?>"></div>
				<div class="ipg"><label>Slogan</label><input type="text" name="setting[slogan]" value="<?=$this->model->setting->getOne("setting","slogan")?>"></div>
				
				<div class="ipg"><label>Điện thoại</label><input type="text" name="setting[phone]" value="<?=$this->model->setting->getOne("setting","phone")?>"></div>
				<div class="ipg"><label>Hotline</label><input type="text" name="setting[hotline]" value="<?=$this->model->setting->getOne("setting","hotline")?>"></div>
				
				<div class="ipg"><label>Email</label><input type="text" name="setting[email]" value="<?=$this->model->setting->getOne("setting","email")?>"></div>
				<div class="ipg"><label>Địa chỉ</label><input type="text" name="setting[address]" value="<?=$this->model->setting->getOne("setting","address")?>"></div>
				<div class="ipg"><label>Số Zalo</label><input type="text" name="setting[zalo]" value="<?=$this->model->setting->getOne("setting","zalo")?>"></div>
				<div class="ipg"><label>Messenger</label><input type="text" name="setting[messenger]" value="<?=$this->model->setting->getOne("setting","messenger")?>"></div>
			</div>
			<div class="col col-6">
				
				<div class="ipg field"><label>Hình logo</label>
					<input type="text" id="inputlogo" name="setting[logo]" value="<?=$this->model->setting->getOne("setting","logo")?>"><a class="btn-save" href="javascript:void(0);" onclick="openByID('inputlogo')">Chọn</a>
				</div>
				<div class="ipg field"><label>Favicon</label>
					<input type="text" id="inputfavicon" name="setting[favicon]" value="<?=$this->model->setting->getOne("setting","favicon")?>"><a class="btn-save" href="javascript:void(0);" onclick="openByID('inputfavicon')">Chọn</a>
				</div>
				<div class="ipg"><label>Facebook</label><input type="text" name="setting[facebook]" value="<?=$this->model->setting->getOne("setting","facebook")?>"></div>
				
				<div class="ipg"><label>Youtube</label><input type="text" name="setting[youtube]" value="<?=$this->model->setting->getOne("setting","youtube")?>"></div>
				<div class="ipg"><label>Instagram</label><input type="text" name="setting[instagram]" value="<?=$this->model->setting->getOne("setting","instagram")?>"></div>
				<div class="ipg"><label>Tiêu đề</label><input type="text" name="setting[title]" value="<?=$this->model->setting->getOne("setting","title")?>"></div>
				<div class="ipg"><label>Mô tả</label><input type="text" name="setting[description]" value="<?=$this->model->setting->getOne("setting","description")?>"></div>
				<div class="ipg field"><label>Ảnh đại diện</label>
					<input type="text" id="setting_image" name="setting[image]" value="<?=$this->model->setting->getOne("setting","image")?>"><a class="btn-save" href="javascript:void(0);" onclick="openByID('setting_image')">Chọn</a>
				</div>
			
				
			</div>
			
			
		</div>
		<label class="forTextarea">Bản đồ</label>
		<textarea name="setting[map]" placeholder="Bản đồ"><?=$this->model->setting->getOne("setting","map")?></textarea>
		
		<?php foreach($this->template->string->children() as $string => $name){ ?>
		<div class="ipg"><label>[<?=$name?>]</label><input type="text" name="string[<?=$string?>]" value="<?=$this->model->setting->getOne("string",$string)?>" required></div>
		<?php } ?>
		
		<?php foreach($this->template->text->children() as $text => $name){ ?>
		<label class="forTextarea">[<?=$name?>]</label>
		<textarea name="text[<?=$text?>]" placeholder="<?=$name?>" required><?=$this->model->setting->getOne("text",$text)?></textarea>
		<?php } ?>
		
		<button class="btn-submit" type="submit" name="task" value="confirm">Xác nhận</button>
	</form>
</div>