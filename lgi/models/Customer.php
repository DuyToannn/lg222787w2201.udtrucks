<?php
class CustomerModel{
	public function countAll(){
		try {
			global $entityManager;
			$count = $entityManager->createQueryBuilder();
            $count->select('count(i.id)')->from('User','i');
			return $count->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("User")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($keyword = null, &$total, $page, $limit = 50, $id_province = null) {
        try {
			global $entityManager;
			$count = $entityManager->createQueryBuilder();
            $count->select('count(i.id)')->from('User','i');
			if($keyword != null) $count->andWhere("i.name LIKE '%" . $keyword . "%' OR i.phone LIKE '%" . $keyword . "%' OR i.email LIKE '%" . $keyword . "%'");
			if($id_province != null) $count->andWhere("i.id_province = ".$id_province);
            $total = $count->getQuery()->getSingleScalarResult();


            $query = $entityManager->createQueryBuilder();
            $query->add('select', 'i')->from('User', 'i');
            if($keyword != null) $query->andWhere("i.name LIKE '%" . $keyword . "%' OR i.phone LIKE '%" . $keyword . "%' OR i.email LIKE '%" . $keyword . "%'");
			if($id_province != null) $query->andWhere("i.id_province = ".$id_province);
            $query->orderBy('i.id', 'DESC');
            $query->setFirstResult(($page - 1) * $limit);
            $query->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function create(){
        try {
            global $entityManager;
			$item = $entityManager->getRepository("User")->findOneBy(array('phone' => $_POST['phone']));
			if(!empty($item)) return Helper::setMessage(array("type" => "error", "message" => "Số điện thoại đã tồn tại"));
			$item = new User();
			$item->name = $_POST['name'];
			$item->phone = $_POST['phone'];
			$item->source = $_POST['source'];
			$item->comment = $_POST['comment'];
			$item->created = time();
			$item->status = 1;
			$entityManager->persist($item);
            $entityManager->flush();
			$item->code = date('Ymd').$item->id;
			$entityManager->merge($item);
			$entityManager->flush();
			$entityManager->clear();
			return Helper::setMessage(array("type" => "success", "message" => "Đã thêm khách hàng mới"));
        } catch (Exception $e) {
			return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function createQuick(){
        try {
            global $entityManager;
			$item = $entityManager->getRepository("User")->findOneBy(array('phone' => $_POST['phone']));
			if(!empty($item)) return $item;
			$item = new User();
			$item->name = $_POST['name'];
			$item->phone = $_POST['phone'];
			$item->source = $_POST['source'];
			$item->address = $_POST['address'];
			$item->created = time();
			$item->status = 1;
			$entityManager->persist($item);
            $entityManager->flush();
			$item->code = date('Ymd').$item->id;
			$entityManager->merge($item);
			$entityManager->flush();
			$entityManager->clear();
			return $item;
        } catch (Exception $e) {
			return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function update(){ 
        try {
            global $entityManager;
            $item = $this->getOne($_POST['id']);
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			if(strtotime($_POST['dob']) > 0) $item->dob = strtotime($_POST['dob']);
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
            Helper::setMessage(array("type" => "success", "message" => "Đã cập nhật thông tin"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function status($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->status == 0) $item->status = 1; else $item->status = 0;
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã cập nhật trạng thái"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function reset($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			$item->password = md5($item->phone);
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function delete($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
            $entityManager->remove($item);
            $entityManager->flush();
            $entityManager->clear();
            Helper::setMessage(array("type" => "success", "message" => "Đã xóa dữ liệu"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function addPoint($id_user, $point){ 
        try {
            global $entityManager;
            $item = $this->getOne($id_user);
			$item->point += $point;
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
            Helper::setMessage(array("type" => "success", "message" => "Đã cập nhật dữ liệu"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	
	public function minusPoint($id_user, $point){ 
        try {
            global $entityManager;
            $item = $this->getOne($id_user);
			$item->point -= $point;
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
            Helper::setMessage(array("type" => "success", "message" => "Đã cập nhật dữ liệu"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	
}
?>