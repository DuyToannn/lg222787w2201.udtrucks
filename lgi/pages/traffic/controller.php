<?php
class PController extends Controller{
	public function execute(){
		$model = $this->page;
		$duration = 'today'; if(!empty($_GET['duration'])) $duration = $_GET['duration'];
		$this->total = 0;
		$this->limit = 30;
		$this->pagina = 1; if(!empty($_GET['p']) && $_GET['p'] > 1) $this->pagina = $_GET['p'];
		if(!empty($_GET['frequency'])) $this->list = $this->model->$model->getListByDevice($_GET['frequency'], $this->total, $this->pagina, $this->limit);
		else if(!empty($_GET['frequencyIP'])) $this->list = $this->model->$model->getListByIP($_GET['frequencyIP'], $this->total, $this->pagina, $this->limit);
		else $this->list = $this->model->$model->getList($duration, $this->total, $this->pagina, $this->limit);
		$this->pages = ceil($this->total / $this->limit);
	}
}
?>