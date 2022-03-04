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
	public function getList($keyword = null, &$total, $page, $limit = 50) {
        try {
			global $entityManager;
			//COUNT
			$count = $entityManager->getRepository('LGIOrder')->createQueryBuilder('i');
            $count->add('select','count(i.id)');
			if($keyword != null) $count->andWhere("i.name LIKE '%" . $keyword . "%' OR i.phone LIKE '%" . $keyword . "%' OR i.email LIKE '%" . $keyword . "%'");
            $total = $count->getQuery()->getSingleScalarResult();
			//GET LIST
            $query = $entityManager->getRepository('LGIOrder')->createQueryBuilder('i');
            $query->add('select', 'i');
            if($keyword != null) $query->andWhere("i.name LIKE '%" . $keyword . "%' OR i.phone LIKE '%" . $keyword . "%' OR i.email LIKE '%" . $keyword . "%'");
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
			$product = array();
			for($i = 0; $i < count($_POST["sku"]); $i++){
				$product[$i] = new stdClass();
				$product[$i]->sku = $_POST["sku"][$i];
				$product[$i]->name = $_POST["product"][$i];
				$product[$i]->unit = $_POST["unit"][$i];
				$product[$i]->price = $_POST["price"][$i];
				$product[$i]->quantity = $_POST["quantity"][$i];
				$product[$i]->amount = $_POST["amount"][$i];
				$product[$i]->discount = $_POST["discount"][$i];
			}
			$item->product = json_encode($product);
			$item->price = str_replace(',','',$_POST["total_price"]);
			$item->discount = str_replace(',','',$_POST["total_discount"]);
			$item->fee = str_replace(',','',$_POST["fee"]);
			$item->total = str_replace(',','',$_POST["total"]);
			$item->deposit = str_replace(',','',$_POST["deposit"]);
			$item->debt = str_replace(',','',$_POST["debt"]);
			$item->created = strtotime($_POST["created"]);
			$item->expired = strtotime($_POST["expired"]);
			$item->staff = Helper::getSession('staff');
			$entityManager->persist($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã thêm mới"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function update($id){
        try {
            global $entityManager;
			$item = $this->getOne($id);
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			$product = array();
			for($i = 0; $i < count($_POST["sku"]); $i++){
				$product[$i] = new stdClass();
				$product[$i]->sku = $_POST["sku"][$i];
				$product[$i]->name = $_POST["product"][$i];
				$product[$i]->unit = $_POST["unit"][$i];
				$product[$i]->price = $_POST["price"][$i];
				$product[$i]->quantity = $_POST["quantity"][$i];
				$product[$i]->amount = $_POST["amount"][$i];
				$product[$i]->discount = $_POST["discount"][$i];
			}
			$item->product = json_encode($product);
			$item->price = str_replace(',','',$_POST["total_price"]);
			$item->discount = str_replace(',','',$_POST["total_discount"]);
			$item->fee = str_replace(',','',$_POST["fee"]);
			$item->total = str_replace(',','',$_POST["total"]);
			$item->deposit = str_replace(',','',$_POST["deposit"]);
			$item->debt = str_replace(',','',$_POST["debt"]);
			$item->created = strtotime($_POST["created"]);
			$item->expired = strtotime($_POST["expired"]);
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
            $entityManager->remove($item);
            $entityManager->flush();
            $entityManager->clear();
            Helper::setMessage(array("type" => "success", "message" => "Đã xóa dữ liệu"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
}
?>