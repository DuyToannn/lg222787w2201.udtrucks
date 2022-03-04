<style>
#mobile-menu {
	display: none;
    position: relative;
    z-index: 999;
}
#mobile-menu.open #mobile-menu-close {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.3);
}
.mobile-menu-container {
    text-align: left;
    -ms-transition: left .15s;
    -moz-transition: left .15s;
    -webkit-transition: left .15s;
    transition: left .15s;
    background: #fff;
    height: 100%;
    left: -100vw;
    overflow: auto;
    position: fixed;
    top: 0;
    width: 85vw;
    z-index: 5;
	padding-bottom: 20px;
}
#mobile-menu.open .mobile-menu-container {
    left: 0;
}
.mobile-menu-account{
    float: left;
    width: 100%;
    padding: 5px 10px;
    background: #cccccc;
}
.mobile-menu-account img{
    float: left;
    height: 40px;
    margin-right: 10px;
    border: 3px solid #fff;
    border-radius: 50%;
}
.mobile-menu-account .text-small{
    font-size: 12px;
    float: left;
    width: calc(100% - 100px);
    line-height: 18px;
}
.mobile-menu-account .text{
    font-size: 14px;
    float: left;
    width: calc(100% - 100px);
    line-height: 22px;
    font-weight: 500;
}
.mobile-menu-account .mobile-menu-close{
    line-height: 40px;
    position: absolute;
    right: 5px;
    font-size: 30px;
    width: 40px;
    text-align: center;
}
.mobile-menu-title{
    font-weight: 500;
    padding: 10px 0 5px;
    float: left;
    width: calc(100% - 20px);
    border-bottom: 1px dotted #ddd;
    margin: 0 10px 5px;
}
.mobile-menu-list-item{
    float: left;
    width: calc(100% - 20px);
    margin: 3px 10px 4px;
    font-size: 15px;
}
.mobile-menu-list-item.item-sub{
    display: list-item;
    margin-left: 30px;
    width: calc(100% - 40px);
}
.mobile-menu-list-item.item-sub-sub{
    display: list-item;
	list-style: circle;
    margin-left: 50px;
    width: calc(100% - 60px);
}
</style>
<div id="mobile-menu">
	<div id="mobile-menu-close" onclick="openMenu();"></div>
	<div class="mobile-menu-container">
		<div class="mobile-menu-account">
			<img src="/MCOM2100001/theme/images/header/user-none.png" alt="user">
			<div class="text-small">Đăng nhập/Đăng ký</div>
			<div class="text">Tài khoản</div>
			<a class="mobile-menu-close" onclick="openMenu();">✕</a>
		</div>
		<label class="mobile-menu-title">Sản phẩm & dịch vụ</label>
                                <div class="mobile-menu-list">
									<?php $roots = $this->model->category->getChilds(0); foreach($roots as $root){ ?>
                                    <a href="/<?=$root->alias?>" class="mobile-menu-list-item"><?=$root->name?></a>
										<?php $parents = $this->model->category->getChilds($root->id); foreach($parents as $parent){ ?>
										<a href="/<?=$parent->alias?>" class="mobile-menu-list-item item-sub"><?=$parent->name?></a>
											<?php $childs = $this->model->category->getChilds($parent->id); foreach($childs as $child){ ?>
											<a href="/<?=$child->alias?>" class="mobile-menu-list-item item-sub-sub"><?=$child->name?></a>
											<?php } ?>
										<?php } ?>
									<?php } ?>
                                </div>
	<div class="clr"></div>
	</div>
</div>
<script type="text/javascript">
	function openMenu(){
		let isOpen = $('#mobile-menu').hasClass('open');
		if(isOpen){
			$('#mobile-menu').removeClass('open');
			$('body').css('overflow','');
		}else{
			$('#mobile-menu').addClass('open');
			$('body').css('overflow','hidden');
		}
	}
</script>