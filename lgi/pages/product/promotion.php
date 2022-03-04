<?php
	$combos = json_decode($this->item->combo);
	$gifts = json_decode($this->item->gift);
?>
<label class="forTextarea">Khuyến mãi</label>
<textarea class="areaCKE" name="promotion"><?php echo $this->item->promotion; ?></textarea>
<div class="clr"></div>

<label class="forTextarea blockHeading">Quà tặng kèm</label>
			<div class="clr"></div>
			<div class="row">
				<div class="col col-4">
					<div class="ipg"><label>Chọn tối đa</label><input type="number" min=0 name="gift_max" value="<?=$this->item->gift_max?>"></div>
				</div>
				<div class="col col-8">
					<div class="ipg"><label>Sản phẩm tặng</label><input type="text" id="searchGiftKeyword" onkeyup="searchGift(this)"><div class="search-result" id="searchGift"></div></div>
					
				</div>
				<script type="text/javascript">
					function searchGift(e){
						$('#searchGift').html('');
						$.post("index.php?page=product",{ajax: 'searchProduct', keyword: $(e).val()},function(json, status){
							var products =  JSON.parse(json);
							var result = '';
							$(products).each(function() {
								result += '<a href="javascript:void(0);" onclick="addGift(\''+this.name+'\', \''+this.sku+'\')">'+this.name+'</a>';
							});
							$('#searchGift').html(result);
						});
					}
					function addGift(name, sku){
						let gift = '<tr><td><input class="readonly" readonly value="'+name+'" required> <input type="hidden" name="gift[]" value="'+sku+'" required></td><td align="center"><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Xóa</a></td></tr>';
						$("#gift_list").append(gift);
						$('#searchGiftKeyword').val('');
						$('#searchGift').html('');
					}
				</script>
			</div>
			<div class="col">
				<table class="list-data" style="margin: 0 -10px;border: 1px solid #ddd;">
					<tbody id="gift_list">
						<tr>
							<th align="left">Sản phẩm tặng</th>
							<th width="50"></th>
						</tr>
						<?php foreach($gifts as $gift) { $product = $this->model->product->getOne($gift, 'sku'); ?>
						<tr>
							<td><input class="readonly" readonly value="<?=$product->name?>'" required> <input type="hidden" name="gift[]" value="<?=$gift?>" required></td>
							<td align="center"><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Xóa</a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			
<label class="forTextarea blockHeading">Mua theo COMBO</label>
			<div class="clr"></div>
			<div class="row">
				<div class="col col-4">
					<div class="ipg"><label>Chọn tối đa</label><input type="number" min=0 name="combo_max" value="<?=$this->item->combo_max?>"></div>
				</div>
				<div class="col col-5">
					<div class="ipg"><label>Sản phẩm</label><input type="text" id="searchComboKeyword" onkeyup="searchCombo(this)"><div class="search-result" id="searchCombo"></div></div>
				</div>
				<div class="col col-3">
					<div class="ipg field"><label>Giá Combo</label><input type="text" id="combo_price" data-sku=""><a class="btn-save" href="javascript:void(0);" onclick="addCombo();">Thêm</a></div>
				</div>
				<script type="text/javascript">
					function searchCombo(e){
						$('#searchCombo').html('');
						$.post("index.php?page=product",{ajax: 'searchProduct', keyword: $(e).val()},function(json, status){
							var products =  JSON.parse(json);
							var result = '';
							$(products).each(function() {
								result += '<a href="javascript:void(0);" onclick="chooseProduct(\''+this.name+'\', \''+this.sku+'\', '+this.price+')">'+this.name+'</a>';
							});
							$('#searchCombo').html(result);
						});
					}
					function chooseProduct(name, sku, price){
						$("#searchComboKeyword").val(name);
						$('#combo_price').attr('data-sku', sku);
						$('#combo_price').val(price);
						$('#searchCombo').html('');
					}
					function addCombo(){
						var name = $("#searchComboKeyword").val();
						var price = $("#combo_price").val();
						var sku = $("#combo_price").attr('data-sku');
						if(name == '' || price == '' || sku == '') alert('Vui lòng điền đầy đủ thông tin');
						else{
							let combo = '<tr><td><input class="readonly" readonly value="'+name+'" required> <input type="hidden" name="combo['+sku+'][sku]" value="'+sku+'" required></td>';
							combo += '<td><input class="readonly" name="combo['+sku+'][price]" value="'+price+'" required></td>';
							combo += '<td align="center"><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Xóa</a></td></tr>';
							$("#combo_list").append(combo);
							$('#searchComboKeyword').val('');
							$("#combo_price").val('');
						}
					}
				</script>
			</div>
			<div class="col">
				<table class="list-data" style="margin: 0 -10px;border: 1px solid #ddd;">
					<tbody id="combo_list">
						<tr>
							<th align="left">Sản phẩm Combo</th>
							<th width="200">Giá Combo</th>
							<th width="50"></th>
						</tr>
						<?php foreach($combos as $combo) { $product = $this->model->product->getOne($combo->sku, 'sku'); ?>
						<tr>
							<td><input class="readonly" readonly value="<?php echo $product->name; ?>" required> <input type="hidden" name="combo[<?=$combo->sku?>][sku]" value="<?=$combo->sku?>" required></td>
							<td><input class="readonly" name="combo[<?=$combo->sku?>][price]" value="<?=$combo->price?>" required></td>
							<td align="center"><a href="javascript:void(0);" onclick="$(this).parent().parent().remove();">Xóa</a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>	