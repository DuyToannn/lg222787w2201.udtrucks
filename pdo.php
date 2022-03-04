<?php
error_reporting(E_ERROR | E_PARSE);
ini_set("display_errors", "1");
require_once('config/database.php');
function getTables(){
	try {
		$pdo = new PDO('mysql:host='.Database::$host.';dbname='.Database::$name, Database::$user, Database::$password);
		$sql = "SHOW TABLES";
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$tables = $statement->fetchAll(PDO::FETCH_NUM);
		foreach($tables as $table){
			getStruct($table[0]);
		}
	} catch (Exception $e) {
		var_dump($e);
	}
}

function getStruct($table){
	try {
		$pdo = new PDO('mysql:host='.Database::$host.';dbname='.Database::$name, Database::$user, Database::$password);
		$statement = $pdo->query('DESCRIBE ' . $table);
		$fields = $statement->fetchAll(PDO::FETCH_ASSOC);
		createFile($table, $fields);
	} catch (Exception $e) {
		var_dump($e);
	}
}
function createFile($table, $fields){
	try {
		$component = array("_commerce_"=>"_","_content_"=>"_","_crm_"=>"_","_hrm_"=>"_","_im_"=>"_","_location_"=>"_","_website_"=>"_");
		$class = strtr($table, $component);
		$class = str_replace(Database::$prefix,"",$class);
		
		$class = ucwords($class, "_");
		$class = str_replace("_","",$class);
		$file = fopen("config/tables/".$class.".php", "w") or die("Unable to open file!");
		//$file = fopen(MCOM."/tables/".$class.".php", "w") or die("Unable to open file!");
		$txt = '<?php
/**
 * @Entity @Table(name="'.$table.'")
 **/
class '.$class.'{'."\n";
		fwrite($file, $txt);
		foreach($fields as $field ){
			$type = (strpos($field['Type'], 'int') !== false) ? 'integer' : 'string';
			if(strpos($field['Type'], 'smallint') !== false) $type = 'smallint';
			if(strpos($field['Type'], 'bigint') !== false) $type = 'bigint';
			if(strpos($field['Type'], 'boolean') !== false) $type = 'boolean';
			if(strpos($field['Type'], 'date') !== false) $type = 'date';
			if(strpos($field['Type'], 'time') !== false) $type = 'time';
			if(strpos($field['Type'], 'text') !== false) $type = 'text';
			if(strpos($field['Type'], 'float') !== false || strpos($field['Type'], 'double') !== false) $type = 'float';
			$null = ($field['Null'] == 'YES') ? ', nullable=true' : '';
			$uni = ($field['Key'] == 'UNI') ? ', unique=true' : '';
			$auto = ($field['Extra'] == '') ? '' : ' @GeneratedValue';
			$txt = "\t".'/** @'.$field['Field'].' @Column(type="'.$type.'"'.$null.$uni.')'.$auto.'**/
    public $'.$field['Field'].';'."\n";
			fwrite($file, $txt);
		}
		$txt = "}\n?>";
		fwrite($file, $txt);
		fclose($file);
	///LGIOrder	
	if($class == "Order"){
		$file = fopen("config/tables/LGI".$class.".php", "w") or die("Unable to open file!");
		//$file = fopen(MCOM."/tables/LGI".$class.".php", "w") or die("Unable to open file!");
		$txt = '<?php
/**
 * @Entity @Table(name="'.$table.'")
 **/
class LGI'.$class.'{'."\n";
		fwrite($file, $txt);
		foreach($fields as $field ){
			$type = (strpos($field['Type'], 'int') !== false) ? 'integer' : 'string';
			if(strpos($field['Type'], 'smallint') !== false) $type = 'smallint';
			if(strpos($field['Type'], 'bigint') !== false) $type = 'bigint';
			if(strpos($field['Type'], 'boolean') !== false) $type = 'boolean';
			if(strpos($field['Type'], 'date') !== false) $type = 'date';
			if(strpos($field['Type'], 'time') !== false) $type = 'time';
			if(strpos($field['Type'], 'text') !== false) $type = 'text';
			if(strpos($field['Type'], 'float') !== false || strpos($field['Type'], 'double') !== false) $type = 'float';
			$null = ($field['Null'] == 'YES') ? ', nullable=true' : '';
			$uni = ($field['Key'] == 'UNI') ? ', unique=true' : '';
			$auto = ($field['Extra'] == '') ? '' : ' @GeneratedValue';
			$txt = "\t".'/** @'.$field['Field'].' @Column(type="'.$type.'"'.$null.$uni.')'.$auto.'**/
    public $'.$field['Field'].';'."\n";
			fwrite($file, $txt);
		}
		$txt = "}\n?>";
		fwrite($file, $txt);
		fclose($file);
	}
	} catch (Exception $e) {
		var_dump($e);
	}
}
try {
	$files = glob('config/tables/*'); // get all file names
	//$files = glob(MCOM.'/tables/*');
	foreach($files as $file){ // iterate files
	  if(is_file($file))
		unlink($file); // delete file
	}
	getTables();
	echo "<h1 style='text-align: center;'>Completed</h1>";
} catch (Exception $e) {
	var_dump($e);
}

?>