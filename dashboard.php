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
	
	$publication = array();
	foreach($cursor as $entry){
		 $c = get_object_vars($entry);
		 foreach($c['Publication'] as $pub){
		 	$tmp = get_object_vars($pub);
		 	array_push($publication, $tmp);
		}
	}
	
	foreach($publication as $row)
		echo "Yes";
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
