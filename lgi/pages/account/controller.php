<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST['task']) && $_POST['task'] == 'confirm'){
			$this->model->staff->update($this->staff->id);
			header("Refresh:0");
		}
		if(!empty($_POST['task']) && $_POST['task'] == 'change'){
			$this->model->staff->change($this->staff->id);
			header("Refresh:0");
		}
	}
}
?>