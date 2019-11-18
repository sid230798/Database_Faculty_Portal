<?php

require 'config.php';

session_start();


#$_SESSION["loggedin"] = true;
#$_SESSION["username"] = 'A';
#$_SESSION["facultyID"] = 1;
$error = "";

if (!isset($_SESSION['loggedin'])) {
	header('Location: hierarchy.php');
	exit();
}

// ******************************** this is for my leave requests
if (isset($_SESSION['facultyID'])) {

	$fid = $_SESSION['facultyID'];
	#$sql = "SELECT * FROM Leave_Request WHERE leave_id='$fid' ORDER BY start_date DESC;";
	$pos_sql = "select name,position_id from faculty_position, positions where faculty_id='$fid' and positions.id = faculty_position.position_id";
	$pos_result = pg_query($pg, $pos_sql);
	$posArr = pg_fetch_all($pos_result);
	$posid = $posArr[0]['position_id'];
	$posName = $posArr[0]['name'];
	
	

	$sql = "SELECT * FROM Leave_Request WHERE Id IN (SELECT distinct(lr_id) FROM leave_approvals WHERE recipient_pos='$posid');";
	$result = pg_query($pg, $sql);
	$leave_applications = array();
	
	$resultArr = pg_fetch_all($result);
	#print_r($resultArr);
	foreach($resultArr as $row){
		
		// here $row is each leave_Request for this faculty which will be listed out .. one of these will be the current leave request
		$per_leave_application = array();
		/*Get the required fields for current faculty*/
		$tmp = array();
		$tmp['LeaveID'] = $row['id'];
		$tmp['FacultyID'] = $row['leave_id'];
		$tmp['Status'] = $row['status'];
		$tmp['Comment'] = $row['comments'];
		$tmp['Start'] = $row['start_date'];
		$tmp['End'] = $row['end_date'];
		$tmp['No_of_days'] = (strtotime( $row['start_date'] ) - strtotime( $row['end_date'] ) ) / 86400 ;
		$tmp['Note'] = $row['note'];
		$tmp['Signed_On'] = $row['signed_on'];
		$fid_tmp = $tmp['FacultyID'];
		$tmp_sql = "SELECT name from faculty where faculty.id = '$fid_tmp'";
		$desg_result = pg_query($pg, $tmp_sql);
		$desg_result = pg_fetch_all($desg_result);
		#$tmp['Designation'] = $desg_result[0]['pname'];
		$tmp['FacultyName'] = $desg_result[0]['name'];
		array_push($per_leave_application, $tmp);
		/*-------------------------------------------*/
		
		$sql = "SELECT * FROM Leave_Approvals WHERE LR_id = '".$row['id']."' and status != 'INITIATED';";
		$result2 = pg_query( $pg,$sql );
		#print_r( $tmp['Designation']);
		while( $row2 = pg_fetch_array($result2) ){
			$tmp = array();
			$tmp['FacultyID'] = $row2['recipient'];
			$fid_dash = $row2['recipient'];
			$tmp_sql = "SELECT faculty.name as fname from faculty where faculty.id = '$fid_dash'";
			$desg_result = pg_query($pg, $tmp_sql);
			$desg_result = pg_fetch_all($desg_result);
			$tmp['Status'] = $row2['status'];
			#$tmp['Designation'] = $desg_result[0]['pname'];
			#----------------------------------------------------
			$posid = $row2['recipient_pos'];
			$tmp_pos_dash = "SELECT name from positions where id = '$posid';";
			$result_pos_dash = pg_query($pg, $tmp_pos_dash);
			$result_pos_dash_arr = pg_fetch_all($result_pos_dash);
			$tmp['Designation'] = $result_pos_dash_arr[0]['name'];
			#-------------------------------------------------------
			$tmp['FacultyName'] = $desg_result[0]['fname'];
			$tmp['Date'] = $row2['signed_on'];
			$tmp['Comment'] = $row2['comments'];
			
			array_push($per_leave_application, $tmp);
			// this is each leave_approval row which needs to be printed on clicking view
		}
		
		array_push($leave_applications, $per_leave_application);
	}
	
	#print_r($leave_applications);
}

// ******************************** this is for request approved by me
/*
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
*/
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

	<div class="container">
		<ul>
			<li> <h2 style="color: Tomato; margin-left: -40px;">History Detail's for <?php  echo $posName; ?></h2> </li>
			<li style="float: right;"> <a href="logout.php">Logout</a></li>
			<li style="float: right;padding-right: 20px"> <a href="template.php?q=<?php echo $_SESSION['username'];?>"><?php echo $_SESSION['name'];?></a></li>
		</ul>
	</div>
	<div class="container">
		<!-- Apply Button
		<div class="form-group">
			<form action="application.php" method="post">
				<input type="submit" class="btn btn-primary" value="Apply">
			</form>
		</div>
		-->
		<hr>
		<?php for($idx=0; $idx < count($leave_applications); $idx++){?>
			<!-- Edit comment and status 
			<form action="<?php if($idx == 0){?>edit.php<?php }?>" method="post">-->
				<div class="form-group">
					<ul>
						<li style="margin-left: -40px;">
							<!--<?php if($is_checkbox[$idx] == true) {?> Please click Show button to add your comments and sign the Leave Request.<?php } ?>-->
							<!--<?php if(strcmp($leave_applications[$idx][0]['Status'], 'RENEW') == 0){ ?><input type="submit" class="btn btn-primary" value="Edit"><?php } ?>-->
						</li>
						<li style="float: right">
							<br><br><br><br><br><br><label>Overall-Status: </label>
							<input type="text" name="Status" class="form-control" value="<?php echo $leave_applications[$idx][0]['Status']; ?>" readonly>
						</li>
					</ul>
				</div>
			<!--</form>-->	
				<div class="form-group">				
					<label style="color: blue"> Leave Application Id : <?php echo $leave_applications[$idx][0]['LeaveID'];?> </label><br>
					<label style="color: blue"> Faculty : <?php echo $leave_applications[$idx][0]['FacultyName'];?> </label><br>
					<label style="color: blue"> Start Date : <?php echo $leave_applications[$idx][0]['Start'];?> </label><br>
					<label style="color: blue"> End Date : <?php echo $leave_applications[$idx][0]['End'];?> </label><br>
					<label style="color: blue"> Initiated On : <?php echo $leave_applications[$idx][0]['Signed_On'];?> </label><br>
					<!--<label style="color: blue"> Date :  </label>-->	
				</div>
				<div class="form-group">
					<?php if(strcmp($leave_applications[$idx][0]['Note'], "") != 0){?>
						<label> Notes </label>
						<input type="text" name="note" class="form-control" value="<?php echo $leave_applications[$idx][0]['Note'];?>" readonly><br>
					
					<?php } ?>
					<label> Comment </label>
					<input type="text" name="Comment" class="form-control" value="<?php echo $leave_applications[$idx][0]['Comment'];?>" readonly><br>
					
				</div>
				<!-- Repeat this for complete trail -->
				<div class="Trail<?php echo $leave_applications[$idx][0]['LeaveID'];?>" style="display: none">
					<?php for($cnt = 1; $cnt < count($leave_applications[$idx]); $cnt++){?>						
						<div class="form-group">
						<ul>
							<li style="float: right">
								<label>Status: </label>
															
								<input type="text" name="Status" class="form-control" value="<?php echo $leave_applications[$idx][$cnt]['Status']; ?>" readonly>
								
							</li>
							<li style="margin-left: -40px;">
								<label style="color: blue"> <?php echo $leave_applications[$idx][$cnt]['Designation'];?> : <?php echo $leave_applications[$idx][$cnt]['FacultyName'];?> </label><br>
								<label style="color: blue; margin-left: -40px;"> <?php if(strcmp($leave_applications[$idx][$cnt]['Status'], 'PENDING') != 0){?>Signed_ON : <?php echo $leave_applications[$idx][$cnt]['Date'];?> <?php }?></label><br>	
							</li>
							
						</ul>				
						<label> Comment </label>
						<input type="text" name="Comment" class="form-control" value="<?php echo $leave_applications[$idx][$cnt]['Comment'];?>" readonly><br>
						<!--<label style="color: blue"> Date :  </label>-->	
						</div>		
					<?php }?>
				</div>
				<button id="Trail<?php echo $leave_applications[$idx][0]['LeaveID'];?>" class="btn btn-primary" style="float: right" onclick="toggleDisplay(this.id)">Show</button>
			
			<hr><br>
		<?php }?>
	</div>
	<script>
	
		function toggleDisplay(id){
		
			var x = document.getElementsByClassName(id);
			for(var i = 0;i<x.length;i++){
				if(x[i].style.display == "none"){
					x[i].style.display = "block";
					document.getElementById(id).innerHTML = "Hide";
				}
				else{
					x[i].style.display = "none";
					document.getElementById(id).innerHTML = "Show";
				}
			}	
				
		}
	</script>
</body>
</html>

