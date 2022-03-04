<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST['task'])){
			if($_POST['task'] == 'confirm' && empty($_POST['id'])) $this->model->script->create();
			if($_POST['task'] == 'confirm' && !empty($_POST['id'])) $this->model->script->update();
			header("Refresh:0");
		}
		if(!empty($_POST['delete']) && empty($_POST['task'])){
			$this->model->script->delete($_POST['delete']);
			header("Refresh:0");
		}
	}
}
?>