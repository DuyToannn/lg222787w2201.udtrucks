<style type="text/css">
aside{
    float: right;
    width: 370px;
}
.aside-banner {
    float: left;
    margin-top: 15px;
}
.aside-banner img {
    float: left;
    width: 100%;
}
.aside-heading {
    float: left;
    width: 100%;
    margin: 15px 0;
    text-transform: uppercase;
    border-bottom: 1px solid #888;
    padding-bottom: 5px;
    font-size: 18px;
}
.aside-product li{
    float: left;
    width: 100%;
    margin: 0 0 10px;
	border-bottom: 1px solid #dddddd;
    padding-bottom: 10px;
}
.aside-product li:last-child{
    margin: 0 0 15px;
	border-bottom: 0;
    padding-bottom: 0;
}
.aside-product-thumbnail{
    float: left;
    width: 90px;
    height: 90px;
    position: relative;
}
.aside-product-thumbnail img {
    max-height: 90px;
    max-width: 90px;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
}
.aside-product-name {
    float: right;
    width: calc(100% - 100px);
    margin: 0 0 5px;
    font-size: 16px;
    font-weight: normal;
	display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    overflow: hidden;
}
.aside-product-price {
    width: calc(100% - 100px);
    float: right;
    font-size: 14px;
    color: #d0021c;
    font-weight: 500;
    margin: 0;
}
.aside-product-price del{
    color: #555;
    font-weight: normal;
    font-size: 13px;
    margin-left: 5px;
}
.aside-article li {
    float: left;
    width: calc(50% - 8px);
    margin: 0 15px 10px 0;
}
.aside-article li:nth-child(2n + 1) {
    float: right;
    margin-right: 0;
}
.aside-article li:first-child{
    width: 100%;
}
.aside-article-thumbnail{
	float: left;
    width: 100%;
    padding-top: 56.25%;
    background: transparent;
    background-size: cover;
    background-position: center;
}
.aside-article-title{
    float: left;
    width: 100%;
    margin: 5px 0;
    font-weight: 500;
    font-size: 16px;
	display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    overflow: hidden;
}
</style>
<?php
$banner = $this->model->banner->getList('article');
$suggest = $this->model->product->getSuggest(5);
$hot = $this->model->article->getHotest(6);
$sale = $this->model->product->getSale(5);
?>
<aside>
	<?php foreach($banner as $item){echo '<a class="aside-banner" href="'.$item->link.'"><img src="'.$item->image.'" alt="'.$item->name.'"></a>';} ?>
	<h3 class="aside-heading">Gợi ý cho bạn</h3>
	<ul class="aside-product">
	<?php foreach($suggest as $item){ ?>
			<li>
				<a href="/<?=$item->alias?>"><div class="aside-product-thumbnail"><img src="<?=$item->image?>" alt="<?=$item->name?>"></div><h4 class="aside-product-name"><?=$item->name?></h4></a>
				<p class="aside-product-price"><?=number_format($item->price)?>₫</p>
			</li>
	<?php } ?>
	</ul>
	<h3 class="aside-heading">Không thể bỏ qua</h3>
	<ul class="aside-article">
	<?php foreach($hot as $item){ ?>
			<li>
				<a href="/<?=$item->alias?>"><div class="aside-article-thumbnail" style="background-image: url(<?=$item->image?>);"></div><h4 class="aside-article-title"><?=$item->title?></h4></a>
			</li>
	<?php } ?>
	</ul>
	<h3 class="aside-heading">Khuyến mãi cực HOT</h3>
	<ul class="aside-product">
	<?php foreach($sale as $item){ ?>
			<li>
				<a href="/<?=$item->alias?>"><div class="aside-product-thumbnail"><img src="<?=$item->image?>" alt="<?=$item->name?>"></div><h4 class="aside-product-name"><?=$item->name?></h4></a>
				<p class="aside-product-price"><?=number_format($item->price)?>₫ <del><?=number_format($item->price_old)?>₫</del></p>
			</li>
	<?php } ?>
	</ul>
</aside>