<?php include "../models/functions.php"; 

    $functions = new functions();
    $conn = $functions->get_con();

    $e_id = isset($_POST['e_id'])? mysqli_real_escape_string($conn,$_POST['e_id']) : null;
    $fname = isset($_POST['fname'])? mysqli_real_escape_string($conn,$_POST['fname']) : null;
    $mname = isset($_POST['mname'])? mysqli_real_escape_string($conn,$_POST['mname']) : null;
    $lname = isset($_POST['lname'])? mysqli_real_escape_string($conn,$_POST['lname']) : null;
    $extension = isset($_POST['extension'])? mysqli_real_escape_string($conn,$_POST['extension']) : null;
    $gender = isset($_POST['gender'])? mysqli_real_escape_string($conn,$_POST['gender']) : null;
    $unit = isset($_POST['unit'])? mysqli_real_escape_string($conn,$_POST['unit']) : null;
    $usertype = isset($_POST['usertype'])? mysqli_real_escape_string($conn,$_POST['usertype']) : null;
    $username = isset($_POST['username'])? mysqli_real_escape_string($conn,$_POST['username']) : null;
    $password = isset($_POST['password'])? mysqli_real_escape_string($conn,$_POST['password']) : null;

    $anum = $_SESSION['anum'];
    $notifications = $functions->view_notif_status($anum);
    $notif_count = mysqli_num_rows($notifications);

    $accrows = $functions->view_accounts();

    if(isset($_POST['create']) && $_POST['create'] == "Create"){

        $img = $_FILES['file']['name'];

        $target_dir = "C:/xampp/htdocs/CaDIS/views/img/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");
            
        if( in_array($imageFileType,$extensions_arr) ){
             // Upload file
             move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$img);
        }

        $result = $functions->create_account($e_id,$fname,$mname,$lname,$extension,$gender,$unit,$usertype,$username,$password,$img);

        if($result) echo "Your account was successfully created.";
        else echo "Failed"; 
    }

    if(isset($_POST['logout'])){
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