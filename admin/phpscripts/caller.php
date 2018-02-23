<?php
//do NOT put a link to caller.php in the config file
//this file is only called from href NOT eevry time config it called
require_once("config.php");

if(isset($_GET['caller_id'])) {
	$dir = $_GET['caller_id'];
	if($dir == 'logout') {
		logged_out();

	} else {
		echo  "caller id was passed incorectly";
	}
}





?>