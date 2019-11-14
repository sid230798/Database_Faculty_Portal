<?php

session_start();
ini_set('display_errors', 1);
require_once("config.php");

// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: dashboard.php");
//     exit;
// }

$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a valid username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $filter = ['username' => $username , 'password' => $password];
		$options = [];
        $query = new MongoDB\Driver\Query($filter, $options);
		$cursor = $manager->executeQuery('faculty_portal.users', $query);
		$result = pg_query($pg, "select faculty.Id from Faculty, Users where Faculty.Id = Users.Id and Users.username='$username' and Users.password='$password'");
		$resultArr = pg_fetch_all($result);
        $lcnt=0;
        
        foreach ($cursor as $entry)
        {
            $lcnt = $lcnt+1;
        }
        if ($lcnt==0)
        {
            $username_err = "Invalid username/password";
        }
        else
        {
            #session_start();
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["facultyid"] = $resultArr[0]['id'];
            #header("location: dashboard.php");
        }
    }
    
   	if(empty($username_err) && empty($password_err)){
   	
   		echo 1;
   	}
   	else
   		echo 0;
    
}
?>
