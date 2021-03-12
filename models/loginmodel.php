<?php

	include "../models/dbconnect.php";

	class loginmodel extends dbconnect {	

		function login_check($login_username, $login_password) {
			$username = mysqli_real_escape_string($this->con, $login_username); 
			$password = mysqli_real_escape_string($this->con, $login_password);

			//SELECT query
			$query = "SELECT * FROM accounts WHERE BINARY username = '$username' AND BINARY pass = '$password';";

			$result = mysqli_query($this->con, $query);
			
			// if there is an error in your query, an error message is displayed.
			if(!$result) {
				die("<strong>WARNING:</strong><br>" . mysqli_error());
            } 
            
            if($result->num_rows==1) {

				while($row=$result->fetch_array()){
					if($row['status'] == "Deactivated"){
						return FALSE;
					} else {
						$_SESSION['anum'] = $row['0'];
						$_SESSION['usertype'] = $row['usertype'];
						$_SESSION['fullname'] = $row['fname'] . " " . $row['mname'] . " " . $row['lname'] . " " . $row['extension'] ;
						$_SESSION['name'] = $username;
						$_SESSION['pass'] = $password;
						$_SESSION['gender'] = $row['gender'];
						setcookie("fullname",$_SESSION['fullname'],time()+86400);
					}
				}

                header("location:profile.php?pr_select=yes");
            }

			/*
				HOW TO INTERPRET
				
				if (result->num_rows == 1) return TRUE;
				else return FALSE;
			*/

			return (($result->num_rows==1)? TRUE: FALSE);
			exit;
		}

		function view_attempts(){

			//SELECT query
			$query = "SELECT * FROM accounts;";

			$result = mysqli_query($this->con, $query);
			
			if($result) {
				return $result;
            } else {
				return false;
			}
			exit;
		}

		function insertAttempt($id){
			$query = "INSERT INTO attempts (a_id) VALUES ('$id');";

			$result = mysqli_query($this->con,$query);
            if($result) return true;
            else return false;
            exit;
		}

		function attempts($id){
			$query = "SELECT a_id FROM attempts WHERE a_id = '$id';";

			$result = mysqli_query($this->con,$query);
			$rows = $result->num_rows;
            if($result) return $rows;
            else return false;
            exit;
		}

		function removedata($id){
			$query = "DELETE FROM attempts WHERE a_id = '$id';";

			$result = mysqli_query($this->con,$query);
			
            if($result) return true;
            else return false;
            exit;
		}

	}

?>