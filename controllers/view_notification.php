<?php session_start();
      include "../models/functions.php";

	  $functions = new functions();
	  $conn = $functions->get_con();

	  $anum = isset($_SESSION['anum'])? mysqli_real_escape_string($conn,$_SESSION['anum']) :NULL;

	  $result = $functions->update_notif($anum);
	  
?>