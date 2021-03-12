<?php include "../models/functions.php";
    $functions = new functions();
    $conn = $functions->get_con();

    $v_select = isset($_REQUEST['v_select'])? mysqli_real_escape_string($conn,$_REQUEST['v_select']) :"no";

    $new_date_encoded = isset($_POST['new_date_encoded'])? mysqli_real_escape_string($conn,$_POST['new_date_encoded']) :NULL;
    $new_payee = isset($_POST['new_payee'])? mysqli_real_escape_string($conn,$_POST['new_payee']) :NULL;
    $new_particular = isset($_POST['new_particular'])? mysqli_real_escape_string($conn,$_POST['new_particular']) :NULL;
    $new_period_from = isset($_POST['new_period_from'])? mysqli_real_escape_string($conn,$_POST['new_period_from']) :NULL;
    $new_period_to = isset($_POST['new_period_to'])? mysqli_real_escape_string($conn,$_POST['new_period_to']) :NULL;
    $new_et_al = isset($_POST['new_et_al'])? mysqli_real_escape_string($conn,$_POST['new_et_al']) :NULL;
    $new_ob_num = isset($_POST['new_ob_num'])? mysqli_real_escape_string($conn,$_POST['new_ob_num']) :NULL;
    $new_gross = isset($_POST['new_gross'])? mysqli_real_escape_string($conn,$_POST['new_gross']) :NULL;
    $new_net = isset($_POST['new_net'])? mysqli_real_escape_string($conn,$_POST['new_net']) :NULL;
    $new_fund = isset($_POST['new_fund'])? mysqli_real_escape_string($conn,$_POST['new_fund']) :NULL;
    $new_program = isset($_POST['new_program'])? mysqli_real_escape_string($conn,$_POST['new_program']) :NULL;
    $new_remarks = isset($_POST['new_remarks'])? mysqli_real_escape_string($conn,$_POST['new_remarks']) :NULL;
    $new_payment_type = isset($_POST['new_payment_type'])? mysqli_real_escape_string($conn,$_POST['new_payment_type']) :NULL;
    $new_payee_type = isset($_POST['new_payee_type'])? mysqli_real_escape_string($conn,$_POST['new_payee_type']) :NULL;
    $new_warrant_num = isset($_POST['new_warrant_num'])? mysqli_real_escape_string($conn,$_POST['new_warrant_num']) :NULL;
    $new_date_released = isset($_POST['new_date_released'])? mysqli_real_escape_string($conn,$_POST['new_date_released']) :NULL;
    $new_or_num = isset($_POST['new_or_num'])? mysqli_real_escape_string($conn,$_POST['new_or_num']) :NULL;
    $new_date_issue = isset($_POST['new_date_issue'])? mysqli_real_escape_string($conn,$_POST['new_date_issue']) :NULL;
    $new_date_claimed = isset($_POST['new_date_claimed'])? mysqli_real_escape_string($conn,$_POST['new_date_claimed']) :NULL;
    $new_claimed_by = isset($_POST['new_claimed_by'])? mysqli_real_escape_string($conn,$_POST['new_claimed_by']) :NULL;

    $v_num = isset($_POST['v_num'])? mysqli_real_escape_string($conn,$_POST['v_num']) :NULL;

    $new_gross = str_replace(',', '', $new_gross);
    $new_net = str_replace(',', '', $new_net);

    $anum = $_SESSION['anum'];
    $notifications = $functions->view_notif_status($anum);
    $notif_count = mysqli_num_rows($notifications);

    $re_issue_vnum = isset($_POST['re_issue_vnum'])? mysqli_real_escape_string($conn,$_POST['re_issue_vnum']) :NULL;
    $re_issue_warrant = isset($_POST['re_issue_warrant'])? mysqli_real_escape_string($conn,$_POST['re_issue_warrant']) :NULL;
    $re_issued_by = isset($_SESSION['fullname'])? mysqli_real_escape_string($conn,$_SESSION['fullname']) :NULL;
    $re_issue = isset($_POST['re_issue'])? mysqli_real_escape_string($conn,$_POST['re_issue']) :NULL;

    //$previous = "javascript:history.go(-1)";
    $previous = isset($_POST['previous'])? mysqli_real_escape_string($conn,$_POST['previous']) :NULL;

    if(isset($_POST['save']) && $_POST['save'] == "Save Changes" && !isset($re_issue)){
        $result = $functions->edit_voucher($v_num,$new_date_encoded,$new_payee,$new_particular,$new_period_from,$new_period_to,$new_et_al,$new_ob_num,$new_gross,$new_net,$new_fund,$new_program,$new_remarks,$new_payment_type,$new_payee_type,$new_warrant_num,$new_date_released,$new_or_num,$new_date_issue,$new_date_claimed);

        if($result){ //header("location:".$previous); 
        }
        else {echo "Error". mysqli_error(); }

    } 
    if(isset($_POST['save']) && $_POST['save'] == "Save Changes" && isset($re_issue)){
        $date_re_issued = date("Y-m-d");
        if($re_issue_warrant == ''){
            $result = $functions->re_issue($re_issue_vnum,$re_issued_by,$date_re_issued,$new_gross,$new_net,$new_warrant_num);
        } else {
            $result = $functions->re_issue2($re_issue_vnum,$re_issued_by,$date_re_issued,$new_gross,$new_net,$new_warrant_num);
        }
    }

    // view one voucher
    if(isset($v_select) && $v_select == "yes"){
        $vrow = $functions->view_vc($v_num);
        $accrows = $functions->view_accounts();
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
