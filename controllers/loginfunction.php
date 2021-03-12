<?php 
	include "../models/loginmodel.php";
	$Logged_In = null;	//a flag variable that checks if the user is logged in
	$attempts = null;
	
	$login = new loginmodel();

	// request data from client
	$login_username = isset($_POST['login_username'])? $_POST['login_username'] :NULL;
    $login_password = isset($_POST['login_password'])? $_POST['login_password'] :NULL;

	if (isset($_POST['submit']) && $_POST['submit'] == "Login") {
		
		$result = $login->login_check($login_username, $login_password);
		
		if ($result) {
			// user is successfully logged in
			$login->removedata($login_username);
			$Logged_In = true;
		} else {
			$Logged_In=false;

			$result2 = $login->view_attempts();

			foreach ($result2 as $index => $value):
				if($value['username'] == $login_username){
					$insert = $login->insertAttempt($login_username);
					$attempts = $login->attempts($login_username);
				}
				//echo $result2;
			endforeach;

			if($attempts==3){
				setcookie("attempts",$login_username,time()+60);
				//echo "attempts: " . $attempts;
				$login->removedata($login_username);
				header("location:login.php");
			} 
        }
	}

	$login->close();
?>	