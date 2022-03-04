<?php
class TrafficModel{
	public function countTraffic($duration = 0) {
        try {
			global $entityManager;
			$query_count = $entityManager->createQueryBuilder();
            $query_count->select($query_count->expr()->count('i.id'))->from('Traffic','i');
			if($duration == 1) $query_count->andWhere('i.checkin >= '.strtotime("today").' AND i.checkin <= '.(strtotime("today") + 86399));
			if($duration == -1) $query_count->andWhere('i.checkin >= '.strtotime("yesterday").' AND i.checkin <= '.(strtotime("yesterday") + 86399));
			if($duration == 7) $query_count->andWhere('i.checkin >= '.(strtotime("today") - (86400 * 7)).' AND i.checkin < '.strtotime("today"));
			if($duration == 30) $query_count->andWhere('i.checkin >= '.(strtotime("today") - (86400 * 30)).' AND i.checkin < '.strtotime("today"));
            return $query_count->getQuery()->getSingleScalarResult();
        } catch (Exception $e) {
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
	public function checkout(){
        try {
			$json = file_get_contents(ROOT."config/json/apple.json");
			$json = json_decode($json, true);
            global $entityManager;
			$item = $entityManager->getRepository("Traffic")->findOneBy(array("id" => Helper::getSession('id_parent')));
			$time = new DateTime(date("Y-m-d H:i:s"));
			$item->checkout = $time->getTimestamp();
			if($item->device == "iPhone" && !empty($_POST["height"]) && !empty($json[$_POST["height"]])){
				$item->device = $json[$_POST["height"]];
			}
			$entityManager->merge($item);
			$entityManager->flush();
			$entityManager->clear();
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function execute($user = null){
        try {
            global $entityManager;
			if(!empty(Helper::getSession('id_parent'))){
				$item = $entityManager->getRepository("Traffic")->findOneBy(array("id" => Helper::getSession('id_parent')));
				if(!empty($item)){
					if(!empty($user)) $item->user = $user;
					$item->pages = json_encode(Helper::getSession('traffics'));
					$time = new DateTime(date("Y-m-d H:i:s"));
					$item->checkout = $time->getTimestamp();
					$entityManager->merge($item);
					$entityManager->flush();
					$entityManager->clear();
				}
			}else{
				$cookie_string = 'mcom_'.$_SERVER["SERVER_NAME"];
				$cookie_string = str_replace('.','_',$cookie_string);
				$cookie_string = str_replace('-','_',$cookie_string);
				$item = new Traffic();
				if(!empty($user)) $item->user = $user; else $item->user = "(none)";
				$item->agent = $_SERVER["HTTP_USER_AGENT"];
				$item->device = "Windows";
				if(strpos($_SERVER["HTTP_USER_AGENT"], "Mac OS") !== false) $item->device = "Mac OS";
				if(strpos($_SERVER["HTTP_USER_AGENT"], "iPhone") !== false) $item->device = "iPhone";
				if(strpos($_SERVER["HTTP_USER_AGENT"], "iPad") !== false) $item->device = "iPad";
				if(strpos($_SERVER["HTTP_USER_AGENT"], "Android") !== false) $item->device = "Android";
				if(!empty($_SERVER["HTTP_REFERER"])) $item->referer = $_SERVER["HTTP_REFERER"]; else $item->referer = "(direct)";
				if(strpos($_SERVER["REQUEST_URI"], "gclid") !== false || (!empty($_SERVER["HTTP_REFERER"]) && strpos($_SERVER["HTTP_REFERER"], "gclid") !== false)) $item->referer = "Google Ads";
				if(strpos($_SERVER["REQUEST_URI"], "fbclid") !== false || (!empty($_SERVER["HTTP_REFERER"]) && strpos($_SERVER["HTTP_REFERER"], "fbclid") !== false)) $item->referer = "Facebook";
				if(strpos($_SERVER["REQUEST_URI"], "zalo") !== false || (!empty($_SERVER["HTTP_REFERER"]) && strpos($_SERVER["HTTP_REFERER"], "zalo") !== false)) $item->referer = "Zalo";
				$item->ip = $_SERVER["REMOTE_ADDR"];
				$item->pages = json_encode(Helper::getSession('traffics'));
				$time = new DateTime(date("Y-m-d H:i:s"));
				$item->checkin = $time->getTimestamp();
				$item->checkout = $item->checkin;
				if(isset($_COOKIE[$cookie_string])){
					$item->id_parent = $_COOKIE[$cookie_string];
					setcookie($cookie_string, $item->id_parent, time() + (86400 * 30), '/');
				}
				$entityManager->persist($item);
				$entityManager->flush();
				$entityManager->clear();
				Helper::setSession('id_parent', $item->id);
				if(!isset($_COOKIE[$cookie_string])){
					setcookie($cookie_string, $item->id, time() + (86400 * 30), '/');
					$item->id_parent = $item->id;
					$entityManager->merge($item);
					$entityManager->flush();
					$entityManager->clear();
				}
			}
        } catch (Exception $e) {
            Helper::setMessage(array("type" => "error", "message" => $e->getMessage()));
        }
    }
	public function dispatchURL($re_url, &$page, &$item){
		return;
    }
}
?>