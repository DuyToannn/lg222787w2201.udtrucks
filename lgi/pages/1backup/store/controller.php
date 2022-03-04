<?php
class PController extends Controller{
	public function execute(){
		$this->provinces = $this->model->province->getAll();
		if(!empty($_POST['task'])){
			if($_POST['task'] == 'confirm' && empty($_POST['id'])) $this->model->store->create();
			if($_POST['task'] == 'confirm' && !empty($_POST['id'])) $this->model->store->update();
			header("Refresh:0");
		}
		if(!empty($_POST['published']) && empty($_POST['task'])){
			$this->model->store->published($_POST['published']);
			header("Refresh:0");
		}
		if(!empty($_POST['delete']) && empty($_POST['task'])){
			$this->model->store->delete($_POST['delete']);
			header("Refresh:0");
		}
	}
}
?>