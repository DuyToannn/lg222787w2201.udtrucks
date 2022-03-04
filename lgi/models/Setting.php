<?php
class SettingModel{
	public function getOne($type, $position){
		try {
			global $entityManager;
			$result = $entityManager->getRepository("Setting")->findOneBy(array('type' => $type, 'position' => $position));
			if(!empty($result)) return $result->value; else return '';
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getAll(){
		try {
			global $entityManager;
			return $entityManager->getRepository("Setting")->findAll();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function update($setting, $string, $text){
        try {
            global $entityManager;
			foreach ($setting as $position => $value){
				$item = $entityManager->getRepository("Setting")->findOneBy(array('type' => 'setting', 'position' => $position));
				if(!empty($item)){
					$query = $entityManager->createQueryBuilder() ->update('Setting', 'i')->set('i.value', ':value')
					->where("i.type = 'setting' AND i.position = :position")
					->setParameter('value', $value)
					->setParameter('position', $position)
					->getQuery()->execute();
				}else{
					$item = new Setting();
					$item->type = 'setting';
					$item->position = $position;
					$item->value = $value;
					$entityManager->persist($item);
					$entityManager->flush();
					$entityManager->clear();
				}
			}
			foreach ($string as $position => $value){
				$item = $entityManager->getRepository("Setting")->findOneBy(array('type' => 'string', 'position' => $position));
				if(!empty($item)){
					$query = $entityManager->createQueryBuilder() ->update('Setting', 'i')->set('i.value', ':value')
					->where("i.type = 'string' AND i.position = :position")
					->setParameter('value', $value)
					->setParameter('position', $position)
					->getQuery()->execute();
				}else{
					$item = new Setting();
					$item->type = 'string';
					$item->position = $position;
					$item->value = $value;
					$entityManager->persist($item);
					$entityManager->flush();
					$entityManager->clear();
				}
			}
			foreach ($text as $position => $value){
				$item = $entityManager->getRepository("Setting")->findOneBy(array('type' => 'text', 'position' => $position));
				if(!empty($item)){
					$query = $entityManager->createQueryBuilder() ->update('Setting', 'i')->set('i.value', ':value')
					->where("i.type = 'text' AND i.position = :position")
					->setParameter('value', $value)
					->setParameter('position', $position)
					->getQuery()->execute();
				}else{
					$item = new Setting();
					$item->type = 'text';
					$item->position = $position;
					$item->value = $value;
					$entityManager->persist($item);
					$entityManager->flush();
					$entityManager->clear();
				}
			}
			Helper::setMessage(array("type" => "success", "message" => "Đã cập nhật"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function updateOption($option, $name){
        try {
            global $entityManager;
			foreach ($option as $position => $value){
				$item = $entityManager->getRepository("Setting")->findOneBy(array('type' => $name, 'position' => $position));
				if(!empty($item)){
					$query = $entityManager->createQueryBuilder() ->update('Setting', 'i')->set('i.value', ':value')
					->where("i.type = '".$name."' AND i.position = :position")
					->setParameter('value', $value)
					->setParameter('position', $position)
					->getQuery()->execute();
				}else{
					$item = new Setting();
					$item->type = $name;
					$item->position = $position;
					$item->value = $value;
					$entityManager->persist($item);
					$entityManager->flush();
					$entityManager->clear();
				}
			}
			Helper::setMessage(array("type" => "success", "message" => "Đã cập nhật"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
}
?>