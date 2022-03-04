<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST['task'])){
			switch($_POST['task']){
				case 'update';
					$this->model->comment->update($_POST['id']);
					break;
				case 'delete';
					$this->model->comment->delete($_POST['id']);
					break;
			}
			header("Refresh:0");
		}
		if(!empty($_POST['published']) && empty($_POST['task'])){
			$this->model->comment->published($_POST['published']);
			header("Refresh:0");
		}
		if(!empty($_POST['featured']) && empty($_POST['task'])){
			$this->model->comment->featured($_POST['featured']);
			header("Refresh:0");
		}
		if(!empty($_POST['delete']) && empty($_POST['task'])){
			$this->model->comment->delete($_POST['delete']);
			header("Refresh:0");
		}
	}
}
?>