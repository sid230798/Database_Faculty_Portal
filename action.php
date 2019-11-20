<?php

	require_once('config.php');
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	
		$insRec = new MongoDB\Driver\BulkWrite;
		$id = $_POST['id'];
		if(isset($_POST['OverviewForm'])){
		
			$username = $_POST['username'];
			$pass = $_POST['password'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$overview = $_POST['overview'];
			$fid = $_SESSION["facultyID"];
			
			$insRec->update(['_id'=>new MongoDB\BSON\ObjectID($id)],['$set' => ["username" => $username, "password" => $pass, "name" => $name, "email" => $email, "Overview" => $overview]]);
			$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
			$result = $manager->executeBulkWrite('faculty_portal.users', $insRec, $writeConcern);
			//header($_SESSION['url']);
			/*Editing same username, password and name*/
			$sql = "update faculty set username='$username', password='$pass', name='$name', email='$email' where id='$fid'";
			$posResult = pg_query($pg, $sql);
			
			header('Location: logout.php');
			echo $result->getModifiedCount();
		
		}elseif(isset($_POST['PublicationForm'])){
		
			
			$paper = $_POST['paper'];
			$conf = $_POST['conf'];
			
			$publication = array();
			
			for($i = 0; $i < count($paper); $i++){
			
				$local = array("Paper" => $paper[$i], "Conf" => $conf[$i]);
				array_push($publication, $local);
			
			}
			
			$insRec->update(['_id'=>new MongoDB\BSON\ObjectID($id)],['$set' => ["Publication" => $publication]]);
			$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
			$result = $manager->executeBulkWrite('faculty_portal.users', $insRec, $writeConcern);
			
			//header($_SESSION['url']);
			echo $result->getModifiedCount();
		
			
		}elseif(isset($_POST['EducationForm'])){
		
			$paper = $_POST['study'];
			$conf = $_POST['year'];
			
			$publication = array();
			
			for($i = 0; $i < count($paper); $i++){
			
				$local = array("Study" => $paper[$i], "Year" => $conf[$i]);
				array_push($publication, $local);
			
			}
			
			$insRec->update(['_id'=>new MongoDB\BSON\ObjectID($id)],['$set' => ["Education" => $publication]]);
			$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
			$result = $manager->executeBulkWrite('faculty_portal.users', $insRec, $writeConcern);
			
			//header($_SESSION['url']);
			echo $result->getModifiedCount();
			
		}elseif(isset($_POST['AwardsForm'])){
		
			$paper = $_POST['title'];
			$conf = $_POST['date'];
			
			$publication = array();
			
			for($i = 0; $i < count($paper); $i++){
			
				$local = array("Title" => $paper[$i], "Date" => $conf[$i]);
				array_push($publication, $local);
			
			}
			
			$insRec->update(['_id'=>new MongoDB\BSON\ObjectID($id)],['$set' => ["Award" => $publication]]);
			$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
			$result = $manager->executeBulkWrite('faculty_portal.users', $insRec, $writeConcern);
			
			//header($_SESSION['url']);
			echo $result->getModifiedCount();
		
		}elseif(isset($_POST['TeachingForm'])){
		
			$paper = $_POST['course'];
			$conf = $_POST['date'];
			
			$publication = array();
			
			for($i = 0; $i < count($paper); $i++){
			
				$local = array("Course" => $paper[$i], "Date" => $conf[$i]);
				array_push($publication, $local);
			
			}
			
			$insRec->update(['_id'=>new MongoDB\BSON\ObjectID($id)],['$set' => ["Teaching" => $publication]]);
			$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
			$result = $manager->executeBulkWrite('faculty_portal.users', $insRec, $writeConcern);
			
			//header($_SESSION['url']);
			echo $result->getModifiedCount();
		
		}else{
		
			echo "Fail";
		}
		
	
	}

?>
