<?php
class ProductModel{
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Product")->findOneBy(array('published' => 1, $field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($id_category = 0, $limit = 100, $start = 0, $order = 'DESC', $by = 'featured', &$total = 0, $manu = 0, $min = 0, $max = 0) {
        try {
            global $entityManager;
			$query_count = $entityManager->createQueryBuilder();
            $query_count->select('count(i.id)')->from('Product','i')->where('i.published = 1');
			if($id_category > 0) $query_count->leftJoin('Category', 'child', 'WITH', 'child.id = i.id_category ')->leftJoin('Category', 'parent', 'WITH', 'parent.id = child.id_parent')
				->andWhere('child.id = '.$id_category.' OR parent.id = '.$id_category.' OR parent.id_parent = '.$id_category);
			if(!empty($manu)) $query_count->andWhere('i.id_manufacturer = '.$manu);
			if(!empty($min)) $query_count->andWhere('i.price >= '.$min);
			if(!empty($max)) $query_count->andWhere('i.price <= '.$max);
            $total = $query_count->getQuery()->getSingleScalarResult();

			$query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Product','i')->where('i.published = 1');
			if($id_category > 0) $query->leftJoin('Category', 'child', 'WITH', 'child.id = i.id_category ')->leftJoin('Category', 'parent', 'WITH', 'parent.id = child.id_parent')
				->andWhere('child.id = '.$id_category.' OR parent.id = '.$id_category.' OR parent.id_parent = '.$id_category);
			if(!empty($manu)) $query->andWhere('i.id_manufacturer = '.$manu);
			if(!empty($min)) $query->andWhere('i.price >= '.$min);
			if(!empty($max)) $query->andWhere('i.price <= '.$max);
            $query->orderBy('i.'.$by, $order);
            $query->setFirstResult($start);
            $query->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function search($keyword, &$total = 0, $limit = 30, $start = 0, $order = 'DESC', $by = 'id') {
        try {
			$keywords = explode(" ",$keyword);
            global $entityManager;
			/*$query_count = $entityManager->createQueryBuilder();
            $query_count->select($query_count->expr()->count('i.id'));
            $query_count->from('Product','i');
			$query_count->andWhere('i.published = 1');
			foreach($keywords as $key){
				$query_count->andWhere("i.name LIKE '%" . $key . "%' OR i.sku LIKE '%" . $key . "%' ");
			}
            $total = $query_count->getQuery()->getSingleScalarResult();*/
			
			$query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Product', 'i')
			->leftJoin('Category', 'c', 'WITH', 'i.id_category = c.id')
			->leftJoin('Manufacturer', 'm', 'WITH', 'i.id_manufacturer = m.id')
			->where('i.published = 1');
			foreach($keywords as $key){
				$query->andWhere("i.name LIKE '%" . $key . "%' OR i.sku LIKE '%" . $key . "%' OR c.name LIKE '%" . $key . "%' OR m.name LIKE '%" . $key . "%' ");
			}
            $query->orderBy('i.'.$by, $order);
            $query->setFirstResult($start);
            $query->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getRelated($item, $limit = 10, $start = 0) {
        try {
			global $entityManager;
            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Product', 'i');
            $query->andWhere('i.published = 1 AND i.id_category = '.$item->id_category);
            $query->andWhere('i.id <> '.$item->id);
            $query->orderBy('i.created', 'DESC');
            $query->setFirstResult($start);
            $query->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getSuggest($limit = 10, $start = 0, $id_category = null) {
        try {
            if($id_category != null){
				$query = $entityManager->createQueryBuilder();
				$query->add('select', 'i')->from('Product', 'i')->where('i.published = 1 AND i.suggest = 1')
				->leftJoin('Category', 'child', 'WITH', 'child.id = i.id_category ')->leftJoin('Category', 'parent', 'WITH', 'parent.id = child.id_parent')
				->andWhere('child.id = '.$id_category.' OR parent.id = '.$id_category.' OR parent.id_parent = '.$id_category);

				$query->orderBy('i.id', 'DESC')->setFirstResult($start)->setMaxResults($limit);
				return $query->getQuery()->getResult();
			}else global $entityManager;
            return $entityManager->getRepository('Product')->findBy(array('published' => 1, 'suggest' => 1), array('id' => 'DESC'), $limit, $start);
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getTop($limit = 10, $start = 0, $id_category = null) {
        try {
            global $entityManager;
            if($id_category != null){
				$query = $entityManager->createQueryBuilder();
				$query->add('select', 'i')->from('Product', 'i')->where('i.published = 1 AND i.top = 1')
				->leftJoin('Category', 'child', 'WITH', 'child.id = i.id_category ')->leftJoin('Category', 'parent', 'WITH', 'parent.id = child.id_parent')
				->andWhere('child.id = '.$id_category.' OR parent.id = '.$id_category.' OR parent.id_parent = '.$id_category);

				$query->orderBy('i.id', 'DESC')->setFirstResult($start)->setMaxResults($limit);
				return $query->getQuery()->getResult();
			}else return $entityManager->getRepository('Product')->findBy(array('published' => 1, 'top' => 1), array('id' => 'DESC'), $limit, $start);
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getNewest($limit = 10, $start = 0, $id_category = null) {
        try {
            global $entityManager;
            if($id_category != null){
				$query = $entityManager->createQueryBuilder();
				$query->add('select', 'i')->from('Product', 'i')->where('i.published = 1 AND i.new = 1')
				->leftJoin('Category', 'child', 'WITH', 'child.id = i.id_category ')->leftJoin('Category', 'parent', 'WITH', 'parent.id = child.id_parent')
				->andWhere('child.id = '.$id_category.' OR parent.id = '.$id_category.' OR parent.id_parent = '.$id_category);

				$query->orderBy('i.id', 'DESC')->setFirstResult($start)->setMaxResults($limit);
				return $query->getQuery()->getResult();
			}else return $entityManager->getRepository('Product')->findBy(array('published' => 1, 'new' => 1), array('id' => 'DESC'), $limit, $start);
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getSale($limit = 10, $start = 0, $id_category = null) {
        try {
            global $entityManager;
            if($id_category != null){
				$query = $entityManager->createQueryBuilder();
				$query->add('select', 'i')->from('Product', 'i')->where('i.published = 1 AND i.sale = 1')
				->leftJoin('Category', 'child', 'WITH', 'child.id = i.id_category ')->leftJoin('Category', 'parent', 'WITH', 'parent.id = child.id_parent')
				->andWhere('child.id = '.$id_category.' OR parent.id = '.$id_category.' OR parent.id_parent = '.$id_category);

				$query->orderBy('i.id', 'DESC')->setFirstResult($start)->setMaxResults($limit);
				return $query->getQuery()->getResult();
			}else return $entityManager->getRepository('Product')->findBy(array('published' => 1, 'sale' => 1), array('id' => 'DESC'), $limit, $start);
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getFeatured($limit = 10, $start = 0, $id_category = null) {
        try {
            global $entityManager;
			if($id_category != null){
				$query = $entityManager->createQueryBuilder();
				$query->add('select', 'i')->from('Product', 'i')->where('i.published = 1 AND i.featured = 1')
				->leftJoin('Category', 'child', 'WITH', 'child.id = i.id_category ')->leftJoin('Category', 'parent', 'WITH', 'parent.id = child.id_parent')
				->andWhere('child.id = '.$id_category.' OR parent.id = '.$id_category.' OR parent.id_parent = '.$id_category);

				$query->orderBy('i.id', 'DESC')->setFirstResult($start)->setMaxResults($limit);
				return $query->getQuery()->getResult();
			}else return $entityManager->getRepository('Product')->findBy(array('published' => 1, 'featured' => 1), array('id' => 'DESC'), $limit, $start);
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
    public function dispatchURL($re_url, &$page, &$item){
		try {
			$urls = explode("/", $re_url);
			if(count($urls) == 2){
				$finals = explode("?",end($urls));
				$alias = current($finals);
				global $entityManager;
				$result = $entityManager->getRepository('Product')->findOneBy(array('published' => 1, 'alias' => $alias));
                if(!empty($result)) {
					$page = 'product';
					$item = $result;
					$item->view ++;
					$entityManager->merge($item);
					$entityManager->flush();
					$entityManager->clear();
				}
			}
		} catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
}
?>