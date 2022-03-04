<?php
class MenuModel{
	public function getList($position) {
        try {
            global $entityManager;
            return $entityManager->getRepository('Menu')->findBy(array('published' => 1, 'id_parent' => 0, 'position' => $position), array('sort' => 'ASC'));
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getChilds($id_parent) {
        try {
            global $entityManager;
            return $entityManager->getRepository('Menu')->findBy(array('published' => 1, 'id_parent' => $id_parent), array('sort' => 'ASC'));
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function dispatchURL($re_url, &$page, &$item){
		try {
			global $entityManager;
			$result = $entityManager->getRepository('Menu')->findOneBy(array('published' => 1, 'link' => $re_url));
			if(!empty($result) && $result->type != "link") {
				$page = $result->type;
				$item = $result;
			}
		} catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
}
?>