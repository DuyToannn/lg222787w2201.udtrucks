<?php
class UserModel{
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("User")->findOneBy(array('status' => 1, $field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getOrderList($user, &$total, $start = 0, $limit = 25, $order = 'DESC', $by = 'created'){
        try {
            global $entityManager;
			$count = $entityManager->createQueryBuilder()->select("COUNT(i.id)")->from('LGIOrder','i')->where("i.user = '".$user."'");
            $total = $count->getQuery()->getSingleScalarResult();
			
			$query = $entityManager->createQueryBuilder()->add('select', 'i')->from('LGIOrder', 'i')->where("i.user = '".$user."'")
					->orderBy('i.'.$by, $order)->setFirstResult($start)->setMaxResults($limit);
            return $query->getQuery()->getResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function getOrderDetail($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Order")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function countDebt($user){
		try {
			global $entityManager;
			$count = $entityManager->createQueryBuilder()->select("SUM(i.debt)")->from('LGIOrder','i')->where("i.user = '".$user."'");
            return $count->getQuery()->getSingleScalarResult();
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function create($login = true){
        try {
            global $entityManager;
			if(!empty($_POST['phone'])) $item = $entityManager->getRepository("User")->findOneBy(array('phone' => $_POST['phone']));
			if(!empty($item)) return $item;
			if(!empty($_POST['email'])) $item = $entityManager->getRepository("User")->findOneBy(array('email' => $_POST['email']));
			if(!empty($item)) return $item;
			$item = new User();
			$item->name = $_POST['name'];
			$item->phone = $_POST['phone'];
			$item->source = 'website';
			if(!empty($_POST['email'])) $item->email = $_POST['email'];
			if(!empty($_POST['address'])) $item->address = $_POST['address'];
			if(!empty($_POST['id_province'])) $item->id_province = $_POST['id_province'];
			if(!empty($_POST['id_district'])) $item->id_district = $_POST['id_district'];
			if(!empty($_POST['id_ward'])) $item->id_ward = $_POST['id_ward'];
			if(!empty($_POST['password'])) $item->password = md5($_POST['password']);
			$item->created = time();
			$item->status = 1;
			$entityManager->persist($item);
            $entityManager->flush();
			$item->code = date('Ymd').$item->id;
			$entityManager->merge($item);
			$entityManager->flush();
			$entityManager->clear();
			if($login) Helper::setSession('user', $item->code);
			return $item;
        } catch (Exception $e) {
			Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
			return false;
        }
    }
	public function createTicket($user){ 
        try {
            global $entityManager;
			$item = new Ticket();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			$item->user = $user;
			$item->created = time();
			$item->status = 0;
            $entityManager->persist($item);
            $entityManager->flush();
            $entityManager->clear();
            Helper::setMessage(array("type" => "success", "message" => "???? g???i y??u c???u, xin c???m ??n qu?? kh??ch."));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function login(){
		try{
			global $entityManager;
			$item = $entityManager->getRepository('User')->findOneBy( array('status' => 1, 'code' => $_POST['code'], 'password' => md5($_POST['password'])));	
			if(!empty($item)){ 
				Helper::setSession('user', $item->code);
				$item->login = time();
				$entityManager->merge($item);
				$entityManager->flush();
				$entityManager->clear();
				return $item;
			}else{
				Helper::setMessage(array('type' => 'error', 'message' => 'Th??ng tin ????ng nh???p kh??ng ????ng.'));
				return false;
			}
		}catch(Exception $e){
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
	}
	public function update(){ 
        try {
            global $entityManager;
			$item = $entityManager->getRepository("User")->findOneBy(array('code' => Helper::getSession('user')));
			//check exist
			$exist = $entityManager->getRepository('User')->findOneBy(array('phone' => $_POST['phone']));
			if(!empty($exist) && $exist->id != $item->id) return Helper::setMessage(array("type" => "error", "message" => "S??? ??i???n tho???i ???? t???n t???i."));
			$exist = $entityManager->getRepository('User')->findOneBy(array('email' => $_POST['email']));
			if(!empty($exist) && $exist->id != $item->id) return Helper::setMessage(array("type" => "error", "message" => "?????a ch??? email ???? t???n t???i."));
			//update info
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			$item->updated = time();
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
            Helper::setMessage(array("type" => "success", "message" => "???? c???p nh???t th??ng tin"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function change(){ 
        try {
			if($_POST['new'] != $_POST['password']) return Helper::setMessage(array("type" => "success", "message" => "M???t kh???u m???i kh??ng tr??ng kh???p."));
            global $entityManager;
            $item = $entityManager->getRepository("User")->findOneBy(array('code' => Helper::getSession('user')));
			if($item->password != md5($_POST['old'])) return Helper::setMessage(array("type" => "success", "message" => "M???t kh???u c?? kh??ng ch??nh x??c."));
			$item->password = md5($_POST['password']);
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
            Helper::setMessage(array("type" => "success", "message" => "???? thay ?????i m???t kh???u"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function resetPWD($item, $pwd){ 
        try {
			global $entityManager;
            $item->password = md5($pwd);
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