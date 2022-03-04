<?php
class ProvinceModel{
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Province")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getAll(){
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
}
?>