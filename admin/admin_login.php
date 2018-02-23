<?php
//mac error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once('phpscripts/config.php');

//use the ip address(single and multiple) and if someone isn't targeting from this ip address then you can't have access to this informaiton.
$ip = $_SERVER['REMOTE_ADDR'];
// echo $ip;
if(isset($_POST['submit'])){
	$username = trim($_POST['username']);//trim method will check to make sure there is no whitespace
	$password = trim($_POST['password']);

	if($username !== "" && $password !== "") {
		// echo 'you can type';
		$result = logIn($username, $password, $ip);
		$message = $result;
	}else {
		$message = "Please fill in the required fields";
		// echo $message;
	}
}

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,600%7CRoboto:300,400" rel="stylesheet">
<link rel="stylesheet" href="css/main.css">
<title>Movie Review App - Portal Login</title>
</head>
<body id="loginBack">

  <div id="loginPageCon">
    <h1>Welcome to the Movie Review App</h1>
    <div id="formCon">
      <form action="admin_login.php" method="post" id="loginForm">
        <h2>Login</h2>
        <label>Username:</label>
        <input type="text" name="username" value="">
        <br><br>
        <label>Password:</label>
        <input type="password" name="password" value="">
        <br>
        <!-- this means not empty on the load of page -->
        <p id="error"><?php if(!empty($message)){ echo $message;} ?></p>
        <input type="submit" name="submit" value="Login" class="submitButton">
				<!-- <a href="admin_createuser.php">Create User</a> -->
      </form>
    </div>
  </div>

</body>
</html>
