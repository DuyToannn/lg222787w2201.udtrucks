<?php
class LibraryModel{
	public function countAll(){
		try {
			global $entityManager;
			$query_count = $entityManager->createQueryBuilder();
            $query_count->select($query_count->expr()->count('i.id'))->from('Library','i');
			return $query_count->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Library")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($keyword = '', &$total, $page, $limit = 50, $status = -1) {
        try {
			global $entityManager;
			$query_count = $entityManager->createQueryBuilder();
            $query_count->select($query_count->expr()->count('i.id'))->from('Library','i');
			if ($keyword != '') $query_count->andWhere('i.name LIKE \'%' . $keyword . '%\'');
			if ($status > -1) {
				if($status == 0) $query_count->andWhere('i.published = 0');
				if($status == 1) $query_count->andWhere('i.published = 1');
				if($status == 2) $query_count->andWhere('i.featured = 1');
			}
            $total = $query_count->getQuery()->getSingleScalarResult();


            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Library', 'i');
            if ($keyword != '') $query->andWhere('i.name LIKE \'%' . $keyword . '%\'');
			if ($status > -1) {
				if($status == 0) $query->andWhere('i.published = 0');
				if($status == 1) $query->andWhere('i.published = 1');
				if($status == 2) $query->andWhere('i.featured = 1');
			}
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
			$item = new Library();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			if(!empty($_POST['alias'])) $item->alias = Helper::stringURLSafe($_POST['alias']); else $item->alias = Helper::stringURLSafe($_POST['name']);
			$item->created = time();
			$item->created_by = Helper::getSession('staff');
			$item->view = 0;
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
			$item->updated = time();
			$item->updated_by = Helper::getSession('staff');
			if(empty($_POST['published'])) $item->published = 0;
			if(empty($_POST['featured'])) $item->featured = 0;
			$entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã cập nhật"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function featured($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->featured == 0) $item->featured = 1; else $item->featured = 0;
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
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
            $item = $this->getOne($id);
            $entityManager->remove($item);
            $entityManager->flush();
            $entityManager->clear();
            Helper::setMessage(array("type" => "success", "message" => "Đã xóa dữ liệu"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
}
?>