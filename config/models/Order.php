<?php
class OrderModel{
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Order")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getDetail($code){
		try {
			global $entityManager;
			return $entityManager->getRepository("OrderDetail")->findBy(array('code' => $code));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function create($user){
        try {
            global $entityManager;
			$item = new Order();
			$item->user = $user;
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			$item->created = time();
			$item->type = 'website';
			$item->status = 0;
			$entityManager->persist($item);
            $entityManager->flush();
			$item->code = $user.$item->id;
			$entityManager->merge($item);
			$entityManager->flush();
            $entityManager->clear();
			/*foreach($_POST['product'] as $combo => $product){
				foreach($product as $sku => $value){
					$detail = new OrderDetail();
					$detail->code = $item->code;
					$detail->combo = $combo;
					$detail->sku = $sku;
					$detail->price = $value['price'];
					$detail->quantity = $value['quantity'];
					$detail->color = $value['color'];
					$detail->size = $value['size'];
					$detail->type = $value['type'];
					$entityManager->persist($detail);
					$entityManager->flush();
					$entityManager->clear();
				}
			}*/
			return $item;
        } catch (Exception $e) {
			return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function createLog($order_code, $type, $method, $method_code, $detail){
        try {
            global $entityManager;
			$order = $this->getOne($order_code, 'code');
			$item = new OrderLog();
			$item->code = $order->code;
			$item->type = $type;
			$item->method = $method;
			$item->method_code = $method_code;
			$item->detail = $detail;
			$item->created = time();
			$item->created_by = $order->user;
			$entityManager->persist($item);
            $entityManager->flush();
            $entityManager->clear();
        } catch (Exception $e) {
			return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function pay($order, $note = null) {
        try {
            global $entityManager;
            $item = $this->getOne($order, 'code');
			$item->status = 1;
			$item->note = $note;
			$item->paid = time();
			$item->paid_by = 'user';
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
		} catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function cancel($order, $note = null) {
        try {
            global $entityManager;
            $item = $this->getOne($order, 'code');
			$item->status = -1;
			$item->note = $note;
			$item->canceled = time();
			$item->canceled_by = 'user';
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
		} catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function dispatchURL($re_url, &$page, &$item){
		return;
    }
}
?>