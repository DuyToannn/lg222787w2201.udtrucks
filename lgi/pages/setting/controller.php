<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST)){
			$this->model->setting->update($_POST["setting"], $_POST["string"], $_POST["text"]);
			header("Refresh:0");
		}
	}
}
?>