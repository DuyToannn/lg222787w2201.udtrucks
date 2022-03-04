<?php
class TrafficModel{
	public function countAll(){
		try {
			global $entityManager;
			$query = $entityManager->createQueryBuilder();
            $query->select('count(i.id)')->from('Traffic','i');
			return $query->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Traffic")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getFrequency($id){
		try {
			global $entityManager;
			$query = $entityManager->createQueryBuilder();
            $query->select('count(i.id)')->from('Traffic','i')->andWhere('i.id_parent = '.$id);
            return $query->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getFrequencyIP($ip){
		try {
			global $entityManager;
			$query = $entityManager->createQueryBuilder();
            $query->select('count(i.id)')->from('Traffic','i')->andWhere("i.ip = '".$ip."'");
            return $query->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($duration = 'today', &$total, $page, $limit = 30) {
        try {
			global $entityManager;
			$count = $entityManager->createQueryBuilder();
            $count->select('count(i.id)')->from('Traffic','i');
			if($duration == 'today') $count->andWhere('i.checkin >= '.strtotime("today").' AND i.checkin <= '.(strtotime("today") + 86399));
			if($duration == 'yesterday') $count->andWhere('i.checkin >= '.strtotime("yesterday").' AND i.checkin <= '.(strtotime("yesterday") + 86399));
			if($duration == 7) $count->andWhere('i.checkin >= '.(strtotime("today") - (86400 * 7)).' AND i.checkin < '.strtotime("today"));
			if($duration == 30) $count->andWhere('i.checkin >= '.(strtotime("today") - (86400 * 30)).' AND i.checkin < '.strtotime("today"));
            $total = $count->getQuery()->getSingleScalarResult();


            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('Traffic', 'i');
			if($duration == 'today') $query->andWhere('i.checkin >= '.strtotime("today").' AND i.checkin <= '.(strtotime("today") + 86399));
			if($duration == 'yesterday') $query->andWhere('i.checkin >= '.strtotime("yesterday").' AND i.checkin <= '.(strtotime("yesterday") + 86399));
			if($duration == 7) $query->andWhere('i.checkin >= '.(strtotime("today") - (86400 * 7)).' AND i.checkin < '.strtotime("today"));
			if($duration == 30) $query->andWhere('i.checkin >= '.(strtotime("today") - (86400 * 30)).' AND i.checkin < '.strtotime("today"));
            $query->orderBy('i.checkin', 'DESC')->setFirstResult(($page - 1) * $limit)->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getListByDevice($id, &$total, $page, $limit = 30){
		try {
			global $entityManager;
			$count = $entityManager->createQueryBuilder();
            $count->select('count(i.id)')->from('Traffic','i')->andWhere('i.id_parent = '.$id);
			$total = $count->getQuery()->getSingleScalarResult();
			return $entityManager->getRepository("Traffic")->findBy(array('id_parent' => $id), array('checkin' => 'DESC'), $limit, (($page - 1) * $limit));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getListByIP($ip, &$total, $page, $limit = 30){
		try {
			global $entityManager;
			$count = $entityManager->createQueryBuilder();
            $count->select('count(i.id)')->from('Traffic','i')->andWhere("i.ip = '".$ip."'");
			$total = $count->getQuery()->getSingleScalarResult();
			return $entityManager->getRepository("Traffic")->findBy(array('ip' => $ip), array('checkin' => 'DESC'), $limit, (($page - 1) * $limit));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
}
?>