<?php
	$categories = array();
	$this->model->category->getAll($categories,0,'');
	$manufacturers = $this->model->manufacturer->getAll();
	if(!empty($_GET['id'])) $this->item = $this->model->product->getOne($_GET['id']);
?>
<div class="block">
	<form id="frm-item" method="post" class="frm-post" action="/<?php echo HOME; ?>?page=product">
		<input type="hidden" name="id" value="<?php echo $this->item->id; ?>" required>
		<button style="display:none;" id="frm-item-btn-submit" class="btn-submit" type="submit" name="task" value="confirm" style="margin-top: 10px; ">Xác nhận</button>
		<ul class="tab-label">
			<li class="active"><a href="javascript:void(0);" onclick="$('.tab-label li').removeClass('active'); $(this).parent().addClass('active'); $('.tab-content').fadeOut(0); $('#tab-1').fadeIn();">Cơ bản</a></li>
			<li><a href="javascript:void(0);" onclick="$('.tab-label li').removeClass('active'); $(this).parent().addClass('active'); $('.tab-content').fadeOut(0); $('#tab-2').fadeIn();">Hình ảnh</a></li>
			<li><a href="javascript:void(0);" onclick="$('.tab-label li').removeClass('active'); $(this).parent().addClass('active'); $('.tab-content').fadeOut(0); $('#tab-3').fadeIn();">Mô tả</a></li>
			<li class="click-submit"><a href="javascript:void(0);" onclick="$('#frm-item-btn-submit').click();">Lưu lại</a></li>
		</ul>
		<div class="tab-content" id="tab-1" style="display:block;">
			<div class="row">
				<div class="col col-6">
					<div class="ipg">
						<label>Danh mục</label>
						<select name="id_category">
							<option value="0">Không có</option>
							<?php foreach($categories as $category){ if($this->item->id_category == $category->id) echo '<option value="'.$category->id.'" selected>'.$category->prefix.$category->name.'</option>';
								else echo '<option value="'.$category->id.'">'.$category->prefix.$category->name.'</option>'; } ?>
						</select>
					</div>
					<div class="ipg">
						<label>Nhà sản xuất</label>
						<select name="id_manufacturer">
							<option value="0">Không rõ</option>
							<?php foreach($manufacturers as $manufacturer){ if($this->item->id_manufacturer == $manufacturer->id) echo '<option value="'.$manufacturer->id.'" selected>'.$manufacturer->name.'</option>';
								else echo '<option value="'.$manufacturer->id.'">'.$manufacturer->name.'</option>'; } ?>
						</select>
					</div>
					<div class="ipg"><label>Tên sản phẩm</label><input type="text" name="name" value="<?php echo $this->item->name; ?>" required></div>
					<div class="ipg"><label>URL sản phẩm</label><input type="text" name="alias" value="<?php echo $this->item->alias; ?>"></div>
					
					
				</div>
				<div class="col col-6">
					
					
					<div class="ipg"><label>Xuất xứ</label><input type="text" name="origin" value="<?php echo $this->item->origin; ?>"></div>
					<div class="clr"></div>
					<div class="row">
						<div class="col col-6">
							<div class="ipg"><label>Mã sản phẩm</label><input type="text" name="sku" class="isSKU" value="<?php echo $this->item->sku; ?>" required></div>
						</div>
						<div class="col col-6">
							<div class="ipg"><label>Điểm thưởng</label><input type="text" name="lp" value="<?php echo $this->item->lp; ?>"></div>
						</div>
					</div>
					
					<div class="clr"></div>
					<div class="row">
						<div class="col col-6">
							<div class="ipg"><label>Giá bán</label><input id="ip_price" type="text" name="price" value="<?php echo number_format($this->item->price); ?>" class="isPrice"></div>
						</div>
						<div class="col col-6">
							<div class="ipg"><label>Giá cũ</label><input id="ip_old" type="text" name="price_old" value="<?php echo number_format($this->item->price_old); ?>" class="isPrice"></div>
						</div>
					</div>
					<div class="clr"></div>
					<div class="row">
						<div class="col col-6">
							<div class="ipg"><label>Giá sốc</label><input type="text" name="price_shock" value="<?php echo number_format($this->item->price_shock); ?>" class="isPrice"></div>
						</div>
						<div class="col col-6">
							<div class="ipg"><label>Số lượng</label><input type="number" name="shock" value="<?=$this->item->shock?>"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="ipg"><label>Trạng thái</label>
				
				<span><input type="checkbox" name="published" value="1" <?php if(!empty($this->item->published))  echo 'checked'; ?>>Hiển thị</span>
				<span><input type="checkbox" name="featured" value="1" <?php if(!empty($this->item->featured))  echo 'checked'; ?>>Nổi bật</span>
				<span><input type="checkbox" name="new" value="1" <?php if(!empty($this->item->new))  echo 'checked'; ?>>Mới về</span>
				<span><input type="checkbox" name="sale" value="1" <?php if(!empty($this->item->sale))  echo 'checked'; ?>>Khuyến mãi</span>
				<span><input type="checkbox" name="top" value="1" <?php if(!empty($this->item->top))  echo 'checked'; ?>>Bán chạy</span>
				<span><input type="checkbox" name="suggest" value="1" <?php if(!empty($this->item->suggest))  echo 'checked'; ?>>Gợi ý</span>
				<span><input type="checkbox" name="coming" value="1" <?php if(!empty($this->item->coming))  echo 'checked'; ?>>Sắp về</span>
				<span><input type="checkbox" name="outstock" value="1" <?php if(!empty($this->item->outstock))  echo 'checked'; ?>>Hết hàng</span>
			</div>
			<div class="clr"></div>
		</div>
		<div class="tab-content" id="tab-2">
			<div class="ipg field"><label>Hình đại diện</label>
				<input type="text" name="image" value="<?php echo $this->item->image; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('image')">Chọn</a>
			</div>
			<div class="ipg field"><label>Hình banner</label>
				<input type="text" name="banner" value="<?php echo $this->item->banner; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('banner')">Chọn</a>
			</div>
			<div class="ipg field"><label>Album ảnh</label>
				<input type="text" name="photo" value="<?php echo $this->item->photo; ?>"><a class="btn-save" href="javascript:void(0);" onclick="openFM('photo')">Chọn</a>
			</div>
			<div class="ipg"><label>Video</label><input type="text" name="video" value="<?php echo $this->item->video; ?>"></div>
			
		</div>
		<div class="tab-content" id="tab-3">
			<div class="ipg"><label>Thẻ Title</label><input type="text" name="title" value="<?php echo $this->item->title; ?>"></div>
			<label class="forTextarea">Thẻ Description</label>
			<textarea name="description" placeholder="Thẻ Description"><?php echo $this->item->description; ?></textarea>
			<label class="forTextarea">Điểm nổi bật</label>
			<textarea class="areaCKE" name="highlight"><?php echo $this->item->highlight; ?></textarea>
			<label class="forTextarea">Chi tiết</label>
			<textarea class="areaCKE" name="content"><?php echo $this->item->content; ?></textarea>
			<label class="forTextarea">Thông số</label>
			<textarea class="areaCKE" name="specs"><?php echo $this->item->specs; ?></textarea>
		</div>
	</form>
</div>