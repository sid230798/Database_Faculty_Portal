<?php

	require_once('config.php');
	session_start();
	
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	
		$insRec = new MongoDB\Driver\BulkWrite;
		$id = $_POST['id'];
		$key = $_POST['Title'];
		$paper = $_POST['index'];
		$conf = $_POST['comment'];
		
		$publication = array();
		
		for($i = 0; $i < count($paper); $i++){
		
			$local = array("Index" => $paper[$i], "Comment" => $conf[$i]);
			array_push($publication, $local);
		
		}
		
		$insRec->update(['_id'=>new MongoDB\BSON\ObjectID($id)],['$set' => [$key => $publication]]);
		$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
		$result = $manager->executeBulkWrite('faculty_portal.users', $insRec, $writeConcern);
		
		if($result)
			header('Location: '.$_SESSION['url']);
		//$result->getModifiedCount();
	
	}
?>
