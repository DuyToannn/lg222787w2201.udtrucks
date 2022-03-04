<?php if(!empty($this->item) || isset($_GET['add'])) require_once('item.php'); else {?>
	<div class="block"><form method="post">
		<table class="list-data">
				<tr>
					<th width="100">Số C.từ</th>
					<th width="100">Ngày C.từ</th>
					<th width="100">Hạn B.hành</th>
					<th width="100">Mã KH</th>
					<th>Khách hàng</th>
					<th width="150">Điện thoại</th>
					<th width="150">Tiền</th>
					<th width="150">Phí G.hàng</th>
					<th width="150">C.khấu</th>
					<th width="150">Đã T.toán</th>
					<th width="150">Tiền nợ</th>
					<th width="110"><a href="?page=order&add">THÊM MỚI</a></th>
				</tr>
				<?php foreach ($this->list as $item) : $customer = $this->model->customer->getOne($item->user, 'code'); ?>
					<tr>
						<td align="center"><a href="?page=<?php echo $this->page; ?>&id=<?php echo $item->id; ?>"><?php echo $item->code; ?></a></td>
						<td align="center"><?php echo date('d-m-Y', $item->created); ?></td>
						<td align="center"><?php echo date('d-m-Y', $item->expired); ?></td>
						<td align="center"><?php echo $item->user; ?></td>
						<td align="center"><?php echo $customer->name; ?></td>
						<td align="center"><?php echo $customer->phone; ?></td>
						<td align="center"><?php echo number_format($item->price); ?></td>
						<td align="center"><?php echo number_format($item->fee); ?></td>
						<td align="center"><?php echo number_format($item->discount); ?></td>
						<td align="center"><?php echo number_format($item->deposit); ?></td>
						<td align="center"><?php echo number_format($item->debt); ?></td>
						<td align="center">
							<a href="?page=order&id=<?php echo $item->id; ?>"><i class="ion-android-open"></i></a>
							<button type="submit" name="delete" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')"><i class="ion-trash-a"></i></button>
						</td>
					</tr>
				<?php endforeach; ?>
		</table></form>
		<form id="frm-pagination" method="get" class="fr">
			<input type="hidden" name="page" value="<?php echo $this->page; ?>">
			<?php if ($this->total > 0) {
					echo '<span>Tổng ' . number_format($this->total) . '</span>';
					if ($this->pagina != 1) echo '<button type="submit" class="btn-pagina" name="p" value="1">|<</button>';
					if ($this->pagina - 2 > 1) echo '<button type="submit" class="btn-pagina" name="p" value="' . ($this->pagina - 2) . '">' . ($this->pagina - 2) . '</button>';
					if ($this->pagina - 1 > 1) echo '<button type="submit" class="btn-pagina" name="p" value="' . ($this->pagina - 1) . '">' . ($this->pagina - 1) . '</button>';
					echo '<button type="button" class="btn-pagina active" name="p" value="' . $this->pagina . '">' . $this->pagina . '</button>';
					if ($this->pagina + 1 < $this->pages) echo '<button type="submit" class="btn-pagina" name="p" value="' . ($this->pagina + 1) . '">' . ($this->pagina + 1) . '</button>';
					if ($this->pagina + 2 < $this->pages) echo '<button type="submit" class="btn-pagina" name="p" value="' . ($this->pagina + 2) . '">' . ($this->pagina + 2) . '</button>';
					if ($this->pagina != $this->pages) echo '<button type="submit" class="btn-pagina" name="p" value="' . $this->pages . '">>|</button>';
				}
				?>
		</form>
	</div>
<?php } ?>