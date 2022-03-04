<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php echo $this->title; ?></title>
		<meta name="description" content="<?php echo $this->description; ?>">
		<link rel="canonical" href="<?php echo $this->link; ?>">
		<link rel="alternate" href="<?php echo $this->link; ?>" hreflang="vi" />
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="audience" content="General" />
		<meta name="resource-type" content="Document" />
		<meta name="distribution" content="Global" />
		<meta name="RATING" content="GENERAL">
		<meta property="fb:app_id" content="1100350723372113">
		<meta property="og:type" content="website">
		<meta property="og:locale" content="vi_VN">
		<meta property="og:url" content="<?php echo $this->link; ?>">
		<meta property="og:title" content="<?php echo $this->title; ?>">
		<meta property="og:description" content="<?php echo $this->description; ?>">
		<meta property="og:image" content="<?php echo $this->image; ?>">
		<meta property="og:site_name" content="<?=$this->setting->name?>" />
		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:description" content="<?php echo $this->description; ?>" />
		<meta name="twitter:title" content="<?php echo $this->title; ?>" />
		<meta name="twitter:image" content="<?php echo $this->image; ?>" />
		<meta name="twitter:site" content="@LeGiaICT" />
		<meta name="twitter:creator" content="@LeGiaICT" />
		<meta name="format-detection" content="telephone=no">
		<meta name="format-detection" content="email=no">
		<meta name="theme-color" content="#000000" />
		<meta name="GENERATOR" content="Lê Gia ICT">
		<link href="<?=$this->setting->favicon?>" rel="shortcut icon" type="image/x-icon">
		
		<link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/footer.css">
    <link rel="stylesheet" href="./assets/css/reset.css">
    <!--=============SWIPER=============-->
    <link rel="stylesheet" href="./assets/css/swiper.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <!--==============JQUERY=============-->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!--==============Font-aw=============-->
    <link rel="stylesheet" href="https://cdn.mcom.vn/assets/fontawesome/style.css">
    <!--==============Font gg=============-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

		<?php 
		$this->getCSS('app');

		foreach($this->script->head as $head){echo $head->content;};
		?>
	</head>
	<body>
		<?php foreach($this->script->top as $top){echo $top->content;}; require_once('header.php'); ?>
		<?php require_once('header.php'); ?>
		<div class="clr"></div>
		<main id="page-<?php echo $this->page; ?>"><?php $this->getPage(); ?></main>
		<div class="clr"></div>
		<?php require_once('footer.php'); foreach($this->script->bottom as $bottom){echo $bottom->content;}; ?>
		<?php Helper::showMessageJS(); ?>
	<?php
	$this->getJS('app');
	?>
	<script src="/template/js/cart.js"></script>
	<script src="./assets/main/main.js"></script>
    </body>
</html>
