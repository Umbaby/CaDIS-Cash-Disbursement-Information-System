<?php include "../models/functions.php";

    $functions = new functions();
    $conn = $functions->get_con();

    $acc_select = isset($_REQUEST['acc_select'])? mysqli_real_escape_string($conn,$_REQUEST['acc_select']) :"no";
    $ac_select = isset($_REQUEST['ac_select'])? mysqli_real_escape_string($conn,$_REQUEST['ac_select']) :"no";
    $vc_select = isset($_REQUEST['vc_select'])? mysqli_real_escape_string($conn,$_REQUEST['vc_select']) :"no";
    $pr_select = isset($_REQUEST['pr_select'])? mysqli_real_escape_string($conn,$_REQUEST['pr_select']) :"no";
    $nf_select = isset($_REQUEST['nf_select'])? mysqli_real_escape_string($conn,$_REQUEST['nf_select']) :"no";
    $fo_select = isset($_REQUEST['fo_select'])? mysqli_real_escape_string($conn,$_REQUEST['fo_select']) :"no";
    $ft_select = isset($_REQUEST['ft_select'])? mysqli_real_escape_string($conn,$_REQUEST['ft_select']) :"no";
    $f171_select = isset($_REQUEST['f171_select'])? mysqli_real_escape_string($conn,$_REQUEST['f171_select']) :"no";
    $f184_select = isset($_REQUEST['f184_select'])? mysqli_real_escape_string($conn,$_REQUEST['f184_select']) :"no";
    $r_select = isset($_REQUEST['r_select'])? mysqli_real_escape_string($conn,$_REQUEST['r_select']) :"no";
    //$v_num = isset($_REQUEST['v_num'])? mysqli_real_escape_string($conn,$_REQUEST['v_num']) :NULL;

    $anum = isset($_SESSION['anum'])? mysqli_real_escape_string($conn,$_SESSION['anum']) :NULL;

    $cancel_v_num = isset($_POST['cancel_v_num'])? mysqli_real_escape_string($conn,$_POST['cancel_v_num']) :NULL;
    $cancel_status = "cancelled";
    $cancelled_by = isset($_SESSION['fullname'])? mysqli_real_escape_string($conn,$_SESSION['fullname']) :NULL;

    $input = isset($_POST['input'])? mysqli_real_escape_string($conn,$_POST['input']) :NULL;
    
    $input101 = isset($_POST['input101'])? mysqli_real_escape_string($conn,$_POST['input101']) :NULL;
    $input102 = isset($_POST['input102'])? mysqli_real_escape_string($conn,$_POST['input102']) :NULL;
    $input171 = isset($_POST['input171'])? mysqli_real_escape_string($conn,$_POST['input171']) :NULL;
    $input184 = isset($_POST['input184'])? mysqli_real_escape_string($conn,$_POST['input184']) :NULL;
    $input_status = isset($_POST['input_status'])? mysqli_real_escape_string($conn,$_POST['input_status']) : NULL;

    $acc_input = isset($_POST['acc_input'])? mysqli_real_escape_string($conn,$_POST['acc_input']) :NULL;

    $filter_status = isset($_POST['filter_status'])? mysqli_real_escape_string($conn,$_POST['filter_status']) : NULL;
    $filter_payee_type = isset($_POST['filter_payee_type'])? mysqli_real_escape_string($conn,$_POST['filter_payee_type']) : NULL;
    $filter_payee = isset($_POST['filter_payee'])? mysqli_real_escape_string($conn,$_POST['filter_payee']) : NULL;
    $filter_from = isset($_POST['filter_from'])? mysqli_real_escape_string($conn,$_POST['filter_from']) : NULL;
    $filter_to = isset($_POST['filter_to'])? mysqli_real_escape_string($conn,$_POST['filter_to']) : NULL;
    $filter_program = isset($_POST['filter_program'])? mysqli_real_escape_string($conn,$_POST['filter_program']) : NULL;

    $top = isset($_POST['top'])? mysqli_real_escape_string($conn,$_POST['top']) : NULL;
    $top_position = isset($_POST['top_position'])? mysqli_real_escape_string($conn,$_POST['top_position']) : NULL;
    $thru = isset($_POST['thru'])? mysqli_real_escape_string($conn,$_POST['thru']) : NULL;
    $thru_position = isset($_POST['thru_position'])? mysqli_real_escape_string($conn,$_POST['thru_position']) : NULL;
    $focal_person = isset($_POST['focal_person'])? mysqli_real_escape_string($conn,$_POST['focal_person']) : NULL;
    $focal_position = isset($_POST['focal_position'])? mysqli_real_escape_string($conn,$_POST['focal_position']) : NULL;
    $issued_from = isset($_POST['issued_from'])? mysqli_real_escape_string($conn,$_POST['issued_from']) : NULL;
    $deadline = isset($_POST['deadline'])? mysqli_real_escape_string($conn,$_POST['deadline']) : NULL;
    $remarks = isset($_POST['remarks'])? $_POST['remarks'] : NULL;

    $previous = isset($_POST['previous'])? mysqli_real_escape_string($conn,$_POST['previous']) :NULL;

    $adsearch_payee = isset($_POST['adsearch_payee'])? mysqli_real_escape_string($conn,$_POST['adsearch_payee']) :NULL;
    $adsearch_gross = isset($_POST['adsearch_gross'])? mysqli_real_escape_string($conn,$_POST['adsearch_gross']) :NULL;
    $adsearch_net = isset($_POST['adsearch_net'])? mysqli_real_escape_string($conn,$_POST['adsearch_net']) :NULL;
    $adsearch_obnum = isset($_POST['adsearch_obnum'])? mysqli_real_escape_string($conn,$_POST['adsearch_obnum']) :NULL;
    $adsearch_warrant = isset($_POST['adsearch_warrant'])? mysqli_real_escape_string($conn,$_POST['adsearch_warrant']) :NULL;
    $adsearch_fund = isset($_POST['fund'])? mysqli_real_escape_string($conn,$_POST['fund']) :NULL;
    
    $filter_report_from = isset($_POST['filter_report_from'])? mysqli_real_escape_string($conn,$_POST['filter_report_from']) : NULL;
    $filter_report_to = isset($_POST['filter_report_to'])? mysqli_real_escape_string($conn,$_POST['filter_report_to']) : NULL;

    $gross = isset($_POST['gross'])? mysqli_real_escape_string($conn,$_POST['gross']) :NULL;
    $net = isset($_POST['net'])? mysqli_real_escape_string($conn,$_POST['net']) :NULL;
    $cancel_remarks = isset($_POST['cancel_remarks'])? mysqli_real_escape_string($conn,$_POST['cancel_remarks']) :NULL;

    $filter_row = null;

    $notif_count = 0;

    // view accounts
    if((isset($acc_select) && $acc_select == "yes") || (isset($ac_select) && $ac_select == "yes") || (isset($r_select) && $r_select == "yes")){
        $accrows = $functions->view_accounts();
    } else {
        $accrows = $functions->view_accounts();
    }

    // view user activity
    if(isset($ac_select) && $ac_select == "yes"){
        $arows = $functions->view_activity();
    } else {
        $accrows = $functions->view_accounts();
    }

    // view reports
    if(isset($r_select) && $r_select == "yes" && !isset($_POST['filter_report'])){
        $rrows = $functions->view_vouchers();
        $for_issuance = 0;
        $for_claim = 0;
        $claimed = 0;
        $cancelled = 0;
        $expired = 0;
        $for_issuance_gross = 0;
        $for_claim_gross = 0;
        $claimed_gross = 0;
        $cancelled_gross = 0;
        $expired_gross = 0;
        $for_issuance_net = 0;
        $for_claim_net = 0;
        $claimed_net = 0;
        $cancelled_net = 0;
        $expired_net = 0;
        $total_gross = 0;
        $total_net = 0;

        foreach ($rrows as $index => $value): 
            if($value['status'] == "for_issuance"){
                $for_issuance = $for_issuance + 1;
                $for_issuance_gross = $for_issuance_gross + $value['gross'];
                $for_issuance_net = $for_issuance_net + $value['net'];
                
            } 
            if($value['status'] == "for_claim/for_or"){
                $for_claim = $for_claim + 1;
                $for_claim_gross = $for_claim_gross + $value['gross'];
                $for_claim_net = $for_claim_net + $value['net'];
                
            } 
            if($value['status'] == "claimed"){
                $claimed = $claimed + 1;
                $claimed_gross = $claimed_gross + $value['gross'];
                $claimed_net = $claimed_net + $value['net'];
                
            } 
            if($value['status'] == "cancelled"){
                $cancelled = $cancelled + 1;
                $cancelled_gross = $cancelled_gross + $value['gross'];
                $cancelled_net = $cancelled_net + $value['net'];
                
            } 
            if($value['status'] == "expired"){
                $expired = $expired + 1;
                $expired_gross = $expired_gross + $value['gross'];
                $expired_net = $expired_net + $value['net'];
                
            } 
            if($value['status'] != "expired" && $value['status'] != "cancelled"){
                $total_gross = $total_gross + $value['gross'];
                $total_net = $total_net + $value['net'];
            }
        endforeach;
    } else {
        $accrows = $functions->view_accounts();
    }
    
    // view vouchers
    if(isset($f171_select) || isset($f184_select) || isset($nf_select) || isset($pr_select) || isset($vc_select) || isset($acc_select) || isset($filter_status) && $filter_status == "yes"){
        $vrows = $functions->view_vouchers();
        $accounts = $functions->view_accounts();
        
        // expiration validation
        foreach($vrows as $index => $value):
            $curr_date = date("Y-m-d"); // current date
            $r_date = $value['date_released']; // date released
            $c_edate = date('Y-m-d', strtotime("+3 months", strtotime($r_date))); // expiration (after 3 months for cheque)
            $a_edate = date('Y-m-d', strtotime("+2 days", strtotime($r_date))); // automatic claimed (after 2 days for ada)

            if(($value['status'] == "for_claim/for_or") && ($curr_date>$c_edate) && ($value['payment_type'] == "cheque") && ($value['warrant_num'] != "")){
                $result = $functions->c_expire($value['v_num'],$c_edate);
                $status = "expired";
                //$result2 = $functions->add_report($curr_date,$status,$value['gross'],$value['net']);
                    if(!$result2) echo "Error" . mysqli_error();

                $payee = $value['payee'];
                $reference = $value['warrant_num'];
                $detail = "Stale cheque";
                
                foreach ($accounts as $index2 => $value2):
                    if(($value2['usertype'] != "Admin") && ($value2['usertype'] != "AA")){
                        $result = $functions->insert_notif_cheque2($payee,$detail,$reference,$c_edate,$value2['account_num']); 
                    }
                endforeach;
            }
            if(($value['status'] == "for_claim/for_or") && ($curr_date>=$a_edate) && ($value['payment_type'] == "ADA") && ($value['date_released'] > 0)){
                $result = $functions->a_claim($value['v_num'],$a_edate);
            }
        endforeach;
    } else {
        $accrows = $functions->view_accounts();
    }

    // view FUND 101 vouchers
    if(isset($fo_select) && $fo_select == "yes"){
        $fo_rows = $functions->view_fund101();
        $accrows = $functions->view_accounts();
    } else {
        $accrows = $functions->view_accounts();
    }

    // view FUND 102 vouchers
    if(isset($ft_select) && $ft_select == "yes"){
        $ft_rows = $functions->view_fund102();
        $accrows = $functions->view_accounts();
    } else {
        $accrows = $functions->view_accounts();
    }

    // view FUND 171 vouchers
    if(isset($f171_select) && $f171_select == "yes"){
        $f171_rows = $functions->view_fund171();
        $accrows = $functions->view_accounts();
    } else {
        $accrows = $functions->view_accounts();
    }

    // view FUND 184 vouchers
    if(isset($f184_select) && $f184_select == "yes"){
        $f184_rows = $functions->view_fund184();
        $accrows = $functions->view_accounts();
    } else {
        $accrows = $functions->view_accounts();
    }

    if(isset($_POST['re_issue']) && $_POST['re_issue'] == "Re-Issue"){
        $date_re_issued = date("Y-m-d");
        if($re_issue_warrant == ''){
            $result = $functions->re_issue($re_issue_vnum,$re_issued_by,$date_re_issued);
        } else {
            $result = $functions->re_issue2($re_issue_vnum,$re_issued_by,$date_re_issued);
        }
        header("location:".$previous);
    }

    // search FUND 101 vouchers
    if(isset($_POST['search_fo']) && $_POST['search_fo'] == "Search"){
        if($input101 != null){
            if($input_status!="all"){
                $fo_row = $functions->search_fund101_2($input101,$input_status);
            } else {
                $fo_row = $functions->search_fund101($input101);
            }
        } else {
            if($input_status!="all"){
                $fo_row = $functions->search_fund101_3($input_status);
            } else {
                $fo_row = $functions->view_fund101();
            }  
        }
    } 

    // search FUND 102 vouchers
    if(isset($_POST['search_ft']) && $_POST['search_ft'] == "Search"){
        if($input102 != null){
            if($input_status!="all"){
                $ft_row = $functions->search_fund102_2($input102,$input_status);
            } else {
                $ft_row = $functions->search_fund102($input102);
            }
        } else {
            if($input_status!="all"){
                $ft_row = $functions->search_fund102_3($input_status);
            } else {
                $ft_row = $functions->view_fund102();
            }  
            
        }
    } 

    // search FUND 171 vouchers
    if(isset($_POST['search_f171']) && $_POST['search_f171'] == "Search"){
        if($input171 != null){
            if($input_status!="all"){
                $f171_row = $functions->search_fund171_2($input171,$input_status);
            } else {
                $f171_row = $functions->search_fund171($input171);
            }
        } else {
            if($input_status!="all"){
                $f171_row = $functions->search_fund171_3($input_status);
            } else {
                $f171_row = $functions->view_fund171();
            } 
        }
    } 

    // search FUND 184 vouchers
    if(isset($_POST['search_f184']) && $_POST['search_f184'] == "Search"){
        if($input184 != null){
            if($input_status!="all"){
                $f184_row = $functions->search_fund184_2($input184,$input_status);
            } else {
                $f184_row = $functions->search_fund184($input184);
            }
        } else {
            if($input_status!="all"){
                $f184_row = $functions->search_fund184_3($input_status);
            } else {
                $f184_row = $functions->view_fund184();
            } 
            
        }
    } 

    // view own profile
    if(isset($pr_select) && $pr_select == "yes"){
        $prows = $functions->view_profile($anum);
        $accrows = $functions->view_accounts();
    } else {
        $accrows = $functions->view_accounts();
    }

    // filter report
    if(isset($_POST['filter_report']) && $_POST['filter_report'] == "Filter"){

        /*if($filter_report_from != null && $filter_report_to != null){
            $rrows = $functions->view_report($filter_report_from,$filter_report_to);
        } else if ($filter_report_from != null && $filter_report_to == null){
            $rrows = $functions->view_report2($filter_report_from);
        } else if ($filter_report_from == null && $filter_report_to != null){
            $rrows = $functions->view_report3($filter_report_to);
        }*/
        $rrows = $functions->view_vouchers();
        
        $for_issuance = 0;
        $for_claim = 0;
        $claimed = 0;
        $cancelled = 0;
        $expired = 0;
        $for_issuance_gross = 0;
        $for_claim_gross = 0;
        $claimed_gross = 0;
        $cancelled_gross = 0;
        $expired_gross = 0;
        $for_issuance_net = 0;
        $for_claim_net = 0;
        $claimed_net = 0;
        $cancelled_net = 0;
        $expired_net = 0;
        $total_gross = 0;
        $total_net = 0;

        foreach ($rrows as $index => $value): 
            if($value['status'] == "for_issuance"){
                if($filter_report_from != null && $filter_report_to != null){
                    $for_issuance_date = $functions->for_issuance_both($value['v_num'],$filter_report_from,$filter_report_to);
                } else if ($filter_report_from != null && $filter_report_to == null){
                    $for_issuance_date = $functions->for_issuance_from($value['v_num'],$filter_report_from);
                } else if ($filter_report_from == null && $filter_report_to != null){
                    $for_issuance_date = $functions->for_issuance_to($value['v_num'],$filter_report_to);
                } else {
                    $for_issuance_date = $functions->for_issuance($value['v_num']);
                }
                
                foreach ($for_issuance_date as $index2 => $value2):
                    $for_issuance = $for_issuance + 1;
                    $for_issuance_gross = $for_issuance_gross + $value2['gross'];
                    $for_issuance_net = $for_issuance_net + $value2['net'];
                    $total_gross = $total_gross + $value2['gross'];
                    $total_net = $total_net + $value2['net'];
                endforeach;
            } 
            if($value['status'] == "for_claim/for_or"){
                if($filter_report_from != null && $filter_report_to != null){
                    $for_claim_date = $functions->for_claim_both($value['v_num'],$filter_report_from,$filter_report_to);
                } else if ($filter_report_from != null && $filter_report_to == null){
                    $for_claim_date = $functions->for_claim_from($value['v_num'],$filter_report_from);
                } else if ($filter_report_from == null && $filter_report_to != null){
                    $for_claim_date = $functions->for_claim_to($value['v_num'],$filter_report_to);
                } else {
                    $for_claim_date = $functions->for_claim($value['v_num']);
                }

                foreach ($for_claim_date as $index2 => $value2):
                    $for_claim = $for_claim + 1;
                    $for_claim_gross = $for_claim_gross + $value2['gross'];
                    $for_claim_net = $for_claim_net + $value2['net'];
                    $total_gross = $total_gross + $value2['gross'];
                    $total_net = $total_net + $value2['net'];
                endforeach;
               
            } 
            if($value['status'] == "claimed"){
                if($filter_report_from != null && $filter_report_to != null){
                    $claimed_date = $functions->claimed_both($value['v_num'],$filter_report_from,$filter_report_to);
                } else if ($filter_report_from != null && $filter_report_to == null){
                    $claimed_date = $functions->claimed_from($value['v_num'],$filter_report_from);
                } else if ($filter_report_from == null && $filter_report_to != null){
                    $claimed_date = $functions->claimed_to($value['v_num'],$filter_report_to);
                } else {
                    $claimed_date = $functions->claimed($value['v_num']);
                }

                foreach ($claimed_date as $index2 => $value2):
                    $claimed = $claimed + 1;
                    $claimed_gross = $claimed_gross + $value2['gross'];
                    $claimed_net = $claimed_net + $value2['net'];
                    $total_gross = $total_gross + $value2['gross'];
                    $total_net = $total_net + $value2['net'];
                endforeach;
            } 
            if($value['status'] == "cancelled"){
                if($filter_report_from != null && $filter_report_to != null){
                    $cancelled_date = $functions->cancelled_both($value['v_num'],$filter_report_from,$filter_report_to);
                } else if ($filter_report_from != null && $filter_report_to == null){
                    $cancelled_date = $functions->cancelled_from($value['v_num'],$filter_report_from);
                } else if ($filter_report_from == null && $filter_report_to != null){
                    $cancelled_date = $functions->cancelled_to($value['v_num'],$filter_report_to);
                } else {
                    $cancelled_date = $functions->cancelled($value['v_num']);
                }

                foreach ($cancelled_date as $index2 => $value2):
                    $cancelled = $cancelled + 1;
                    $cancelled_gross = $cancelled_gross + $value2['gross'];
                    $cancelled_net = $cancelled_net + $value2['net'];
                endforeach;
            } 
            if($value['status'] == "expired"){
                if($filter_report_from != null && $filter_report_to != null){
                    $expired_date = $functions->expired_both($value['v_num'],$filter_report_from,$filter_report_to);
                } else if ($filter_report_from != null && $filter_report_to == null){
                    $expired_date = $functions->expired_from($value['v_num'],$filter_report_from);
                } else if ($filter_report_from == null && $filter_report_to != null){
                    $expired_date = $functions->expired_to($value['v_num'],$filter_report_to);
                } else {
                    $expired_date = $functions->expired($value['v_num']);
                }

                foreach ($expired_date as $index2 => $value2):
                    $expired = $expired + 1;
                    $expired_gross = $expired_gross + $value2['gross'];
                    $expired_net = $expired_net + $value2['net'];
                endforeach;
            } 
            /*if($value['status'] != "expired" && $value['status'] != "cancelled"){
                $total_gross = $total_gross + $value['gross'];
                $total_net = $total_net + $value['net'];
            }*/
        endforeach;
    } 

    // search voucher via payee for creditors
    if(isset($_POST['search']) && $_POST['search'] == "Search"){
        $vrow = $functions->view_voucher($input);
    }

    // search voucher for registered users
    if(isset($_POST['search_vc']) && $_POST['search_vc'] == "Search"){
        if($input != null){
            if($input_status!="all"){
                $v_row = $functions->v_voucher2($input,$input_status);
            } else {
                $v_row = $functions->v_voucher($input);
            }
        } else {
            if($input_status!="all"){
                $v_row = $functions->v_voucher3($input_status);
            } else {
                $v_row = $functions->view_vouchers();
            }
        }
    }

    // search account via name
    if(isset($_POST['search_acc']) && $_POST['search_acc'] == "Search"){
        $accrow = $functions->search_account($acc_input);
    }

    // cancel a voucher
    if(isset($_POST['cancel']) && $_POST['cancel'] == "Cancel"){

        $date_cancelled = date("Y-m-d");
        $cancel_vc = $functions->cancel_voucher($cancel_v_num,$cancel_status,$cancelled_by,$date_cancelled,$cancel_remarks);
        header("location:".$previous);
        //$result2 = $functions->add_report($date_cancelled,$cancel_status,$gross,$net);
        if(!$result2) echo "Error" . mysqli_error();
    }

    // filter vouchers for export
    if((isset($_POST['filter']) && $_POST['filter'] == "Filter") || isset($_POST['save_filtered']) || isset($filter_status)){
        if($filter_status == "for_claim/for_or" && $filter_payee_type != "all" && $filter_program == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2($filter_status,$filter_payee_type,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status($filter_status,$filter_payee_type);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_from($filter_status,$filter_payee_type,$filter_payee,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_from($filter_status,$filter_payee_type,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_to($filter_status,$filter_payee_type,$filter_payee,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_to($filter_status,$filter_payee_type,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3($filter_status,$filter_payee_type,$filter_from,$filter_to);
            }
        } else if($filter_status == "for_claim/for_or" && $filter_payee_type != "all" && $filter_program != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_program($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_program($filter_status,$filter_payee_type,$filter_payee,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_program($filter_status,$filter_payee_type,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_from_program($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_from_program($filter_status,$filter_payee_type,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_to_program($filter_status,$filter_payee_type,$filter_payee,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_to_program($filter_status,$filter_payee_type,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_program($filter_status,$filter_payee_type,$filter_from,$filter_to,$filter_program);
            }
        } else if($filter_status == "for_claim/for_or" && $filter_payee_type == "all" && $filter_program == "all") {
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_notype($filter_status,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype($filter_status,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype($filter_status);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype_from($filter_status,$filter_payee,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_notype_from($filter_status,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_notype_to($filter_status,$filter_payee,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_notype_to($filter_status,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_notype($filter_status,$filter_from,$filter_to);
            }
        } else if($filter_status == "for_claim/for_or" && $filter_payee_type == "all" && $filter_program != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_notype_program($filter_status,$filter_payee,$filter_from,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype_program($filter_status,$filter_payee,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype_program($filter_status,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype_from_program($filter_status,$filter_payee,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_notype_from_program($filter_status,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_notype_to_program($filter_status,$filter_payee,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_notype_to_program($filter_status,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_notype_program($filter_status,$filter_from,$filter_to,$filter_program);
            }
        }

        if($filter_status == "for_issuance" && $filter_payee_type != "all" && $filter_program == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_issuance($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2($filter_status,$filter_payee_type,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status($filter_status,$filter_payee_type);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_issuance_from($filter_status,$filter_payee_type,$filter_payee,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_issuance_from($filter_status,$filter_payee_type,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_issuance_to($filter_status,$filter_payee_type,$filter_payee,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_issuance_to($filter_status,$filter_payee_type,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_issuance($filter_status,$filter_payee_type,$filter_from,$filter_to);
            }
        } else if($filter_status == "for_issuance" && $filter_payee_type != "all" && $filter_program != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_issuance_program($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_program($filter_status,$filter_payee_type,$filter_payee,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_program($filter_status,$filter_payee_type,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_issuance_from_program($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_issuance_from_program($filter_status,$filter_payee_type,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_issuance_to_program($filter_status,$filter_payee_type,$filter_payee,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_issuance_to_program($filter_status,$filter_payee_type,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_issuance_program($filter_status,$filter_payee_type,$filter_from,$filter_to,$filter_program);
            }
        } else if($filter_status == "for_issuance" && $filter_payee_type == "all" && $filter_program == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_issuance_notype($filter_status,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype($filter_status,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype($filter_status);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_issuance_notype_from($filter_status,$filter_payee,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_issuance_notype_from($filter_status,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_issuance_notype_to($filter_status,$filter_payee,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_issuance_notype_to($filter_status,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_issuance_notype($filter_status,$filter_from,$filter_to);
            }
        } else if($filter_status == "for_issuance" && $filter_payee_type == "all" && $filter_program != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_issuance_notype_program($filter_status,$filter_payee,$filter_from,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype_program($filter_status,$filter_payee,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype_program($filter_status,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_issuance_notype_from_program($filter_status,$filter_payee,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_issuance_notype_from_program($filter_status,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_issuance_notype_to_program($filter_status,$filter_payee,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_issuance_notype_to_program($filter_status,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_issuance_notype_program($filter_status,$filter_from,$filter_to,$filter_program);
            }
        }

        if($filter_status == "claimed" && $filter_payee_type != "all" && $filter_program == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_claimed($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2($filter_status,$filter_payee_type,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status($filter_status,$filter_payee_type);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_claimed_from($filter_status,$filter_payee_type,$filter_payee,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_claimed_from($filter_status,$filter_payee_type,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_claimed_to($filter_status,$filter_payee_type,$filter_payee,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_claimed_to($filter_status,$filter_payee_type,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_claimed($filter_status,$filter_payee_type,$filter_from,$filter_to);
            }
        } else if($filter_status == "claimed" && $filter_payee_type != "all" && $filter_program != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_claimed_program($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_program($filter_status,$filter_payee_type,$filter_payee,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_program($filter_status,$filter_payee_type,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_claimed_from_program($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_claimed_from_program($filter_status,$filter_payee_type,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_claimed_to_program($filter_status,$filter_payee_type,$filter_payee,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_claimed_to_program($filter_status,$filter_payee_type,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_claimed_program($filter_status,$filter_payee_type,$filter_from,$filter_to,$filter_program);
            }
        } else if($filter_status == "claimed" && $filter_payee_type == "all" && $filter_program == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_claimed_notype($filter_status,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype($filter_status,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype($filter_status);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_claimed_notype_from($filter_status,$filter_payee,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_claimed_notype_from($filter_status,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_claimed_notype_to($filter_status,$filter_payee,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_claimed_notype_to($filter_status,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_claimed_notype($filter_status,$filter_from,$filter_to);
            }
        } else if($filter_status == "claimed" && $filter_payee_type == "all" && $filter_program != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_claimed_notype_program($filter_status,$filter_payee,$filter_from,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype_program($filter_status,$filter_payee,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype_program($filter_status,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_claimed_notype_from_program($filter_status,$filter_payee,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_claimed_notype_from_program($filter_status,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_claimed_notype_to_program($filter_status,$filter_payee,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_claimed_notype_to_program($filter_status,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_claimed_notype_program($filter_status,$filter_from,$filter_to,$filter_program);
            }
        }

        if($filter_status == "cancelled" && $filter_payee_type != "all" && $filter_program == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_cancelled($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2($filter_status,$filter_payee_type,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status($filter_status,$filter_payee_type);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_cancelled_from($filter_status,$filter_payee_type,$filter_payee,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_cancelled_from($filter_status,$filter_payee_type,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_cancelled_to($filter_status,$filter_payee_type,$filter_payee,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_cancelled_to($filter_status,$filter_payee_type,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_cancelled($filter_status,$filter_payee_type,$filter_from,$filter_to);
            }
        } else if($filter_status == "cancelled" && $filter_payee_type != "all" && $filter_program != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_cancelled_program($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_program($filter_status,$filter_payee_type,$filter_payee,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_program($filter_status,$filter_payee_type,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_cancelled_from_program($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_cancelled_from_program($filter_status,$filter_payee_type,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_cancelled_to_program($filter_status,$filter_payee_type,$filter_payee,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_cancelled_to_program($filter_status,$filter_payee_type,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_cancelled_program($filter_status,$filter_payee_type,$filter_from,$filter_to,$filter_program);
            }
        } else if($filter_status == "cancelled" && $filter_payee_type == "all" && $filter_program == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_cancelled_notype($filter_status,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype($filter_status,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype($filter_status);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_cancelled_notype_from($filter_status,$filter_payee,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_cancelled_notype_from($filter_status,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_cancelled_notype_to($filter_status,$filter_payee,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_cancelled_notype_to($filter_status,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_cancelled_notype($filter_status,$filter_from,$filter_to);
            }
        } else if($filter_status == "cancelled" && $filter_payee_type == "all" && $filter_program != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_cancelled_notype_program($filter_status,$filter_payee,$filter_from,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype_program($filter_status,$filter_payee,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype_program($filter_status,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_cancelled_notype_from_program($filter_status,$filter_payee,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_cancelled_notype_from_program($filter_status,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_cancelled_notype_to_program($filter_status,$filter_payee,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_cancelled_notype_to_program($filter_status,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_cancelled_notype_program($filter_status,$filter_from,$filter_to,$filter_program);
            }
        }

        if($filter_status == "expired" && $filter_payee_type != "all" && $filter_program == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_expired($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2($filter_status,$filter_payee_type,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status($filter_status,$filter_payee_type);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_expired_from($filter_status,$filter_payee_type,$filter_payee,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_expired_from($filter_status,$filter_payee_type,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_expired_to($filter_status,$filter_payee_type,$filter_payee,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_expired_to($filter_status,$filter_payee_type,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_expired($filter_status,$filter_payee_type,$filter_from,$filter_to);
            }
        } else if($filter_status == "expired" && $filter_payee_type != "all" && $filter_program != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_expired_program($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_program($filter_status,$filter_payee_type,$filter_payee,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_program($filter_status,$filter_payee_type,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_expired_from_program($filter_status,$filter_payee_type,$filter_payee,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_expired_from_program($filter_status,$filter_payee_type,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_expired_to_program($filter_status,$filter_payee_type,$filter_payee,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_expired_to_program($filter_status,$filter_payee_type,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_expired_program($filter_status,$filter_payee_type,$filter_from,$filter_to,$filter_program);
            }
        } else if($filter_status == "expired" && $filter_payee_type == "all" && $filter_program == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_expired_notype($filter_status,$filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype($filter_status,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype($filter_status);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_expired_notype_from($filter_status,$filter_payee,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_expired_notype_from($filter_status,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_expired_notype_to($filter_status,$filter_payee,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_expired_notype_to($filter_status,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_expired_notype($filter_status,$filter_from,$filter_to);
            }
        } else if($filter_status == "expired" && $filter_payee_type == "all" && $filter_program != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_expired_notype_program($filter_status,$filter_payee,$filter_from,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_notype_program($filter_status,$filter_payee,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_notype_program($filter_status,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_expired_notype_from_program($filter_status,$filter_payee,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_expired_notype_from_program($filter_status,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_expired_notype_to_program($filter_status,$filter_payee,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_expired_notype_to_program($filter_status,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_expired_notype_program($filter_status,$filter_from,$filter_to,$filter_program);
            }
        }

        if($filter_status == "all" && $filter_payee_type != "all" && $filter_program == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_all($filter_payee,$filter_payee_type,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_all($filter_payee_type,$filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_all($filter_payee_type);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_all_from($filter_payee_type,$filter_payee,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_all_from($filter_payee_type,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_all_to($filter_payee_type,$filter_payee,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_all_to($filter_payee_type,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_all($filter_payee_type,$filter_from,$filter_to);
            }
        } else if($filter_status == "all" && $filter_payee_type != "all" && $filter_program != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_all_program($filter_payee,$filter_payee_type,$filter_from,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_all_program($filter_payee_type,$filter_payee,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_all_program($filter_payee_type,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_all_from_program($filter_payee_type,$filter_payee,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_all_from_program($filter_payee_type,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_all_to_program($filter_payee_type,$filter_payee,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_all_to_program($filter_payee_type,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_all_program($filter_payee_type,$filter_from,$filter_to,$filter_program);
            }
        } else if($filter_status == "all" && $filter_payee_type == "all" && $filter_program == "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_all_notype($filter_payee,$filter_from,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_all_notype($filter_payee);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_all_notype();
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_all_notype_from($filter_payee,$filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_all_notype_from($filter_from);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_all_notype_to($filter_payee,$filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_all_notype_to($filter_to);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_all_notype($filter_from,$filter_to);
            }
        } else if($filter_status == "all" && $filter_payee_type == "all" && $filter_program != "all"){
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers_all_notype_program($filter_payee,$filter_from,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_all_notype_program($filter_payee,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to == null){
                $filter_row = $functions->filter_status_all_notype_program($filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_vouchers2_all_notype_from_program($filter_payee,$filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to == null){
                $filter_row = $functions->filter_status_all_notype_from_program($filter_from,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee != null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_vouchers2_all_notype_to_program($filter_payee,$filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from == null && $filter_to != null){
                $filter_row = $functions->filter_status_all_notype_to_program($filter_to,$filter_program);
            }
            if($filter_status != null && $filter_payee_type != null && $filter_payee == null && $filter_from != null && $filter_to != null){
                $filter_row = $functions->filter_vouchers3_all_notype_program($filter_from,$filter_to,$filter_program);
            }
        }
    }

    // view notifications
    if(isset($nf_select) && $nf_select == "yes"){
        $nrows = $functions->view_notif($anum);
        $accrows = $functions->view_accounts();
    }

    // check notifications
    if(isset($f171_select) || isset($f184_select) || isset($nf_select) || isset($pr_select) || isset($vc_select) || isset($acc_select)){
        $check = $functions->view_vouchers();
        $accounts = $functions->view_accounts();
        $notifications = $functions->view_notif_status($anum);
        $notif_count = mysqli_num_rows($notifications);
        $notif = $functions->view_notif($anum);

        foreach ($check as $index => $value):
            if( ($value['payment_type'] == "cheque") && ($value['status'] == "for_claim/for_or") && ($value['notif_reference'] == 0) ){
                $curr_date = date("Y-m-d");
                $released_date = $value['date_released']; // date released
                $expire_date = date('Y-m-d', strtotime("+3 months", strtotime($released_date))); // expiration (after 3 months for cheque)
                $check_date = date('Y-m-d', strtotime("-2 weeks", strtotime($expire_date)));

                $date = date_create($expire_date);
                $date2 = date_format($date,"M-d-Y");

                    if($curr_date >= $check_date){
                        $payee = $value['payee'];
                        $reference = $value['warrant_num'];
                        $detail = "Near expiry date" ;
                        $days_left = 14;

                        foreach ($accounts as $index2 => $value2):
                            if(($value2['usertype'] != "Admin") && ($value2['usertype'] != "AA")){
                                $result = $functions->insert_notif_cheque($payee,$detail,$reference,$value2['account_num'],$days_left,$expire_date); 
                                //setcookie("days_left","days_left",time()+86400);
                            }
                        endforeach;

                        $flag = 1;
                        $result2 = $functions->set_notif_ref($flag,$value['v_num']);
                    }
            } 
            if( ($value['payment_type'] == "ADA") && ($value['status'] == "claimed") && ($value['payee_type'] == "employee") && ($value['or_num'] == "") && ($value['notif_reference'] == 0) ){
                $curr_date = date("Y-m-d");
                $released_date = $value['date_released'];
                $check_date = date('Y-m-d', strtotime("+2 days", strtotime($released_date)));

                    if($curr_date >= $check_date){
                        $payee = $value['payee'];
                        $reference = $value['warrant_num'];
                        $detail = "No receipt";
                        
                        foreach ($accounts as $index2 => $value2):
                            if(($value2['usertype'] != "Admin") && ($value2['usertype'] != "AA")){
                                $result = $functions->insert_notif_ada($payee,$detail,$reference,$value2['account_num']); 
                            }
                        endforeach;

                        $flag = 1;
                        $result2 = $functions->set_notif_ref($flag,$value['v_num']);
                    }
            }
        endforeach;

        foreach($notif as $index3 => $value3):
            if($value3['days_left']>0){
                $curr_date = date("Y-m-d");
                $expire = strtotime($value3['expire_date']); //Future date.
                $timefromdb = strtotime($curr_date);
                $timeleft = $expire-$timefromdb;
                $daysleft = round((($timeleft/24)/60)/60); 
                $result = $functions->update_days_left($daysleft,$value3['notif_num']);
                //echo $daysleft . "<br>";
            }
        endforeach;
    }

    if(isset($_POST['save']) && $_POST['save'] == "Save"){
        $filter_row = $functions->view_vouchers();
    }

    if(isset($_POST['adsearch']) && $_POST['adsearch'] == "Search"){
        if($adsearch_fund == 'both'){
            if($adsearch_payee != null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_all($adsearch_payee,$adsearch_gross,$adsearch_net,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_no_warrant($adsearch_payee,$adsearch_gross,$adsearch_net,$adsearch_obnum);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_no_obnum($adsearch_payee,$adsearch_gross,$adsearch_net,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_no_net($adsearch_payee,$adsearch_gross,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_no_gross($adsearch_payee,$adsearch_net,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_no_payee($adsearch_gross,$adsearch_net,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_no_warrant_and_obnum($adsearch_payee,$adsearch_gross,$adsearch_net);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_no_warrant_and_net($adsearch_payee,$adsearch_gross,$adsearch_obnum);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_no_warrant_and_gross($adsearch_payee,$adsearch_net,$adsearch_obnum);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_no_warrant_and_payee($adsearch_gross,$adsearch_net,$adsearch_obnum);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_no_obnum_and_payee($adsearch_gross,$adsearch_net,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_no_obnum_and_gross($adsearch_payee,$adsearch_net,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_no_obnum_and_net($adsearch_payee,$adsearch_gross,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_no_net_and_gross($adsearch_payee,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_no_net_and_payee($adsearch_gross,$adsearch_obnum,$adsearch_warrant);

            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_no_gross_and_payee($adsearch_net,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_payee_and_gross($adsearch_payee,$adsearch_gross);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_payee_and_net($adsearch_payee,$adsearch_net);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_payee_and_obnum($adsearch_payee,$adsearch_obnum);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_payee_and_warrant($adsearch_payee,$adsearch_warrant);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_gross_and_net($adsearch_gross,$adsearch_net);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_gross_and_obnum($adsearch_gross,$adsearch_obnum);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_gross_and_warrant($adsearch_gross,$adsearch_warrant);
            
            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_net_and_obnum($adsearch_net,$adsearch_obnum);
            
            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_net_and_warrant($adsearch_net,$adsearch_warrant);
            
            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_obnum_and_warrant($adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->v_voucher($adsearch_payee);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->v_voucher($adsearch_gross);
            
            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->v_voucher($adsearch_net);
            
            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->v_voucher($adsearch_obnum);
            
            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->v_voucher($adsearch_warrant);
            
            } 
        } else {
            if($adsearch_payee != null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_all($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_net,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_fund_and_no_warrant($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_net,$adsearch_obnum);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_no_obnum($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_net,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_no_net($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_no_gross($adsearch_fund,$adsearch_payee,$adsearch_net,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_no_payee($adsearch_fund,$adsearch_gross,$adsearch_net,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_fund_and_no_warrant_and_obnum($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_net);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_fund_and_no_warrant_and_net($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_obnum);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_fund_and_no_warrant_and_gross($adsearch_fund,$adsearch_payee,$adsearch_net,$adsearch_obnum);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_fund_and_no_warrant_and_payee($adsearch_fund,$adsearch_gross,$adsearch_net,$adsearch_obnum);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_no_obnum_and_payee($adsearch_fund,$adsearch_gross,$adsearch_net,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_no_obnum_and_gross($adsearch_fund,$adsearch_payee,$adsearch_net,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_no_obnum_and_net($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_no_net_and_gross($adsearch_fund,$adsearch_payee,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_no_net_and_payee($adsearch_fund,$adsearch_gross,$adsearch_obnum,$adsearch_warrant);

            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_no_gross_and_payee($adsearch_fund,$adsearch_net,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_fund_and_payee_and_gross($adsearch_fund,$adsearch_payee,$adsearch_gross);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_fund_and_payee_and_net($adsearch_fund,$adsearch_payee,$adsearch_net);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_fund_and_payee_and_obnum($adsearch_fund,$adsearch_payee,$adsearch_obnum);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_payee_and_warrant($adsearch_fund,$adsearch_payee,$adsearch_warrant);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_fund_and_gross_and_net($adsearch_fund,$adsearch_gross,$adsearch_net);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_fund_and_gross_and_obnum($adsearch_fund,$adsearch_gross,$adsearch_obnum);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_gross_and_warrant($adsearch_fund,$adsearch_gross,$adsearch_warrant);
            
            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->adsearch_fund_and_net_and_obnum($adsearch_fund,$adsearch_net,$adsearch_obnum);
            
            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_net_and_warrant($adsearch_fund,$adsearch_net,$adsearch_warrant);
            
            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant != null){
                $adsearch = $functions->adsearch_fund_and_obnum_and_warrant($adsearch_fund,$adsearch_obnum,$adsearch_warrant);
            
            } else if ($adsearch_payee != null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->v_voucher4($adsearch_payee,$adsearch_fund);
            
            } else if ($adsearch_payee == null && $adsearch_gross != null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->v_voucher4($adsearch_gross,$adsearch_fund);
            
            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net != null && $adsearch_obnum == null && $adsearch_warrant == null){
                $adsearch = $functions->v_voucher4($adsearch_net,$adsearch_fund);
            
            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum != null && $adsearch_warrant == null){
                $adsearch = $functions->v_voucher4($adsearch_obnum,$adsearch_fund);
            
            } else if ($adsearch_payee == null && $adsearch_gross == null && $adsearch_net == null && $adsearch_obnum == null && $adsearch_warrant != null){
                $adsearch = $functions->v_voucher4($adsearch_warrant,$adsearch_fund);
            
            } 
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