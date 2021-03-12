<?php include "../models/functions.php";

    $functions = new functions();
    $conn = $functions->get_con();

    $ex_select = isset($_REQUEST['ex_select'])? mysqli_real_escape_string($conn,$_REQUEST['ex_select']) :"no";
    $all_select = isset($_REQUEST['all_select'])? mysqli_real_escape_string($conn,$_REQUEST['all_select']) :"no";

    $doc_select = isset($_POST['doc_select'])? mysqli_real_escape_string($conn,$_POST['doc_select']) :"no";
    $alldoc_select = isset($_REQUEST['alldoc_select'])? mysqli_real_escape_string($conn,$_REQUEST['alldoc_select']) :"no";
    
    $filter_status = isset($_REQUEST['filter_status'])? mysqli_real_escape_string($conn,$_REQUEST['filter_status']) : NULL;
    $filter_payee_type = isset($_REQUEST['payee_type'])? mysqli_real_escape_string($conn,$_REQUEST['payee_type']) : NULL;   
    $filter_payee = isset($_REQUEST['payee'])? mysqli_real_escape_string($conn,$_REQUEST['payee']) : NULL;    
    $filter_from = isset($_REQUEST['from'])? mysqli_real_escape_string($conn,$_REQUEST['from']) : NULL;
    $filter_to = isset($_REQUEST['to'])? mysqli_real_escape_string($conn,$_REQUEST['to']) : NULL;

    $top = isset($_POST['top'])? mysqli_real_escape_string($conn,$_POST['top']) : NULL;
    $top_position = isset($_POST['top_position'])? mysqli_real_escape_string($conn,$_POST['top_position']) : NULL;
    $thru_position = isset($_POST['thru_position'])? mysqli_real_escape_string($conn,$_POST['thru_position']) : NULL;
    $thru = isset($_POST['thru'])? mysqli_real_escape_string($conn,$_POST['thru']) : NULL;
    $focal_person = isset($_POST['focal_person'])? mysqli_real_escape_string($conn,$_POST['focal_person']) : NULL;
    $focal_position = isset($_POST['focal_position'])? mysqli_real_escape_string($conn,$_POST['focal_position']) : NULL;

    // filtered export
    if(isset($ex_select) && $ex_select == "yes"){
        if($filter_status == "for_claim/for_or" && $filter_payee_type != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2($filter_status,$filter_payee_type,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status($filter_status,$filter_payee_type);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3($filter_status,$filter_payee_type,$filter_from,$filter_to);
            }
        } else {
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_notype($filter_status,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype($filter_status,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype($filter_status);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_notype($filter_status,$filter_from,$filter_to);
            }
        }

        if($filter_status == "for_issuance" && $filter_payee_type != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_issuance($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2($filter_status,$filter_payee_type,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status($filter_status,$filter_payee_type);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_issuance($filter_status,$filter_payee_type,$filter_from,$filter_to);
            }
        } else if($filter_status == "for_issuance" && $filter_payee_type == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_issuance_notype($filter_status,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype($filter_status,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype($filter_status);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_issuance_notype($filter_status,$filter_from,$filter_to);
            }
        }

        if($filter_status == "claimed" && $filter_payee_type != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_claimed($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2($filter_status,$filter_payee_type,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status($filter_status,$filter_payee_type);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_claimed($filter_status,$filter_payee_type,$filter_from,$filter_to);
            }
        } else if($filter_status == "claimed" && $filter_payee_type == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_claimed_notype($filter_status,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype($filter_status,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype($filter_status);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_claimed_notype($filter_status,$filter_from,$filter_to);
            }
        }

        if($filter_status == "cancelled" && $filter_payee_type != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_cancelled($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2($filter_status,$filter_payee_type,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status($filter_status,$filter_payee_type);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_cancelled($filter_status,$filter_payee_type,$filter_from,$filter_to);
            }
        } else if($filter_status == "cancelled" && $filter_payee_type == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_cancelled_notype($filter_status,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype($filter_status,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype($filter_status);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_cancelled_notype($filter_status,$filter_from,$filter_to);
            }
        }

        if($filter_status == "expired" && $filter_payee_type != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_expired($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2($filter_status,$filter_payee_type,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status($filter_status,$filter_payee_type);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_expired($filter_status,$filter_payee_type,$filter_from,$filter_to);
            }
        } else if($filter_status == "expired" && $filter_payee_type == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_expired_notype($filter_status,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype($filter_status,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype($filter_status);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_expired_notype($filter_status,$filter_from,$filter_to);
            }
        }

        if($filter_status == "all" && $filter_payee_type != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_all($filter_payee,$filter_payee_type,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_all($filter_payee_type,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_all($filter_payee_type);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_all($filter_payee_type,$filter_from,$filter_to);
            }
        } else if($filter_status == "all" && $filter_payee_type == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_all_notype($filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_all_notype($filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_all_notype();
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_all_notype($filter_from,$filter_to);
            }
        }
    }

    // unfiltered export
    if((isset($all_select) && $all_select == "yes") || (isset($alldoc_select) && $alldoc_select == "yes")){
        $filter_row = $functions->view_vouchers();
    }

?>