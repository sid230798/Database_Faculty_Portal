<?php 

	require_once 'config.php';
	session_start();
	
	if(isset($_SESSION['loggedin'])){
	
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			
			$leave_id = $_POST['Leave_id'];
			$status = $_POST['Status'];
			$comment = $_POST['Comment'];
			$fid = $_SESSION['facultyID'];
			
			$sql = "update leave_approvals set status='$status', comments='$comment' where lr_id='$leave_id' and recipient='$fid'";
			$result = pg_query($pg, $sql);
			
			if($result){
				header('Location: leave_application_portal.php');
			}else{
				echo "Something went Worng!!";
			}
			
		
		}else{
		
			header('Location: hierarchy.php');
		}
	
	
	}else{
		header('Location: hierarchy.php');
	}


?>
