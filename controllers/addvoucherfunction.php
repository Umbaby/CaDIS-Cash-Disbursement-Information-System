<?php include "../models/functions.php";

    $functions = new functions();
    $conn = $functions->get_con();

    date_default_timezone_set('Asia/Manila');
    
    $date_e = date("Y-m-d"); // current date
    $time = date("H:i:s");
    $payee = isset($_POST['payee'])? mysqli_real_escape_string($conn,$_POST['payee']) :NULL;
    $particular = isset($_POST['particular'])? mysqli_real_escape_string($conn,$_POST['particular']) :NULL;
    $from = isset($_POST['from'])? mysqli_real_escape_string($conn,$_POST['from']) :NULL;    
    $to = isset($_POST['to'])? mysqli_real_escape_string($conn,$_POST['to']) :NULL;
    $etal = isset($_POST['etal'])? mysqli_real_escape_string($conn,$_POST['etal']) :NULL;
    $obno = isset($_POST['obno'])? mysqli_real_escape_string($conn,$_POST['obno']) :NULL;
    $gross = isset($_POST['gross'])? mysqli_real_escape_string($conn,$_POST['gross']) :NULL;
    $net = isset($_POST['net'])? mysqli_real_escape_string($conn,$_POST['net']) :NULL;
    $fund = isset($_POST['fund'])? mysqli_real_escape_string($conn,$_POST['fund']) :NULL;
    $program = isset($_POST['program'])? mysqli_real_escape_string($conn,$_POST['program']) :NULL;
    $remarks = isset($_POST['remarks'])? mysqli_real_escape_string($conn,$_POST['remarks']) :NULL;
    $status = isset($_POST['status'])? mysqli_real_escape_string($conn,$_POST['status']) :NULL;
    $payment_type = isset($_POST['payment_type'])? mysqli_real_escape_string($conn,$_POST['payment_type']) :NULL;
    $payee_type = isset($_POST['payee_type'])? mysqli_real_escape_string($conn,$_POST['payee_type']) :NULL;

    $gross = str_replace(',', '', $gross);
    $net = str_replace(',', '', $net);

    $anum = $_SESSION['anum'];
    $fullname = $_SESSION['fullname'];

    $notifications = $functions->view_notif_status($anum);
    $notif_count = mysqli_num_rows($notifications);

    $accrows = $functions->view_accounts();

    if(isset($_POST['add']) && $_POST['add'] == "Add"){
		
		$result = $functions->add_voucher($date_e,$time,$payee,$particular,$from,$to,$etal,$obno,$gross,$net,$fund,$program,$remarks,$status,$payment_type,$payee_type,$fullname);
            if(!$result) echo "Error" . mysqli_error();
            
        //$result2 = $functions->add_report($date_e,$status,$gross,$net);
          //  if(!$result2) echo "Error" . mysqli_error();
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