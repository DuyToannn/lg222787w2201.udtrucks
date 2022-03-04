<?php
class PController extends Controller{
	public function execute(){
		if(!empty($_POST)){
			if(!empty($_POST['sendEmail'])){
				if($_POST['sendEmail'] == "test"){
					require(ADMIN.'libs/mailer.php');
					$address = $_POST['email']['test'];
					$subject = "Gửi thử thành công!!!";
					$text = "Gửi thử thành công!!!";
					$mailer = new MailerModel($_POST['email']['host'], $_POST['email']['username'], $_POST['email']['password'], $_POST['email']['port'], $_POST['email']['from'], $_POST['email']['name']);
					echo $mailer->send($address, $subject, $text);
				}
				exit();
			}
			$this->model->setting->updateOption($_POST["email"], "email");
			//$this->model->setting->updateOption($_POST["VNP"], "VNP");
			//$this->model->setting->updateOption($_POST["VTP"], "VTP");
			//$this->model->setting->updateOption($_POST["GHTK"], "GHTK");
			//$this->model->setting->updateOption($_POST["GHN"], "GHN");
			//$this->model->setting->updateOption($_POST["JTE"], "JTE");
			header("Refresh:0");
		}
	}
}
?>