<?php
//mac error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once('phpscripts/config.php');

confirm_logged_in();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,600%7CRoboto:300,400" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
  <title>Movie Review App - Dashboard</title>
</head>
<body id="adminPanel">
  <header id="aPanelHead">
    <p class="navBut">Hi <?php echo $_SESSION['user_name']; ?></p> <!-- This shows the username when you log in -->
		<a href="phpscripts/caller.php?caller_id=logout" class="navBut">Sign Out</a>
  </header>

  <h2><?php
// Being in London, the timezone would be America/Toronto
date_default_timezone_set('America/Toronto');

// 24-hour format of an hour without leading zeros (0 through 23)
$Hour = date('G');

if ( $Hour >= 5 && $Hour <= 11 ) {
    echo "Good Morning, go grab a coffee!";
} else if ( $Hour >= 12 && $Hour <= 16 ) {
    echo "Good Afternoon, ready for a nap yet?";
} else if ( $Hour >= 17 && $Hour <= 20 ) {
    echo "Good Evening, I hope dinner is tasty!";
} else if ( $Hour >= 21 || $Hour <= 4 ) {
  echo "Goodnight! Now go get some sleep!";
}
?>
</h2>

<div id="panelFunct">
  <ul>
    <li class="boxBut"><a href="#">Edit Movies</a></li>
    <li class="boxBut"><a href="admin_createuser.php">Create User</a></li>
    <li class="boxBut"><a href="#">My Account</a></li>
  </ul>
</div>

</body>
</html>
