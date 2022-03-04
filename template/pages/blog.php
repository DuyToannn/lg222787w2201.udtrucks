<?php
$page = 1; if(!empty($_GET['p'])) $page = $_GET['p'];
$limit = 30;
$total = null;
$this->list = $this->model->article->getList($this->item->id, $total, $limit, ($page - 1) * $limit);
$pages = ceil($total/$limit);
?>
<div class="container">
	<ul class="breadcrumb">
		<li><a href="/">Trang chủ</a><span>/</span></li>
		<li><a href="/<?=$this->item->alias?>"><?=$this->item->name?></a></li>
	</ul>
	<div class="page-heading">
		<h1><?=$this->item->name?></h1>
		<p><?=$this->item->title?></p>
		<ul>
			<?php $roots = $this->model->blog->getChilds($this->item->id_parent); foreach($roots as $root){ ?>
			<li><a <?php if($root->id == $this->item->id || $root->id_parent == $this->item->id) echo 'class="active"'; ?> href="/<?= $root->alias ?>"><?= $root->name ?></a></li>
			<?php } ?>
		</ul>
	</div>
	<div class="clr"></div>
		<div class="row">
			<?php foreach($this->list as $item){ ?>
			<div class="col col-4 mb-12">
				<a href="/<?=$item->alias?>" class="articles-item">
					<div class="img"><img src="<?=$item->image?>" alt="<?=$item->title?>"></div>
					<h4 class="articles-item-name"><?=$item->title?></h4>
					<p><?=$item->summary?></p>
				</a>
			</div>
			<?php } ?>
		</div>
	<ul class="pagination">
			<?php if($page - 3 > 1) echo '<li><a href="/'.$this->item->alias.'"><<</a></li>'; ?>
			<?php if($page - 2 > 1) echo '<li><a href="/'.$this->item->alias.'?p='.($page - 2).'">'.($page - 2).'</a></li>'; ?>
			<?php if($page - 1 >= 1) echo '<li><a href="/'.$this->item->alias.'?p='.($page - 1).'">'.($page - 1).'</a></li>'; ?>
			<li><span><?=$page?></span></li>
			<?php if($page + 1 <= $pages) echo '<li><a href="/'.$this->item->alias.'?p='.($page + 1).'">'.($page + 1).'</a></li>'; ?>
			<?php if($page + 2 < $pages) echo '<li><a href="/'.$this->item->alias.'?p='.($page + 2).'">'.($page + 2).'</a></li>'; ?>
			<?php if($page + 3 < $pages) echo '<li><a href="/'.$this->item->alias.'?p='.$pages.'">>></a></li>'; ?>
		</ul>
</div>