<?php
$root = 'http://'.DOMAIN.'/'; 
if(!empty(Config::$ssl)) $root = 'https://'.DOMAIN.'/'; 
header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="utf-8" ?>'."\n";
echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
//HOME
echo '<url>'."\n";
echo '<loc>'.$root.'</loc>'."\n";
echo '<changefreq>daily</changefreq>'."\n";
echo '<priority>1.0</priority>'."\n";
echo '</url>'."\n";
/*
//PAGE
$list = $this->model->page->getAll();
foreach($list as $item){ if($item->code != 'home'){
	echo '<url>'."\n";
	echo '<loc>'.$root.$item->alias.'</loc>'."\n";
	echo '<changefreq>daily</changefreq>'."\n";
	echo '<priority>1.0</priority>'."\n";
	echo '</url>'."\n";	
}}
//CATEGORY
$list = $this->model->category->getAll();
foreach($list as $item){
	echo '<url>'."\n";
	echo '<loc>'.$root.$item->alias.'</loc>'."\n";
	echo '<changefreq>daily</changefreq>'."\n";
	echo '<priority>0.9</priority>'."\n";
	echo '</url>'."\n";	
}
//ARTICLE
$list = $this->model->article->getAll();
foreach($list as $item){
	echo '<url>'."\n";
	echo '<loc>'.$root.$item->alias.'</loc>'."\n";
	echo '<changefreq>daily</changefreq>'."\n";
	echo '<priority>0.8</priority>'."\n";
	echo '</url>'."\n";	
}*/
//END
echo '</urlset>';