<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST['task'])){
			switch($_POST['task']){
				case 'complete';
					$this->model->ticket->complete($_POST['id']);
					break;
				case 'update';
					$this->model->ticket->update($_POST['id']);
					break;
				case 'delete';
					$this->model->ticket->delete($_POST['id']);
					break;
			}
			header("Refresh:0");
		}
		if(!empty($_POST['complete'])){
			$this->model->ticket->complete($_POST['complete']);
			header("Refresh:0");
		}
		if(!empty($_POST['delete'])){
			$this->model->ticket->delete($_POST['delete']);
			header("Refresh:0");
		}
	}
}
?>