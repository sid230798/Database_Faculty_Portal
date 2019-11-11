<?php
// Include config file
ini_set('display_errors', 1);

require_once("config.php");
$filter = [];
$options = [];
$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('faculty_portal.users', $query);
$bulk = new MongoDB\Driver\BulkWrite;
$bulk2 = new MongoDB\Driver\BulkWrite;
$password = "";
$password_2 = "";
$username = "";
$password_err = "";
$password_2_err = "";
$username_err = "";
$count =0;
$str="";

// foreach($cursor as $entry)
// {
// 	// $a = $entry['username'];
// 	// $doc1 = $client->part1->$a->findOne();
// 	$p = implode(', ',(array)$entry['Publication']);
// 	$e = implode(', ',(array)$entry['Education']);
// 	$a = implode(', ',(array)$entry['Award']);
// 	$g = implode(', ',(array)$entry['Grants']);
// 	$t = implode(', ',(array)$entry['Teaching']);
// 	$str = $str.$entry['username'].':<br>'.'Publications: '.$p.'<br>'.'Education: '.$e.'<br>'.'Awards: '.$a.'<br>'.'Grants: '.$g.'<br>'.'Teaching: '.$t.'<br>';
// }

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Invalid Username. Enter again.";
    } 
    else
    {
        $filter = ['username'=>$_POST["username"]];
        $query = new MongoDB\Driver\Query($filter, $options);
        $cursor = $manager->executeQuery('faculty_portal.users' , $query);
        $count = 0;
        foreach ($cursor as $entry)
        {
        	$count = $count + 1;
        }
        if($count>0)
        {
        	$username_err = "This username is already taken.";
        }
        else
        {
            $username = trim($_POST["username"]);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $password_2_err = "Please confirm password.";     
    } else{
        $password_2 = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $password_2)){
            $password_2_err = "The passwords do not match.";
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($password_2_err)){
        $result1 = $bulk->insert(['username'=>$username,'password'=>$password]);
        $result1 = $manager->executeBulkWrite('faculty_portal.users', $bulk);
        // $log = $manager->createCollection( $username );
        // $collection1 = $client->part1->createCollection($username);
        $result1 = $bulk2->insert(['Publication'=>array(),'Education'=>array(),'Award'=>array(),'Grants'=>array(),'Teaching'=>array()]);
        $result1 = $manager->executeBulkWrite('faculty_portal.users.'.$username, $bulk2);

        header("location: login.php");
    }
 }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
	<!-- <div>
		<h1>All faculty info</h1>
		<h4> <b>echo ($str); </b> </h4>
	</div> -->
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_2_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $password_2; ?>">
                <span class="help-block"><?php echo $password_2_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>