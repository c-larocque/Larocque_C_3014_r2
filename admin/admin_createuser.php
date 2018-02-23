<?php
//mac error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once('phpscripts/config.php');

//for testing purposes below is commented but this should be uncommented in real life so people don't have access
confirm_logged_in();

if(isset($_POST['submit'])) {
	$fname = trim($_POST['fname']);
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$email = trim($_POST['email']);
	$userlvl = $_POST['userlvl'];
	//$url = redirect_to("admin_index.php"); // Tried adding a URL redirect for the email message but it broke my code. Not entirely sure the proper syntax for including a path in a email message. I also made sure to add $url in the brackets but removed them when the code was breaking.
	//$url = file_get_contents("admin_index.php"); //Tried the same as above, nothing worked.

	// This should create an encrypted password in the database, however it does not work. The database still only shows the generated password, instead of the hashed one.
	$dbPassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

//people may miss the user level so if its empty give people an error message
	if(empty($userlvl)) {
		$message = "Please select a user level.";
	} else {
		$result = createUser($fname, $username, $password, $email, $userlvl);
		$message = $result;
		if(!empty($email)) {
			$createEmail = sendEmail($fname, $username, $password, $email);
		}
		}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,600%7CRoboto:300,400" rel="stylesheet">
<link rel="stylesheet" href="css/main.css">
	<title>Movie Review App - Create New User</title>
</head>
<body id="userBack">

	<header>
    <p class="navBut">Hi <?php echo $_SESSION['user_name']; ?></p> <!-- This shows the username when you log in -->
		<a href="admin_index.php" class="navBut">Dashboard</a>
		<a href="phpscripts/caller.php?caller_id=logout" class="navBut">Sign Out</a>
  </header>

	<h1>Welcome to the Movie Review App</h1>
	<?php if(!empty($message)) {echo $message;} ?>
	<!-- action says run on this page -->
	<form action="admin_createuser.php" method="post" id="userForm">
		<h2>Create New User</h2>
		<label>First Name: </label>
		<input type="text" name="fname" value="<?php if(!empty($fname)) {echo $fname;} ?>" ><br>

		<label>Username: </label>
		<input type="text" name="username" value="<?php if(!empty($username)) {echo $username;} ?>"><br>

		<label>Password:</label>
		<input type="text" name="password" id="passInput" value="<?php $password = genPassword(10); ?>" readonly><br>

		<label>Email: </label>
		<input type="text" name="email" value="<?php if(!empty($email)) {echo $email;} ?>"><br>

		<label>User Level: </label>
		<select name="userlvl">
			<option>Select a Level</option>
			<option value="3">Web Admin</option>
			<option value="2">Web Master</option>
			<option value="1">Web Assist</option>

		</select><br><br>

		<input type="submit" name="submit" value="Create New User" class="submitButton"><br>

	</form>

</body>
</html>
