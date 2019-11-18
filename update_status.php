<?php 

	require_once 'config.php';
	session_start();
	
	if(isset($_SESSION['loggedin'])){
	
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			
			$leave_id = $_POST['Leave_id'];
			$status = $_POST['Status'];
			$comment = $_POST['Comment'];
			$fid = $_SESSION['facultyID'];
			$getPosSql = "select Position_Id from faculty_position where faculty_id='$fid'";
			$posResult = pg_query($pg, $getPosSql);
			$posResultArr = pg_fetch_all($posResult);
			$posid = $posResultArr[0]['position_id'];
			
			$sql = "update leave_approvals set status='$status', comments='$comment', recipient_pos='$posid' where lr_id='$leave_id' and recipient='$fid'";
			$result = pg_query($pg, $sql);
			
			if($result){
				header('Location: leave_approval_portal.php');
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
