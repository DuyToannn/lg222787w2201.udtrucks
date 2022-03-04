<?php
	//config PHP
	error_reporting(E_ERROR | E_PARSE);
	ini_set("display_errors", "1");
	//date_default_timezone_set("Asia/Ho_Chi_Minh");
	session_start();
	define("ROOT", dirname(__FILE__) ."/");
	define("DOMAIN",$_SERVER["SERVER_NAME"]);
	
	require_once(ROOT."libs/cms.php");
	require_once(ROOT."libs/router.php");
	require_once(ROOT."libs/controller.php");
	require_once(ROOT."libs/helper.php");
	//config ORM
	require_once(ROOT."config/database.php");
	require_once(ROOT."libs/ORM-2.9.2/autoload.php");
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;
	$tables = array(ROOT."config/tables");
	$params = array(
		"driver"	=> Database::$driver,
		"user"		=> Database::$user,
		"password"	=> Database::$password,
		"dbname"	=> Database::$name,
		"host"		=> Database::$host,
		"charset"	=> "utf8mb4"
	);
	$datacfg = Setup::createAnnotationMetadataConfiguration($tables, false);
	$entityManager = EntityManager::create($params, $datacfg);
	//execute cms
	$website = new WebCMS();
	$website->execute();
?>