<?php
class PromotionModel{
	public function countAll(){
		try {
			global $entityManager;
			$query = $entityManager->createQueryBuilder();
            $query->select('count(i.id)')->from('Promotion','i');
			return $query->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Promotion")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($keyword = null, &$total, $page, $limit = 50) {
        try {
			global $entityManager;
			$count = $entityManager->createQueryBuilder();
            $count->select('count(i.id)')->from('Promotion','i');
			if($keyword != null) $count->andWhere('i.name LIKE \'%' . $keyword . '%\' OR i.code LIKE \'%' . $keyword . '%\' OR i.phone LIKE \'%' . $keyword . '%\' OR i.email LIKE \'%' . $keyword . '%\'');
            $total = $count->getQuery()->getSingleScalarResult();


            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Promotion', 'i');
            if($keyword != null) $query->andWhere('i.name LIKE \'%' . $keyword . '%\' OR i.code LIKE \'%' . $keyword . '%\' OR i.phone LIKE \'%' . $keyword . '%\' OR i.email LIKE \'%' . $keyword . '%\'');
            $query->orderBy('i.id', 'DESC');
            $query->setFirstResult(($page - 1) * $limit);
            $query->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function create(){
        try {
            global $entityManager;
			$item = new Promotion();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			if(strtotime($_POST['expired']) > 0) $item->expired = strtotime($_POST['expired']);
			$item->created = time();
			$entityManager->persist($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "???? th??m m???i"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function update(){
        try {
            global $entityManager;
			$item = $this->getOne($_POST['id']);
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			if(empty($_POST['status'])) $item->status = 0;
			if(empty($_POST['stack'])) $item->stack = 0;
			if(strtotime($_POST['expired']) > 0) $item->expired = strtotime($_POST['expired']);
			$item->updated = time();
			$entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "???? c???p nh???t"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function status($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->status == 0) $item->status = 1; else $item->status = 0;
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function delete($id) {
        try {
            global $entityManager;
            $query = $entityManager->createQueryBuilder()->delete('Promotion', 'i')->where('i.id = '.$id);
			$result = $query->getQuery()->getResult();
            Helper::setMessage(array("type" => "success", "message" => "???? x??a khuy???n m??i"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
}
?>