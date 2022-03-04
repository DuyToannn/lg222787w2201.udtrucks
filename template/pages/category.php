<?php
$limit = 30;
					$page = 1; if(!empty($_GET['p']) && $_GET['p'] > 1) $page = $_GET['p'];
					$order = 'DESC';
					$by = 'id';
					$total = 0;
					$manu = 0; $min = 0; $max = 0;
					$this->list = $this->model->product->getList($this->item->id, $limit, $limit*($page-1), $order, $by, $total, $manu, $min, $max);
					$pages = ceil($total/$limit);
					$featured =  $this->model->product->getFeatured();
?>
<section id="category">
        <div class="container">
            <h1 class="page-heading"><?=$this->item->name?></h1>
            <ul class="product-list" id="product-list">
				<?php foreach($this->list as $item){ ?>
                <li class="product-item">
                    <a href="/<?=$item->alias?>" class="product-link">
                        <div class="product-image-wrapper">
                            <div class="product-image"> <img src="<?=$item->image?>" alt="<?=$item->name?>"></div>
                        </div>
                        <div class="product-name">
                            <h3><?=$item->name?></h3>
                            <p class="product-price"><?=number_format($item->price)?>đ<!--<del>500,000đ</del>--></p>
                        </div>
                    </a>
                </li>
				<?php } ?>
            </ul>
        </div>
</section>