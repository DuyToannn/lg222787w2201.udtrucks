<?php
class StoreModel{
	public function countAll(){
		try {
			global $entityManager;
			$query = $entityManager->createQueryBuilder();
            $query->select('count(i.id)')->from('Store','i');
			return $query->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Store")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getAll(){
		try {
			global $entityManager;
			return $entityManager->getRepository("Store")->findBy(array(), array("name"=>"ASC"));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($keyword = null, &$total, $page, $limit = 50, $id_province = -1) {
        try {
			global $entityManager;
			$count = $entityManager->createQueryBuilder();
            $count->select('count(i.id)')->from('Store','i');
			if($keyword != null) $count->andWhere('i.name LIKE \'%' . $keyword . '%\' OR i.code LIKE \'%' . $keyword . '%\' OR i.phone LIKE \'%' . $keyword . '%\' OR i.email LIKE \'%' . $keyword . '%\'');
			if($id_province > -1) $count->andWhere('i.id_province = '.$id_province);
            $total = $count->getQuery()->getSingleScalarResult();


            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Store', 'i');
            if($keyword != null) $query->andWhere('i.name LIKE \'%' . $keyword . '%\' OR i.code LIKE \'%' . $keyword . '%\' OR i.phone LIKE \'%' . $keyword . '%\' OR i.email LIKE \'%' . $keyword . '%\'');
			if($id_province > -1) $query->andWhere('i.id_province = '.$id_province);
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
			$item = new Store();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			if(!empty($_POST['alias'])) $item->alias = Helper::stringURLSafe($_POST['alias']); else $item->alias = Helper::stringURLSafe($_POST['name']);
			$item->created = time();
			$entityManager->persist($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã thêm mới"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function update(){
        try {
            global $entityManager;
			$item = $this->getOne($_POST['id']);
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			if(!empty($_POST['alias'])) $item->alias = Helper::stringURLSafe($_POST['alias']); else $item->alias = Helper::stringURLSafe($_POST['name']);
			if(empty($_POST['published'])) $item->published = 0;
			$item->updated = time();
			$entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã cập nhật"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function published($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->published == 0) $item->published = 1; else $item->published = 0;
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
            $query = $entityManager->createQueryBuilder()->delete('Store', 'i')->where('i.id = '.$id);
			$result = $query->getQuery()->getResult();
            Helper::setMessage(array("type" => "success", "message" => "Đã xóa cửa hàng"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
}
?>