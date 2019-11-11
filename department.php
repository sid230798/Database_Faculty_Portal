<?php

	## Include connection.php file and extract list of faculty_names
	 session_start();
     $_SESSION['url'] = $_SERVER['REQUEST_URI'];
     
     if(isset($_GET['q'])){
     
     	$dept_name = $_GET['q'];
     	
     	if(strcmp($dept_name, "CS") == 0)
     		$dept_to_write = "Computer Science Department";
     	else if(strcmp($dept_name, "EE") == 0)
     		$dept_to_write = "Electrical Department";
     	else if(strcmp($dept_name, "ME") == 0)
     		$dept_to_write = "Mechanical Department";
     	else
     		$dept_to_write = Null;	
     
     }

?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
    <title> Faculty Hierarchy of College(Static for now) </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style type="text/css">
    
    	.primary{
    	
    		background-color:  #4da6ff;
    		height: 400px;
    		text-align: center;
    	
    	}
    	
    	.Logo{
    	
    		width : 350px;
    		height:350px;
    		margin-top:25px;
    	
    	}
    	
    	hr{
    	
    		border: 2px solid black;
    	
    	}
    	
    	.card {
		  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		  max-width: 200px;
		  /*margin: auto;*/
		  text-align: center;
		  font-family: arial;
		}
		
		.faculty-column {
		  float: left;
		  width: 33.33%;
		  padding: 5px;
		}
		
		.faculty-row::after {
		  content: "";
		  clear: both;
		  display: table;
		}
		
		.containerdash{
		
			margin-left : 175px;
		}
		
		
		li {
		  float: left;
		}

		li a {
		  display: block;
		  color: #666;
		  text-align: center;
		  padding: 14px 16px;
		  text-decoration: none;
		}

		li a:hover:not(.active) {
		  background-color: #ddd;
		}

		li a.active {
		  color: white;
		  background-color: #4da6ff;
		}
		
		.has-navigation {
		  list-style-type: none;
		  width: 100%;
		  margin: 0;
		  padding: 0;
		  overflow: hidden;
		  border: 1px solid #e7e7e7;
		  font-size: 18px;
		}
		
		.modal-content{
		
			font: 14px sans-serif;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 800px;
			padding: 20px;
		
		}
    	
    </style>
</head>

<body>
<div id="Fun">
	<header id="page-header">
	
		<div class="primary" >
		
			<div class="container">
				<a href="hierarchy.html">
					<img src="Images/IITLogo.jpg" alt="Indian Institute of Ropar" class="Logo">
				</a>
				
			</div>
		</div>
		
		<div class="sub-menu">
			<div class="Secondary">
					
						<ul class="has-navigation">
						
							<div class="containerdash">
							
							<li class style="float:right; margin-right: 30px">
								<button class="trigger" onclick="openForm()">Login</button>
							</li>
							</div>
						</ul>
			</div>
		</div>
	</header>
	
	<div class="container">
	
		<div class="Department-Name">
		
			<h1 style="color:#595959;"><?php  echo $dept_to_write ?></h1>
			<hr>
			
		</div>
		
		<?php if($dept_to_write){?>
			<div class="HOD">
			
				<h2 style="color:#595959;"> Head Of Department </h2>
				<hr>
				<!-- Insert link for HOD's Page here-->
				<a href="#">
					<div class="card">
					  <img src="Images/Person.png" alt="John" style="width:100%">
					  <h3>Head of Department's Name</h3>
					</div>
				</a>
			</div>
			
			<div class="Faculty">
				<h2 style="color:#595959;"> Faculty </h2>
				<hr>
				<div class="faculty-row">
				
					<!-- Repeat this for number of faculties -->
					<div class="faculty-column">
						<a href="#">
							<div class="card">
							  <img src="Images/Person.png" alt="John" style="width:100%">
							  <h3>Faculty_Name</h3>
							</div>
						</a>
					</div>
					
					<!-- Images can change w.r.t to faculty images and name -->
					
				</div>
			</div>
		<?php }?>
	</div>
</div>
<!-- Login Pop Up Implemented -->
	<div class="modal" id="myForm">
		<div class="modal-content">
		    <h2>Login</h2>
		    <p>Please fill in your credentials to login.</p>
		    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
		            <label>Username</label>
		            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
		            <span class="help-block"><?php echo $username_err; ?></span>
		        </div>    
		        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
		            <label>Password</label>
		            <input type="password" name="password" class="form-control">
		            <span class="help-block"><?php echo $password_err; ?></span>
		        </div>
		        <div class="form-group">
		            <input type="submit" class="btn btn-primary" value="Login">
		        </div>
		        
		        <div class="form-group">
		            <button type="button" class="btn cancel" onclick="closeForm()" style="background-color:red;">Close</button>
		        </div>
		        
		        <p>Don't have an account? <a href="phpinfo.php">Sign up now</a>.</p>
		    </form>
		</div>
    </div>
	
	<script>
	
		
		function openForm() {
		
		  document.getElementById("myForm").style.display = "block";
		  document.getElementById("Fun").style.opacity = 0.3;
		  
		}

		function closeForm() {
		  document.getElementById("myForm").style.display = "none";
		  document.getElementById("Fun").style.opacity = 1;
		}
		/*
		var modal = document.querySelector(".modal");
		var trigger = document.querySelector(".trigger");
		var closeButton = document.querySelector(".close-button");

		function toggleModal() {
		    modal.classList.toggle("show-modal");
		}

		function windowOnClick(event) {
		    if (event.target === modal) {
		        toggleModal();
		    }
		}

		trigger.addEventListener("click", toggleModal);
		closeButton.addEventListener("click", toggleModal);
		window.addEventListener("click", windowOnClick);
		*/
	</script>
	<!-- ##################################3-->
</body>
</html>
