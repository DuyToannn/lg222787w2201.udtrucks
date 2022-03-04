<?php
class ProductModel{
	public function countAll(){
		try {
			global $entityManager;
			$query_count = $entityManager->createQueryBuilder();
            $query_count->select($query_count->expr()->count('i.id'))->from('Product','i');
			return $query_count->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Product")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($keyword = '', &$total, $page, $limit = 50, $status = -1, $id_category = -1, $id_manufacturer = -1) {
        try {
			global $entityManager;
			$query_count = $entityManager->createQueryBuilder();
            $query_count->select($query_count->expr()->count('i.id'))->from('Product','i');
			if ($id_category > -1) {
				if($id_category == 0) $query_count->andWhere('i.id_category = 0');
				else $query_count->leftJoin('Category', 'child', 'WITH', 'child.id = i.id_category ')->leftJoin('Category', 'parent', 'WITH', 'parent.id = child.id_parent')
				->andWhere('child.id = '.$id_category.' OR parent.id = '.$id_category.' OR parent.id_parent = '.$id_category);
			}
			if ($keyword != '') {
				$keywords = explode(" ",$keyword);
				foreach($keywords as $key){
					$query_count->andWhere("i.name LIKE '%" . $key . "%' OR i.sku LIKE '%" . $key . "%'");
				}
			}
			if ($status > -1) {
				if($status == 0) $query_count->andWhere('i.published = 0');
				if($status == 1) $query_count->andWhere('i.published = 1');
				if($status == 2) $query_count->andWhere('i.featured = 1');
				if($status == 3) $query_count->andWhere('i.top = 1');
				if($status == 4) $query_count->andWhere('i.new = 1');
				if($status == 5) $query_count->andWhere('i.sale = 1');
				if($status == 6) $query_count->andWhere('i.suggest = 1');
				if($status == 7) $query_count->andWhere('i.outstock = 1');
				if($status == 8) $query_count->andWhere('i.coming = 1');
			}
			
			if ($id_manufacturer > -1) $query_count->andWhere('i.id_manufacturer = '.$id_manufacturer);
            $total = $query_count->getQuery()->getSingleScalarResult();


            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Product', 'i');
			if ($id_category > -1) {
				if($id_category == 0) $query->andWhere('i.id_category = 0');
				else $query->leftJoin('Category', 'child', 'WITH', 'child.id = i.id_category ')->leftJoin('Category', 'parent', 'WITH', 'parent.id = child.id_parent')
				->andWhere('child.id = '.$id_category.' OR parent.id = '.$id_category.' OR parent.id_parent = '.$id_category);
				//$query->add('where', $query->expr()->in('i.id_category', '?1'));
				//$query->setParameter(1, $id_category);
			}
            if ($keyword != ''){
				$keywords = explode(" ",$keyword);
				foreach($keywords as $key){
					$query->andWhere("i.name LIKE '%" . $key . "%' OR i.sku LIKE '%" . $key . "%'");
				}
			}
			if ($status > -1) {
				if($status == 0) $query->andWhere('i.published = 0');
				if($status == 1) $query->andWhere('i.published = 1');
				if($status == 2) $query->andWhere('i.featured = 1');
				if($status == 3) $query->andWhere('i.top = 1');
				if($status == 4) $query->andWhere('i.new = 1');
				if($status == 5) $query->andWhere('i.sale = 1');
				if($status == 6) $query->andWhere('i.suggest = 1');
				if($status == 7) $query->andWhere('i.outstock = 1');
				if($status == 8) $query->andWhere('i.coming = 1');
			}
			
			if ($id_manufacturer > -1) $query->andWhere('i.id_manufacturer = '.$id_manufacturer);
            $query->orderBy('i.updated', 'DESC');
            $query->setFirstResult(($page - 1) * $limit);
            $query->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function searchAJAX($keyword, $limit = 5){
		try {
			global $entityManager;
			$query = $entityManager->createQueryBuilder();
            $query->select('i.id, i.image, i.name, i.sku, i.price, i.color, i.size, i.type')->from('Product', 'i');
			$keywords = explode(" ",$keyword);
			foreach($keywords as $key){
				$query->andWhere("i.name LIKE '%" . $key . "%' OR i.sku LIKE '%" . $key . "%'");
			}
			$query->orderBy('i.id', 'DESC');
            $query->setFirstResult(0)->setMaxResults($limit);
            return $query->getQuery()->getResult();
		} catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
	}
	public function create(){
        try {
            global $entityManager;
			$item = new Product();
			if(!empty($_POST['name'])) {$_POST['name'] = str_replace('"', '', $_POST['name']);$_POST['name'] = str_replace("'", '', $_POST['name']);}
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			if(!empty($_POST['alias'])) $item->alias = Helper::stringURLSafe($_POST['alias']); else $item->alias = Helper::stringURLSafe($_POST['name']);
			$item->created = time();
			$item->updated = time();
			$item->view = 0;
			if(!empty($_POST['color'])) $item->color = json_encode($_POST['color']);
			if(!empty($_POST['size'])) $item->size = json_encode($_POST['size']);
			if(!empty($_POST['type'])) $item->type = json_encode($_POST['type']);
			if(!empty($_POST['gift'])) $item->gift = json_encode(array_unique($_POST['gift']));
			if(!empty($_POST['combo'])) $item->combo = json_encode($_POST['combo']);
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
			if(!empty($_POST['name'])) {$_POST['name'] = str_replace('"', '', $_POST['name']);$_POST['name'] = str_replace("'", '', $_POST['name']);}
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			if(!empty($_POST['alias'])) $item->alias = Helper::stringURLSafe($_POST['alias']); else $item->alias = Helper::stringURLSafe($_POST['name']);
			$item->updated = time();
			if(empty($_POST['published'])) $item->published = 0;
			if(empty($_POST['featured'])) $item->featured = 0;
			if(empty($_POST['new'])) $item->new = 0;
			if(empty($_POST['sale'])) $item->sale = 0;
			if(empty($_POST['hot'])) $item->hot = 0;
			if(empty($_POST['top'])) $item->top = 0;
			if(empty($_POST['suggest'])) $item->suggest = 0;
			if(empty($_POST['outstock'])) $item->outstock = 0;
			if(empty($_POST['coming'])) $item->coming = 0;
			if(!empty($_POST['color'])) $item->color = json_encode($_POST['color']); else $item->color = null;
			if(!empty($_POST['size'])) $item->size = json_encode($_POST['size']); else $item->size = null;
			if(!empty($_POST['type'])) $item->type = json_encode($_POST['type']); else $item->type = null;
			if(!empty($_POST['gift'])) $item->gift = json_encode(array_unique($_POST['gift'])); else $item->gift = null;
			if(!empty($_POST['combo'])) $item->combo = json_encode($_POST['combo']); else $item->combo = null;
			$entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã cập nhật"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function outstock($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->outstock == 0) $item->outstock = 1; else $item->outstock = 0;
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function top($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->top == 0) $item->top = 1; else $item->top = 0;
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function new($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->new == 0) $item->new = 1; else $item->new = 0;
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function sale($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->sale == 0) $item->sale = 1; else $item->sale = 0;
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
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
	public function suggest($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->suggest == 0) $item->suggest = 1; else $item->suggest = 0;
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function coming($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->coming == 0) $item->coming = 1; else $item->coming = 0;
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