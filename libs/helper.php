<?php
class Helper{
	public static function getSession($key) {
		if(!empty($_SESSION[Database::$session][$key])) {
			return $_SESSION[Database::$session][$key];
		}
		return false;
	}
	public static function setSession($key,$data) {
		$_SESSION[Database::$session][$key] = $data;
	}
	public static function unsetSession($key) {
		if(!empty($_SESSION[Database::$session][$key])) {
			unset($_SESSION[Database::$session][$key]);
			return true;
		}
		return false;
	}
	public static function setMessage($message) {
		$_SESSION['message']['type'] = $message['type'];
		$_SESSION['message']['message'] = $message['message'];
		return $message['type'] == 'error' ? false : true;
	}
	public static function showMessage() {
		if (!empty($_SESSION['message'])) {
		  echo '<div class="alert alert-'. $_SESSION['message']['type'] .'"><div class="modal"><i class="ion-close-circled"></i>'. $_SESSION['message']['message'] . '</div></div>';
		  unset($_SESSION['message']);
		}
	}
	public static function showMessageJS() {
		if (!empty($_SESSION['message'])) {
		  echo '<script>alert("'.$_SESSION["message"]["message"].'");</script>';
		  unset($_SESSION['message']);
		}
	}
	
}
?>