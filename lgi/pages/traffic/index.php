<div class="block">
	<table class="list-data">
		<tr><th width="110">Truy cập</th><th width="100">Định danh</th><th width="80">Tần suất</th><th>Chuỗi nhận dạng</th>
		<th width="120">Thiết bị</th>
		<th>Nguồn</th><th width="135">IP</th>
		<th width="150">Thời gian</th></tr>
		<?php foreach($this->list as $item) : 
		$frequencyIP = $this->model->traffic->getFrequencyIP($item->ip); 
		$frequency = 1; if($item->id_parent) $frequency = $this->model->traffic->getFrequency($item->id_parent);
		$tr_class = ""; if($item->referer == "Google Ads" && $frequencyIP >= 5) $tr_class = "tr-warring"; if($item->referer == "Google Ads" && $frequencyIP >= 10) $tr_class = "tr-error"; 
		$cheat = ""; if($item->referer == "Google Ads" && $frequency >= 3) $cheat = "cheat";
		?>
		<tr class="<?php echo $tr_class; ?> <?php echo $cheat; ?>">
			<td align="center"><?php echo date('H:i d/m/y',$item->checkin); ?></td>
			<td align="center" class="name"><?php echo $item->user; ?></td>
			<td align="center"><?php echo $frequency; ?></td>
			<td><?php if($frequency >=3 ) echo '<a href="?page=traffic&frequency='.$item->id_parent.'" style="color: #262626; text-decoration: underline;">'.$item->agent.'</a>'; else echo $item->agent; ?></td>
			<td  align="center"><?php echo str_replace('iPhone ','',$item->device); ?></td>
			<td><?php echo $item->referer; ?></td>
			<td align="right"><?php if($frequencyIP >=3 ) echo '<a href="?page=traffic&frequencyIP='.$item->ip.'" style="color: #262626; text-decoration: underline;">'.$item->ip.' ('.$frequencyIP.')</a>'; else echo $item->ip.' ('.$frequencyIP.')'; ?></td>
			<td align="center"><?php echo Helper::getTime($item->checkout - $item->checkin); ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<form id="frm-pagination" method="get" class="fr">
		<input type="hidden" name="page" value="<?php echo $this->page; ?>">
		<?php 
		if(!empty($_GET['frequency'])) echo '<input type="hidden" name="frequency" value="'.$_GET['frequency'].'">';
		if(!empty($_GET['frequencyIP'])) echo '<input type="hidden" name="frequencyIP" value="'.$_GET['frequencyIP'].'">';
		if($this->total > 0){ 
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
		<?php if(empty($_GET['frequency']) && empty($_GET['frequencyIP'])){ ?>
		<select name="duration" onchange="$('#frm-pagination').submit();">
				<option value="today">Hôm nay</option>
				<option value="yesterday" <?php if (isset($_GET['duration']) && $_GET['duration'] == 'yesterday') echo 'selected'; ?>>Hôm qua</option>
				<option value="7" <?php if (isset($_GET['duration']) && $_GET['duration'] == 7) echo 'selected'; ?>>7 ngày qua</option>
				<option value="30" <?php if (isset($_GET['duration']) && $_GET['duration'] == 30) echo 'selected'; ?>>30 ngày qua</option>
				<option value="all" <?php if (isset($_GET['duration']) && $_GET['duration'] == 'all') echo 'selected'; ?>>Mọi lúc</option>
		</select>
		<?php } ?>
	</form>
</div>
<style>
.list-data tr.tr-warring {
	background: rgba(255, 255, 0, 0.3);
}
.list-data tr.tr-error {
	background: rgba(255, 0, 0, 0.3);
}
.list-data tr.cheat{
    color: #f00;
}
.list-data td {
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    max-width: 100px;
}
</style>