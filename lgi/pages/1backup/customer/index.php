<?php if(!empty($this->item)) require_once('item.php'); else {?>
	<div class="block">
		<form method="post" class="frm-post">
			<div class="row">
				<div class="col col-3"><div class="ipg"><label>Mã khách hàng</label><input type="text" name="code" class="isAccount" required></div></div>
				<div class="col col-3"><div class="ipg"><label>Tên khách hàng</label><input type="text" name="name" required></div></div>
				<div class="col col-3"><div class="ipg"><label>Số điện thoại</label><input type="text" name="phone" pattern="[0-9]{10,11}" required class="isPhone"></div></div>
				<div class="col col-3"><div class="ipg"><label>Email</label><input type="email" name="email" required></div></div>
				<div class="col col-12">
					<div class="ipg field">
						<label>Địa chỉ</label><input type="text" name="address" required>
						<button class="btn-save" type="submit" name="task" value="create">Thêm</button>
					</div>
				</div>
			</div>
			<textarea name="comment" placeholder="Ghi chú..."></textarea>
		</form>
	</div>
	<div class="clr"></div>
	<div class="block"><form method="post">
		<table class="list-data">
				<tr>
					<th width="100">Mã KH</th>
					<th align="left">Khách hàng</th>
					<th width="100">Điện thoại</th>
					<th width="200">Email</th>
					<th align="left">Địa chỉ</th>
					<th width="150">Doanh số</th>
					<th width="150">Dư nợ</th>
					<th width="100">Trạng thái</th>
				</tr>
				<?php foreach ($this->list as $item) : ?>
					<tr>
						<td align="center"><a href="?page=<?php echo $this->page; ?>&id=<?php echo $item->id; ?>"><?php echo $item->code; ?></a></td>
						<td class="name"><?php echo $item->name; ?></td>
						<td align="center"><?php echo $item->phone; ?></td>
						<td><?php echo $item->email; ?></td>
						<td><?php echo $item->address; ?></td>
						<td align="center"><?=number_format($this->model->customer->countAmount($item->code))?></td>
						<td align="center"><?=number_format($this->model->customer->countDebt($item->code))?></td>
						<td align="center"><button type="submit" name="status" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')">
						<i class="<?php if($item->status) echo 'ion-unlocked'; else echo 'ion-locked'; ?>"></i></button></td>
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
			<select name="province" onchange="$('#frm-pagination').submit();">
				<option value="">Tất cả tỉnh/thành</option>
				<?php foreach ($this->provinces as $item) {
						if (isset($_GET['province']) && $_GET['province'] == $item->id) echo '<option value="' . $item->id . '" selected>' . $item->name . '</option>';
						else echo '<option value="' . $item->id . '">' . $item->name . '</option>';
					} ?>
			</select>
		</form>
	</div>
<?php } ?>