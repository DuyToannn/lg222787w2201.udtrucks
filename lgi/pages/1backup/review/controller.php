<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST['task'])){
			switch($_POST['task']){
				case 'update';
					$this->model->review->update($_POST['id']);
					break;
				case 'delete';
					$this->model->review->delete($_POST['id']);
					break;
			}
			header("Refresh:0");
		}
		if(!empty($_POST['published']) && empty($_POST['task'])){
			$this->model->review->published($_POST['published']);
			header("Refresh:0");
		}
		if(!empty($_POST['featured']) && empty($_POST['task'])){
			$this->model->review->featured($_POST['featured']);
			header("Refresh:0");
		}
		if(!empty($_POST['delete']) && empty($_POST['task'])){
			$this->model->review->delete($_POST['delete']);
			header("Refresh:0");
		}
	}
}
?>