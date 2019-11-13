<?php
	ob_start();
	error_reporting(E_ALL);
	// This path should point to Composer's autoloader
	try
	{
	  $manager = new MongoDB\Driver\Manager("mongodb://localhost");
	  $pg = pg_connect("host=localhost dbname=faculty_portal user=db_project password=12qwaszx");
	}
	catch (MongoConnectionException $e)
	{
		die('Error connecting to MongoDB server');
	} 
	catch (MongoException $e) {
		die('Error: ' . $e->getMessage());
	}
	// include_once("functions.php");
	// session_start();
	// session_register("login");
	// session_register("password");
	// session_register("loggedIn");
?>
