<?php
 function logIn($username, $password, $ip) {
 	require_once('connect.php');
 	$username = mysqli_real_escape_string($link, $username);//this is sanitzation, changes everything to literals
 	$password = mysqli_real_escape_string($link, $password);

 	$loginstring = "SELECT * FROM tbl_user WHERE user_name = '{$username}' AND user_pass = '{$password}'";
 	// echo $loginstring;
 	$user_set = mysqli_query($link, $loginstring);

 	if(mysqli_num_rows($user_set)){
 		//this works as a boolean
 		$found_user = mysqli_fetch_array($user_set,MYSQLI_ASSOC);
 		$id = $found_user['user_id'];//now you have access to the users ID
 		// echo $id;
 		//sessions only exist on the server level and do not exist on the local machine. Do not use cookies to pass things they can be found and hacked into. As soon as the browser is closed the file is terminated. Only pass things around using a session because it requires someone to hack an entire server. BUT do not pass an entire session.. be specific.
 		$_SESSION['user_id'] = $id; //label user_id equals the variable id
 		$_SESSION['user_name'] = $found_user['user_fname'];//these variables are accessible to every page but only through the server

 		if(mysqli_query($link, $loginstring)){
 			//if they've successfully logged in then update their ip address in the db
 			$updatestring = "UPDATE tbl_user SET user_ip = '$ip' WHERE user_id = {$id}";
 			$updatequery = mysqli_query($link, $updatestring);
 			// echo $ip;

 		}
 		redirect_to('admin_index.php');
 	} else {
 		$message = "Username or password is incorrect";
 		return $message;
 	}


 	mysqli_close($link);//always make sure to close it off especially on a login
 }



?>
