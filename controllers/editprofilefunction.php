<?php include "../models/functions.php"; 

    $functions = new functions();
    $conn = $functions->get_con();

    $account_num = isset($_POST['account_num'])? mysqli_real_escape_string($conn,$_POST['account_num']) :NULL;
    $new_employee_id = isset($_POST['new_employee_id'])? mysqli_real_escape_string($conn,$_POST['new_employee_id']) :NULL;
    $new_fname = isset($_POST['new_fname'])? mysqli_real_escape_string($conn,$_POST['new_fname']) :NULL;
    $new_mname = isset($_POST['new_mname'])? mysqli_real_escape_string($conn,$_POST['new_mname']) :NULL;
    $new_lname = isset($_POST['new_lname'])? mysqli_real_escape_string($conn,$_POST['new_lname']) :NULL;
    $new_extension = isset($_POST['new_extension'])? mysqli_real_escape_string($conn,$_POST['new_extension']) :NULL;
    $new_unit = isset($_POST['new_unit'])? mysqli_real_escape_string($conn,$_POST['new_unit']) :NULL;
    $new_gender = isset($_POST['new_gender'])? mysqli_real_escape_string($conn,$_POST['new_gender']) :NULL;
    $new_usertype = isset($_POST['new_usertype'])? mysqli_real_escape_string($conn,$_POST['new_usertype']) :NULL;
    $new_username = isset($_POST['new_username'])? mysqli_real_escape_string($conn,$_POST['new_username']) :NULL;    
    $new_password = isset($_POST['new_password'])? mysqli_real_escape_string($conn,$_POST['new_password']) :NULL;
    $new_status = isset($_POST['new_status'])? mysqli_real_escape_string($conn,$_POST['new_status']) : NULL;

    $pr_select = isset($_POST['pr_select'])? mysqli_real_escape_string($conn,$_POST['pr_select']) :"no";
    
    $anum = isset($_POST['anum'])? mysqli_real_escape_string($conn,$_POST['anum']) :NULL;

    $previous = isset($_POST['previous'])? mysqli_real_escape_string($conn,$_POST['previous']) :NULL;

    $anum2 = $_SESSION['anum'];
    $notifications = $functions->view_notif_status($anum2);
    $notif_count = mysqli_num_rows($notifications);

        // view own profile
        if(isset($pr_select) && $pr_select == "yes"){
            $prows = $functions->view_profile($anum);
            $accrows = $functions->view_accounts();
        }

        if(isset($_POST['save']) && $_POST['save'] == "Save"){
            $accrows = $functions->view_accounts();

            $result = $functions->edit_account($new_employee_id,$new_fname,$new_mname,$new_lname,$new_extension,$new_gender,$new_unit,$new_usertype,$new_username,$new_password,$new_status,$account_num);
                if($result){
                    if($_SESSION['usertype'] == "Admin" || $_SESSION['usertype'] == "Encoder"){
                        header("location:".$previous);
                    } else {
                        header("location:".$previous);
                    }
                } 
                else echo "Failed";   

            if($anum==$anum2){
                if($_SESSION['gender']=="Male"){
                    $activity = $new_fname . " " . $new_mname . " " . $new_lname . " " . $extension . " updated his profile.";
                } else {
                    $activity = $new_fname . " " . $new_mname . " " . $new_lname . " " . $extension . " updated her profile.";
                }

                $result2 = $functions->insert_activity($activity);
            } else {
                $activity = $new_fname . " " . $new_mname . " " . $new_lname . " " . $extension . "\'s account was updated by ";
            
                $result2 = $functions->insert_activity2($activity,$_SESSION['anum']);
            }
               
        }

        if(isset($_POST['upload']) && $_POST['upload'] == "Upload"){
            $prows = $functions->view_profile($anum);
            $accrows = $functions->view_accounts();
            
            $name = $_FILES['file']['name'];

            $target_dir = "C:/xampp/htdocs/CaDIS/views/img/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
        
            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");
            
            if( in_array($imageFileType,$extensions_arr) ){
                $result = $functions->upload_pic($name,$anum);
    
                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
    
                if($result){
                    header("location:".$previous);
                }
            }
        }

        if(isset($_POST['logout'])){
            setcookie("username","",time()-86400);
            setcookie("password","",time()-86400);
            setcookie("usertype","",time()-86400);
            setcookie("anum","",time()-86400);
            setcookie("fullname","",time()-86400);
            unset($_SESSION['name']);
            unset($_SESSION['pass']);
            unset($_SESSION['usertype']);
            unset($_SESSION['anum']);
            unset($_SESSION['fullname']);
            session_destroy();
            header("location:index.php");
        }
        
    $functions->close();
?>