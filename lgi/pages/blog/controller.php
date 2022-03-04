<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST['task'])){
			if($_POST['task'] == 'confirm' && empty($_POST['id'])) $this->model->blog->create();
			if($_POST['task'] == 'confirm' && !empty($_POST['id'])) $this->model->blog->update();
			header("Refresh:0");
		}
		if(!empty($_POST['featured']) && empty($_POST['task'])){
			$this->model->blog->featured($_POST['featured']);
			header("Refresh:0");
		}
		if(!empty($_POST['published']) && empty($_POST['task'])){
			$this->model->blog->published($_POST['published']);
			header("Refresh:0");
		}
		if(!empty($_POST['delete']) && empty($_POST['task'])){
			$this->model->blog->delete($_POST['delete']);
			header("Refresh:0");
		}
	}
}
?>