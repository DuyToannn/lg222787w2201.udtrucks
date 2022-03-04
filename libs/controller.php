<?php
class Controller{
	public $model;
	public $json;
	public $page;
	public $item;
	public $user;
	public $setting;
	public $string;
	public $text;
	public $script;
	public $title;
	public $description;
	public $link;
	public $image;
	public function __construct($_model, $_page, $_item){
		$jsons = glob(ROOT.'config/json/*.json');
		foreach($jsons as $json){
			$name = basename($json,'.json');
			$this->json->$name = json_decode(file_get_contents($json), true);
		}
		$this->model = $_model;
		$this->page = $_page;
		$this->item = $_item;
		if(!empty(Helper::getSession('user'))) $this->user = $this->model->user->getOne(Helper::getSession('user'), "code");
		else $this->user = null;
		if(empty($this->user) && $this->page == "user") header("Location: /");
	}
	public function getPage(){
		include(ROOT.'/template/pages/'.$this->page.'.php');
	}
	public function getModule($name){
		include(ROOT.'/template/modules/'.$name.'.php');
	}
	public function getCSS($name) {
		$css = file_get_contents(ROOT.'template/css/'.$name.'.css');
		$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
		$css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);
		echo '<style type="text/css">'.$css.'</style>';
    }
	public function getJS($name, $min = false) {
		$js = file_get_contents(ROOT.'template/js/'.$name.'.js');
		if(!$min){
			$expressions = array(
				'MULTILINE_COMMENT'     => '\Q/*\E[\s\S]+?\Q*/\E',
				'SINGLELINE_COMMENT'    => '(?:http|ftp)s?://(*SKIP)(*FAIL)|//.+',
				'WHITESPACE'            => '^\s+|\R\s*'
			);
			foreach ($expressions as $key => $expr) {
				$js = preg_replace('~'.$expr.'~m', '', $js);
			}
		}
		echo '<script type="text/javascript">'.$js.'</script>';
    }
	public function analytics(){
		$robot = false;
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
		foreach ($this->json->bot as $bot) {
			if(strpos($agent, $bot) !== FALSE){
				$robot = true;
				return;
			}
		}
		if($robot === false){
			$traffic = new stdClass;
			$traffic->page = $_SERVER["REQUEST_URI"];
			$traffic->created = time();
			if(!empty(Helper::getSession('traffics'))){
				$traffics = Helper::getSession('traffics');
				array_push($traffics, $traffic);
			}else{
				$traffics = array($traffic);
				Helper::setSession('firstLoad', 1);
			}
			Helper::setSession('traffics', $traffics);
			$user = null; if(!empty(Helper::getSession('phone'))) $user = Helper::getSession('phone');
			$this->model->traffic->execute($user);
		}
	}
	public function context(){
		$this->setting = $this->model->setting->getSetting();
		$this->string = $this->model->setting->getString();
		$this->text = $this->model->setting->getText();
		$this->script = new stdClass;
		$this->script->head = $this->model->script->getList("head");
		$this->script->top = $this->model->script->getList("top");
		$this->script->bottom = $this->model->script->getList("bottom");
		$this->script->complete = $this->model->script->getList("complete");
		$this->title = $this->item->title; if(empty($this->title)) $this->title = $this->item->name;
		$this->description = $this->item->description; if(empty($this->description)) $this->description = $this->item->name;
		if((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')) $this->link = 'https://'.$_SERVER["SERVER_NAME"].'/'.$this->item->alias; else $this->link = 'http://'.$_SERVER["SERVER_NAME"].'/'.$this->item->alias;
		$this->image = $this->item->image;
	}
	public function execute(){
		try {
			$files = glob(ROOT.'config/controllers/*.php');
			foreach($files as $file){include_once($file);}
			$this->analytics();
			$this->context();
			if((@require_once ROOT.'template/index.php') === false) header("HTTP/1.0 404 Not Found");
		} catch (Exception $e) {
			header("HTTP/1.0 404 Not Found");
		}
	}
}
?>