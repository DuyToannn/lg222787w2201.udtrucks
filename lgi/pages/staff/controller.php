<?php
class PController extends Controller{
	public function execute(){
		if($this->staff->permission != 'admin') header("Location: /");
		if(!empty($_POST['task'])){
			if($_POST['task'] == 'create') $this->model->staff->create();
			if($_POST['task'] == 'permission' && !empty($_POST['id'])) $this->model->staff->permission();
			header("Refresh:0");
		}
		if(!empty($_POST['status']) && empty($_POST['task'])){
			$this->model->staff->status($_POST['status']);
			header("Refresh:0");
		}
		if(!empty($_POST['reset']) && empty($_POST['task'])){
			$this->model->staff->reset($_POST['reset']);
			header("Refresh:0");
		}
		if(!empty($_POST['delete']) && empty($_POST['task'])){
			$this->model->staff->delete($_POST['delete']);
			header("Refresh:0");
		}
	}
}
?>