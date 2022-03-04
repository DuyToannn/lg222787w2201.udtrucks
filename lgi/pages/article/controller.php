<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST['task'])){
			if($_POST['task'] == 'confirm' && empty($_POST['id'])) $this->model->article->create();
			if($_POST['task'] == 'confirm' && !empty($_POST['id'])) $this->model->article->update();
			header("Refresh:0");
		}
		if(!empty($_POST['published']) && empty($_POST['task'])){
			$this->model->article->published($_POST['published']);
			header("Refresh:0");
		}
		if(!empty($_POST['featured']) && empty($_POST['task'])){
			$this->model->article->featured($_POST['featured']);
			header("Refresh:0");
		}
		if(!empty($_POST['hot']) && empty($_POST['task'])){
			$this->model->article->hot($_POST['hot']);
			header("Refresh:0");
		}
		if(!empty($_POST['delete']) && empty($_POST['task'])){
			$this->model->article->delete($_POST['delete']);
			header("Refresh:0");
		}
	}
}
?>