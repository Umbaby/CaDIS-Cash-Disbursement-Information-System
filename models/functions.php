<?php include "../models/dbconnect.php"; 

    class functions extends dbconnect {

        // --------------- GET CONNECTION FUNCTION --------------- //
        function get_con(){
            $conn = $this->con;
            return $conn;
        }

        // ----------------- ACCOUNTS FUNCTIONS ------------------ //
        function view_accounts(){
            $query = "SELECT * FROM accounts ORDER BY fname ASC; ";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function create_account($e_id,$fname,$mname,$lname,$extension,$gender,$unit,$usertype,$username,$password,$img){
            $query = "INSERT INTO accounts (employee_id,fname,mname,lname,extension,gender,unit,usertype,username,pass,image)
                    values ('$e_id','$fname','$mname','$lname','$extension','$gender','$unit','$usertype','$username','$password','$img');";

            $result = mysqli_query($this->con,$query);
            if($result) return true;
            else return false;
            exit;
        }

        function edit_account($employee_id,$fname,$mname,$lname,$extension,$gender,$unit,$usertype,$username,$password,$status,$account_num){
            $query = "UPDATE accounts SET
                        employee_id = '$employee_id',
                        fname = '$fname',
                        mname = '$mname',
                        lname = '$lname',
                        extension = '$extension',
                        gender = '$gender',
                        unit = '$unit',
                        usertype = '$usertype',
                        username = '$username',
                        pass = '$password',
                        status = '$status'
                        
                        WHERE account_num ='$account_num';";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function upload_pic($name,$anum){
            $query = "UPDATE accounts SET image = '$name' WHERE account_num = '$anum';";

            $result = mysqli_query($this->con,$query);
            if($result) return true;
            else return false;
            exit;
        }

        function search_account($acc){
            $query = "SELECT * FROM accounts WHERE CONCAT_WS(' ',fname,mname,lname) LIKE '%$acc%' OR CONCAT_WS(' ',fname,lname) LIKE '%$acc%' OR CONCAT_WS(' ',fname,mname) LIKE '%$acc%' OR fname LIKE '%$acc%' OR mname LIKE '%$acc%' OR lname LIKE '%$acc%' OR username LIKE '%$acc%' OR employee_id LIKE '%$acc%' ORDER BY fname ASC;";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function view_profile($anum){
            $query = "SELECT * FROM accounts WHERE account_num = '$anum'; ";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function account_fetch($term){
            $query = "SELECT * FROM accounts WHERE fname LIKE '%$term%' OR mname LIKE '%$term%' OR lname LIKE '%$term%'; ";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function unit_fetch($term){
            $query = "SELECT DISTINCT unit FROM accounts WHERE unit LIKE '%$term%'; ";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        // --------------------- VOUCHER FUNCTIONS ---------------------- //
        function check_warrant_array($warrant){
            $a = 0;
            foreach($warrant as $index => $value):
                $query = "SELECT * FROM vouchers WHERE (warrant_num = '$value'); ";
                $result = mysqli_query($this->con,$query);
                if($result) $a++;
            endforeach;

            return $a;
            exit;
        }

        function check_warrant($warrant){
            $query = "SELECT * FROM vouchers WHERE (warrant_num = '$warrant'); ";
                
            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return false;
            exit;
        }

        function warrant_fetch($warrant){
            $query = "SELECT warrant_num FROM vouchers WHERE (warrant_num = '$warrant'); ";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function receipt_fetch($term){
            $query = "SELECT or_num FROM vouchers WHERE (or_num = '$term'); ";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function particular_fetch($term){
            $query = "SELECT DISTINCT particular FROM vouchers WHERE (particular LIKE '%$term%'); ";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function voucher_fetch($term){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$term%' OR ob_num LIKE = '$term' OR gross = '$term' OR net = '$term' OR warrant_num = '$term') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or'); ";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function fund101_fetch($term){
            $query = "SELECT * FROM vouchers WHERE (fund = '101') AND (payee LIKE '%$term%' OR ob_num = '$term' OR gross = '$term' OR net = '$term' OR warrant_num = '$term') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or'); ";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function fund102_fetch($term){
            $query = "SELECT * FROM vouchers WHERE (fund = '102') AND (payee LIKE '%$term%' OR ob_num = '$term' OR gross = '$term' OR net = '$term' OR warrant_num = '$term') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or'); ";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function fund171_fetch($term){
            $query = "SELECT * FROM vouchers WHERE (fund = '171') AND (payee LIKE '%$term%' OR ob_num = '$term' OR gross = '$term' OR net = '$term' OR warrant_num = '$term') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or'); ";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function fund184_fetch($term){
            $query = "SELECT * FROM vouchers WHERE (fund = '101-184') AND (payee LIKE '%$term%' OR ob_num = '$term' OR gross = '$term' OR net = '$term' OR warrant_num = '$term') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or'); ";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function index_fetch($term){
            $query = "SELECT * FROM vouchers WHERE payee LIKE '%$term%' AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status = 'for_issuance') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function re_issue($v_num,$re_issued_by,$date_re_issued,$gross,$net,$warrant){
            $query = "UPDATE vouchers SET status = 'for_issuance', 
                                    re_issued_by = '$re_issued_by',
                                    date_re_issued = '$date_re_issued',
                                    gross = '$gross',
                                    net = '$net',
                                    warrant_num = '$warrant' 
                                    
                                    WHERE v_num = '$v_num';";

            $result = mysqli_query($this->con,$query);
            if($result) return true;
            else return false;
            exit;
        }

        function re_issue2($v_num,$re_issued_by,$date_re_issued,$gross,$net,$warrant){
            $query = "UPDATE vouchers SET status = 'for_claim/for_or', 
                                    re_issued_by = '$re_issued_by',
                                    date_re_issued = '$date_re_issued',
                                    gross = '$gross',
                                    net = '$net',
                                    warrant_num = '$warrant'  
                                    
                                    WHERE v_num = '$v_num';";

            $result = mysqli_query($this->con,$query);
            if($result) return true;
            else return false;
            exit;
        }

        function view_vouchers(){
            $query = "SELECT * FROM vouchers WHERE ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function view_vouchers2($limit){
            $query = "SELECT * FROM vouchers WHERE ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function v_voucher($input){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$input%' OR ob_num = '$input' OR gross = '$input' OR net = '$input' OR warrant_num = '$input') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function v_voucher2($input,$status){
            $query = "SELECT * FROM vouchers WHERE (status = '$status') AND (payee LIKE '%$input%' OR ob_num = '$input' OR gross = '$input' OR warrant_num = '$input') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function v_voucher3($status){
            $query = "SELECT * FROM vouchers WHERE (status = '$status') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function v_voucher4($input,$fund){
            $query = "SELECT * FROM vouchers WHERE (fund = '$fund') AND (payee LIKE '%$input%' OR ob_num = '$input' OR gross = '$input' OR net = '$input' OR warrant_num = '$input') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function view_voucher($input){
            $query = "SELECT * FROM vouchers WHERE payee LIKE '%$input%' AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status = 'for_issuance') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function view_vc($v_num){
            $query = "SELECT * FROM vouchers WHERE v_num = '$v_num'  ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function view_warrant(){
            $query = "SELECT DISTINCT warrant_num FROM vouchers ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return false;
            exit;
        }

        function tag_vc($v_num,$warrant,$date_r,$status,$tagger){
            $query = "UPDATE vouchers SET
                    warrant_num = '$warrant',
                    date_released = '$date_r',
                    status = '$status',
                    released_tagger = '$tagger'
                    
                    WHERE v_num = '$v_num';";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function claim_vc($v_num,$or_num,$date_issue,$date_claimed,$status,$tagger){
            $query = "UPDATE vouchers SET
                    or_num = '$or_num',
                    date_issue = '$date_issue',
                    date_claimed = '$date_claimed',
                    status = '$status',
                    claimed_tagger = '$tagger'
                    
                    WHERE v_num = '$v_num';";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function c_expire($v_num,$c_edate){
            $query = "UPDATE vouchers SET status = 'expired', date_expire = '$c_edate' WHERE  v_num = '$v_num';";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function a_claim($v_num,$a_edate){
            $query = "UPDATE vouchers SET status = 'claimed', date_claimed = '$a_edate' WHERE  v_num = '$v_num';";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function add_voucher($date_e,$time,$payee,$particular,$from,$to,$etal,$obno,$gross,$net,$fund,$program,$remarks,$status,$payment_type,$payee_type,$fullname){
            $query = "INSERT INTO vouchers (date_encoded,time_encoded,payee,particular,period_from,period_to,et_al,ob_num,gross,net,fund,program,remarks,status,payment_type,payee_type,encoded_by)
                        VALUES ('$date_e','$time','$payee','$particular','$from','$to','$etal','$obno','$gross','$net','$fund','$program','$remarks','$status','$payment_type','$payee_type','$fullname');";

            $result = mysqli_query($this->con,$query);
            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function add_vc_et_at($date_encoded,$time_encoded,$payee,$particular,$period_from,$period_to,$et_al,$ob_num,$gross,$net,$fund,$program,$remarks,$status,$payment_type,$warrant,$date_r,$tagger){
            $query = "INSERT INTO vouchers (date_encoded,time_encoded,payee,particular,period_from,period_to,et_al,ob_num,gross,net,fund,program,remarks,status,payment_type,warrant_num,date_released,released_tagger)
                        VALUES ('$date_encoded','$time_encoded','$payee','$particular','$period_from','$period_to','$et_al','$ob_num','$gross','$gross','$fund','$program','$remarks','$status','$payment_type','$warrant','$date_r','$tagger');";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function update_voucher_status($status,$date_r,$tagger,$v_num){
            $query = "UPDATE vouchers SET status = '$status', date_released = '$date_r', released_tagger = '$tagger' WHERE v_num = '$v_num';";
        
            $result = mysqli_query($this->con,$query);
            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function get_gross(){
            $query = "SELECT gross FROM vouchers ORDER BY v_num DESC LIMIT 1;";

            $result = mysqli_query($this->con,$query);
            if($result) return $result;
            else return FALSE;
            exit;
        }

        function edit_voucher($v_num,$new_date_encoded,$new_payee,$new_particular,$new_period_from,$new_period_to,$new_et_al,$new_ob_num,$new_gross,$new_net,$new_fund,$new_program,$new_remarks,$new_payment_type,$new_payee_type,$new_warrant_num,$new_date_released,$new_or_num,$new_date_issue,$new_date_claimed){
            $query = "UPDATE vouchers SET
                        date_encoded = '$new_date_encoded',
                        payee = '$new_payee',
                        particular = '$new_particular',
                        period_from = '$new_period_from',
                        period_to = '$new_period_to',
                        et_al = '$new_et_al',
                        ob_num = '$new_ob_num',
                        gross = '$new_gross',
                        net = '$new_net',
                        fund = '$new_fund',
                        program = '$new_program',
                        remarks = '$new_remarks',
                        payment_type = '$new_payment_type',
                        payee_type = '$new_payee_type',
                        warrant_num = '$new_warrant_num',
                        date_released = '$new_date_released',
                        or_num = '$new_or_num',
                        date_issue = '$new_date_issue',
                        date_claimed = '$new_date_claimed'

                        WHERE v_num = '$v_num';";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function cancel_voucher($cancel_v_num,$cancel_status,$cancelled_by,$date_cancelled,$cancel_remarks){
            $query = "UPDATE vouchers SET status = '$cancel_status', cancelled_tagger = '$cancelled_by', date_cancelled = '$date_cancelled', cancel_remarks = '$cancel_remarks'
                        WHERE v_num = '$cancel_v_num';";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function view_fund101(){
            $query = "SELECT * FROM vouchers WHERE fund = '101' AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function search_fund101($input){
            $query = "SELECT * FROM vouchers WHERE (fund = '101' AND (payee LIKE '%$input%' OR ob_num = '$input' OR gross = '$input' OR warrant_num = '$input')) AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function search_fund101_2($input,$status){
            $query = "SELECT * FROM vouchers WHERE (fund = '101' AND status = '$status' AND (payee LIKE '%$input%' OR ob_num = '$input' OR gross = '$input' OR warrant_num = '$input')) AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function search_fund101_3($status){
            $query = "SELECT * FROM vouchers WHERE (fund = '101' AND status = '$status') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function view_fund102(){
            $query = "SELECT * FROM vouchers WHERE fund = '102' AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function search_fund102($input){
            $query = "SELECT * FROM vouchers WHERE (fund = '102' AND (payee LIKE '%$input%' OR ob_num = '$input' OR gross = '$input' OR warrant_num = '$input')) AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function search_fund102_2($input,$status){
            $query = "SELECT * FROM vouchers WHERE (fund = '102' AND status = '$status' AND (payee LIKE '%$input%' OR ob_num = '$input' OR gross = '$input' OR warrant_num = '$input')) AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function search_fund102_3($status){
            $query = "SELECT * FROM vouchers WHERE (fund = '102' AND status = '$status') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function view_fund171(){
            $query = "SELECT * FROM vouchers WHERE fund = '171' AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function search_fund171($input){
            $query = "SELECT * FROM vouchers WHERE (fund = '171' AND (payee LIKE '%$input%' OR ob_num = '$input' OR gross = '$input' OR warrant_num = '$input')) AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function search_fund171_2($input,$status){
            $query = "SELECT * FROM vouchers WHERE (fund = '171' AND status = '$status' AND (payee LIKE '%$input%' OR ob_num = '$input' OR gross = '$input' OR warrant_num = '$input')) AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function search_fund171_3($status){
            $query = "SELECT * FROM vouchers WHERE (fund = '171' AND status = '$status') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function view_fund184(){
            $query = "SELECT * FROM vouchers WHERE fund = '101-184' AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function search_fund184($input){
            $query = "SELECT * FROM vouchers WHERE (fund = '101-184' AND (payee LIKE '%$input%' OR ob_num = '$input' OR gross = '$input' OR warrant_num = '$input')) AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function search_fund184_2($input,$status){
            $query = "SELECT * FROM vouchers WHERE (fund = '101-184' AND status = '$status' AND (payee LIKE '%$input%' OR ob_num = '$input' OR gross = '$input' OR warrant_num = '$input')) AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function search_fund184_3($status){
            $query = "SELECT * FROM vouchers WHERE (fund = '101-184' AND status = '$status') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        // ----------------- FILTER VOUCHERS FUNCTIONS ----------------- //

        function filter_vouchers($status,$payee_type,$payee,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%' AND date_released >= '$from' AND date_released <= '$to') AND (status = 'for_claim/for_or' AND warrant_num != '') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2($status,$payee_type,$payee){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_from($status,$payee_type,$payee,$from){
            $query = "SELECT * FROM vouchers WHERE (date_released >= '$from' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_to($status,$payee_type,$payee,$to){
            $query = "SELECT * FROM vouchers WHERE (date_released <= '$to' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_issuance_from($status,$payee_type,$payee,$from){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_issuance_to($status,$payee_type,$payee,$to){
            $query = "SELECT * FROM vouchers WHERE (date_encoded <= '$to' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_claimed_from($status,$payee_type,$payee,$from){
            $query = "SELECT * FROM vouchers WHERE (date_claimed >= '$from' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_claimed_to($status,$payee_type,$payee,$to){
            $query = "SELECT * FROM vouchers WHERE (date_claimed <= '$to' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_cancelled_from($status,$payee_type,$payee,$from){
            $query = "SELECT * FROM vouchers WHERE (date_cancelled >= '$from' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_cancelled_to($status,$payee_type,$payee,$to){
            $query = "SELECT * FROM vouchers WHERE (date_cancelled <= '$to' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_expired_from($status,$payee_type,$payee,$from){
            $query = "SELECT * FROM vouchers WHERE (date_expire >= '$from' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_expired_to($status,$payee_type,$payee,$to){
            $query = "SELECT * FROM vouchers WHERE (date_expire <= '$to' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_from_program($status,$payee_type,$payee,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_released >= '$from' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_to_program($status,$payee_type,$payee,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_released <= '$to' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_issuance_from_program($status,$payee_type,$payee,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_encoded >= '$from' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_issuance_to_program($status,$payee_type,$payee,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_encoded <= '$to' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_claimed_from_program($status,$payee_type,$payee,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_claimed >= '$from' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_claimed_to_program($status,$payee_type,$payee,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_claimed <= '$to' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_cancelled_from_program($status,$payee_type,$payee,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_cancelled >= '$from' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_cancelled_to_program($status,$payee_type,$payee,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_cancelled <= '$to' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_expired_from_program($status,$payee_type,$payee,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_expire >= '$from' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_expired_to_program($status,$payee_type,$payee,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_expire <= '$to' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3($status,$payee_type,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND date_released >= '$from' AND date_released <= '$to') AND (status = 'for_claim/for_or' AND warrant_num != '') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_program($status,$payee_type,$payee,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%' AND date_released >= '$from' AND date_released <= '$to' AND program = '$program') AND (status = 'for_claim/for_or' AND warrant_num != '') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_program($status,$payee_type,$payee,$program){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%' AND program = '$program') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_program($status,$payee_type,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND date_released >= '$from' AND date_released <= '$to' AND program = '$program') AND (status = 'for_claim/for_or' AND warrant_num != '') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_notype($status,$payee,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee LIKE '%$payee%' AND date_released >= '$from' AND date_released <= '$to') AND (status = 'for_claim/for_or' AND warrant_num != '') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_notype($status,$payee){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_notype_from($status,$payee,$from){
            $query = "SELECT * FROM vouchers WHERE (date_released >= '$from' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_notype_to($status,$payee,$to){
            $query = "SELECT * FROM vouchers WHERE (date_released <= '$to' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_issuance_notype_from($status,$payee,$from){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from' AND status = '$status' AND payee LIKE '%$payee%') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_issuance_notype_to($status,$payee,$to){
            $query = "SELECT * FROM vouchers WHERE (date_encoded <= '$to' AND status = '$status' AND payee LIKE '%$payee%') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_claimed_notype_from($status,$payee,$from){
            $query = "SELECT * FROM vouchers WHERE (date_claimed >= '$from' AND status = '$status' AND payee LIKE '%$payee%') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_claimed_notype_to($status,$payee,$to){
            $query = "SELECT * FROM vouchers WHERE (date_claimed <= '$to' AND status = '$status' AND payee LIKE '%$payee%') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_cancelled_notype_from($status,$payee,$from){
            $query = "SELECT * FROM vouchers WHERE (date_cancelled >= '$from' AND status = '$status' AND payee LIKE '%$payee%') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_cancelled_notype_to($status,$payee,$to){
            $query = "SELECT * FROM vouchers WHERE (date_cancelled <= '$to' AND status = '$status' AND payee LIKE '%$payee%') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_expired_notype_from($status,$payee,$from){
            $query = "SELECT * FROM vouchers WHERE (date_expire >= '$from' AND status = '$status' AND payee LIKE '%$payee%') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_expired_notype_to($status,$payee,$to){
            $query = "SELECT * FROM vouchers WHERE (date_expire <= '$to' AND status = '$status' AND payee LIKE '%$payee%') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_notype_from_program($status,$payee,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_released >= '$from' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_notype_to_program($status,$payee,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_released <= '$to' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_issuance_notype_from_program($status,$payee,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_encoded >= '$from' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_issuance_notype_to_program($status,$payee,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_encoded <= '$to' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_claimed_notype_from_program($status,$payee,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_claimed >= '$from' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_claimed_notype_to_program($status,$payee,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_claimed <= '$to' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_cancelled_notype_from_program($status,$payee,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_cancelled >= '$from' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_cancelled_notype_to_program($status,$payee,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_cancelled <= '$to' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_expired_notype_from_program($status,$payee,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_expire >= '$from' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_expired_notype_to_program($status,$payee,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_expire <= '$to' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_notype($status,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND date_released >= '$from' AND date_released <= '$to') AND (status = 'for_claim/for_or' AND warrant_num != '') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_notype_program($status,$payee,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee LIKE '%$payee%' AND date_released >= '$from' AND date_released <= '$to') AND (status = 'for_claim/for_or' AND warrant_num != '') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_notype_program($status,$payee,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_notype_program($status,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND date_released >= '$from' AND date_released <= '$to') AND (status = 'for_claim/for_or' AND warrant_num != '') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_issuance($status,$payee_type,$payee,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%' AND date_encoded >= '$from' AND date_encoded <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_issuance($status,$payee_type,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND date_encoded >= '$from' AND date_encoded <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_issuance_program($status,$payee_type,$payee,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%' AND date_encoded >= '$from' AND date_encoded <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_issuance_program($status,$payee_type,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee_type = '$payee_type' AND date_encoded >= '$from' AND date_encoded <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_issuance_notype($status,$payee,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee LIKE '%$payee%' AND date_encoded >= '$from' AND date_encoded <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_issuance_notype($status,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND date_encoded >= '$from' AND date_encoded <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_issuance_notype_program($status,$payee,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee LIKE '%$payee%' AND date_encoded >= '$from' AND date_encoded <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_issuance_notype_program($status,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND date_encoded >= '$from' AND date_encoded <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_claimed($status,$payee_type,$payee,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%' AND date_claimed >= '$from' AND date_claimed <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_claimed($status,$payee_type,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND date_claimed >= '$from' AND date_claimed <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_claimed_program($status,$payee_type,$payee,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%' AND date_claimed >= '$from' AND date_claimed <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_claimed_program($status,$payee_type,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee_type = '$payee_type' AND date_claimed >= '$from' AND date_claimed <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_claimed_notype($status,$payee,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee LIKE '%$payee%' AND date_claimed >= '$from' AND date_claimed <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_claimed_notype($status,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND date_claimed >= '$from' AND date_claimed <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_claimed_notype_program($status,$payee,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee LIKE '%$payee%' AND date_claimed >= '$from' AND date_claimed <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_claimed_notype_program($status,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND date_claimed >= '$from' AND date_claimed <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }
        
        function filter_vouchers_cancelled($status,$payee_type,$payee,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%' AND date_cancelled >= '$from' AND date_cancelled <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_cancelled($status,$payee_type,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND date_cancelled >= '$from' AND date_cancelled <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_cancelled_program($status,$payee_type,$payee,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%' AND date_cancelled >= '$from' AND date_cancelled <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_cancelled_program($status,$payee_type,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee_type = '$payee_type' AND date_cancelled >= '$from' AND date_cancelled <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_cancelled_notype($status,$payee,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee LIKE '%$payee%' AND date_cancelled >= '$from' AND date_cancelled <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_cancelled_notype($status,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND date_cancelled >= '$from' AND date_cancelled <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_cancelled_notype_program($status,$payee,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee LIKE '%$payee%' AND date_cancelled >= '$from' AND date_cancelled <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_cancelled_notype_program($status,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND date_cancelled >= '$from' AND date_cancelled <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_expired($status,$payee_type,$payee,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%' AND date_expire >= '$from' AND date_expire <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_expired($status,$payee_type,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type' AND date_expire >= '$from' AND date_expire <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_expired_program($status,$payee_type,$payee,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee_type = '$payee_type' AND payee LIKE '%$payee%' AND date_expire >= '$from' AND date_expire <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_expired_program($status,$payee_type,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee_type = '$payee_type' AND date_expire >= '$from' AND date_expire <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_expired_notype($status,$payee,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee LIKE '%$payee%' AND date_expire >= '$from' AND date_expire <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_expired_notype($status,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND date_expire >= '$from' AND date_expire <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_expired_notype_program($status,$payee,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee LIKE '%$payee%' AND date_expire >= '$from' AND date_expire <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_expired_notype_program($status,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND date_expire >= '$from' AND date_expire <= '$to') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_all($payee_type,$payee,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (payee_type = '$payee_type' AND payee LIKE '%$payee%' AND date_encoded >= '$from' AND date_encoded <= '$to') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_all($payee_type,$payee){
            $query = "SELECT * FROM vouchers WHERE (payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_all_from($payee_type,$payee,$from){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_all_to($payee_type,$payee,$to){
            $query = "SELECT * FROM vouchers WHERE (date_encoded <= '$to' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_all($payee_type,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (payee_type = '$payee_type' AND date_encoded >= '$from' AND date_encoded <= '$to') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_all_program($payee_type,$payee,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND payee_type = '$payee_type' AND payee LIKE '%$payee%' AND date_encoded >= '$from' AND date_encoded <= '$to') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_all_program($payee_type,$payee,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_all_from_program($payee_type,$payee,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from' AND program = '$program' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_all_to_program($payee_type,$payee,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (date_encoded <= '$to' AND program = '$program' AND payee_type = '$payee_type' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_all_program($payee_type,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND payee_type = '$payee_type' AND date_encoded >= '$from' AND date_encoded <= '$to') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_all($payee_type){
            $query = "SELECT * FROM vouchers WHERE (payee_type = '$payee_type') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_all_from($payee_type,$from){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from' AND payee_type = '$payee_type') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_all_to($payee_type,$to){
            $query = "SELECT * FROM vouchers WHERE (date_encoded <= '$to' AND payee_type = '$payee_type') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_all_program($payee_type,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND payee_type = '$payee_type') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_all_from_program($payee_type,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from' AND program = '$program' AND payee_type = '$payee_type') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_all_to_program($payee_type,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (date_encoded <= '$to' AND program = '$program' AND payee_type = '$payee_type') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_all_notype($payee,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$payee%' AND date_encoded >= '$from' AND date_encoded <= '$to') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_all_notype($payee){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_all_notype_from($payee,$from){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_all_notype_to($payee,$to){
            $query = "SELECT * FROM vouchers WHERE (date_encoded <= '$to' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_all_notype($from,$to){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from' AND date_encoded <= '$to') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers_all_notype_program($payee,$from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND payee LIKE '%$payee%' AND date_encoded >= '$from' AND date_encoded <= '$to') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_all_notype_program($payee,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_all_notype_from_program($payee,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from' AND program = '$program' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers2_all_notype_to_program($payee,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (date_encoded <= '$to' AND program = '$program' AND payee LIKE '%$payee%') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_vouchers3_all_notype_program($from,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_encoded >= '$from' AND date_encoded <= '$to') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_all_notype(){
            $query = "SELECT * FROM vouchers WHERE ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_all_notype_from($from){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_all_notype_to($to){
            $query = "SELECT * FROM vouchers WHERE (date_encoded <= '$to') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_all_notype_program($program){
            $query = "SELECT * FROM vouchers WHERE ((program = '$program' AND status = 'for_claim/for_or' AND warrant_num != '') OR (program = '$program' AND status != 'for_claim/for_or')) ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_all_notype_from_program($from,$program){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from') AND ((program = '$program' AND status = 'for_claim/for_or' AND warrant_num != '') OR (program = '$program' AND status != 'for_claim/for_or')) ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_all_notype_to_program($to,$program){
            $query = "SELECT * FROM vouchers WHERE (date_encoded <= '$to') AND ((program = '$program' AND status = 'for_claim/for_or' AND warrant_num != '') OR (program = '$program' AND status != 'for_claim/for_or')) ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status($status,$payee_type){
            $query = "SELECT * FROM vouchers WHERE (status = '$status' AND payee_type = '$payee_type') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_from($status,$payee_type,$from){
            $query = "SELECT * FROM vouchers WHERE (date_released >= '$from' AND status = '$status' AND payee_type = '$payee_type') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_to($status,$payee_type,$to){
            $query = "SELECT * FROM vouchers WHERE (date_released <= '$to' AND status = '$status' AND payee_type = '$payee_type') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_issuance_from($status,$payee_type,$from){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_issuance_to($status,$payee_type,$to){
            $query = "SELECT * FROM vouchers WHERE (date_encoded <= '$to' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_claimed_from($status,$payee_type,$from){
            $query = "SELECT * FROM vouchers WHERE (date_claimed >= '$from' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_claimed_to($status,$payee_type,$to){
            $query = "SELECT * FROM vouchers WHERE (date_claimed <= '$to' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_cancelled_from($status,$payee_type,$from){
            $query = "SELECT * FROM vouchers WHERE (date_cancelled >= '$from' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_cancelled_to($status,$payee_type,$to){
            $query = "SELECT * FROM vouchers WHERE (date_cancelled <= '$to' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_expired_from($status,$payee_type,$from){
            $query = "SELECT * FROM vouchers WHERE (date_expire >= '$from' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_expired_to($status,$payee_type,$to){
            $query = "SELECT * FROM vouchers WHERE (date_expire <= '$to' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_from_program($status,$payee_type,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_released >= '$from' AND status = '$status' AND payee_type = '$payee_type') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_to_program($status,$payee_type,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_released <= '$to' AND status = '$status' AND payee_type = '$payee_type') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_issuance_from_program($status,$payee_type,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_encoded >= '$from' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_issuance_to_program($status,$payee_type,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_encoded <= '$to' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_claimed_from_program($status,$payee_type,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_claimed >= '$from' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_claimed_to_program($status,$payee_type,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_claimed <= '$to' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_cancelled_from_program($status,$payee_type,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_cancelled >= '$from' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_cancelled_to_program($status,$payee_type,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_cancelled <= '$to' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_expired_from_program($status,$payee_type,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_expire >= '$from' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_expired_to_program($status,$payee_type,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_expire <= '$to' AND status = '$status' AND payee_type = '$payee_type') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_notype($status){
            $query = "SELECT * FROM vouchers WHERE (status = '$status') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_notype_from($status,$from){
            $query = "SELECT * FROM vouchers WHERE (date_released >= '$from' AND status = '$status') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_notype_to($status,$to){
            $query = "SELECT * FROM vouchers WHERE (date_released <= '$to' AND status = '$status') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_issuance_notype_from($status,$from){
            $query = "SELECT * FROM vouchers WHERE (date_encoded >= '$from' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_issuance_notype_to($status,$to){
            $query = "SELECT * FROM vouchers WHERE (date_encoded <= '$to' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_claimed_notype_from($status,$from){
            $query = "SELECT * FROM vouchers WHERE (date_claimed >= '$from' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_claimed_notype_to($status,$to){
            $query = "SELECT * FROM vouchers WHERE (date_claimed <= '$to' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_cancelled_notype_from($status,$from){
            $query = "SELECT * FROM vouchers WHERE (date_cancelled >= '$from' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_cancelled_notype_to($status,$to){
            $query = "SELECT * FROM vouchers WHERE (date_cancelled <= '$to' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_expired_notype_from($status,$from){
            $query = "SELECT * FROM vouchers WHERE (date_expire >= '$from' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_expired_notype_to($status,$to){
            $query = "SELECT * FROM vouchers WHERE (date_expire <= '$to' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_notype_from_program($status,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_released >= '$from' AND status = '$status') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_notype_to_program($status,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_released <= '$to' AND status = '$status') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_issuance_notype_from_program($status,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_encoded >= '$from' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_issuance_notype_to_program($status,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_encoded <= '$to' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_claimed_notype_from_program($status,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_claimed >= '$from' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_claimed_notype_to_program($status,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_claimed <= '$to' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_cancelled_notype_from_program($status,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_cancelled >= '$from' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_cancelled_notype_to_program($status,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_cancelled <= '$to' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_expired_notype_from_program($status,$from,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_expire >= '$from' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_expired_notype_to_program($status,$to,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND date_expire <= '$to' AND status = '$status') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_program($status,$payee_type,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status' AND payee_type = '$payee_type') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function filter_status_notype_program($status,$program){
            $query = "SELECT * FROM vouchers WHERE (program = '$program' AND status = '$status') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        // ---------------- ADVANCE SEARCH VOUCHERS FUNCTIONS ------------------- //

        function adsearch_all($adsearch_payee,$adsearch_gross,$adsearch_net,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return 1;
            exit;
        }

        function adsearch_no_warrant($adsearch_payee,$adsearch_gross,$adsearch_net,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_obnum($adsearch_payee,$adsearch_gross,$adsearch_net,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND net = '$adsearch_net' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_net($adsearch_payee,$adsearch_gross,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_gross($adsearch_payee,$adsearch_net,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_payee($adsearch_gross,$adsearch_net,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (gross = '$adsearch_gross' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_warrant_and_obnum($adsearch_payee,$adsearch_gross,$adsearch_net){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND net = '$adsearch_net') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_warrant_and_net($adsearch_payee,$adsearch_gross,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_warrant_and_gross($adsearch_payee,$adsearch_net,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_warrant_and_payee($adsearch_gross,$adsearch_net,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (gross = '$adsearch_gross' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }
        
        function adsearch_no_obnum_and_payee($adsearch_gross,$adsearch_net,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (gross = '$adsearch_gross' AND net = '$adsearch_net' AND warrant_num = '$adsearch_warrant') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_obnum_and_gross($adsearch_payee,$adsearch_net,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND net = '$adsearch_net' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_obnum_and_net($adsearch_payee,$adsearch_gross,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_net_and_gross($adsearch_payee,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_net_and_payee($adsearch_gross,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (gross = '$adsearch_gross' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_no_gross_and_payee($adsearch_net,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (net = '$adsearch_net' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_payee_and_gross($adsearch_payee,$adsearch_gross){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_payee_and_net($adsearch_payee,$adsearch_net){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND net = '$adsearch_net') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_payee_and_obnum($adsearch_payee,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_payee_and_warrant($adsearch_payee,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (payee LIKE '%$adsearch_payee%' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_gross_and_net($adsearch_gross,$adsearch_net){
            $query = "SELECT * FROM vouchers WHERE (gross = '$adsearch_gross' AND net = '$adsearch_net') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_gross_and_obnum($adsearch_gross,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (gross = '$adsearch_gross' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_gross_and_warrant($adsearch_gross,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (gross = '$adsearch_gross' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_net_and_obnum($adsearch_net,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (net = '$adsearch_net' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_net_and_warrant($adsearch_net,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (net = '$adsearch_net' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_obnum_and_warrant($adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_all($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_net,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_warrant($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_net,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_obnum($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_net,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND net = '$adsearch_net' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_net($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_gross($adsearch_fund,$adsearch_payee,$adsearch_net,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_payee($adsearch_fund,$adsearch_gross,$adsearch_net,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND gross = '$adsearch_gross' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_warrant_and_obnum($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_net){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND net = '$adsearch_net') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_warrant_and_net($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_warrant_and_gross($adsearch_fund,$adsearch_payee,$adsearch_net,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_warrant_and_payee($adsearch_fund,$adsearch_gross,$adsearch_net,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND gross = '$adsearch_gross' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }
        
        function adsearch_fund_and_no_obnum_and_payee($adsearch_fund,$adsearch_gross,$adsearch_net,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND gross = '$adsearch_gross' AND net = '$adsearch_net' AND warrant_num = '$adsearch_warrant') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_obnum_and_gross($adsearch_fund,$adsearch_payee,$adsearch_net,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND net = '$adsearch_net' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_obnum_and_net($adsearch_fund,$adsearch_payee,$adsearch_gross,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_net_and_gross($adsearch_fund,$adsearch_payee,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_net_and_payee($adsearch_fund,$adsearch_gross,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND gross = '$adsearch_gross' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_no_gross_and_payee($adsearch_fund,$adsearch_net,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_payee_and_gross($adsearch_fund,$adsearch_payee,$adsearch_gross){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND gross = '$adsearch_gross') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_payee_and_net($adsearch_fund,$adsearch_payee,$adsearch_net){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND net = '$adsearch_net') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_payee_and_obnum($adsearch_fund,$adsearch_payee,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_payee_and_warrant($adsearch_fund,$adsearch_payee,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND payee LIKE '%$adsearch_payee%' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_gross_and_net($adsearch_fund,$adsearch_gross,$adsearch_net){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND gross = '$adsearch_gross' AND net = '$adsearch_net') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_gross_and_obnum($adsearch_fund,$adsearch_gross,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND gross = '$adsearch_gross' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_gross_and_warrant($adsearch_fund,$adsearch_gross,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND gross = '$adsearch_gross' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_net_and_obnum($adsearch_fund,$adsearch_net,$adsearch_obnum){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND net = '$adsearch_net' AND ob_num = '$adsearch_obnum') AND ((status = 'for_claim/for_or' AND warrant_num != '') OR status != 'for_claim/for_or') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_net_and_warrant($adsearch_fund,$adsearch_net,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND net = '$adsearch_net' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function adsearch_fund_and_obnum_and_warrant($adsearch_fund,$adsearch_obnum,$adsearch_warrant){
            $query = "SELECT * FROM vouchers WHERE (fund = '$adsearch_fund' AND ob_num = '$adsearch_obnum' AND warrant_num = '$adsearch_warrant') ORDER BY v_num DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        // ---------------- NOTIFICATIONS FUNCTIONS -------------------- //
        function view_notif($anum){
            $query = "SELECT notif_num, payee, notif_detail, created_at, reference, days_left, expire_date FROM notifications WHERE recipient = '$anum' ORDER BY created_at DESC;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function view_notif2($anum,$limit){
            $query = "SELECT notif_num, payee, notif_detail, created_at, reference, days_left, expire_date FROM notifications WHERE recipient = '$anum' ORDER BY created_at DESC LIMIT $limit;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function view_notif_status($anum){
            $query = "SELECT notif_num, payee, notif_detail, created_at, reference, days_left, expire_date FROM notifications WHERE recipient = '$anum' AND (status = 0);";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function update_notif($anum){
            $query = "UPDATE notifications SET status = 1 WHERE status = 0 AND recipient = '$anum';";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function insert_notif_cheque($payee,$detail,$reference,$recipient,$days_left,$expire_date){
            $query = "INSERT INTO notifications (payee,notif_detail,reference,recipient,days_left,expire_date) VALUES ('$payee','$detail','$reference','$recipient','$days_left','$expire_date');";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function insert_notif_cheque2($payee,$detail,$reference,$expire_date,$recipient){
            $query = "INSERT INTO notifications (payee,notif_detail,reference,expire_date,recipient) VALUES ('$payee','$detail','$reference','$expire_date','$recipient');";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function insert_notif_ada($payee,$detail,$reference,$recipient){
            $query = "INSERT INTO notifications (payee,notif_detail,reference,recipient) VALUES ('$payee','$detail','$reference','$recipient');";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function set_notif_ref($flag,$vnum){
            $query = "UPDATE vouchers SET notif_reference = '$flag' WHERE v_num = '$vnum';";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function update_days_left($days,$notif_num){
            $query = "UPDATE notifications SET days_left = '$days' WHERE notif_num = '$notif_num';";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        // --------------- REPORT FUNCTIONS ------------------- //

        function for_issuance_both($vnum,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'for_issuance') AND (date_encoded >= '$from' AND date_encoded <= '$to') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function for_issuance_from($vnum,$from){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'for_issuance') AND (date_encoded >= '$from') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function for_issuance_to($vnum,$to){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'for_issuance') AND (date_encoded <= '$to') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function for_issuance($vnum){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'for_issuance') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function for_claim_both($vnum,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'for_claim/for_or' AND warrant_num != '') AND (date_released >= '$from' AND date_released <= '$to') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function for_claim_from($vnum,$from){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'for_claim/for_or' AND warrant_num != '') AND (date_released >= '$from') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function for_claim_to($vnum,$to){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'for_claim/for_or' AND warrant_num != '') AND (date_released <= '$to') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function for_claim($vnum){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'for_claim/for_or' AND warrant_num != '') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function claimed_both($vnum,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'claimed') AND (date_claimed >= '$from' AND date_claimed <= '$to') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function claimed_from($vnum,$from){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'claimed') AND (date_claimed >= '$from') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function claimed_to($vnum,$to){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'claimed') AND (date_claimed <= '$to') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function claimed($vnum){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'claimed');";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function cancelled_both($vnum,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'cancelled') AND (date_cancelled >= '$from' AND date_cancelled <= '$to') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function cancelled_from($vnum,$from){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'cancelled') AND (date_cancelled >= '$from') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function cancelled_to($vnum,$to){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'cancelled') AND (date_cancelled <= '$to') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function cancelled($vnum){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'cancelled');";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function expired_both($vnum,$from,$to){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'expired') AND (date_expire >= '$from' AND date_expire <= '$to') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function expired_from($vnum,$from){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'expired') AND (date_expire >= '$from') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function expired_to($vnum,$to){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'expired') AND (date_expire <= '$to') ;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }

        function expired($vnum){
            $query = "SELECT * FROM vouchers WHERE (v_num = $vnum) AND (status = 'expired');";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }
        /*
        function view_all_report(){
            $query = "SELECT * FROM reports;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }
        
        function add_report($date,$status,$gross,$net){
            $query = "INSERT reports (report_date,status,gross,net) VALUES ('$date','$status','$gross','$net');";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function edit_report($gross,$net,$v_num){
            $query = "UPDATE reports (gross,net) VALUES ('$gross','$net') WHERE v_num = '$v_num';";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }
        */
        // --------------- ACTIVITY FUNCTIONS ----------------- //

        function insert_activity($detail){
            $query = "INSERT INTO activity (activity_detail) VALUES ('$detail');";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function insert_activity2($detail,$updated_by){
            $query = "INSERT INTO activity (activity_detail,updated_by) VALUES ('$detail','$updated_by');";

            $result = mysqli_query($this->con,$query);

            if($result) return TRUE;
            else return FALSE;
            exit;
        }

        function view_activity(){
            $query = "SELECT * FROM activity;";

            $result = mysqli_query($this->con,$query);

            if($result) return $result;
            else return FALSE;
            exit;
        }
    }

?>