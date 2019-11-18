<?php

	session_start();
	require_once('config.php');
	
	if(isset($_GET['q'])){
    
    	$username = $_GET['q'];
    	#$username= 'A';
    	$filter = ['username' => $username];
		$options = [];
		$query = new MongoDB\Driver\Query($filter, $options);
		$cursor = $manager->executeQuery('faculty_portal.users', $query);
		
		$name = "";
		$email = "";
		$overview = "";
		$publications = array();
		$awards = array();
		$teaching = array();
		$education = array();
		
		foreach($cursor as $entry){
			 $c = get_object_vars($entry);
			 $name = $c['name'];
			 $email = $c['email'];
			 $overview = $c['Overview'];
		 
			 foreach($c['Publication'] as $pub){
			 	$tmp = get_object_vars($pub);
			 	array_push($publications, $tmp);
			 }
			 
			 foreach($c['Education'] as $edu){
			
				$tmp = get_object_vars($edu);
			 	array_push($education, $tmp);
			
			 }
			 
			 foreach($c['Award'] as $aw){
			 
			 	$tmp = get_object_vars($aw);
			 	array_push($awards, $tmp);
			 
			 }
			 
			 foreach($c['Teaching'] as $te){
			 
			 	$tmp = get_object_vars($te);
			 	array_push($teaching, $tmp);
			 
			 }
		 
		}
    
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Template for Use </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
    
    	
    	.has-navigation {
		  list-style-type: none;
		  width: 100%;
		  margin: 0;
		  padding: 0;
		  overflow: hidden;
		  border: 1px solid #e7e7e7;
		  font-size: 18px;
		}

		.containerdash{
		
			margin-left : 175px;
		}
		
		.containerdash2{
		
			margin-left : 10px;
		}
		
		.menu-list {
		  float: left;
		}

		.menu-list a {
		  display: block;
		  color: #666;
		  text-align: center;
		  padding: 14px 16px;
		  text-decoration: none;
		}

		.menu-list a:hover:not(.active) {
		  background-color: #ddd;
		}

		.menu-list a.active {
		  color: white;
		  background-color: #4da6ff;
		}
		
		/* Create two equal columns that floats next to each other */
		.column1 {
		  float: left;
		  width: 40%;
		  padding: 10px;
		  height: 300px; /* Should be removed. Only for demonstration */
		}
		
		.column2 {
		  float: left;
		  width: 60%;
		  padding: 10px;
		  height: 300px; /* Should be removed. Only for demonstration */
		}

		/* Clear floats after the columns */
		.row:after {
		  content: "";
		  display: table;
		  clear: both;
		  width: 100%;
		  
		}
		
		.row{
		
			height: 600px;
			background-color: #f3f3f3;
		}
		
		.card {
		  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		  max-width: 300px;
		  margin: auto;
		  text-align: center;
		  font-family: arial;
		}

		.title {
		  color: grey;
		  font-size: 18px;
		}
		
		.Logo{
    	
    		width : 350px;
    		height:350px;
    		margin-top:25px;
    	
    	}
    	.primary{
    	
    		background-color:  #4da6ff;
    		height: 400px;
    		text-align: center;
    	
    	}
    	
    	/*This CSS is for Login pop up
    	.modal {
		    position: fixed;
		    left: 0;
		    top: 0;
		    width: 100%;
		    height: 100%;
		    background-color: rgba(0, 0, 0, 0.5);
		    opacity: 0;
		    visibility: hidden;
		    transform: scale(1.1);
		    transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
		}
		.modal-content {
		    position: absolute;
		    top: 50%;
		    left: 50%;
		    transform: translate(-50%, -50%);
		    background-color: white;
		    padding: 1rem 1.5rem;
		    width: 24rem;
		    border-radius: 0.5rem;
		}
		.close-button {
		    float: right;
		    width: 1.5rem;
		    line-height: 1.5rem;
		    text-align: center;
		    cursor: pointer;
		    border-radius: 0.25rem;
		    background-color: lightgray;
		}
		.close-button:hover {
		    background-color: darkgray;
		}
		.show-modal {
		    opacity: 1;
		    visibility: visible;
		    transform: scale(1.0);
		    transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
		}
		*/
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
		
			<div class="primary">
			
				<div class="container">
					<a href="#">
						<img src="Images/IITLogo.jpg" alt="Indian Institute of Ropar" class="Logo" >
					</a>
					
				</div>
			</div>

			<div class="sub-menu">
				<div class="Secondary">
						
							<ul class="has-navigation">
							
								<div class="containerdash">
								<li class="menu-list">
									<a href="#" class="active" id="Overview">Overview</a>
								</li>
								
								<li class="menu-list">
									<a href="#" id="Publication">Publication</a>
								</li>
								<li class="menu-list">
									<a href="#" id="Education">Education</a>
								</li>
								
								<li class="menu-list">
									<a href="#" id="Awards">Awards</a>
								</li>
																
								<li class="menu-list">
									<a href="#" id="Teaching"> Teaching </a>
								</li>
								
								<?php if(isset($_SESSION['loggedin'])){?>
								
									<?php if(strcmp($_SESSION['username'], $username) == 0) {?>
										<li class="menu-list">
										<a href="edit_profile.php" id="Edit-Profile"> Edit-Profile </a>
										</li>
										
										<li class="menu-list">
										<a href="leave_application_portal.php" id="Leave-Status"> My-Leave-Portal </a>
										</li>
										
										<?php if($_SESSION['HOD'] == 1 || $_SESSION['CCF'] == 1) {?>
											<li class="menu-list">
											<a href="leave_approval_portal.php" id="Leave-Status"> Leave-Approval-Portal </a>
											</li>
											<li class="menu-list">
											<a href="history_details.php" id="Leave-History"> History-Portal </a>
											</li>
										<?php } ?> 
									<?php }?>
								
								<?php } ?>
								
								<li class style="float:right; margin-right: 30px">
								<?php if(!isset($_SESSION['loggedin'])) {?>
									<a class="trigger" onclick="openForm()" style="color: blue;">Login</a>
								<?php }else{?>
									<a href="logout.php" class="Logout" style="color: blue">Logout</a>
								<?php }?>
								</li>
								<?php if(isset($_SESSION['loggedin'])) {?>
								
								<li class style="float:right; margin-right: 30px">
									<a href="template.php?q=<?php echo $_SESSION['username']; ?>"" style="color: blue"> <?php echo $_SESSION['name']; ?></a>
								</li>
								
								<?php } ?>
								</div>
							</ul>
				</div>
			</div>
		</header>
		
		<div class="containerdash2">
		<div class="row">
			<div class="column1" style="margin-left : -120px">
				<div class="card">
				  <img src="Images/Person.png" alt="John" style="width:100%">
				  <h1><?php echo $name; ?></h1>
				  <p class="title"><?php echo $email; ?></p>
				  <p>IIT Ropar</p>
				  <div style="margin: 24px 0;">
					<a href="#"><i class="fa fa-dribbble"></i></a> 
					<a href="#"><i class="fa fa-twitter"></i></a>  
					<a href="#"><i class="fa fa-linkedin"></i></a>  
					<a href="#"><i class="fa fa-facebook"></i></a> 
				  </div>
				</div>
			</div>
			<div class="column2">
				<div class="Overview" style="display: block;">
					<p><?php echo $overview; ?></p>
				</div>
				
				<div class="Publication" style="display: none;">
					<ul>
					<?php foreach($publications as $pub){?>
					<li>
					<h2 style="color: blue"><?php echo $pub['Paper']; ?> </h2>
					<p><?php echo $pub['Conf'];?></p>
					</li>
					<?php }?>
					</ul>
				</div>
				<div class="Education" style="display: none">
					<ul>
					<?php foreach($education as $edu){?>
					<li>
					<h2 style="color: blue"><?php echo $edu['Study']; ?> </h2>
					<p><?php echo $edu['Year'];?></p>
					</li>
					<?php }?>
					</ul>
				</div>
				<div class="Awards" style="display: none">
					<ul>
					<?php foreach($awards as $aw){?>
					<li>
					<h2 style="color: blue"><?php echo $aw['Title']; ?> </h2>
					<p><?php echo $aw['Date'];?></p>
					</li>
					<?php }?>
					</ul>
				</div>
				<div class="Teaching" style="display: none">
					<ul>
					<?php foreach($teaching as $te){?>
					<li>
					<h2 style="color: blue"><?php echo $te['Course']; ?> </h2>
					<p><?php echo $te['Date'];?></p>
					</li>
					<?php }?>
					</ul>
				</div>				
				
	  		</div>
		
		</div>
		</div>
	</div>
	
	<!-- Login Pop Up Implemented -->
	<div class="modal" id="myForm">
		<div class="modal-content">
		    <h2>Login</h2>
		    <p>Please fill in your credentials to login.</p>
		    <form>
		        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
		            <label>Username</label>
		            <input type="text" name="username" class="form-control">
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
	
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script>

		
		var div = document.getElementsByClassName("containerdash");

		var btns = div[0].getElementsByTagName("a");
		for (var i = 0; i < btns.length; i++) {
			  btns[i].addEventListener("click", function() {
				var current = document.getElementsByClassName("active");

				var currentDisp = current[0].id
				// If there's no active class
				if (current.length > 0) {
				  current[0].className = current[0].className.replace("active", "");
				}

				// Add the active class to the current/clicked button
				this.className += " active";
				document.getElementsByClassName(currentDisp)[0].style.display= "none";
				document.getElementsByClassName(this.id)[0].style.display= "block";
				
				
		  });
		}

		
		
		
		function openForm() {
		
		  document.getElementById("myForm").style.display = "block";
		  document.getElementById("Fun").style.opacity = 0.3;
		  
		}

		function closeForm() {
		  document.getElementById("myForm").style.display = "none";
		  document.getElementById("Fun").style.opacity = 1;
		}
		
		$(function () {
			$(".Logout").click(function(){
			  $.ajax({
				  	url: "logout.php", 
				  	success: function(){
						location.reload();
				  	}
			  });
			});
		});
		
		$(function () {

		    $('form').on('submit', function (e) {

		      e.preventDefault();

		      $.ajax({
		        type: 'post',
		        url: 'login.php',
		        data: $('form').serialize(),
		        success: function (result) {
		        	
		          if(result == 1)
		          	location.reload();
		          	//alert(result);
		          else
		          	$(".help-block").text("Incorrect Username/Passoword");
		        }
		      });

		    });

      	});
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
