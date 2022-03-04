<?php if(isset($_GET['id']) && $_GET['id'] >= 0) require_once(__DIR__.'/item.php'); else { 
	$search = ''; if(!empty($_GET['q'])) $search = $_GET['q'];
	$this->total = 0;
	$this->limit = 50;
	$this->pagina = 1; if(!empty($_GET['p']) && $_GET['p'] > 1) $this->pagina = $_GET['p'];
	$this->list = $this->model->script->getList($search, $this->total, $this->pagina, $this->limit);
	$this->pages = ceil($this->total / $this->limit);
?>
<div class="block"><form method="post">
	<table class="list-data">
		<tr><th width="10">ID</th><th align="left">Tên mã Script</th><th align="left">Vị trí</th><th width="110"><a href="?page=script&id=0">THÊM MỚI</a></th></tr>
		<?php foreach($this->list as $item) : ?>
		<tr>
			<td><?php echo $item->id; ?></td>
			<td class="name"><a href="?page=script&id=<?php echo $item->id; ?>"><?php echo $item->name; ?></a></td>
			<td><?php echo $item->position; ?></td>
			<td align="center">
				<a href="?page=script&id=<?php echo $item->id; ?>"><i class="ion-android-open"></i></a>
				<button type="submit" name="delete" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')"><i class="ion-trash-a"></i></button>
			</td>
		</tr>
		<?php endforeach; ?>
	</table></form>
	<form id="frm-pagination" method="get" class="fr">
		<input type="hidden" name="page" value="script">
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
	</form>
</div>
<?php } ?>