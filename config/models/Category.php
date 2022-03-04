<?php
class CategoryModel{
	public function getOne($_id){
		try {
			global $entityManager;
			return $entityManager->getRepository("Category")->findOneBy(array('published' => 1, 'id' => $_id));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getAll() {
        try {
            global $entityManager;
            return $entityManager->getRepository('Category')->findBy(array('published' => 1),array('sort' => 'ASC'));
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getFeatured($limit = 10, $start = 0) {
        try {
            global $entityManager;
            return $entityManager->getRepository('Category')->findBy(array('published' => 1, 'featured' => 1), array('sort' => 'ASC'), $limit, $start);
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
    public function getChilds($id_parent) {
        try {
            global $entityManager;
            return $entityManager->getRepository('Category')->findBy(array('published' => 1, 'id_parent' => $id_parent),array('sort' => 'ASC'));
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
                $result = $entityManager->getRepository('Category')->findOneBy(array('published' => 1, 'alias' => $alias));
                if(!empty($result)) {
                    $page = 'category';
                    $item = $result;
                }
            }
			/*if(count($urls) == 3){
                $finals = explode("?",end($urls));
                $alias = current($finals);
				global $entityManager;
				$parent = $entityManager->getRepository('Category')->findOneBy(array('published' => 1, 'alias' => $urls[1]));
                $result = $entityManager->getRepository('Category')->findOneBy(array('published' => 1, 'id_parent' => $parent->id, 'alias' => $alias));
                if(!empty($result)) {
                    $page = 'category';
                    $item = $result;
					$language = 'vi';
                }else{
					$parent = $entityManager->getRepository('Category')->findOneBy(array('published' => 1, 'alias_en' => $urls[1]));
					$result = $entityManager->getRepository('Category')->findOneBy(array('published' => 1, 'id_parent' => $parent->id, 'alias_en' => $alias));
					if(!empty($result)) {
						$page = 'category';
						$item = $result;
						$language = 'en';
					}
				}
            }
			if(count($urls) == 4){
                $finals = explode("?",end($urls));
                $alias = current($finals);
				global $entityManager;
				$parent_parent = $entityManager->getRepository('Category')->findOneBy(array('published' => 1, 'alias' => $urls[1]));
				$parent = $entityManager->getRepository('Category')->findOneBy(array('published' => 1, 'id_parent' => $parent_parent->id, 'alias' => $urls[2]));
                $result = $entityManager->getRepository('Category')->findOneBy(array('published' => 1, 'id_parent' => $parent->id, 'alias' => $alias));
                if(!empty($result)) {
                    $page = 'category';
                    $item = $result;
					$language = 'vi';
                }else{
					$parent_parent = $entityManager->getRepository('Category')->findOneBy(array('published' => 1, 'alias_en' => $urls[1]));
					$parent = $entityManager->getRepository('Category')->findOneBy(array('published' => 1, 'id_parent' => $parent_parent->id, 'alias_en' => $urls[2]));
					$result = $entityManager->getRepository('Category')->findOneBy(array('published' => 1, 'id_parent' => $parent->id, 'alias_en' => $alias));
					if(!empty($result)) {
						$page = 'category';
						$item = $result;
						$language = 'en';
					}
				}
            }*/
		} catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
}
?>