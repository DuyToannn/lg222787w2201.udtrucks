<?php
	//config PHP
	error_reporting(E_ERROR | E_PARSE);
	ini_set("display_errors", "1");
	session_start();
	define("ROOT", dirname(dirname(__FILE__)) ."/");
	define("ADMIN", dirname(__FILE__) ."/");
	define("HOME", str_replace(ROOT,'',ADMIN));
	//include libs
	require_once(ADMIN."libs/cms.php");
	require_once(ADMIN."libs/controller.php");
	require_once(ADMIN."libs/helper.php");
	//config ORM
	require_once(ROOT."libs/ORM-2.9.2/autoload.php");
	require_once(ROOT."config/database.php");
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;
	$tables = array(ROOT."config/tables");
	$params = array(
		"driver"   => Database::$driver,
		"user"     => Database::$user,
		"password" => Database::$password,
		"dbname"   => Database::$name,
		"host"     => Database::$host,
		"charset" => "utf8mb4"
	);
	$config = Setup::createAnnotationMetadataConfiguration($tables, false);
	$entityManager = EntityManager::create($params, $config);
	//execute cms
	$website = new WebCMS();
	$website->execute();
?>