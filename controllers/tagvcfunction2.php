<?php include "../models/functions.php";

    $functions = new functions();
    $conn = $functions->get_con();

    date_default_timezone_set('Asia/Manila');
    
    $v_select = isset($_REQUEST['v_select'])? mysqli_real_escape_string($conn,$_REQUEST['v_select']) :"no";

    $date_e = date("Y-m-d"); // current date

    $v_num = isset($_POST['v_num'])? mysqli_real_escape_string($conn,$_POST['v_num']) :NULL;
    $date_encoded = isset($_POST['date_encoded'])? mysqli_real_escape_string($conn,$_POST['date_encoded']) :NULL;
    $time_encoded = isset($_POST['time_encoded'])? mysqli_real_escape_string($conn,$_POST['time_encoded']) :NULL;
    $payee = isset($_POST['payee'])? $_POST['payee'] :NULL; // cont heree
    //$array_payee = isset($payee)? array_map(function($payee) use($conn) { return mysqli_real_escape_string($conn, $payee); }, $payee) :NULL;
    $particular = isset($_POST['particular'])? mysqli_real_escape_string($conn,$_POST['particular']) :NULL;
    $period_from = isset($_POST['period_from'])? mysqli_real_escape_string($conn,$_POST['period_from']) :NULL;
    $period_to = isset($_POST['period_to'])? mysqli_real_escape_string($conn,$_POST['period_to']) :NULL;
    $et_al = isset($_POST['et_al'])? mysqli_real_escape_string($conn,$_POST['et_al']) :NULL;
    $ob_num = isset($_POST['ob_num'])? mysqli_real_escape_string($conn,$_POST['ob_num']) :NULL;
    $gross = isset($_POST['gross'])? $_POST['gross'] :NULL;
    //$array_gross = isset($gross)? array_map(function($gross) use($conn) { return mysqli_real_escape_string($conn, $gross); }, $gross) :NULL;
    $net = isset($_POST['net'])? mysqli_real_escape_string($conn,$_POST['net']) :NULL;
    $fund = isset($_POST['fund'])? mysqli_real_escape_string($conn,$_POST['fund']) :NULL;
    $program = isset($_POST['program'])? mysqli_real_escape_string($conn,$_POST['program']) :NULL;
    $remarks = isset($_POST['remarks'])? mysqli_real_escape_string($conn,$_POST['remarks']) :NULL;
    $payment_type = isset($_POST['payment_type'])? mysqli_real_escape_string($conn,$_POST['payment_type']) :NULL;

    $warrant = isset($_POST['warrant'])? $_POST['warrant'] :NULL;
    //$array_warrant = isset($warrant)? array_map(function($warrant) use($conn) { return mysqli_real_escape_string($conn, $warrant); }, $warrant) :NULL;
    $date_r = isset($_POST['date_released'])? mysqli_real_escape_string($conn,$_POST['date_released']) :NULL;

    $status = "for_claim/for_or";
    $tagger = $_SESSION['fullname'];

    $anum = $_SESSION['anum'];
    $notifications = $functions->view_notif_status($anum);
    $notif_count = mysqli_num_rows($notifications);

    $previous = isset($_POST['previous'])? mysqli_real_escape_string($conn,$_POST['previous']) :NULL;

    $et_al = "";

    if(isset($_POST['save']) && $_POST['save'] == "Save" && !is_array($warrant)){
        $check = $functions->check_warrant($warrant);

        if($check->num_rows==0){
            $result = $functions->tag_vc($v_num,$warrant,$date_r,$status,$tagger);

            if($result){
                //header("location:".$previous);
            } else echo "Error". mysqli_error();

            //$result3 = $functions->add_report($date_e,$status,$gross,$net);
            //if(!$result3) echo "Error" . mysqli_error();
        }
    }

    if(isset($_POST['add']) && $_POST['add'] == "Add" && is_array($warrant)){
        $total = 0;
        if($warrant->num_rows==0){
            for($count = 0; $count < count($warrant); $count++){
                $gross2 = str_replace(',', '', $gross[$count]);
                $result = $functions->add_vc_et_at($date_encoded, $time_encoded, mysqli_real_escape_string($conn,$payee[$count]), $particular, $period_from, $period_to, $et_al, $ob_num, mysqli_real_escape_string($conn,$gross2), $net, $fund, $program, $remarks, $status, $payment_type, mysqli_real_escape_string($conn,$warrant[$count]), $date_r, $tagger);
                $total = $total + $gross[$count];
            }

            $result2 = $functions->get_gross();

            if(!$result && !$result2) echo "Error". mysqli_error();
            
            //$result3 = $functions->add_report($date_e,$status,$total,$total);
            //if(!$result3) echo "Error" . mysqli_error();

            $result4 = $functions->update_voucher_status($status,$date_r,$tagger,$v_num);
            if(!$result4) echo "Error" . mysqli_error();

            header("location:".$previous);
        }
    }

    // view one voucher
    if(isset($v_select) && $v_select == "yes"){
        $v_row = $functions->view_vc($v_num);

        foreach ($v_row as $index => $value):
            if($value['et_al']==""){
                $et_al = "no";
            } else {
                $et_al = "yes";
            }
            $gross = $value['net'];
        endforeach;

        $accrows = $functions->view_accounts();
        $w_rows = $functions->view_warrant();
        $arr = [];
        while($row = mysqli_fetch_array($w_rows)){
            $arr[] = $row['0'];
        }
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