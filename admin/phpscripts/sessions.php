<?php //takes care of loggin in and loggin out and locking down the admin_index page

	session_start();//open command listneing for the serve call of $_SESSION

	function confirm_logged_in() {
		if(!isset($_SESSION['user_id'])){
			//only concerned with the false "not logged in" so if someone bookmarks the page or whatever it will alwyas redirect them to the login page
			redirect_to("admin_login.php");
		}
	}

	function logged_out() {
		session_destroy();
		redirect_to("../admin_login.php");//because it's being called from the folder
	}
?>