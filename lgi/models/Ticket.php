<?php
class TicketModel{
	public function countAll(){
		try {
			global $entityManager;
			$query = $entityManager->createQueryBuilder();
            $query->select('count(i.id)')->from('Ticket','i');
			return $query->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Ticket")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getByCustomer($user){
		try {
			global $entityManager;
			return $entityManager->getRepository("Ticket")->findBy(array("user" => $user), array("created" => "DESC"));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($keyword = null, $status = null, &$total, $page, $limit = 50) {
        try {
			global $entityManager;
			//COUNT
			$count = $entityManager->getRepository('Ticket')->createQueryBuilder('i');
            $count->add('select','count(i.id)');
			if($keyword != null) $count->andWhere("i.name LIKE '%" . $keyword . "%' OR i.phone LIKE '%" . $keyword . "%' OR i.email LIKE '%" . $keyword . "%'");
			if($status != null) $count->andWhere('i.status = '.$status);
            $total = $count->getQuery()->getSingleScalarResult();
			//GET LIST
            $query = $entityManager->getRepository('Ticket')->createQueryBuilder('i');
            $query->add('select', 'i');
            if($keyword != null) $query->andWhere("i.name LIKE '%" . $keyword . "%' OR i.phone LIKE '%" . $keyword . "%' OR i.email LIKE '%" . $keyword . "%'");
			if($status != null) $query->andWhere('i.status = '.$status);
            $query->orderBy('i.id', 'DESC')->setFirstResult(($page - 1) * $limit)->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function create(){
        try {
            global $entityManager;
			$item = new Ticket();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			$entityManager->persist($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "???? th??m m???i"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function update($id){
        try {
            global $entityManager;
			$item = $this->getOne($id);
			$item->comment = $_POST['comment'];
			$item->updated = time();
			$item->updated_by = Helper::getSession('staff');
			$entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "???? c???p nh???t"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function check($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->status == 0){
				$item->status = 1;
				$item->checked = time();
				$item->checked_by = Helper::getSession('staff');
				$entityManager->merge($item);
				$entityManager->flush();
				$entityManager->clear();
			}
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function complete($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			$item->comment = $_POST['comment'];
			$item->status = 2;
			$item->completed = time();
			$item->completed_by = Helper::getSession('staff');
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "???? ho??n t???t"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function delete($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			$delay = (time() - $item->completed)/60/60/24/30;
			if($delay < 30) return Helper::setMessage(array("type" => "success", "message" => "Ch??? c?? th??? x??a y??u c???u sau 30 ng??y."));
			else{
				$query = $entityManager->createQueryBuilder()->delete('Ticket', 'i')->where('i.id = '.$id);
				$result = $query->getQuery()->getResult();
				return Helper::setMessage(array("type" => "success", "message" => "???? x??a y??u c???u"));
			}
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
}
?>