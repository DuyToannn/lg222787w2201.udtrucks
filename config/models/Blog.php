<?php
class BlogModel{
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Blog")->findOneBy(array('published' => 1, $field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getAll() {
        try {
            global $entityManager;
            return $entityManager->getRepository('Blog')->findBy(array('published' => 1),array('sort' => 'ASC'));
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
    public function getChilds($id_parent) {
        try {
            global $entityManager;
            return $entityManager->getRepository('Blog')->findBy(array('published' => 1, 'id_parent' => $id_parent),array('sort' => 'ASC'));
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
                $result = $entityManager->getRepository('Blog')->findOneBy(array('published' => 1, 'alias' => $alias));
                if(!empty($result)) {
                    $page = 'blog';
                    $item = $result;
                }
            }
		} catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
}
?>