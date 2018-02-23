<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

	function createUser($fname, $username, $password, $email, $userlvl) {
		include('connect.php');
		//should run the mysqli_real_escape_string here.. this should all be cleaned and escaped so no quotes happen

		//very important that this is stated correctly
		//null means do whatever it is you want to do on your end mysql
		$userString = "INSERT INTO tbl_user VALUES(NULL, '{$fname}', '{$username}','{$password}', '{$email}', NULL, '{$userlvl}', NULL)";
		//echo $userString;
		$userQuery = mysqli_query($link, $userString);
		if($userQuery) {
			$createEmail = sendEmail($fname, $username, $password, $email);
			redirect_to("admin_index.php");
		} else {
			$message = "Sorry, there was a problem setting up that user. Please try again.";
			return $message;
		}

		mysqli_close($link);
	}

	function genPassword( $length = 10 ) {
	    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890,.?:;!@#$%^&*-_/";
	    $password = substr( str_shuffle( $characters ), 0, $length );
	    echo $password;
	}

	function sendEmail($fname, $username, $password, $email) {
		include('connect.php');
		$to = $email;
		$subj = "Movie Review App Login Information";
		$msg = "Hi there, ".$fname."\n\n A new account was made for you on the Movie Review App. Here are your credentials:\n\n Username: ".$username."\n\n Password: ".$password."\n\n Please login and change your password at: admin_index.php. Thanks for joining!";
		//echo $msg;
		mail($to, $subj, $msg);
		// $direct = $direct."?name={$name}";
		redirect_to("admin_index.php");

		mysqli_close($link);
	}

 ?>
