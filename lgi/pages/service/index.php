<?php
if(isset($_GET['id']) && $_GET['id'] >= 0) require_once(__DIR__.'/item.php'); else { 
	$search = ''; if(!empty($_GET['q'])) $search = $_GET['q'];
	$status = -1; if(isset($_GET['status']) && $_GET['status'] > -1) $status = $_GET['status'];
	$category = -1; if(isset($_GET['category']) && $_GET['category'] > -1) $category = $_GET['category'];
	$this->total = 0;
	$this->limit = 50;
	$this->pagina = 1; if(!empty($_GET['p']) && $_GET['p'] > 1) $this->pagina = $_GET['p'];
	$this->list = $this->model->service->getList($search, $this->total, $this->pagina, $this->limit, $status, $category);
	$this->pages = ceil($this->total / $this->limit);
	$categories = array();
	$this->model->category->getAll($categories,0,'');
?>
<div class="block"><form method="post">
	<table class="list-data">
		<tr><th width="10">ID</th><th align="left">Dịch vụ</th><th width="100">Lượt xem</th><th width="100">Cập nhật</th><th width="100">Nổi bật</th><th width="100">Trạng thái</th><th width="110"><a href="?page=service&id=0">THÊM MỚI</a></th></tr>
		<?php foreach($this->list as $item) : ?>
		<tr>
			<td><?php echo $item->id; ?></td>
			<td class="name"><a href="?page=service&id=<?php echo $item->id; ?>"><?php echo $item->name; ?></a></td>
			<td align="center"><?php echo $item->view; ?></td>
			<td align="center"><?php echo date('H:i d/m',$item->updated); ?></td>
			
			<td align="center"><button type="submit" name="featured" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')">
			<i class="<?php if($item->featured) echo 'ion-android-star'; else echo 'ion-android-star-outline'; ?>"></i></button></td>
			
			<td align="center"><button type="submit" name="published" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')">
			<i class="<?php if($item->published) echo 'ion-eye'; else echo 'ion-eye-disabled'; ?>"></i></button></td>
			<td align="center">
				<a href="?page=service&id=<?php echo $item->id; ?>"><i class="ion-android-open"></i></a>
				<button type="submit" name="delete" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')"><i class="ion-trash-a"></i></button>
			</td>
		</tr>
		<?php endforeach; ?>
	</table></form>
	<form id="frm-pagination" method="get" class="fr">
		<input type="hidden" name="page" value="service">
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
		<select name="category" onchange="$('#frm-pagination').submit();">
			<option value="-1">Tất cả danh mục</option>
			<option value="0" <?php if(isset($_GET['category']) && $_GET['category'] == 0) echo 'selected'; ?>>Không có danh mục</option>
			<?php foreach($categories as $category){ if(isset($_GET['category']) && $_GET['category'] == $category->id) echo '<option value="'.$category->id.'" selected>'.$category->prefix.$category->name.'</option>';
			else echo '<option value="'.$category->id.'">'.$category->prefix.$category->name.'</option>'; } ?>
		</select>
		<select name="status" onchange="$('#frm-pagination').submit();">
			<option value="-1">Tất cả dịch vụ</option>
			<option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == 0) echo 'selected'; ?>>Không hiện</option>
			<option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == 1) echo 'selected'; ?>>Hiển thị</option>
			<option value="2" <?php if(isset($_GET['status']) && $_GET['status'] == 2) echo 'selected'; ?>>Nổi bật</option>
		</select>
	</form>
</div>
<?php } ?>