<?php
class Helper{
	public static function stringURLSafe($string){
		$trans = array(
			"Q"=>"q","W"=>"w","R"=>"r","T"=>"t","P"=>"p","S"=>"s","F"=>"f",
			"đ"=>"d","N"=>"n","M"=>"m","C"=>"c","V"=>"v","B"=>"b","H"=>"h",
			"Đ"=>"d","J"=>"j","K"=>"k","L"=>"l","Z"=>"z","X"=>"x","G"=>"g",
			"á"=>"a", "à"=>"a", "ả"=>"a", "ã"=>"a", "ạ"=>"a","D"=>"d",
			"Á"=>"a", "À"=>"a", "Ả"=>"a", "Ã"=>"a", "Ạ"=>"a","A"=>"a",
			"ấ"=>"a", "ầ"=>"a", "ẩ"=>"a", "ẫ"=>"a", "ậ"=>"a","â"=>"a",
			"Ấ"=>"a", "Ầ"=>"a", "Ẩ"=>"a", "Ẫ"=>"a", "Ậ"=>"a","Â"=>"a",
			"ắ"=>"a", "ằ"=>"a", "ẳ"=>"a", "ẵ"=>"a", "ặ"=>"a","ă"=>"a",
			"Ắ"=>"a", "Ằ"=>"a", "Ẳ"=>"a", "Ẵ"=>"a", "Ặ"=>"a","Ă"=>"a",
			"é"=>"e", "è"=>"e", "ẻ"=>"e", "ẽ"=>"e", "ẹ"=>"e",
			"É"=>"e", "È"=>"e", "Ẻ"=>"e", "Ẽ"=>"e", "Ẹ"=>"e","E"=>"e",
			"ế"=>"e", "ề"=>"e", "ể"=>"e", "ễ"=>"e", "ệ"=>"e","ê"=>"e",
			"Ế"=>"e", "Ề"=>"e", "Ể"=>"e", "Ễ"=>"e", "Ệ"=>"e","Ê"=>"e",
			"ú"=>"u", "ù"=>"u", "ủ"=>"u", "ũ"=>"u", "ụ"=>"u",
			"Ú"=>"u", "Ù"=>"u", "Ủ"=>"u", "Ũ"=>"u", "Ụ"=>"u", "U"=>"u",
			"ứ"=>"u", "ừ"=>"u", "ử"=>"u", "ữ"=>"u", "ự"=>"u", "ư"=>"u",
			"Ứ"=>"u", "Ừ"=>"u", "Ử"=>"u", "Ữ"=>"u", "Ự"=>"u", "Ư"=>"u",
			"í"=>"i", "ì"=>"i", "ỉ"=>"i", "ĩ"=>"i", "ị"=>"i",
			"Í"=>"i", "Ì"=>"i", "Ỉ"=>"i", "Ĩ"=>"i", "Ị"=>"i", "I"=>"i",
			"ý"=>"y", "ỳ"=>"y", "ỷ"=>"y", "ỹ"=>"y", "ỵ"=>"y",
			"Ý"=>"y", "Ỳ"=>"y", "Ỷ"=>"y", "Ỹ"=>"y", "Ỵ"=>"y", "Y"=>"y",
			"ó"=>"o", "ò"=>"o", "ỏ"=>"o", "õ"=>"o", "ọ"=>"o",
			"Ó"=>"o", "Ò"=>"o", "Ỏ"=>"o", "Õ"=>"o", "Ọ"=>"o", "O"=>"o",
			"ố"=>"o", "ồ"=>"o", "ổ"=>"o", "ỗ"=>"o", "ộ"=>"o", "ô"=>"o",
			"Ố"=>"o", "Ồ"=>"o", "Ổ"=>"o", "Ỗ"=>"o", "Ộ"=>"o", "Ô"=>"o",
			"ớ"=>"o", "ờ"=>"o", "ở"=>"o", "ỡ"=>"o", "ợ"=>"o", "ơ"=>"o",
			"Ớ"=>"o", "Ờ"=>"o", "Ở"=>"o", "Ỡ"=>"o", "Ợ"=>"o", "Ơ"=>"o",
		);
		$str = str_replace('-', ' ', $string);
		$str = strtr($str, $trans);
		$str = preg_replace('/(\s|[^A-Za-z0-9\-\.])+/', '-', $str);
		$str = trim($str, '-');
		return $str;
	}
	public static function getTime($duration) {
		$text = ($duration % 60).' giây';
		if($duration / 60 > 1) {
			$duration = floor($duration / 60);
			$text = ($duration % 60).' phút '.$text;
			if($duration / 60 > 1) {
				$duration = floor($duration / 60);
				$text = ($duration % 60).' giờ '.$text;
			}
		}
		return $text;
	}
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
			echo '<div class="cn-'. $_SESSION['message']['type'] .'">'. $_SESSION['message']['message'] . '</div>';
			unset($_SESSION['message']);
		}
	}
	public static function showMessageJS() {
		if (!empty($_SESSION['message'])) {
		  echo '<script>alert("'.html_entity_decode($_SESSION["message"]["message"]).'");</script>';
		  unset($_SESSION['message']);
		}
	}
	
	public static function setEditor($id) {
	    $html = '<script>
	        var roxyFileman = "/'.HOME.'libs/fileman/index.html";
	        $(function(){
	           CKEDITOR.replace( '. $id .',{filebrowserBrowseUrl:roxyFileman,
	                                        filebrowserImageBrowseUrl:roxyFileman+\'?type=files\',
	                                        removeDialogTabs: \'link:upload;image:upload\'});
	        });
	    </script>';
	    echo $html;
	}
	public static function setImage($id) {
		$html = '<div class="roxyCustomPanel" id="roxyCustomPanel'.$id.'" style="display: none;">
		  <iframe src="/'.HOME.'libs/fileman/index.html?integration=custom&type=files&txtFieldId='.$id.'" style="width:100%;height:100%" frameborder="0"></iframe></div>
		<script>
			function openCustomRoxy(id){$("#roxyCustomPanel" + id).dialog({modal:true,width:875,height:600});}
			function closeCustomRoxy(){$(".roxyCustomPanel").dialog("close"); }
		</script>';
		echo $html;
	}
}
?>