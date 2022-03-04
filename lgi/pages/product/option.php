<?php
	$colors = json_decode($this->item->color);
	$sizes = json_decode($this->item->size);
	$types = json_decode($this->item->type);
?>
<label class="forTextarea">Màu sắc</label>
			<div class="clr"></div>
			<div class="row">
				<div class="col col-3">
					<div class="ipg"><label>Tên gọi</label><input type="text" id="color_name"></div>
				</div>
				
				<div class="col col-3">
					<div class="ipg"><label>Mã màu</label><input type="color" id="color_code"></div>
				</div>
				<div class="col col-3">
					<div class="ipg field"><label>Hình ảnh</label>
						<input type="text" id="color_image" name="color_image"><a class="btn-save" href="javascript:void(0);" onclick="openFM('color_image')">Chọn</a>
					</div>
				</div>
				<div class="col col-3">
					<div class="ipg field"><label>Mã phụ</label><input type="text" id="color_sku" class="isSKU"><a class="btn-save" href="javascript:void(0);" onclick="addColor();">Thêm</a></div>
				</div>
				<script type="text/javascript">
					function addColor(){
						var name = $("#color_name").val();
						var image = $("#color_image").val();
						var code = $("#color_code").val();
						var sku = $("#color_sku").val();
						if(name == '' || image == '' || code == '' || sku == '') alert('Vui lòng điền đầy đủ thông tin');
						else{
							var color = '<tr><td><input class="readonly" name="color['+sku+'][name]" value="'+name+'" required></td><td><input class="readonly" name="color['+sku+'][image]" value="'+image+'" required></td><td align="center"><input class="readonly" type="color" name="color['+sku+'][code]" value="'+code+'" required></td><td align="center"><input class="readonly isSKU center" name="color['+sku+'][sku]" value="'+sku+'" readonly required></td><td align="center"><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Xóa</a></td></tr>';
							$("#color_list").append(color);
							$("#color_name").val('');
							$("#color_image").val('');
							$("#color_code").val('');
							$("#color_sku").val('');
							issetIP();
						}
					}
				</script>
			</div>
			<div class="col">
				<table class="list-data" style="margin: 0 -10px;border: 1px solid #ddd;">
					<tbody id="color_list">
						<tr>
							<th width="300" align="left">Tên gọi</th>
							<th align="left">Hình ảnh</th>
							<th width="150">Mã màu</th>
							<th width="150">Mã phụ</th>
							<th width="50"></th>
						</tr>
						<?php foreach($colors as $color) {?>
						<tr>
							<td><input class="readonly" name="color[<?=$color->sku?>][name]" value="<?php echo $color->name; ?>" required></td>
							<td><input class="readonly" name="color[<?=$color->sku?>][image]" value="<?php echo $color->image; ?>" required></td>
							<td align="center"><input class="readonly" type="color" name="color[<?=$color->sku?>][code]" value="<?php echo $color->code; ?>" required></td>
							<td align="center"><input class="readonly isSKU center" name="color[<?=$color->sku?>][sku]" value="<?php echo $color->sku; ?>" readonly required></td>
							<td align="center"><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Xóa</a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<label class="forTextarea blockHeading">Kích thước/Dung tích/Size</label>
			<div class="clr"></div>
			<div class="row">
				<div class="col col-3">
					<div class="ipg"><label>Định nghĩa</label><input type="text" name="size_define" value="<?=$this->item->size_define?>"></div>
				</div>
				<div class="col col-3">
					<div class="ipg"><label>Tên gọi</label><input type="text" id="size_name"></div>
				</div>
				<div class="col col-3">
					<div class="ipg field"><label>Hình ảnh</label>
						<input type="text" id="size_image" name="size_image"><a class="btn-save" href="javascript:void(0);" onclick="openFM('size_image')">Chọn</a>
					</div>
				</div>
				<div class="col col-3">
					<div class="ipg field"><label>Mã phụ</label><input type="text" id="size_sku" class="isSKU"><a class="btn-save" href="javascript:void(0);" onclick="addSize();">Thêm</a></div>
				</div>
				<script type="text/javascript">
					function addSize(){
						var name = $("#size_name").val();
						var image = $("#size_image").val();
						var sku = $("#size_sku").val();
						if(name == '' || image == '' || sku == '') alert('Vui lòng điền đầy đủ thông tin');
						else{
							var size = '<tr><td><input class="readonly" name="size['+sku+'][name]" value="'+name+'" required></td><td><input class="readonly" name="size['+sku+'][image]" value="'+image+'" required></td><td align="center"><input class="readonly isSKU center" name="size['+sku+'][sku]" value="'+sku+'" readonly required></td><td align="center"><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Xóa</a></td></tr>';
							$("#size_list").append(size);
							$("#size_name").val('');
							$("#size_image").val('');
							$("#size_sku").val('');
							issetIP();
						}
					}
				</script>
			</div>
			<div class="col">
				<table class="list-data" style="margin: 0 -10px;border: 1px solid #ddd;">
					<tbody id="size_list">
						<tr>
							<th width="300" align="left">Tên gọi</th>
							<th align="left">Hình ảnh</th>
							<th width="150">Mã phụ</th>
							<th width="50"></th>
						</tr>
						<?php foreach($sizes as $size) {?>
						<tr>
							<td><input class="readonly" name="size[<?=$size->sku?>][name]" value="<?php echo $size->name; ?>" required></td>
							<td><input class="readonly" name="size[<?=$size->sku?>][image]" value="<?php echo $size->image; ?>" required></td>
							<td align="center"><input class="readonly isSKU center" name="size[<?=$size->sku?>][sku]" value="<?php echo $size->sku; ?>" readonly required></td>
							<td align="center"><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Xóa</a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<label class="forTextarea blockHeading">Phân loại/Chất liệu/Thành phần</label>
			<div class="clr"></div>
			<div class="row">
				<div class="col col-3">
					<div class="ipg"><label>Định nghĩa</label><input type="text" name="type_define" value="<?=$this->item->type_define?>"></div>
				</div>
				<div class="col col-3">
					<div class="ipg"><label>Tên gọi</label><input type="text" id="type_name"></div>
				</div>
				<div class="col col-3">
					<div class="ipg field"><label>Hình ảnh</label>
						<input type="text" id="type_image" name="type_image"><a class="btn-save" href="javascript:void(0);" onclick="openFM('type_image')">Chọn</a>
					</div>
				</div>
				<div class="col col-3">
					<div class="ipg field"><label>Mã phụ</label><input type="text" id="type_sku" class="isSKU"><a class="btn-save" href="javascript:void(0);" onclick="addType();">Thêm</a></div>
				</div>
				<script type="text/javascript">
					function addType(){
						var name = $("#type_name").val();
						var image = $("#type_image").val();
						var sku = $("#type_sku").val();
						if(name == '' || image == '' || sku == '') alert('Vui lòng điền đầy đủ thông tin');
						else{
							var type = '<tr><td><input class="readonly" name="type['+sku+'][name]" value="'+name+'" required></td><td><input class="readonly" name="type['+sku+'][image]" value="'+image+'" required></td><td align="center"><input class="readonly isSKU center" name="type['+sku+'][sku]" value="'+sku+'" readonly required></td><td align="center"><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Xóa</a></td></tr>';
							$("#type_list").append(type);
							$("#type_name").val('');
							$("#type_image").val('');
							$("#type_sku").val('');
							issetIP();
						}
					}
				</script>
			</div>
			<div class="col">
				<table class="list-data" style="margin: 0 -10px;border: 1px solid #ddd;">
					<tbody id="type_list">
						<tr>
							<th width="300" align="left">Tên gọi</th>
							<th align="left">Hình ảnh</th>
							<th width="150">Mã phụ</th>
							<th width="50"></th>
						</tr>
						<?php foreach($types as $type) { ?>
						<tr>
							<td><input class="readonly" name="type[<?=$type->sku?>][name]" value="<?php echo $type->name; ?>" required></td>
							<td><input class="readonly" name="type[<?=$type->sku?>][image]" value="<?php echo $type->image; ?>" required></td>
							<td align="center"><input class="readonly isSKU center" name="type[<?=$type->sku?>][sku]" value="<?php echo $type->sku; ?>" readonly required></td>
							<td align="center"><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Xóa</a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>