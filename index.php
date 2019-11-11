<?include_once("config.php");?>
<html>
<head>
  <title>Welcome to MongoDB</title>
</head>
<body>
<h1>Heya What's Up!!</h1>
  <?if(!loggedIn()):?>
    <a href="register.php">Register</a> |
    <a href="login.php">Login</a> |
  <?else:?>
    <a href="logout.php">Logout</a>
  <?endif;?>
</body>
</html>
