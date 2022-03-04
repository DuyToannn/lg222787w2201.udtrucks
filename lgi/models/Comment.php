<?php
class CommentModel{
	public function countAll(){
		try {
			global $entityManager;
			$query = $entityManager->createQueryBuilder();
            $query->select('count(i.id)')->from('Comment','i');
			return $query->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Comment")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getByCustomer($user){
		try {
			global $entityManager;
			return $entityManager->getRepository("Comment")->findBy(array("user" => $user), array("created" => "DESC"));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($keyword = null, $status = null, &$total, $page, $limit = 50) {
        try {
			global $entityManager;
			//COUNT
			$count = $entityManager->getRepository('Comment')->createQueryBuilder('i');
            $count->add('select','count(i.id)');
			if($keyword != null) $count->andWhere("i.name LIKE '%" . $keyword . "%' OR i.phone LIKE '%" . $keyword . "%' OR i.email LIKE '%" . $keyword . "%' OR i.content LIKE '%" . $keyword . "%'");
			if($status != null){
				if($status == 0) $count->andWhere('i.published = 0');
				if($status == 1) $count->andWhere('i.published = 1');
				if($status == 2) $count->andWhere('i.featured = 1');
			}
            $total = $count->getQuery()->getSingleScalarResult();
			//GET LIST
            $query = $entityManager->getRepository('Comment')->createQueryBuilder('i');
            $query->add('select', 'i');
            if($keyword != null) $query->andWhere("i.name LIKE '%" . $keyword . "%' OR i.phone LIKE '%" . $keyword . "%' OR i.email LIKE '%" . $keyword . "%' OR i.content LIKE '%" . $keyword . "%'");
			if($status != null) {
				if($status == 0) $query->andWhere('i.published = 0');
				if($status == 1) $query->andWhere('i.published = 1');
				if($status == 2) $query->andWhere('i.featured = 1');
			}
            $query->orderBy('i.id', 'DESC')->setFirstResult(($page - 1) * $limit)->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function update($id){
        try {
            global $entityManager;
			$item = $this->getOne($id);
			if(empty($_POST['published'])) $item->published = 0; else $item->published = 1;
			if(empty($_POST['featured'])) $item->featured = 0; else $item->featured = 1;
			$item->comment = $_POST['comment'];
			$item->updated = time();
			$item->updated_by = Helper::getSession('staff');
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