<?php
class BannerModel{
	public function getOne($_position){
		try {
			global $entityManager;
			return $entityManager->getRepository("Banner")->findOneBy(array('published' => 1, 'position' => $_position));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($_position) {
        try {
            global $entityManager;
            return $entityManager->getRepository('Banner')->findBy(array('published' => 1, 'position' => $_position),array('sort' => 'ASC'));
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function dispatchURL($re_url, &$page, &$item){
		return;
    }
}
?>