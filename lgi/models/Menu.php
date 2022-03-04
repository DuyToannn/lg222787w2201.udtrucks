<?php
class MenuModel{
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Menu")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($keyword = '', &$total, $page, $limit = 50) {
        try {
			global $entityManager;
			$query_count = $entityManager->createQueryBuilder();
            $query_count->select($query_count->expr()->count('i.id'));
            $query_count->from('Menu','i');
			if ($keyword != '') $query_count->andWhere('i.name LIKE \'%' . $keyword . '%\' OR i.title LIKE \'%' . $keyword . '%\'');
            $total = $query_count->getQuery()->getSingleScalarResult();


            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Menu', 'i');
            if ($keyword != '') $query->andWhere('i.name LIKE \'%' . $keyword . '%\' OR i.title LIKE \'%' . $keyword . '%\'');
            $query->orderBy('i.id', 'DESC');
            $query->setFirstResult(($page - 1) * $limit);
            $query->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getChilds($id_parent) {
        try {
            global $entityManager;
            return $entityManager->getRepository('Menu')->findBy(array('id_parent' => $id_parent));
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getAll(&$list,$id_parent,$text) {
        try {
            $results = $this->getChilds($id_parent);
            foreach ($results as $item) {
                $item->prefix = $text;
                $list[] = $item;
                $this->getAll($list,$item->id,$text.'|-----');
            }
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function create(){
        try {
            global $entityManager;
			$item = new Menu();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			if(!empty($_POST['alias'])) $item->alias = Helper::stringURLSafe($_POST['alias']);
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
			if(!empty($_POST['alias'])) $item->alias = Helper::stringURLSafe($_POST['alias']);
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
			$childs = $this->getChilds($id);
			if(!empty($childs)) return Helper::setMessage(array("type" => "success", "message" => "Vui lòng xóa menu con trước"));
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