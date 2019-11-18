<?php
require 'config.php';
session_start();
$error = "";
if (!isset($_SESSION['loggedin'])) {
	header('Location: hierarchy.php');
	exit();
}
if (isset($_SESSION['facultyID'])) {
	$sql = "SELECT total_leaves, next_year_leaves_left, leaves_left, cur_leave_app_id FROM Leaves WHERE id="."'".$_SESSION['facultyID']."'";
	//echo $sql;
	$to_check = false;
	$result = pg_query($pg, $sql);
	$row = pg_fetch_array($result);
	$total_leaves = $row['total_leaves'];
	$cur_leave_app = $row['cur_leave_app_id'];
	$rem_leaves = $row['leaves_left'];
	$rem_next_leaves = $row['next_year_leaves_left'];
	if( $cur_leave_app != 0 ){
		// notify that leave application cannot be granted
		$to_check = true;
		$error = "Error: New application cannot be started because of a previous pending leave application. Only one leave application is allowed at a time.";
	}
	else if( $rem_leaves == 0 and $rem_next_leaves == 0 ){
		$error = "Error: Leaves Exhausted. No leaves to left to borrow from next year either.";
	}
	else{
		if (isset($_POST['start']) && isset($_POST['comment']) && isset($_POST['end'])) {
			$start = strtotime($_POST['start']);
			$end = strtotime($_POST['end']);
			$comment = $_POST['comment'];
			$no_of_days = ($end-$start)/86400;
			//echo $no_of_days;
			if( $no_of_days < 0 ){
				$error = "Error: Invalid Request. Start date of the leave is after the end date.";
			}
			else if( $no_of_days == 0 ){
				$error = "Error: Invalid Request. Start date of the leave is same as the end date.";
			}
			else if( $no_of_days > $rem_leaves + $rem_next_leaves ){
				$error = "Error: Requested number of days for the leave is more than available number of days.";
			}else{
				$note = "";
				$now = date("Y-m-d H:i:s",time()) ;
				$start = date("Y-m-d H:i:s" , $start);
				$end = date("Y-m-d H:i:s" , $end);
				if($no_of_days > $rem_leaves){
					$note = "The applicant has borrowed " . ((string)($no_of_days - $rem_leaves)) . " leaves from next year.";
				}
				$sql = "INSERT INTO Leave_Request(leave_id, status, start_date, end_date, note, signed_on, comments) VALUES ('".$_SESSION['facultyID']."', 'PENDING' , '".$start."' , '".$end."' , '".$note."' , '".$now."' , '".$comment."');";
				#echo $sql;
				#echo '<br>';
				$res2 = pg_query($pg , $sql);
				if($res2){
					header('Location: leave_application_portal.php');
				}else{
					$error = 'Could not submit leave application.';
				}
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
				<li> <h2 style="color: Tomato; margin-left: -40px;">Leave Application Portal</h2> </li>
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
					<label style="color: blue"> Current Years Leaves Left : <?php echo $rem_leaves."/".$total_leaves;?> </label><br>
					<label style="color: blue"> Next Year Leaves Left : <?php echo $rem_next_leaves."/".$total_leaves;?> </label><br>
					<!--<label style="color: blue"> Date :  </label>-->	
				</div>
				<!--
				<hr><label> Current Year Leaves Left : <?php echo $rem_leaves;?> </label><br>
				<label> Next Year Leaves Left : <?php echo $rem_next_leaves;?> </label><br>
				-->
				<form action="" method="post">
				    <div class="form-group">
				        Start Date for the Leaves : <input type="date" name="start" class="form-control" placeholder="Start Date(YYYY-MM-DD)" required>
				    </div>    
				    <div class="form-group">
				        End Date for the Leaves : <input type="date" name="end" class="form-control" placeholder="End Date(YYYY-MM-DD)" required>
				    </div>
				    <div class="form-group">					
						<label> Comment </label>
						<input type="text" name="comment" class="form-control" placeholde="Comments" required>				
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
					}*/
					?>
			</div>
		</div>
	</body>
</html>
