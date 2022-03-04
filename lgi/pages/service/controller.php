<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST['task'])){
			if($_POST['task'] == 'confirm' && empty($_POST['id'])) $this->model->service->create();
			if($_POST['task'] == 'confirm' && !empty($_POST['id'])) $this->model->service->update();
			header("Refresh:0");
		}
		if(!empty($_POST['published']) && empty($_POST['task'])){
			$this->model->service->published($_POST['published']);
			header("Refresh:0");
		}
		if(!empty($_POST['featured']) && empty($_POST['task'])){
			$this->model->service->featured($_POST['featured']);
			header("Refresh:0");
		}
		if(!empty($_POST['delete']) && empty($_POST['task'])){
			$this->model->service->delete($_POST['delete']);
			header("Refresh:0");
		}
	}
}
?>