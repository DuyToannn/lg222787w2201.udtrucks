<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST['task'])){
			switch($_POST['task']){
				case 'cancel';
					$this->model->order->cancel($_POST['id']);
					break;
				case 'confirm';
					$this->model->order->confirm($_POST['id']);
					break;
				case 'send';
					$this->model->order->send($_POST['id']);
					break;
				case 'delivery';
					$this->model->order->delivery($_POST['id']);
					break;
				case 'return';
					$this->model->order->return($_POST['id']);
					break;
				case 'update';
					$this->model->order->update($_POST['id']);
					break;
			}
			header("Refresh:0");
		}
		if(!empty($_POST['cancel'])){
			$this->model->order->cancel($_POST['cancel']);
			header("Refresh:0");
		}
		if(!empty($_POST['delete'])){
			$this->model->order->delete($_POST['delete']);
			header("Refresh:0");
		}
	}
}
?>