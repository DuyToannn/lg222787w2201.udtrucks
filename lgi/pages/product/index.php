<?php
if(isset($_GET['id']) && $_GET['id'] >= 0) require_once(__DIR__.'/item.php'); else { 
	$search = ''; if(!empty($_GET['q'])) $search = $_GET['q'];
	$status = -1; if(isset($_GET['status']) && $_GET['status'] > -1) $status = $_GET['status'];
	$id_category = -1; if(isset($_GET['id_category']) && $_GET['id_category'] > -1) $id_category = $_GET['id_category'];
	$id_manufacturer = -1; if(isset($_GET['id_manufacturer']) && $_GET['id_manufacturer'] > -1) $id_manufacturer = $_GET['id_manufacturer'];
	$this->total = 0;
	$this->limit = 50;
	$this->pagina = 1; if(!empty($_GET['p']) && $_GET['p'] > 1) $this->pagina = $_GET['p'];
	$this->list = $this->model->product->getList($search, $this->total, $this->pagina, $this->limit, $status, $id_category, $id_manufacturer);
	$this->pages = ceil($this->total / $this->limit);
	$categories = array();
	$this->model->category->getAll($categories,0,'');
	$manufacturers = $this->model->manufacturer->getAll();
?>
<div class="block"><form method="post">
	<table class="list-data">
		<tr><th width="10">ID</th><th width="50">SKU</th><th align="left">Sản phẩm</th><th width="150">Giá bán</th><th width="90">Nổi bật</th><th width="90">Hiện Thị</th><th width="110"><a href="?page=product&id=0">THÊM MỚI</a></th></tr>
		<?php foreach($this->list as $item) : ?>
		<tr>
			<td><?php echo $item->id; ?></td>
			<td><?php echo $item->sku; ?></td>
			<td class="name"><a href="?page=product&id=<?php echo $item->id; ?>"><?php echo $item->name; ?></a></td>
			<td align="right"><?php echo number_format($item->price); ?></td>



			<td align="center"><button type="submit" name="featured" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')">
			<i class="<?php if($item->featured) echo 'ion-android-star'; else echo 'ion-android-star-outline'; ?>"></i></button></td>

			<td align="center"><button type="submit" name="published" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')">
			<i class="<?php if($item->published) echo 'ion-eye'; else echo 'ion-eye-disabled'; ?>"></i></button></td>
			
			<td align="center">
				<a href="?page=product&id=<?php echo $item->id; ?>"><i class="ion-android-open"></i></a>
				<button type="submit" name="delete" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')"><i class="ion-trash-a"></i></button>
			</td>
		</tr>
		<?php endforeach; ?>
	</table></form>
	<form id="frm-pagination" method="get" class="fr">
		<input type="hidden" name="page" value="product">
		<?php if(isset($_GET['q']) && $_GET['q'] != '') echo '<input type="hidden" name="q" value="'.$_GET['q'].'">';  ?>
		<?php if($this->total > 0){ 
			echo '<span>Tổng '.number_format($this->total).'</span>';
			if($this->pagina != 1) echo '<button type="submit" class="btn-pagina" name="p" value="1">|<</button>';
			if($this->pagina - 2 > 1) echo '<button type="submit" class="btn-pagina" name="p" value="'.($this->pagina - 2).'">'.($this->pagina - 2).'</button>';
			if($this->pagina - 1 > 1) echo '<button type="submit" class="btn-pagina" name="p" value="'.($this->pagina - 1).'">'.($this->pagina - 1).'</button>';
			echo '<button type="button" class="btn-pagina active" name="p" value="'.$this->pagina.'">'.$this->pagina.'</button>';
			if($this->pagina + 1 < $this->pages) echo '<button type="submit" class="btn-pagina" name="p" value="'.($this->pagina + 1).'">'.($this->pagina + 1).'</button>';
			if($this->pagina + 2 < $this->pages) echo '<button type="submit" class="btn-pagina" name="p" value="'.($this->pagina + 2).'">'.($this->pagina + 2).'</button>';
			if($this->pagina != $this->pages) echo '<button type="submit" class="btn-pagina" name="p" value="'.$this->pages.'">>|</button>';
		}
		?>
		<select name="id_manufacturer" onchange="$('#frm-pagination').submit();">
			<option value="-1">Tất cả nhà sản xuất</option>
			<option value="0" <?php if(isset($_GET['id_manufacturer']) && $_GET['id_manufacturer'] == 0) echo 'selected'; ?>>Không rõ nhà sản xuất</option>
			<?php foreach($manufacturers as $manufacturer){ if(isset($_GET['id_manufacturer']) && $_GET['id_manufacturer'] == $manufacturer->id) echo '<option value="'.$manufacturer->id.'" selected>'.$manufacturer->name.'</option>';
			else echo '<option value="'.$manufacturer->id.'">'.$manufacturer->name.'</option>'; } ?>
		</select>
		<select name="id_category" onchange="$('#frm-pagination').submit();">
			<option value="-1">Tất cả danh mục</option>
			<option value="0" <?php if(isset($_GET['id_category']) && $_GET['id_category'] == 0) echo 'selected'; ?>>Không có danh mục</option>
			<?php foreach($categories as $category){ if(isset($_GET['id_category']) && $_GET['id_category'] == $category->id) echo '<option value="'.$category->id.'" selected>'.$category->prefix.$category->name.'</option>';
			else echo '<option value="'.$category->id.'">'.$category->prefix.$category->name.'</option>'; } ?>
		</select>
		<select name="status" onchange="$('#frm-pagination').submit();">
			<option value="-1">Tất cả sản phẩm</option>
			<option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == 0) echo 'selected'; ?>>Sản phẩm không hiện</option>
			<option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == 1) echo 'selected'; ?>>Sản phẩm hiển thị</option>
			<option value="2" <?php if(isset($_GET['status']) && $_GET['status'] == 2) echo 'selected'; ?>>Sản phẩm nổi bật</option>
			<option value="3" <?php if(isset($_GET['status']) && $_GET['status'] == 3) echo 'selected'; ?>>Sản phẩm bán chạy</option>
			<option value="4" <?php if(isset($_GET['status']) && $_GET['status'] == 4) echo 'selected'; ?>>Sản phẩm mới về</option>
			<option value="5" <?php if(isset($_GET['status']) && $_GET['status'] == 5) echo 'selected'; ?>>Sản phẩm khuyến mãi</option>
			<option value="6" <?php if(isset($_GET['status']) && $_GET['status'] == 6) echo 'selected'; ?>>Sản phẩm gợi ý</option>
			<option value="7" <?php if(isset($_GET['status']) && $_GET['status'] == 7) echo 'selected'; ?>>Sản phẩm tạm hết</option>
		</select>
	</form>
</div>
<?php } ?>