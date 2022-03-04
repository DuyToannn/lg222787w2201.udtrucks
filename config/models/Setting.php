<?php
class SettingModel{
	public function getTitle() {
        try {
            global $entityManager;
            $query = $entityManager->createQueryBuilder();
            $query->select('i.value')->from('Setting','i')->andWhere("i.type = 'setting' AND i.position = 'title'");
            return $query->getQuery()->getSingleScalarResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getDescription() {
        try {
            global $entityManager;
            $query = $entityManager->createQueryBuilder();
            $query->select('i.value')->from('Setting','i')->andWhere("i.type = 'setting' AND i.position = 'description'");
            return $query->getQuery()->getSingleScalarResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getImage() {
        try {
            global $entityManager;
            $query = $entityManager->createQueryBuilder();
            $query->select('i.value')->from('Setting','i')->andWhere("i.type = 'setting' AND i.position = 'image'");
            return $query->getQuery()->getSingleScalarResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getSetting() {
        try {
            global $entityManager;
			$result = new stdClass;
			$query = $entityManager->createQueryBuilder();
			$database = $entityManager->getRepository("Setting")->findBy(array('type' => 'setting'));
			foreach($database as $data){
				$key = $data->position;
				$result->$key = $data->value;
			}
			return $result;
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getString() {
        try {
			global $entityManager;
			$result = new stdClass;
			$query = $entityManager->createQueryBuilder();
			$database = $entityManager->getRepository("Setting")->findBy(array('type' => 'string'));
			foreach($database as $data){
				$key = $data->position;
				$result->$key = $data->value;
			}
			return $result;
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getText() {
        try {
			global $entityManager;
			$result = new stdClass;
			$query = $entityManager->createQueryBuilder();
			$database = $entityManager->getRepository("Setting")->findBy(array('type' => 'text'));
			foreach($database as $data){
				$key = $data->position;
				$result->$key = $data->value;
			}
			return $result;
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getType($type) {
        try {
			global $entityManager;
			$result = new stdClass;
			$query = $entityManager->createQueryBuilder();
			$database = $entityManager->getRepository("Setting")->findBy(array('type' => $type));
			foreach($database as $data){
				$key = $data->position;
				$result->$key = $data->value;
			}
			return $result;
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function dispatchURL($re_url, &$page, &$item){
		return;
    }
}
?>