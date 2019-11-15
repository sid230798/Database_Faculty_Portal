<?php

require 'config.php';

session_start();

$error = "";

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit();
}

if (isset($_SESSION['facultyID'])) {

	$sql = "SELECT start_date, end_date, comments, status FROM Leave_Request WHERE leave_id="."'".$_SESSION['facultyID']."';";

	$result = pg_query($manager, $sql);
	$row = pg_fetch_array($result);
	$start_date = $row['start_date'];
	$end_date = $row['end_date'];
	$comments = $row['comments'];
	$status = $row['status'];
	if($status != 'RENEW'){
		$error = 'Application cannot be updated unless asked for.';
	}
	else{
		if (isset($_POST['comment'] ) ) {

			$comment = $_POST['comment'];

			$sql = "UPDATE Leave_Request set comments = '".$comment."', status = "MODIFIED" WHERE leave_id = "."'".$_SESSION['facultyID']."';";
			// echo $sql;
			$res2 = pg_query($manager , $sql);
			if($res2){
				header('Location: profile.php');
			}else{
				$error = 'Could not edit leave application.';
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Apply for a Leave</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>IIT Ropar - Leave Application Portal</h1>
				<a href="profile.php"><i class="fas fa-home"></i>My Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Leave Application</h2>
				<?php
				
					echo "<div>
					Start Date for the leave: <br>".$start_date."<br><br>
					End Date for the leave: <br>".$end_date."<br><br>
				</div><br>";

					echo "<div>
				<form action=\"edit_app.php\" method=\"POST\" id=\"usrform\">
					Comments for leave application: <br>
					<textarea rows=\"6\" cols=\"80\" name=\"comment\" form=\"usrform\">".$comments."</textarea><br><br>
					<input type=\"submit\" value=\"Submit application\">
				</form>
				</div><br>";

				if($error){
					echo $error;
				}
				?>
		</div>
	</body>
</html>