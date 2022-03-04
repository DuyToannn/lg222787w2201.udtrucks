<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once(ROOT.'libs/PHPMailer/autoload.php');
class MailerModel{
	public $mail;
	public function __construct($host, $username, $password, $port, $from, $name){
        $this->mail = new PHPMailer(true);
		   //Server settings
		$this->mail->CharSet = 'UTF-8';
		//$this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$this->mail->isSMTP();                                            //Send using SMTP
		$this->mail->Host       = $host;                     //Set the SMTP server to send through
		$this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$this->mail->Username   = $username;                     //SMTP username
		$this->mail->Password   = $password;                               //SMTP password
		//$this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$this->mail->Port       = $port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		$this->mail->setFrom($from, $name);
	}
    public function send($address, $subject, $text){
        try{
			$this->mail->addAddress($address); 
			$this->mail->isHTML(true);
			$this->mail->Subject = $subject;
			$this->mail->Body    = $text;
            if(!$this->mail->send()) {
                return $this->mail->ErrorInfo;
            } else {
                return 'Đã gửi thành công.';
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}