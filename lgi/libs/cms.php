<?php
class WebCMS{
	public $page;
	public $controller;
	public function execute(){
		try {
			if(!empty($_GET['page']) && is_dir(ADMIN.'pages/'.$_GET['page'])) $this->page = $_GET['page'];
			else $this->page = 'dashboard';
			require_once(ADMIN.'pages/'.$this->page.'/controller.php');
			$this->controller = new PController($this->page);
			$this->controller->display();			
		} catch (Exception $e) {
			var_dump($e->getMessage());exit;
		}
	}
}
?>