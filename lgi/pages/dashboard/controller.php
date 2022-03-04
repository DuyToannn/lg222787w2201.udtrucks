<?php
class PController extends Controller{
	public function execute(){
		$_SESSION["upload_path"] = "/images";
		if(isset($_GET['task']) && $_GET['task'] == 'logout'){
			session_unset();
			header('Location: index.php'); exit();
		}
	}
}
?>