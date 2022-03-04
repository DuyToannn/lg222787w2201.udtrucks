<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST['ajax']) && $_POST['ajax'] == 'searchProduct') {
			$result = $this->model->product->searchAJAX($_POST['keyword']);
			echo json_encode($result);
			die();
		}
		if(!empty($_POST['task'])){
			if($_POST['task'] == 'confirm' && empty($_POST['id'])) $this->model->product->create();
			if($_POST['task'] == 'confirm' && !empty($_POST['id'])) $this->model->product->update();
			header("Refresh:0");
		}
		if(!empty($_POST['published']) && empty($_POST['task'])){
			$this->model->product->published($_POST['published']);
			header("Refresh:0");
		}
		if(!empty($_POST['featured']) && empty($_POST['task'])){
			$this->model->product->featured($_POST['featured']);
			header("Refresh:0");
		}
		if(!empty($_POST['new']) && empty($_POST['task'])){
			$this->model->product->new($_POST['new']);
			header("Refresh:0");
		}
		if(!empty($_POST['sale']) && empty($_POST['task'])){
			$this->model->product->sale($_POST['sale']);
			header("Refresh:0");
		}
		if(!empty($_POST['top']) && empty($_POST['task'])){
			$this->model->product->top($_POST['top']);
			header("Refresh:0");
		}
		if(!empty($_POST['outstock']) && empty($_POST['task'])){
			$this->model->product->outstock($_POST['outstock']);
			header("Refresh:0");
		}
		if(!empty($_POST['suggest']) && empty($_POST['task'])){
			$this->model->product->suggest($_POST['suggest']);
			header("Refresh:0");
		}
		if(!empty($_POST['delete']) && empty($_POST['task'])){
			$this->model->product->delete($_POST['delete']);
			header("Refresh:0");
		}
	}
}
?>