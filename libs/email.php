<?php
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once(ROOT.'libs/PHPMailer/autoload.php');*/
require_once(ROOT.'libs/PHPMailer/PHPMailerAutoload.php');
class EmailModel{
	public $mail;
	public $email;
	public function __construct(){
		$this->email = new PHPMailer(true);
        $this->email->CharSet = 'UTF-8';
        $this->email->isSMTP();
		$this->email->isHTML(true);
		$this->email->SMTPAuth = true;
        $this->email->Host = "smtp.gmail.com";
        $this->email->Username = "chungmt.pigment@gmail.com";
        $this->email->Password = "wnaxplenvvbjgntg";
        $this->email->SMTPSecure = "tls";
        $this->email->Port = "587";
        $this->email->From = "chungmt.pigment@gmail.com";
        $this->email->FromName = "Pigment";
		
        /*
		$this->mail = new PHPMailer(true);
		
		   //Server settings
		$this->mail->CharSet = 'UTF-8';                    //Enable verbose debug output
		$this->mail->isSMTP();      
		$this->mail->isHTML(true);		//Send using SMTP
		$this->mail->Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
		$this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$this->mail->Username   = "chungmt.pigment@gmail.com";                     //SMTP username
		$this->mail->Password   = "wnaxplenvvbjgntg";                               //SMTP password
		$this->mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
		$this->mail->Port       = "587";   
		$this->mail->From = "chungmt.pigment@gmail.com";
        $this->mail->FromName = "Pigment"; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		*/
	}
	public function sendText($address, $subject, $text){
        try{
            $this->email->addAddress($address);
            $this->email->Subject = $subject;
            $this->email->Body    = $text;
            if(!$this->email->send()) return $this->email->ErrorInfo;
            else return "Gửi email thành công.";
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function send($address, $subject, $text){
        try{
			$this->mail->addAddress($address); 
			
			$this->mail->Subject = $subject;
			$this->mail->Body    = $text;
            if(!$this->mail->send()) {
                return Helper::setMessage(array('type' => 'error', 'message' => $this->mail->ErrorInfo));
            } else {
                return Helper::setMessage(array('type' => 'error', 'message' => 'Đã gửi thành công.'));
            }
        }catch(Exception $e){
            return Helper::setMessage(array('type' => 'error', 'message' => $e->getMessage()));
        }
    }
}