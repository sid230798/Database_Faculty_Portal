<?php

	require_once('config.php');
	session_start();
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
	 /*Just for Verification purposes*/
	$username = 'a';
	$pass = '12qwaszx';
	
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
		 $id = $c['_id']->__toString();
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Template for Use </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css"">
    
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
    
    	.modal-content{
		
			font: 14px sans-serif;
			/*top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);*/
			width: 100%;
			padding: 20px;
		
		}
    </style>
</head>
<body>

	<?php if(isset($_SESSION['loggedin'])) {?>
	<div id="Fun">
		<header id="page-header">
		
			<div class="primary">
			
				<div class="container">
					<a href="#">
						<img src="Images/IITLogo.jpg" alt="Indian Institute of Ropar" class="Logo" >
					</a>
					
				</div>
			</div>
			<div class="container">
				<h2> Edit Profile </h2>
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
								
								<li class="menu-list" style="float:right; margin-right: 30px">	
									<a href="template.php?q=<?php echo $_SESSION['username']; ?>""> <?php echo $_SESSION['username']; ?></a>
								</li>
								<?php if(isset($_SESSION['loggedin'])) {?>
							
								<li class style="float:right; margin-right: 30px">
									<a href="logout.php" class="Logout">Logout</a>
								</li>
								
								<?php } ?>
								</div>
							</ul>
				</div>
			</div>
		</header>
	</div>
	<!-- OVERVIEW FORM-------------------------------------------->
	<div class="Overview">
		<div class="modal-content">
		    <h2>Personal Profile</h2>
		    <p>Please Edit the required Information.</p>
		    <form id="Form1">
		    	<input type="hidden" name="OverviewForm" value="1"/>
		    	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		        <div class="form-group">
		            <label>Username</label>
		            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
		            <span class="help-block"></span>
		        </div>    
		        <div class="form-group">
		            <label>Password</label>
		            <input type="password" name="password" class="form-control" value="<?php echo $pass; ?>">
		            <span class="help-block"></span>
		        </div>
		        <div class="form-group">
		            <label>Name</label>
		            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
		            <span class="help-block"></span>
		        </div>
		        <div class="form-group">
		            <label>Email</label>
		            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
		            <span class="help-block"></span>
		        </div>
		        <div class="form-group">
		            <label>Overview</label>
		            <input type="text" name="overview" class="form-control" value="<?php echo $overview; ?>">
		            <span class="help-block"></span>
		        </div>
		        <div class="form-group">
		            <input type="submit" class="btn btn-primary" value="Submit">
		        </div>
		    </form>
		</div>
    </div>
    
	<!-- ---------------------------------------------------------->
	<!-- Publication Form ----------------------------------------->
	
	<div class="Publication" style="display: none">
		<div class="modal-content">
		    <h2>Publications Profile</h2>
		    <p>Please Edit the required Information.</p>
		    <form id="Form2">
		    	<input type="hidden" name="PublicationForm" value="1"/>
		    	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		    	<div id="Publication-Content">
		    	<?php $cnt = 1; foreach($publications as $pub){?>
		    	
		    		<div class="container">
		    			<h3> Publication <?php echo $cnt; ?></h3>
		    			<div class="form-group">
				        	<label>Paper</label>
				        	<input type="text" name="paper[]" class="form-control" value="<?php echo $pub['Paper']; ?>" required>
				        </div>
				        <div class="form-group">
						    <label>Conference</label>
						    <input type="text" name="conf[]" class="form-control" value="<?php echo $pub['Conf']; ?>" required>
				        </div> 
		    		</div>
		   			<hr>
		    	<?php $cnt += 1;}?>
		    	</div>
		    	<div class="form-group">
		            <button class="btn btn-primary" onclick="addPublication()">Add</button>
		        </div>
		        <div class="form-group">
		            <input type="submit" class="btn btn-primary" value="Submit">
		        </div>
		    </form>
		</div>
    </div>
	
	<!-------------------------------------------------------------->
	<!-- Education FORM -------------------------------------------->
	<div class="Education" style="display: none">
		<div class="modal-content">
		    <h2>Educations Profile</h2>
		    <p>Please Edit the required Information.</p>
		    <form id="Form3">
		    	<input type="hidden" name="EducationForm" value="1"/>
		    	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		    	<div id="Education-Content">
		    	<?php $cnt = 1; foreach($education as $edu){?>
		    	
		    		<div class="container">
		    			<h3> Education <?php echo $cnt; ?></h3>
		    			<div class="form-group">
				        	<label>Study</label>
				        	<input type="text" name="study[]" class="form-control" value="<?php echo $edu['Study']; ?>" required>
				        </div>
				        <div class="form-group">
						    <label>Year</label>
						    <input type="text" name="year[]" class="form-control" value="<?php echo $edu['Year']; ?>" required>
				        </div> 
		    		</div>
		   			<hr>
		    	<?php $cnt += 1;}?>
		    	</div>
		    	<div class="form-group">
		            <button class="btn btn-primary" onclick="addEducation()">Add</button>
		        </div>
		        <div class="form-group">
		            <input type="submit" class="btn btn-primary" value="Submit">
		        </div>
		    </form>
		</div>
    </div>
	
	<!--------------------------------------------------------------->
	<!--  Awards FORM ----------------------------------------------->
	<div class="Awards" style="display: none">
		<div class="modal-content">
		    <h2>Awards Profile</h2>
		    <p>Please Edit the required Information.</p>
		    <form id="Form4">
		    	<input type="hidden" name="AwardsForm" value="1"/>
		    	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		    	<div id="Awards-Content">
		    	<?php $cnt = 1; foreach($awards as $aw){?>
		    	
		    		<div class="container">
		    			<h3> Awards <?php echo $cnt; ?></h3>
		    			<div class="form-group">
				        	<label>Title</label>
				        	<input type="text" name="title[]" class="form-control" value="<?php echo $aw['Title']; ?>" required>
				        </div>
				        <div class="form-group">
						    <label>Date</label>
						    <input type="text" name="date[]" class="form-control" value="<?php echo $aw['Date']; ?>" required>
				        </div> 
		    		</div>
		   			<hr>
		    	<?php $cnt += 1;}?>
		    	</div>
		    	<div class="form-group">
		            <button class="btn btn-primary" onclick="addAwards()">Add</button>
		        </div>
		        <div class="form-group">
		            <input type="submit" class="btn btn-primary" value="Submit">
		        </div>
		    </form>
		</div>
    </div>
	
	
	<!-- ------------------------------------------------------------->
	<!-- Teaching Content----------------------------------------------->
	<div class="Teaching" style="display: none">
		<div class="modal-content">
		    <h2>Teaching Profile</h2>
		    <p>Please Edit the required Information.</p>
		    <form id="Form5">
		    	<input type="hidden" name="TeachingForm" value="1"/>
		    	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
		    	<div id="Teaching-Content">
		    	<?php $cnt = 1; foreach($teaching as $te){?>
		    	
		    		<div class="container">
		    			<h3> Teaching <?php echo $cnt; ?></h3>
		    			<div class="form-group">
				        	<label>Course</label>
				        	<input type="text" name="course[]" class="form-control" value="<?php echo $te['Course']; ?>" required>
				        </div>
				        <div class="form-group">
						    <label>Date</label>
						    <input type="text" name="date[]" class="form-control" value="<?php echo $te['Date']; ?>" required>
				        </div> 
		    		</div>
		   			<hr>
		    	<?php $cnt += 1;}?>
		    	</div>
		    	<div class="form-group">
		            <button class="btn btn-primary" onclick="addTeaching()">Add</button>
		        </div>
		        <div class="form-group">
		            <input type="submit" class="btn btn-primary" value="Submit">
		        </div>
		    </form>
		</div>
    </div>
    <?php }else{?>
    
    	<h1> Wrong Address!!! </h1>
    
    <?php }?>
	<!-- ---------------------------------------------------------------->
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
		
		
		function addPublication(){
		
			var parent = document.getElementById("Publication-Content");
			var count = parent.childElementCount/2 + 1;
		
			var div = document.createElement("DIV");
			div.className = "container";
			var h3 = document.createElement("H3");
			h3.innerHTML = "Publication " + count;
			//alert(h3.innerHTML);
			div.appendChild(h3);
			
			var div1 = document.createElement("DIV");
			div1.className = "form-group";
			var label1 = document.createElement("LABEL");
			label1.innerHTML = "Paper";
			div1.appendChild(label1);
			var input1 = document.createElement("INPUT");
			input1.type = "text";
			input1.name = "paper[]";
			input1.className = "form-control";
			input1.required = true;
			div1.appendChild(input1);
			div.appendChild(div1);
			
			var div2 = document.createElement("DIV");
			div2.className = "form-group";
			var label2 = document.createElement("LABEL");
			label2.innerHTML = "Conference";
			div2.appendChild(label2);
			var input2 = document.createElement("INPUT");
			input2.type = "text";
			input2.name = "conf[]";
			input2.className = "form-control";
			input2.required = true;
			div2.appendChild(input2);
			div.appendChild(div2);
			
			parent.appendChild(div);
			parent.appendChild(document.createElement("hr"));
			
			
		
		}
		
		function addEducation(){
		
			var parent = document.getElementById("Education-Content");
			var count = parent.childElementCount/2 + 1;
		
			var div = document.createElement("DIV");
			div.className = "container";
			var h3 = document.createElement("H3");
			h3.innerHTML = "Education " + count;
			//alert(h3.innerHTML);
			div.appendChild(h3);
			
			var div1 = document.createElement("DIV");
			div1.className = "form-group";
			var label1 = document.createElement("LABEL");
			label1.innerHTML = "Study";
			div1.appendChild(label1);
			var input1 = document.createElement("INPUT");
			input1.type = "text";
			input1.name = "study[]";
			input1.className = "form-control";
			input1.required = true;
			div1.appendChild(input1);
			div.appendChild(div1);
			
			var div2 = document.createElement("DIV");
			div2.className = "form-group";
			var label2 = document.createElement("LABEL");
			label2.innerHTML = "Year";
			div2.appendChild(label2);
			var input2 = document.createElement("INPUT");
			input2.type = "text";
			input2.name = "year[]";
			input2.className = "form-control";
			input2.required = true;
			div2.appendChild(input2);
			div.appendChild(div2);
			
			parent.appendChild(div);
			parent.appendChild(document.createElement("hr"));
			
			
		
		}
		
		function addAwards(){
		
			var parent = document.getElementById("Awards-Content");
			var count = parent.childElementCount/2 + 1;
		
			var div = document.createElement("DIV");
			div.className = "container";
			var h3 = document.createElement("H3");
			h3.innerHTML = "Awards " + count;
			//alert(h3.innerHTML);
			div.appendChild(h3);
			
			var div1 = document.createElement("DIV");
			div1.className = "form-group";
			var label1 = document.createElement("LABEL");
			label1.innerHTML = "Title";
			div1.appendChild(label1);
			var input1 = document.createElement("INPUT");
			input1.type = "text";
			input1.name = "title[]";
			input1.className = "form-control";
			input1.required = true;
			div1.appendChild(input1);
			div.appendChild(div1);
			
			var div2 = document.createElement("DIV");
			div2.className = "form-group";
			var label2 = document.createElement("LABEL");
			label2.innerHTML = "Date";
			div2.appendChild(label2);
			var input2 = document.createElement("INPUT");
			input2.type = "text";
			input2.name = "date[]";
			input2.className = "form-control";
			input2.required = true;
			div2.appendChild(input2);
			div.appendChild(div2);
			
			parent.appendChild(div);
			parent.appendChild(document.createElement("hr"));
		
		
		
		}
		
		function addTeaching(){
		
			var parent = document.getElementById("Teaching-Content");
			var count = parent.childElementCount/2 + 1;
		
			var div = document.createElement("DIV");
			div.className = "container";
			var h3 = document.createElement("H3");
			h3.innerHTML = "Teaching " + count;
			//alert(h3.innerHTML);
			div.appendChild(h3);
			
			var div1 = document.createElement("DIV");
			div1.className = "form-group";
			var label1 = document.createElement("LABEL");
			label1.innerHTML = "Course";
			div1.appendChild(label1);
			var input1 = document.createElement("INPUT");
			input1.type = "text";
			input1.name = "course[]";
			input1.className = "form-control";
			input1.required = true;
			div1.appendChild(input1);
			div.appendChild(div1);
			
			var div2 = document.createElement("DIV");
			div2.className = "form-group";
			var label2 = document.createElement("LABEL");
			label2.innerHTML = "Date";
			div2.appendChild(label2);
			var input2 = document.createElement("INPUT");
			input2.type = "text";
			input2.name = "date[]";
			input2.className = "form-control";
			input2.required = true;
			div2.appendChild(input2);
			div.appendChild(div2);
			
			parent.appendChild(div);
			parent.appendChild(document.createElement("hr"));
		
		
		
		}
		
		$(function () {

		    $('#Form1').on('submit', function (e) {

		      e.preventDefault();

		      $.ajax({
		        type: 'post',
		        url: 'action.php',
		        data: $('#Form1').serialize(),
		        success: function (result) {
		        	
		          //if(result == 1)
		          	location.reload();
		          	//alert(result);
		          
		        }
		      });

		    });

      	});
      	$(function () {

		    $('#Form2').on('submit', function (e) {

		      e.preventDefault();

		      $.ajax({
		        type: 'post',
		        url: 'action.php',
		        data: $('#Form2').serialize(),
		        success: function (result) {
		        	
		          //if(result == 1)
		          	location.reload();
		          	//alert(result);
		          
		        }
		      });

		    });

      	});
      	
      	$(function () {

		    $('#Form3').on('submit', function (e) {

		      e.preventDefault();

		      $.ajax({
		        type: 'post',
		        url: 'action.php',
		        data: $('#Form3').serialize(),
		        success: function (result) {
		        	
		          //if(result == 1)
		          	location.reload();
		          	//alert(result);
		          
		        }
		      });

		    });

      	});
      	
      	$(function () {

		    $('#Form4').on('submit', function (e) {

		      e.preventDefault();

		      $.ajax({
		        type: 'post',
		        url: 'action.php',
		        data: $('#Form4').serialize(),
		        success: function (result) {
		        	
		          //if(result == 1)
		          	location.reload();
		          	//alert(result);
		          
		        }
		      });

		    });

      	});
      	
      	$(function () {

		    $('#Form5').on('submit', function (e) {

		      e.preventDefault();

		      $.ajax({
		        type: 'post',
		        url: 'action.php',
		        data: $('#Form5').serialize(),
		        success: function (result) {
		        	
		          //if(result == 1)
		          	location.reload();
		          	//alert(result);
		          
		        }
		      });

		    });

      	});
      	
	</script>
</body>
</html>

