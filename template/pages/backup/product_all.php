<?php
$limit = 30;
					$page = 1; if(!empty($_GET['p']) && $_GET['p'] > 1) $page = $_GET['p'];
					$order = 'DESC';
					$by = 'id';
					$total = 0;
					$manu = 0; $min = 0; $max = 0;
					$this->list = $this->model->product->getList(0, $limit, $limit*($page-1), $order, $by, $total, $manu, $min, $max);
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
			<?php $roots = $this->model->category->getChilds(0); foreach($roots as $root){ ?>
			<li><a href="/<?= $root->alias ?>"><?= $root->name ?></a></li>
			<?php } ?>
		</ul>
	</div>
	<div class="clr"></div>
		<div class="row">
			<?php foreach($this->list as $item){ ?>
			<div class="col col-4 mb-12">
				
						<a href="/<?=$item->alias?>" class="product-item">
							<div class="img"><img src="<?=$item->image?>" alt="<?=$item->name?>"></div>
							<h3><?=$item->name?></h3>
						</a>
				
			</div>
			<?php } ?>
		</div>
	<ul class="pagination">
			<?php if($page - 3 > 1) echo '<li><a href="'.$this->item->link.'"><<</a></li>'; ?>
			<?php if($page - 2 > 1) echo '<li><a href="'.$this->item->link.'?p='.($page - 2).'">'.($page - 2).'</a></li>'; ?>
			<?php if($page - 1 >= 1) echo '<li><a href="'.$this->item->link.'?p='.($page - 1).'">'.($page - 1).'</a></li>'; ?>
			<li><span><?=$page?></span></li>
			<?php if($page + 1 <= $pages) echo '<li><a href="'.$this->item->link.'?p='.($page + 1).'">'.($page + 1).'</a></li>'; ?>
			<?php if($page + 2 < $pages) echo '<li><a href="'.$this->item->link.'?p='.($page + 2).'">'.($page + 2).'</a></li>'; ?>
			<?php if($page + 3 < $pages) echo '<li><a href="'.$this->item->link.'?p='.$pages.'">>></a></li>'; ?>
		</ul>
</div>