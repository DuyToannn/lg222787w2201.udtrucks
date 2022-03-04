<?php 
	if(isset($_GET['id']) && $_GET['id'] >= 0) require_once(__DIR__.'/item.php'); else { 
	$search = null; if(!empty($_GET['q'])) $search = $_GET['q'];
	$status = null; if(isset($_GET['status'])) $status = $_GET['status'];
	$this->total = 0;
	$this->limit = 50;
	$this->pagina = 1; if(!empty($_GET['p']) && $_GET['p'] > 1) $this->pagina = $_GET['p'];
	$this->list = $this->model->ticket->getList($search, $status, $this->total, $this->pagina, $this->limit);
	$this->pages = ceil($this->total / $this->limit);
?>
<a class="view-tab <?php if($status == null) echo 'active'; ?>" href="?page=ticket">Tất cả</a>
<a class="view-tab <?php if($status == 0 && $status != null) echo 'active'; ?>" href="?page=ticket&status=0">Chờ tiếp nhận</a>
<a class="view-tab <?php if($status == 1) echo 'active'; ?>" href="?page=ticket&status=1">Đang xử lý</a>
<a class="view-tab <?php if($status == 2) echo 'active'; ?>" href="?page=ticket&status=2">Đã hoàn tất</a>
<div class="block">
	<form method="post"><table class="list-data">
		<tr><th align="left">Yêu cầu</th><th align="left">Họ tên</th><th width="100">Điện thoại</th><th width="200">Email</th><th width="130">Ngày tạo</th><th width="130">Trạng thái</th><th width="50"></th></tr>
		<?php foreach($this->list as $item) : ?>
		<tr class="ticket-status-<?=$item->status?>">
			<td><a href="?page=ticket&id=<?php echo $item->id; ?>"><?php echo $item->subject; ?></a></td>
			<td class="name"><?php echo $item->name; ?></td>
			<td align="center"><?php echo $item->phone; ?></td>
			<td><?php echo $item->email; ?></td>
			<td align="center"><?=date('H:i d-m-Y',$item->created)?></td>
			<td align="center"><?=$this->json->ticket[$item->status]?></td>
			<td align="center">
				<?php if($item->status == 2){ ?>
				<button type="submit" name="delete" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn xóa yêu cầu!?')"><i class="ion-android-cancel"></i></button>
				<?php }else{ ?>
				<button type="submit" name="complete" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn hoàn tất!?')"><i class="ion-ios-checkmark"></i></button>
				<?php } ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table></form>
	<form id="frm-pagination" method="get" class="fr">
		<input type="hidden" name="page" value="ticket">
		<input type="hidden" name="status" value="<?=$status?>">
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
	</form>
</div>
<?php } ?>