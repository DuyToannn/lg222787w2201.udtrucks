<?php
class Router{
	public $page;
	public $item;
	public function  __construct($_page){
		$this->page = $_page;
		$this->item = null;
	}
	public function dispatch($models){
		$this->page = '404';
		$this->item = null;
		$url = explode("?", $_SERVER['REQUEST_URI']);
		switch($url[0]){
			case '/':
				$this->page = 'home';
				$this->item = new stdClass;
				$this->item->title = $models->setting->getTitle();
				$this->item->description = $models->setting->getDescription();
				$this->item->image = $models->setting->getImage();
				$this->item->alias = '';
				break;
			case '/collection':
				$this->page = 'category';
				$this->item = new stdClass;
				$this->item->title = "All Collection";
				$this->item->description = "All Collection";
				$this->item->image = $models->setting->getImage();
				$this->item->alias = 'category';
				break;
			case '/warranty':
				$this->page = 'warranty';
				$this->item = new stdClass;
				$this->item->title = "Warranty";
				$this->item->description = "Warranty";
				$this->item->image = $models->setting->getImage();
				$this->item->alias = 'warranty';
				break;
			case '/member':
				$this->page = 'member';
				$this->item = new stdClass;
				$this->item->title = "Member";
				$this->item->description = "Member";
				$this->item->image = $models->setting->getImage();
				$this->item->alias = 'member';
				break;
			case '/lien-he':
				$this->page = 'contact';
				$this->item = new stdClass;
				$this->item->title = "Liên hệ";
				$this->item->description = "Liên hệ";
				$this->item->image = $models->setting->getImage();
				$this->item->alias = 'lien-he';
				break;
			case '/cart':
				$this->page = 'cart';
				$this->item = new stdClass;
				$this->item->title = "Cart";
				$this->item->description = "Cart";
				$this->item->image = $models->setting->getImage();
				$this->item->alias = 'cart';
				break;
			// case '/user':
			// case '/user/order':
			// 	$this->page = 'user';
			// 	$this->item = new stdClass;
			// 	$this->item->title = "Tài khoản của bạn";
			// 	$this->item->description = "Tài khoản của bạn";
			// 	$this->item->image = $models->setting->getImage();
			// 	$this->item->alias = 'user';
			// 	$this->item->view = end(explode("/", $url[0]));
			// 	break;
			case '/sitemap.xml':
				$this->page = 'sitemap';
				break;
			case '/payment':
				$this->page = 'payment';
				break;
			default:
				$models->menu->dispatchURL($url[0],$this->page,$this->item);
				if($this->page == '404'){
					foreach($models as $model){
						$model->dispatchURL($url[0],$this->page,$this->item);
						if($this->page != '404') break;		
					}
				}
				break;
		}
		if($this->page == '404') {echo '<meta http-equiv="refresh" content="0; url=/">';exit();}
	}
}
?>
