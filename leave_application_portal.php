<?php

require 'config.php';

session_start();

$error = "";

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit();
}

// ******************************** this is for my leave requests
if (isset($_SESSION['facultyID'])) {

	$sql = "SELECT * FROM Leave_Request WHERE leave_id="."".$_SESSION['facultyID'].";";

	$result = pg_query($manager, $sql);
	
	while( $row = pg_fetch_array($result) ){
		// here $row is each leave_Request for this faculty which will be listed out .. one of these will be the current leave request
		echo $row['leave_id'];
		echo '<br>';
		$sql = "SELECT * FROM Leave_Approvals WHERE LR_id = '".$row['id']."';";
		$result2 = pg_query( $manager,$sql );
		while( $row2 = pg_fetch_array($result2) ){
			echo $row2['lr_id'];
			echo '<br>';
			// this is each leave_approval row which needs to be printed on clicking view
		}
	}
}

// ******************************** this is for request approved by me

if (isset($_SESSION['facultyID'])) {

	$sql = "SELECT * FROM Leave_Request WHERE Id IN (SELECT distinct(lr_id) FROM leave_approvals WHERE recipient="."".$_SESSION['facultyID'].");";

	$result = pg_query($manager, $sql);
	
	while( $row = pg_fetch_array($result) ){
		// here $row is each leave_Request for this faculty which will be listed out .. one of these will be the current leave request
		echo $row['leave_id'];
		echo '<br>';
		$sql = "SELECT * FROM Leave_Approvals WHERE LR_id = '".$row['id']."';";
		$result2 = pg_query( $manager,$sql );

		while( $row2 = pg_fetch_array($result2) ){
			echo $row2['lr_id'];
			echo '<br>';
			// this is each leave_approval row which needs to be printed on clicking view
		}
	}
}


// ******************************** 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Template for Use </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
    
    	ul li{
    	
    		display: inline;
    		text-decoration: none;
    	}
    	
    </style>
</head>
<body>
	<div class="container" style="margin-top: 100px;">
		<!-- Apply Button -->
		<div class="form-group">
			<form action="application.php" method="post">
				<input type="submit" class="btn btn-primary" value="Apply">
			</form>
		</div>
		<hr>
		<!-- Edit comment and status -->
		<form action="edit.php" method="post">
			<div class="form-group">
				<ul>
					<li style="margin-left: -40px;">
						<input type="submit" class="btn btn-primary" value="Edit">
					</li>
					<li style="float: right">
						<label>Status: </label>
						<input type="text" name="Status" class="form-control" value="Value to be placed in Status" readonly>
					</li>
				</ul>
			</div>
			<div class="form-group">
				
				<label> Comment </label>
				<input type="text" name="Status" class="form-control" value="Comment" readonly>
					
			</div>
		</form>
		<hr>
		<!-- Repeat This for trail -->
		<form action="#" method="post">
			<div class="form-group">
				<ul>				
					<li style="margin-left: -40px;">
					</li>
					<li style="float: right">
						<label>Status: </label>
						<input type="text" name="Status" class="form-control" value="Value to be placed in Status" readonly>
					</li>
				</ul>
			</div>
			<br>
			<div class="form-group">				
				<label> Comment </label>
				<input type="text" name="Status" class="form-control" value="Comment" readonly>					
			</div>
		</form>
		<hr>
		<!-- Repeat above -->
	</div>
</body>
</html>

