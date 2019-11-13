<?php

	require_once("config.php");
	$filter = ['username' => 'sid230798'];
	$options = [];
    $query = new MongoDB\Driver\Query($filter, $options);
	$cursor = $manager->executeQuery('faculty_portal.users', $query);
	$username = 'sid230798';
	$result = pg_query($pg, "select username from users where username='$username'");
	$resultArr = pg_fetch_all($result); 
	print_r($resultArr[0]['username']);
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
	
	
	foreach($cursor as $entry){
		 $c = get_object_vars($entry);
		 print_r($c['Publication'][0]);
	}
	
	
?>
<html>
<body>
Logged In
</body>
</html>
