<?php
class StaffModel{
	public function getOne($value, $field = "id"){
		try {
			global $entityManager;
			return $entityManager->getRepository("Staff")->findOneBy(array($field => $value));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function getList($permission){
		try {
			global $entityManager;
			return $entityManager->getRepository("Staff")->findBy(array('permission' => $permission), array('login' => 'DESC'));
		} catch (Exception $e) {
            return Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function login(){
		try{
			global $entityManager;
			$item = $entityManager->getRepository('Staff')->findOneBy( array('status' => 1, 'code' => $_POST['account'], 'password' => md5($_POST['password'])));	
			if(empty($item)) $item = $entityManager->getRepository('Staff')->findOneBy( array('status' => 1, 'phone' => $_POST['account'], 'password' => md5($_POST['password'])));
			if(!empty($item)){ 
				Helper::setSession('staff', $item->code);
				$_SESSION['is_admin_logged'] = true;
				$item->login = time();
				$entityManager->merge($item);
				$entityManager->flush();
				$entityManager->clear();
				return $item;
			}else{
				Helper::setMessage(array('type' => 'error', 'message' => 'Thông tin đăng nhập không đúng.'));
				return false;
			}
		}catch(Exception $e){
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
	}
	public function create(){
        try {
            global $entityManager;
			$item = new Staff();
			foreach ($_POST as $key => $value){if($key != "task") $item->$key = $_POST[$key];}
			$item->password = md5($_POST['password']);
			$item->created = time();
			$item->status = 1;
			$entityManager->persist($item);
            $entityManager->flush();
			$item->code = 'MC'.$item->id;
			$entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
			Helper::setMessage(array("type" => "success", "message" => "Đã thêm mới"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function update($_id){ 
        try {
            global $entityManager;
            $item = $this->getOne($_id);
			foreach ($_POST as $key => $value){ if($key != "task") $item->$key = $_POST[$key]; }
			if(!empty($_POST['dob']) && strtotime($_POST['dob']) > 0) $item->dob = strtotime($_POST['dob']);
			$item->updated = time();
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
            Helper::setMessage(array("type" => "success", "message" => "Đã cập nhật dữ liệu"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function change($_id){ 
        try {
			if($_POST['password'] != $_POST['confirm']) return Helper::setMessage(array("type" => "success", "message" => "Xác nhận nhập không đúng"));
            global $entityManager;
            $item = $this->getOne($_id);
			if($item->password != md5($_POST['old'])) return Helper::setMessage(array("type" => "success", "message" => "Mật khẩu cũ không đúng"));
			$item->password = md5($_POST['password']);
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
            Helper::setMessage(array("type" => "success", "message" => "Đã cập nhật dữ liệu"));
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function activity($type, $task, $content = null){ 
        try {
			global $entityManager;
			$item = new StaffActivity();
			$item->staff = Helper::getSession('staff');
			$item->created = time();
			$item->type = $type;
			$item->task = $task;
			$item->content = $content;
			$item->ip = $_SERVER["REMOTE_ADDR"];
			$item->agent = $_SERVER["HTTP_USER_AGENT"];
			$item->device = "Windows";
			if(strpos($_SERVER["HTTP_USER_AGENT"], "Mac OS") !== false) $item->device = "Mac OS";
			if(strpos($_SERVER["HTTP_USER_AGENT"], "iPhone") !== false) $item->device = "iPhone";
			if(strpos($_SERVER["HTTP_USER_AGENT"], "iPad") !== false) $item->device = "iPad";
			if(strpos($_SERVER["HTTP_USER_AGENT"], "Android") !== false) $item->device = "Android";
			$entityManager->persist($item);
            $entityManager->flush();
            $entityManager->clear();
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	
	
	//OLD
	public function status($id) {
        try {
            global $entityManager;
            $item = $this->getOne($id);
			if($item->status == 0) $item->status = 1; else $item->status = 0;
            $entityManager->merge($item);
            $entityManager->flush();
            $entityManager->clear();
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
	public function permission() {
        try {
            global $entityManager;
            $item = $this->getOne($_POST['id']);
			$item->permission = $_POST['permission'];
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
}
?>