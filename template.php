<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Template for Use </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css"">
    
    	
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
								<li class>
									<a href="#">Home</a>
								</li>
								
								<li class>
									<a href="#">Overview</a>
								</li>
								
								<li class>
									<a href="#"> Publications </a>
								</li>
								
								<li class>
									<a href="#"> Awards </a>
								</li>
								
								<li class>
									<a href="#" class="active"> Teaching </a>
								</li>
								
								<li class style="float:right; margin-right: 30px">
									<button class="trigger" onclick="openForm()">Login</button>
									<!--<a href="#">Login</a>-->
								</li>
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
				  <h1>John Doe</h1>
				  <p class="title">CEO & Founder, Example</p>
				  <p>Harvard University</p>
				  <div style="margin: 24px 0;">
					<a href="#"><i class="fa fa-dribbble"></i></a> 
					<a href="#"><i class="fa fa-twitter"></i></a>  
					<a href="#"><i class="fa fa-linkedin"></i></a>  
					<a href="#"><i class="fa fa-facebook"></i></a> 
				  </div>
				</div>
			</div>
			<div class="column2">
				<h2>Column 2</h2>
				<p>This column will contain the content which is clicked like research, Grants, Publications etc.</p>
	  		</div>
		
		</div>
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
