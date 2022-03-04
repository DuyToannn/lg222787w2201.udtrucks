<?php
class ArticleModel{
	public function countAll(){
		try {
			global $entityManager;
			$query_count = $entityManager->createQueryBuilder();
            $query_count->select($query_count->expr()->count('i.id'))->from('Article','i');
			return $query_count->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Article")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($keyword = '', &$total, $page, $limit = 50, $status = -1, $id_blog = -1) {
        try {
			global $entityManager;
			$query_count = $entityManager->createQueryBuilder();
            $query_count->select($query_count->expr()->count('i.id'))->from('Article','i');
			if ($keyword != '') $query_count->andWhere('i.title LIKE \'%' . $keyword . '%\'');
			if ($status > -1) {
				if($status == 0) $query_count->andWhere('i.published = 0');
				if($status == 1) $query_count->andWhere('i.published = 1');
				if($status == 2) $query_count->andWhere('i.featured = 1');
				if($status == 3) $query_count->andWhere('i.hot = 1');
			}
			if ($id_blog > -1) {
				if($id_blog == 0) $query_count->andWhere('i.id_blog = 0');
				else $query_count->leftJoin('Blog', 'b', 'WITH', 'b.id = i.id_blog')->andWhere('b.id = '.$id_blog.' OR b.id_parent = '.$id_blog);
			}
            $total = $query_count->getQuery()->getSingleScalarResult();


            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Article', 'i');
            if ($keyword != '') $query->andWhere('i.title LIKE \'%' . $keyword . '%\'');
			if ($status > -1) {
				if($status == 0) $query->andWhere('i.published = 0');
				if($status == 1) $query->andWhere('i.published = 1');
				if($status == 2) $query->andWhere('i.featured = 1');
				if($status == 3) $query->andWhere('i.hot = 1');
			}
			if ($id_blog > -1) {
				if($id_blog == 0) $query->andWhere('i.id_blog = 0');
				else $query->leftJoin('Blog', 'b', 'WITH', 'b.id = i.id_blog')->andWhere('b.id = '.$id_blog.' OR b.id_parent = '.$id_blog);
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
			$item = new Article();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			if(!empty($_POST['alias'])) $item->alias = Helper::stringURLSafe($_POST['alias']); else $item->alias = Helper::stringURLSafe($_POST['title']);
			$time = new DateTime(date("Y-m-d H:i:s"));
			$item->created = $time->getTimestamp();
			$item->updated = $time->getTimestamp();
			$item->staff = Helper::getSession('staff');
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
			if(!empty($_POST['alias'])) $item->alias = Helper::stringURLSafe($_POST['alias']); else $item->alias = Helper::stringURLSafe($_POST['title']);
			$time = new DateTime(date("Y-m-d H:i:s"));
			$item->updated = $time->getTimestamp();
			if(empty($_POST['published'])) $item->published = 0;
			if(empty($_POST['featured'])) $item->featured = 0;
			if(empty($_POST['hot'])) $item->hot = 0;
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
	public function hot($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->hot == 0) $item->hot = 1; else $item->hot = 0;
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