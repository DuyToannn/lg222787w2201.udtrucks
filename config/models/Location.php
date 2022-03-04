<?php
class LocationModel{
	public function getProvince(){
		try {
			global $entityManager;
			return $entityManager->getRepository("Province")->findAll();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getDistrict($id_province){
		try {
			global $entityManager;
			return $entityManager->getRepository("District")->findBy(array('id_province' => $id_province));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getWard($id_district){
		try {
			global $entityManager;
			return $entityManager->getRepository("Ward")->findBy(array('id_district' => $id_district));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function dispatchURL($re_url, &$page, &$item){
		return;
    }
}
?>