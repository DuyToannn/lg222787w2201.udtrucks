<?php
class ArticleModel{
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Article")->findOneBy(array('published' => 1, $field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function search($keyword, &$total, $limit = 25, $start = 0, $order = 'DESC', $by = 'id') {
        try {
            global $entityManager;
			$count = $entityManager->createQueryBuilder()->select("COUNT(i.id)")->from('Article','i')->where("i.published = 1 AND i.title LIKE '%".$keyword."%'");
            $total = $count->getQuery()->getSingleScalarResult();
			
			$query = $entityManager->createQueryBuilder()->add('select', 'i')->from('Article', 'i')->where("i.published = 1 AND i.title LIKE '%".$keyword."%'")
					->orderBy('i.'.$by, $order)->setFirstResult($start)->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getList($id_blog, &$total, $limit = 25, $start = 0, $order = 'DESC', $by = 'id') {
        try {
            global $entityManager;
			$count = $entityManager->createQueryBuilder()->select("COUNT(i.id)")->from('Article','i')->where('i.published = 1')
					->leftJoin('Blog', 'b', 'WITH', 'b.id = i.id_blog')->andWhere('b.id = '.$id_blog.' OR b.id_parent = '.$id_blog);
            $total = $count->getQuery()->getSingleScalarResult();
			
			$query = $entityManager->createQueryBuilder()->add('select', 'i')->from('Article', 'i')->where('i.published = 1')
					->leftJoin('Blog', 'b', 'WITH', 'b.id = i.id_blog')->andWhere('b.id = '.$id_blog.' OR b.id_parent = '.$id_blog)
					->orderBy('i.'.$by, $order)->setFirstResult($start)->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getRelated($item, $limit = 10, $start = 0) {
        try {
			global $entityManager;
            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Article', 'i');
            $query->andWhere('i.published = 1 AND i.id_blog = '.$item->id_blog);
            $query->andWhere('i.id <> '.$item->id);
            $query->orderBy('i.created', 'DESC');
            $query->setFirstResult($start);
            $query->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getHotest($limit = 10, $start = 0, $id_blog = 0) {
        try {
            global $entityManager;
            if($id_blog != 0) return $entityManager->getRepository('Article')->findBy(array('published' => 1, 'hot' => 1, 'id_blog' => $id_blog), array('id' => 'DESC'), $limit, $start);
            else return $entityManager->getRepository('Article')->findBy(array('published' => 1, 'hot' => 1), array('id' => 'DESC'), $limit, $start);
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getFeatured($limit = 10, $start = 0, $id_blog = 0) {
        try {
            global $entityManager;
            if($id_blog != 0) return $entityManager->getRepository('Article')->findBy(array('published' => 1, 'featured' => 1, 'id_blog' => $id_blog), array('id' => 'DESC'), $limit, $start);
            else return $entityManager->getRepository('Article')->findBy(array('published' => 1, 'featured' => 1), array('id' => 'DESC'), $limit, $start);
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getNewest($limit = 10, $start = 0, $id_blog = 0) {
        try {
            global $entityManager;
            if($id_blog != 0) return $entityManager->getRepository('Article')->findBy(array('published' => 1, 'id_blog' => $id_blog), array('id' => 'DESC'), $limit, $start);
            else return $entityManager->getRepository('Article')->findBy(array('published' => 1), array('id' => 'DESC'), $limit, $start);
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
    public function getMostViewed($limit = 10, $start = 0, $id_blog = 0) {
        try {
            global $entityManager;
			if($id_blog != 0) return $entityManager->getRepository('Article')->findBy(array('published' => 1, 'id_blog' => $id_blog), array('view' => 'DESC', 'id' => 'DESC'), $limit, $start);
            else return $entityManager->getRepository('Article')->findBy(array('published' => 1), array('view' => 'DESC', 'id' => 'DESC'), $limit, $start);
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
				$result = $entityManager->getRepository('Article')->findOneBy(array('published' => 1, 'alias' => $alias));
                if(!empty($result)) {
					$page = 'article';
					$item = $result;
					$item->description = $result->summary;
					$result->view ++;
					$entityManager->merge($result);
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