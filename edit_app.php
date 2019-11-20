<?php

require 'config.php';

session_start();

$error = "";
$to_check = false;

if (!isset($_SESSION['loggedin'])) {
	header('Location: hierarchy.php');
	exit();
}

if (isset($_SESSION['facultyID'])) {

	$fid = $_SESSION['facultyID'];
	$lid = $_POST['leave_id'];
	$sql = "SELECT start_date, end_date, comments, status FROM Leave_Request WHERE leave_id='$fid' and id='$lid' and status='RENEW';";


	$result = pg_query($pg, $sql);
	$row = pg_fetch_array($result);
	$start_date = $row['start_date'];
	$end_date = $row['end_date'];
	$comments = $row['comments'];
	$status = $row['status'];
	#print_r($row);
	if($status != 'RENEW'){
		$error = 'Application cannot be updated unless asked for.';
		$to_check = false;
	}
	else{
		if (isset($_POST['comment'] ) ) {

			$comment = $_POST['comment'];

			$sql = "UPDATE Leave_Request set comments = '$comment', status = 'MODIFIED' WHERE leave_id = '$fid' and id='$lid';";
			// echo $sql;
			$res2 = pg_query($pg , $sql);
			if($res2){
				header('Location: leave_application_portal.php');
			}else{
				$error = 'Could not edit leave application.';
			}
		}
	}
	
	#echo $end_date;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Apply for a Leave</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style type="text/css">
    
    	ul li{
    	
    		display: inline;
    		text-decoration: none;
    	}
    	
    	</style>
	</head>
	<body class="loggedin">
		<div class="container">
			<ul>
				<li> <h2 style="color: Tomato; margin-left: -40px;">Edit Application Portal</h2> </li>
				<li style="float: right;"> <a href="logout.php">Logout</a></li>
				<li style="float: right;padding-right: 20px"> <a href="template.php?q=<?php echo $_SESSION['username'];?>"><?php echo $_SESSION['name'];?></a></li>
			</ul>
			<!--
			<div>
				<h1>IIT Ropar - Leave Application Portal</h1>
				<a href="template.php?q=<?php echo $_SESSION['username'];?>"><i class="fas fa-home"></i>My Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
			-->
		</div>
		<div class="container">
			<div class="content">
				<hr>				
				    <div class="form-group">
				        Start Date for the Leaves : <input type="text" name="start" class="form-control" value="<?php echo $start_date; ?>" readonly>
				    </div>    
				    <div class="form-group">
				        End Date for the Leaves : <input type="text" name="end" class="form-control" value="<?php echo $end_date;?>" readonly>
				    </div>
				    <form action="" method="post">
				    	<input type="hidden" name="leave_id" value = "<?php echo $lid; ?>" >
						<div class="form-group">					
							<label> Comment </label>
							<input type="text" name="comment" class="form-control" value="<?php echo $comments; ?>" required>				
						</div>
						<span class="help-block" style="color: red"><?php echo $error; ?></span>
					
						<div class="form-group">
							<?php if($to_check == false){ ?>
						    	<input type="submit" class="btn btn-primary" value="Submit"/>
						    <?php }else{ ?>
						    	<input type="submit" class="btn btn-primary" value="Submit" disabled="disabled"/>
						    <?php } ?>
						</div>					    	        
		   			</form>
					<?php
						/*
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
					}*/
					?>
			</div>
		</div>
	</body>
</html>
