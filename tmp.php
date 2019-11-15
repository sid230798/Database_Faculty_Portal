<?php

	$val = "Not Yet";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	
		$val = $_POST['name'][1];
		//$val = "Hello";
		#header("Refresh:0");	
	}
	

?>
<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>
<p> <?php echo $val; ?> </p>
<form action="" method="post">
  First name:<br>
  <input type="text" name="name[]" value="Mickey">
  <br>
  Last name:<br>
  <input type="password" name="name[]" value="Mouse">
  <br><br>
  <input type="submit" value="Submit">
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

</body>
</html>

