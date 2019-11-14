<?php
	
	session_start();
	require_once("config.php");
	
	
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
    	
    	.department-column {
		  float: left;
		  width: 33.33%;
		  padding: 5px;
		}
		
		.department-row::after {
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
				<a href="#">
					<img src="Images/IITLogo.jpg" alt="Indian Institute of Ropar" class="Logo">
				</a>
				
			</div>
		</div>
		<div class="sub-menu">
			<div class="Secondary">
					
						<ul class="has-navigation">
						
							<div class="containerdash">
							
							<li class style="float:right; margin-right: 30px">
								<?php if(!isset($_SESSION['loggedin'])) {?>
									<button class="trigger" onclick="openForm()">Login</button>
								<?php }else{?>
									<a href="template.php?q=<?php echo $_SESSION['username']; ?>""> <?php echo $_SESSION['username']; ?></a>
								<?php }?>
							</li>
							<?php if(isset($_SESSION['loggedin'])) {?>
							
							<li class style="float:right; margin-right: 30px">
								<button class="Logout">Logout</button>
							</li>
							
							<?php } ?>
							</div>
						</ul>
			</div>
		</div>
	</header>
	
	<div class="container">
	
		<div class="Director">
		
			<h2 style="color:#595959;"> Director </h2>
			<hr>
			<!-- Insert link for Director's Page here-->
			<a href="#">
				<div class="card">
				  <img src="Images/Person.png" alt="John" style="width:100%">
				  <h3>Director's Name</h3>
				</div>
			</a>
		</div>
		
		<!-- Insert links for sites here as well -->
		<div class="Departments">
			<h2 style="color:#595959;"> Departments </h2>
			<hr>
			
			<div class="department-row">
				<div class="department-column">
					<a href="department.php?q=CS">
						<div class="card">
						  <img src="Images/Person.png" alt="John" style="width:100%">
						  <h3>CS Dept.</h3>
						</div>
					</a>
				</div>
				<div class="department-column">
					<a href="department.php?q=EE">
						<div class="card">
						  <img src="Images/Person.png" alt="John" style="width:100%">
						  <h3>EE Dept.</h3>
						</div>
					</a>
				</div>
				<div class="department-column">
					<a href="department.php?q=ME">
						<div class="card">
						  <img src="Images/Person.png" alt="John" style="width:100%">
						  <h3>ME Dept.</h3>
						</div>
					</a>
				</div>
			</div>
		</div>
		<!-- Insert links accurately-->
		<div class="Cross-Cutting Faculty">
			<h2 style="color:#595959;"> Cross-Cutting Faculty </h2>
			<hr>
			<div class="department-row">
				<div class="department-column">
					<a href="#">
						<div class="card">
						  <img src="Images/Person.png" alt="John" style="width:100%">
						  <h3>Dean</h3>
						</div>
					</a>
				</div>
				<div class="department-column">
					<a href="#">
						<div class="card">
						  <img src="Images/Person.png" alt="John" style="width:100%">
						  <h3>Associate dean</h3>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Login Page For Faculty -->
<!-- Login Pop Up Implemented -->
	<div class="modal" id="myForm">
		<div class="modal-content">
		    <h2>Login</h2>
		    <p>Please fill in your credentials to login.</p>
		    <!--
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
		    -->
		    <form>
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
	
	 <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script>
	
		
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
