<?php if(isset($_GET['id']) && $_GET['id'] >= 0) require_once(__DIR__.'/item.php'); else { 
	$this->list = array();
	$this->model->blog->getAll($this->list,0,'');
?>
<div class="block"><form method="post">
	<table class="list-data">
		<tr><th width="10">ID</th><th align="left">Danh mục bài viết</th><th align="left">Đường dẫn</th><th width="100">Nổi bật</th><th width="100">Trạng thái</th><th width="110"><a href="?page=blog&id=0">THÊM MỚI</a></th></tr>
		<?php foreach($this->list as $item) : ?>
		<tr>
			<td><?php echo $item->id; ?></td>
			<td class="name"><a href="?page=blog&id=<?php echo $item->id; ?>"><?php echo $item->prefix.$item->name; ?></a></td>
			<td><?php echo $item->alias; ?></td>
			<td align="center"><button type="submit" name="featured" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')">
			<i class="<?php if($item->featured) echo 'ion-android-star'; else echo 'ion-android-star-outline'; ?>"></i></button></td>
			<td align="center"><button type="submit" name="published" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')">
			<i class="<?php if($item->published) echo 'ion-eye'; else echo 'ion-eye-disabled'; ?>"></i></button></td>
			<td align="center">
				<a href="?page=blog&id=<?php echo $item->id; ?>"><i class="ion-android-open"></i></a>
				<button type="submit" name="delete" value="<?php echo $item->id; ?>" onclick="return confirm('Bạn đã chắc chắn!?')"><i class="ion-trash-a"></i></button>
			</td>
		</tr>
		<?php endforeach; ?>
	</table></form>
</div>
<?php } ?>