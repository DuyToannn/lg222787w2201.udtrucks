<?php
if(isset($_GET['id']) && $_GET['id'] >= 0) require_once(__DIR__.'/item.php'); else { 
	$search = null; if(!empty($_GET['q'])) $search = $_GET['q'];
	$status = null; if(isset($_GET['status']) && $_GET['status'] > -1) $status = $_GET['status'];
	$this->total = 0;
	$this->limit = 50;
	$this->pagina = 1; if(!empty($_GET['p']) && $_GET['p'] > 1) $this->pagina = $_GET['p'];
	$this->list = $this->model->comment->getList($search, $status, $this->total, $this->pagina, $this->limit);
	$this->pages = ceil($this->total / $this->limit);
?>
<div class="block"><form method="post">
	<table class="list-data">
		<tr><th width="10">ID</th><th align="left">Bình luận</th><th width="100">Họ tên</th><th width="100">Điện thoại</th><th width="100">Thời gian</th><th width="100">Nổi bật</th><th width="100">Trạng thái</th><th width="100"></th></tr>
		<?php foreach($this->list as $item) : ?>
		<tr>
			<td><?php echo $item->id; ?></td>
			<td class="name"><a href="?page=comment&id=<?php echo $item->id; ?>"><?php echo $item->content; ?></a></td>
			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->phone; ?></td>
			<td align="center"><?php echo date('H:i d/m',$item->created); ?></td>
			
			<td align="center"><button type="submit" name="featured" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')">
			<i class="<?php if($item->featured) echo 'ion-android-star'; else echo 'ion-android-star-outline'; ?>"></i></button></td>
			
			<td align="center"><button type="submit" name="published" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')">
			<i class="<?php if($item->published) echo 'ion-eye'; else echo 'ion-eye-disabled'; ?>"></i></button></td>
			<td align="center">
				<a href="?page=comment&id=<?php echo $item->id; ?>"><i class="ion-android-open"></i></a>
				<button type="submit" name="delete" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')"><i class="ion-trash-a"></i></button>
			</td>
		</tr>
		<?php endforeach; ?>
	</table></form>
	<form id="frm-pagination" method="get" class="fr">
		<input type="hidden" name="page" value="comment">
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
		<select name="status" onchange="$('#frm-pagination').submit();">
			<option value="">Tất cả trạng thái</option>
			<option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == 0) echo 'selected'; ?>>Không hiện</option>
			<option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == 1) echo 'selected'; ?>>Hiển thị</option>
			<option value="2" <?php if(isset($_GET['status']) && $_GET['status'] == 2) echo 'selected'; ?>>Nổi bật</option>
		</select>
	</form>
</div>
<?php } ?>