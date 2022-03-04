<?php
class PController extends Controller{
	public function execute(){
		$model = $this->page;
		if(!empty($_POST["ajax"]) && $_POST["ajax"] == "searchCustomer"){
				$result = new stdClass;
				$result->status = "error";
				$result->data = null;
				$result->message = "Đã xảy ra lỗi không mong muốn. Vui lòng thử lại sau.";
				$data = $this->model->customer->searchAJAX($_POST["keyword"]);
				if(!empty($data)){
					$result->status = "success";
					$result->data = $data;
					$result->message = "Kết quả tìm kiếm.";
				}else{
					$result->status = "error";
					$result->data = null;
					$result->message = "Không tìm thấy thông tin.";
				}
				exit(json_encode($result));
			}
		if (!empty($_POST['task'])) {
			if($_POST['task'] == 'confirm' && empty($_POST['id'])) $this->model->$model->create();
			if($_POST['task'] == 'confirm' && !empty($_POST['id'])) $this->model->$model->update($_POST['id']);
			header("Refresh:0");
		}
		if (!empty($_POST['delete']) && empty($_POST['task'])){
			$this->model->$model->delete($_POST['delete']);
			header("Refresh:0");
		}
		if(isset($_GET['id']) && $_GET['id'] >= 0) {
			$this->item = $this->model->$model->getOne($_GET['id']);
			$this->customer = $this->model->customer->getOne($this->item->user, 'code');
			$this->products = json_decode($this->item->product);
		}else{
			$search = null; if(!empty($_GET['q'])) $search = $_GET['q'];
			$this->total = 0;
			$this->limit = 30;
			$this->pagina = 1; if(!empty($_GET['p']) && $_GET['p'] > 1) $this->pagina = $_GET['p'];
			$this->list = $this->model->$model->getList($search, $this->total, $this->pagina, $this->limit);
			$this->pages = ceil($this->total / $this->limit);
		}
	}
}
?>