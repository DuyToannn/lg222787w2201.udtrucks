<?php
class ManufacturerModel{
	public function getOne($_id){
		try {
			global $entityManager;
			$result = $entityManager->getRepository("Manufacturer")->findOneBy(array('published' => 1, 'id' => $_id));
			return $result;
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getAll() {
        try {
            global $entityManager;
            return $entityManager->getRepository('Manufacturer')->findBy(array('published' => 1),array('sort' => 'ASC'));
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getFeatured($limit = 10, $start = 0) {
        try {
            global $entityManager;
            return $entityManager->getRepository('Manufacturer')->findBy(array('published' => 1, 'featured' => 1), array('sort' => 'ASC'), $limit, $start);
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function dispatchURL($re_url, &$page, &$item){
		return;
    }
}
?>