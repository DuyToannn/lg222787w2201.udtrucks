<?php
class Controller{
	public $model;
	public $json;
	public $staff;
	public $component;
	public $page;
	public $template;
	public function __construct($_page){
		$this->model = new stdclass;
		//include(table)
		$tables = glob(ROOT.'config/tables/*.php');
		foreach ($tables as $table) {require_once($table);}
		//init(model)
		$files = glob(ADMIN.'models/*.php');
		foreach($files as $file ){
			require_once($file);
			$name = basename($file,'.php');
			$model = $name.'Model';
			$temp = strtolower($name);
			$this->model->$temp = new $model;
		}
		$this->json = new stdclass;
		//init(json)
		$jsons = glob(ROOT.'config/json/*.json');
		foreach($jsons as $json){
			$name = basename($json,'.json');
			$this->json->$name = json_decode(file_get_contents($json), true);
		}
		$jsons = glob(ADMIN.'json/*.json');
		foreach($jsons as $json){
			$name = basename($json,'.json');
			$this->json->$name = json_decode(file_get_contents($json), true);
		}
		$this->staff = null;
		$this->page = $_page;
		$this->component = null;
		foreach($this->json->component as $key => $val){
			if(array_key_exists($this->page, $val['page'])) $this->component = $key;
		}
		$this->template = simplexml_load_file(ROOT.'template/config.xml');
	}
	public function initStaff(){
		if(!empty($_POST['task']) && $_POST['task'] == 'login') $this->staff = $this->model->staff->login();
		if(!empty(Helper::getSession('staff'))) {
			$this->staff = $this->model->staff->getOne(Helper::getSession('staff'), 'code');
			$_SESSION['eso_directory'] = "/assets";
		}
	}
	public function initData(){
		if(isset($_POST['alias'])) $_POST['alias'] = Helper::stringURLSafe($_POST['alias']);
		if(isset($_POST['price'])) $_POST['price'] = str_replace(',','',$_POST['price']);
		if(isset($_POST['amount'])) $_POST['amount'] = str_replace(',','',$_POST['amount']);
		if(isset($_POST['discount'])) $_POST['discount'] = str_replace(',','',$_POST['discount']);
		if(isset($_POST['price_old'])) $_POST['price_old'] = str_replace(',','',$_POST['price_old']);
		if(isset($_POST['price_new'])) $_POST['price_new'] = str_replace(',','',$_POST['price_new']);
		if(isset($_POST['price_combo'])) $_POST['price_combo'] = str_replace(',','',$_POST['price_combo']);
		if(isset($_POST['price_shock'])) $_POST['price_shock'] = str_replace(',','',$_POST['price_shock']);
	}
	public function getCSS($name) {
		$css = file_get_contents(ADMIN.'layout/css/'.$name.'.css');
		$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
		$css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
		echo '<style type="text/css">'.$css.'</style>';
    }
	public function getModule($name){
		if((@require_once ADMIN.'modules/'.$name.'.php') === false) header("HTTP/1.0 404 Not Found");
	}
	public function getPage(){
		if((@require_once ADMIN.'pages/'.$this->page.'/index.php') === false) header("HTTP/1.0 404 Not Found");
	}
	public function execute(){}
	public function display(){
		try {
			$this->initStaff();
			$this->initData();
			$this->execute();
			if((@require_once ADMIN.'layout/index.php') === false) header("HTTP/1.0 404 Not Found");
		} catch (Exception $e) {
			var_dump($e->getMessage());exit;
		}
	}
}
?>