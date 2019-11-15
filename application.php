<?php

require 'config.php';

session_start();

$error = "";

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit();
}

if (isset($_SESSION['facultyID'])) {

	$sql = "SELECT leaves_left, cur_leave_app_id FROM Leaves WHERE id="."'".$_SESSION['facultyID']."'";

	$result = pg_query($manager, $sql);
	$row = pg_fetch_array($result);
	$cur_leave_app = $row['cur_leave_app_id'];
	$rem_leaves = $row['leaves_left'];
	if( $cur_leave_app != 0 ){
		// notify that leave application cannot be granted
		$error = "Error: New application cannot be started because of a previous pending leave application. Only one leave application is allowed at a time.";
	}else{
		if (isset($_POST['start']) && isset($_POST['comment']) && isset($_POST['end'])) {

			$start = $_POST['start'];
			$end = $_POST['end'];
			$comment = $_POST['comment'];

			$sql = "INSERT INTO Leave_Request(leave_id, status, start_date, end_date, comments) VALUES ('".$_SESSION['facultyID']."', 'PENDING' , '".$start."' , '".$end."' , '".$comment."');";
			// echo $sql;
			$res2 = pg_query($manager , $sql);
			if($res2){
				header('Location: profile.php');
			}else{
				$error = 'Could not submit leave application.';
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
				<form action=\"application.php\" method=\"POST\" id=\"usrform\">
					Start Date for the leave: <br><input type=\"date\" name=\"start\" placeholder=\"Start Date(YYYY-MM-DD)\" id=\"start\" required><br><br>
					End Date for the leave: <br><input type=\"date\" name=\"end\" placeholder=\"End Date(YYYY-MM-DD)\" id=\"end\" required><br><br>
					Comments for leave application: <br>
					<textarea rows=\"6\" cols=\"80\" name=\"comment\" form=\"usrform\"></textarea><br><br>
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