<?php

	require_once("config.php");
	$filter = ['username' => 'a'];
	$options = [];
    $query = new MongoDB\Driver\Query($filter, $options);
	$cursor = $manager->executeQuery('faculty_portal.users', $query);
	//$username = 'sid230798';
	#$result = pg_query($pg, "select username from users where username='$username'");
	//$dept_name = 'EE';
	//$result = pg_query($pg, "select Faculty.Name, Users.username from Faculty, Department, Users where Faculty.Id = Users.Id and Faculty.dept_id = Department.Id and Department.name='$dept_name'");
	#$result = pg_query($pg, "select Faculty.Name, Users.username from Faculty, Department, Users, HOD where Faculty.Id = Users.Id and Faculty.dept_id = Department.Id and HOD.dept_id = Department.Id and Department.name='$dept_name'");
	//$resultArr = pg_fetch_all($result);
	#echo count($resultArr);
	/*
	for($c = 0; $c < count($resultArr); $c++){
		print_r($resultArr[$c]['name']);
	}*/
	#print_r(len($resultArr);
	/*
	$iterator = new IteratorIterator($cursor);

	$iterator->rewind();

	while (true) {
		if ($iterator->valid()) {
		    $document = $iterator->current();
		    printf("Consumed document created at: %s\n", $document->createdAt);
		    print_r($document);
		}

		$iterator->next();
	}*/
	/*echo $cursor->ModuleAccountInfo[0]->username*/
	
	//$result = pg_query($pg, "select faculty.Id from Faculty, Users where Faculty.Id = Users.Id and Users.username='a' and Users.password='12qwaszx'");
	//$resultArr = pg_fetch_all($result);
	//echo $resultArr[0]['id'];
	
	$publication = array();
	foreach($cursor as $entry){
		 $c = get_object_vars($entry);
		 $id = $c['_id']->__toString();
		 print_r($id);
		 #$obj = new MongoDB\BSON\ObjectID($id);
		 #print_r($obj);
		 
		 foreach($c['Publication'] as $pub){
		 	$tmp = get_object_vars($pub);
		 	$tmp['Paper'] = "Mostly Sane";
		 	array_push($publication, $tmp);
		 	
		}
	}
	
	print_r($publication);
	
	$insRec = new MongoDB\Driver\BulkWrite;
	$username = "a";
	$pass = "12qwaszx";
	$name = "Dr. Aditya";
	$email = "a@iitrpr.ac.in";
	$overview = "Interested in Machine Learning, Enthu as well";
	//$insRec->update(['_id'=>new MongoDB\BSON\ObjectID($id)],['$set' => ["Publication" => $publication]]);
	$insRec->update(['_id'=>new MongoDB\BSON\ObjectID($id)],['$set' => ["username" => $username, "password" => $pass, "name" => $name, "email" => $email, "Overview" => $overview]]);
	$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
	$result = $manager->executeBulkWrite('faculty_portal.users', $insRec, $writeConcern);
	
	echo $result->getModifiedCount();
	
	/*
	foreach($publication as $row)
		echo "Yes";
	*/
	#print_r($publication)
	
	
	
	
?>
<!DOCTYPE html>
<html>
<body>
Logged In
<input type="text" value=""te>
<p> <?php echo $publication.length; ?> </p>
<div class="Publication">
<ul>
<?php foreach($publication as $pub){?>
<li>
<h2 style="color: blue"><?php echo $pub['Paper']; ?> </h2>
<p><?php echo $pub['Conf'];?></p>
</li>
<?php }?>
</ul>
</div>
</body>
</html>
