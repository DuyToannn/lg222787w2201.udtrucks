<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST['task'])){
			if($_POST['task'] == 'confirm' && empty($_POST['id'])) $this->model->banner->create();
			if($_POST['task'] == 'confirm' && !empty($_POST['id'])) $this->model->banner->update();
			header("Refresh:0");
		}
		if(!empty($_POST['published']) && empty($_POST['task'])){
			$this->model->banner->published($_POST['published']);
			header("Refresh:0");
		}
		if(!empty($_POST['delete']) && empty($_POST['task'])){
			$this->model->banner->delete($_POST['delete']);
			header("Refresh:0");
		}
	}
}
?>