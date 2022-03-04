<?php
class OrderModel{
	public function countAll(){
		try {
			global $entityManager;
			$query = $entityManager->createQueryBuilder();
            $query->select('count(i.id)')->from('Order','i');
			return $query->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Order")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getByCustomer($user){
		try {
			global $entityManager;
			return $entityManager->getRepository("Order")->findBy(array("user" => $user), array("created" => "DESC"));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getDetail($code){
		try {
			global $entityManager;
			return $entityManager->getRepository("OrderDetail")->findBy(array("code" => $code));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($keyword = null, $status = null, &$total, $page, $limit = 50) {
        try {
			global $entityManager;
			//COUNT
			$count = $entityManager->getRepository('LGIOrder')->createQueryBuilder('i');
            $count->add('select','count(i.id)');
			if($keyword != null) $count->andWhere("i.name LIKE '%" . $keyword . "%' OR i.phone LIKE '%" . $keyword . "%' OR i.email LIKE '%" . $keyword . "%'");
			if($status != null) $count->andWhere('i.status = '.$status);
            $total = $count->getQuery()->getSingleScalarResult();
			//GET LIST
            $query = $entityManager->getRepository('LGIOrder')->createQueryBuilder('i');
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
			$item = new Order();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			$entityManager->persist($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã thêm mới"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function createQuick($user){
        try {
            global $entityManager;
			$item = new Order();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			$item->created = time();
			$item->type = $_POST['source'];
			$item->staff = Helper::getSession('staff');
			$item->user = $user;
			$item->discount = str_replace(',','',$_POST['discount']);
			$item->status = 0;
			$entityManager->persist($item);
            $entityManager->flush();
			$item->code = $user.$item->id;
			$entityManager->merge($item);
			$entityManager->flush();
            $entityManager->clear();
			foreach($_POST['detailSku'] as $index => $sku){
				$detail = new OrderDetail();
				$detail->code = $item->code;
				//$detail->combo = $combo;
				$detail->sku = $sku;
				$detail->product = $sku;
				$detail->color = $_POST['detailColor'][$index];
				$detail->size = $_POST['detailSize'][$index];
				$detail->type = $_POST['detailType'][$index];
				$detail->price = $_POST['detailPrice'][$index];
				$detail->quantity = $_POST['detailQuantity'][$index];
				$entityManager->persist($detail);
				$entityManager->flush();
				$entityManager->clear();
			}
			return $item;
        } catch (Exception $e) {
			return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function update($id){
        try {
            global $entityManager;
			$item = $this->getOne($id);
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			$item->updated = time();
			$item->updated_by = Helper::getSession('staff');
			$entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã cập nhật"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function confirm($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			$item->comment = $_POST['comment'];
			$item->complaint = $_POST['complaint'];
			$item->status = 1;
			$item->confirmed = time();
			$item->confirmed_by = Helper::getSession('staff');
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã xác nhận"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function send($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			$item->comment = $_POST['comment'];
			$item->complaint = $_POST['complaint'];
			$item->status = 2;
			$item->sent = time();
			$item->sent_by = Helper::getSession('staff');
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã gửi hàng"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function delivery($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			$item->comment = $_POST['comment'];
			$item->complaint = $_POST['complaint'];
			$item->status = 3;
			$item->delivered = time();
			$item->delivered_by = Helper::getSession('staff');
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã giao hàng"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function return($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			$item->comment = $_POST['comment'];
			$item->complaint = $_POST['complaint'];
			$item->status = 4;
			$item->returned = time();
			$item->returned_by = Helper::getSession('staff');
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã trả hàng"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function cancel($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			$item->comment = $_POST['comment'];
			$item->complaint = $_POST['complaint'];
			$item->status = -1;
			$item->canceled = time();
			$item->canceled_by = Helper::getSession('staff');
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã hủy đơn"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function delete($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			$time = $item->canceled; if(!empty($item->returned)) $time = $item->returned;
			$delay = (time() - $time)/60/60/24/30;
			if($delay < 30) return Helper::setMessage(array("type" => "success", "message" => "Chỉ có thể xóa đơn hàng sau 30 ngày."));
			else{
				$query = $entityManager->createQueryBuilder()->delete('OrderDetail', 'i')->where("i.code = '".$time->code."'");
				$result = $query->getQuery()->getResult();
				$query = $entityManager->createQueryBuilder()->delete('Order', 'i')->where('i.id = '.$id);
				$result = $query->getQuery()->getResult();
				return Helper::setMessage(array("type" => "success", "message" => "Đã xóa đơn hàng"));
			}
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
}
?>