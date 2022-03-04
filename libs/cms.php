<?php
class WebCMS{
	public $router;
	public $model;
	public function __construct(){
		$this->router = new Router('home');
		$this->model = new stdclass;
		$tables = glob(ROOT.'config/tables/*.php');
		foreach ($tables as $file) {require_once($file);}
		$models = glob(ROOT.'config/models/*.php');
		foreach($models as $file ){
			require_once($file);
			$name = basename($file,'.php');
			$model = $name.'Model';
			$temp = strtolower($name);
			$this->model->$temp = new $model;
		}
	}
	public function execute(){
		try {
			if(isset($_GET['logout'])) Helper::unsetSession('user');
			$this->router->dispatch($this->model);
			if($this->router->page == 'payment') require_once(ROOT.'libs/Payment/index.php');
			else if($this->router->page == 'sitemap') require_once(ROOT.'libs/Sitemap/index.php');
			else{
				$this->controller = new Controller($this->model, $this->router->page, $this->router->item);
				$this->controller->execute();
			}
		} catch (Exception $e) {
			header("HTTP/1.0 404 Not Found");
		}
	}
}
?>