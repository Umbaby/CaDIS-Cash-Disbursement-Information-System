<?php include "../models/functions.php";

    $functions = new functions();
    $conn = $functions->get_con();

    date_default_timezone_set('Asia/Manila');
    
    $v_select = isset($_REQUEST['v_select'])? mysqli_real_escape_string($conn,$_REQUEST['v_select']):"no";

    $date_e = date("Y-m-d"); // current date

    $v_num = isset($_POST['v_num'])? mysqli_real_escape_string($conn,$_POST['v_num']) :NULL;
    $or_num = isset($_POST['or_num'])? mysqli_real_escape_string($conn,$_POST['or_num']) :NULL;
    $date_issue = isset($_POST['date_issue'])? mysqli_real_escape_string($conn,$_POST['date_issue']) :NULL;
    $date_claimed = isset($_POST['date_claimed'])? mysqli_real_escape_string($conn,$_POST['date_claimed']) :NULL;
    //$claimed_by = isset($_POST['claimed_by'])? mysqli_real_escape_string($conn,$_POST['claimed_by']) :NULL;
    $gross = isset($_POST['gross'])? mysqli_real_escape_string($conn,$_POST['gross']) :NULL;
    $net = isset($_POST['net'])? mysqli_real_escape_string($conn,$_POST['net']) :NULL;

    $status = "claimed";
    $tagger = isset($_SESSION['fullname'])? mysqli_real_escape_string($conn,$_SESSION['fullname']) :NULL;

    $anum = $_SESSION['anum'];
    $notifications = $functions->view_notif_status($anum);
    $notif_count = mysqli_num_rows($notifications);

    $previous = isset($_POST['previous'])? mysqli_real_escape_string($conn,$_POST['previous']) :NULL;

    // save the entered info
    if(isset($_POST['save']) && $_POST['save'] == "Save"){
        $result = $functions->claim_vc($v_num,$or_num,$date_issue,$date_claimed,$status,$tagger);

        if($result){ //header("location:".$previous);
        } else { echo "Error". mysqli_error(); }

        //$result2 = $functions->add_report($date_e,$status,$gross,$net);
        //if(!$result2) echo "Error" . mysqli_error();
    }

    // view one voucher
    if(isset($v_select) && $v_select == "yes"){
        $v_row = $functions->view_vc($v_num);
        $accrows = $functions->view_accounts();
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
