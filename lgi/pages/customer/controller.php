<?php
class PController extends Controller{
	public function execute(){
		$model = $this->page;
		if (!empty($_POST['task'])) {
			if($_POST['task'] == 'create' && empty($_POST['id'])) $this->model->$model->create();
			if($_POST['task'] == 'update' && !empty($_POST['id'])) $this->model->$model->update();
			if($_POST['task'] == 'status' && !empty($_POST['id'])) $this->model->$model->status($_POST['id']);
			header("Refresh:0");
		}
		if(!empty($_POST['status']) && empty($_POST['task'])){
			$this->model->$model->status($_POST['status']);
			header("Refresh:0");
		}
		$this->provinces = $this->model->province->getAll();
		if(isset($_GET['id']) && $_GET['id'] >= 0){
			$this->types = array("input" => "Thêm thông tin khách hàng", "care" => "Liên hệ chăm sóc khách hàng", "quote" => "Khách hàng yêu cầu báo giá", "test" => "Khách hàng yêu cầu lái thử", "request" => "Khách hàng yêu hỗ trợ");
			if(!empty($_GET['id'])) $this->item = $this->model->$model->getOne($_GET['id']);
		}else{
			$search = null; if(!empty($_GET['q'])) $search = $_GET['q'];
			$province = null; if(!empty($_GET['province'])) $province = $_GET['province'];
			$this->total = 0;
			$this->limit = 30;
			$this->pagina = 1; if(!empty($_GET['p']) && $_GET['p'] > 1) $this->pagina = $_GET['p'];
			$this->list = $this->model->$model->getList($search, $this->total, $this->pagina, $this->limit, $province);
			$this->pages = ceil($this->total / $this->limit);
		}
	}
}
?>