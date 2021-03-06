<?php session_start();
    include "../controllers/viewfunction.php";

    if(isset($_SESSION['usertype']) && (($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype'] == "Claim/OR officer" || $_SESSION['usertype'] == "Releasing officer")){
      $date = date_create(date("Y-m-d"));
      $current = date_format($date,"M d,Y");
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <head>
        <title>CaDIS</title>
        <link rel="shortcut icon" href="img/favicon.png">

        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- bootstrap theme -->
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <!--external css-->
        <!-- font icon -->
        <link href="css/elegant-icons-style.css" rel="stylesheet" />
        <link href="css/font-awesome.min.css" rel="stylesheet" />
        <!-- full calendar css-->
        <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
        <link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
        <!-- easy pie chart-->
        <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
        <!-- owl carousel -->
        <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
        <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
        <!-- Custom styles -->
        <link rel="stylesheet" href="css/fullcalendar.css">
        <link href="css/widgets.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
        <link href="css/xcharts.min.css" rel=" stylesheet">
        <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
        <script src="js/jquery2.js" type="text/javascript"></script>
	<script type="text/javascript">

	function myFunction2() {
		$.ajax({
			url: "../controllers/view_notification.php",
			type: "POST",
			processData:false,
			success: function(data){
				$("#notification-count").remove();					
				$("#notification-latest").show();$("#notification-latest").html(data);
			},
			error: function(){}           
		});
	 }
	 
	 $(document).ready(function() {
		$('body').click(function(e){
			if ( e.target.id != 'notification-icon'){
				$("#notification-latest").hide();
			}
		});
	});
		 
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
            $("body").css("display", "none");
            $("body").fadeIn(250);
            $("a.transition").click(function(event){
                event.preventDefault();
                linkLocation = this.href;
                $("body").fadeOut(250, redirectPage);      
            });
                
            function redirectPage() {
                window.location = linkLocation;
            }
    });
</script>

  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    </head>

    <body>  

    <!-- container section start -->
  <section id="container" class="">


<header class="header dark-bg">
<div class="toggle-nav">
  <div class="icon-reorder tooltips" data-placement="bottom"><i class="icon_menu"></i></div>
</div>

  <!--logo start-->
  
    <a href="index.php" class="logo">
        <img src= "img/dswd2.png" class= "img-logo">
      DSWD XI - CaDIS
    </a>
  <!--logo end-->


  <div class="top-nav notification-row">
  <form action="<?php $_PHP_SELF; ?>" method="POST">
     <button type= "submit" name= "logout" class= "buttons-2"> <i class= "fa fa-sign-out"></i>
            <a onclick="return confirm('Logout?');"> LOG OUT </a>
    </button>

  </form>  
  </div>
    
</header>
<!--header end-->

<!--sidebar start-->
<aside>
  <div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu">
    
    <div class="container" style="color:gray;background-color:white">
      <h4 id="date_time"></h4>
    </div>

    <li id= "sidemenu">
      <a class="transition"href="profile.php?pr_select=yes">
      <?php foreach($accrows as $index => $value): ?>
                    <?php if($value['image']==null && $value['account_num'] == $_SESSION['anum']){ ?>
                      <center><img src= "img/prof.png" class="profilepic" align="center"></center>
                    <?php } else if($value['image']!=null && $value['account_num'] == $_SESSION['anum']) { 
                        $image = $value['image'];
                        $image_src = "img/".$image; ?>
                      
                        <center><img src= "<?php echo $image_src; ?>" class="profilepic"></center>
                    <?php } ?>
            <?php  endforeach;  ?>
                    <!--<i class="fa fa-user"></i>--><br>
                    <center>
                    <span>
                    <?php if(isset($_SESSION['name'])){ echo "My Profile ( " . $_SESSION['name'] . " )"; } ?>
                    </span> <!-- name of user -->
                    </center>
      </a>
    </li>

    <?php if(isset($_SESSION['usertype']) && $_SESSION['usertype'] != "Admin" && $_SESSION['usertype'] !="AA"){ ?>
      <li id= "sidemenu">
      
      <a class="transition" id="notification-icon" onclick="myFunction2()" href="notifications.php?nf_select=yes">
      <?php if($notif_count>0) { ?>
            <span id="notification-count">
              <?php echo $notif_count; ?>
            </span>
          <?php } ?>
                    <i class="fa fa-bell"></i>
                    <span> Notifications </span>          
      </a>
  
      <div id="notification-latest"></div>
  </li>
    <?php } ?>
    
    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype'] == "Admin" || $_SESSION['usertype'] == "Encoder")){ ?>
    <li id= "sidemenu">
        <a class="transition" href="accounts.php?acc_select=yes">
                      <i class="fa fa-users"></i>
                      <span>Manage Accounts</span>
        </a>
      </li>
    <?php } ?>

    <?php if(isset($_SESSION['usertype']) && $_SESSION['usertype'] != "Admin"){ ?>
    <li id= "sidemenu">
        <a class="transition" href="vouchers.php?vc_select=yes">
                      <i class="fa fa-file-text"></i>
                      <span> Manage Vouchers </span>
                      
        </a>
        </li>
        <?php } ?>

        <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype'] == "Encoder" || $_SESSION['usertype'] == "Encoder2")){ ?>
    <li id= "sidemenu">
        <a class="transition" href="addvoucher.php">
                      <i class="fa fa-files-o"></i>
                      <span> New Transaction </span>
                      
        </a>
        </li>
        <?php } ?>

        <?php if(isset($_SESSION['usertype']) && $_SESSION['usertype'] !="AA" && $_SESSION['usertype'] !="Admin"){ ?>
    <li id= "sidemenu">
            <a class="transition" href="export.php?vc_select=yes">
                        <i class="fa fa-file-excel-o"></i>
                      <span> Export </span>
            </a>
    </li>
    
    <?php } ?>

    <?php if(isset($_SESSION['usertype']) && $_SESSION['usertype'] !="AA" && $_SESSION['usertype'] !="Admin"){ ?>
    <li id= "sidemenu">
            <a class="transition" href="reports.php?r_select=yes">
                        <i class="fa fa-calendar-o"></i>
                      <span> Timely Reports </span>
            </a>
    </li>
    
    <?php } ?>


  </ul>
  <!-- sidebar menu end-->
  
      
  </div>
</aside>
<!--sidebar end-->

<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <!--overview start-->
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-file-excel-o"></i>
          Export Table to Excel
        </h3> <!-- name of user -->
        <ol class="breadcrumb" align= "center"> 

      <div class="modal fade" id="pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <form action="<?php $_PHP_SELF; ?>" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><strong><h3 class="modal-title" id="myModalLabel">Enter Information</h3></strong></center>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <div class="form-group input-group">
                      <span class="input-group-addon" style="width:150px;">Status:</span>
                      <select class="details-field-a" style="width:350px;height:50px;" id="filter_status" name="filter_status">
                        <option name="all" value="all">All types</option>
                        <option name="for_issuance" value="for_issuance">On Process</option>
                        <option name="for_claim/for_or" value="for_claim/for_or">For Claim/Receipt</option>
                        <option name="claimed" value="claimed">Claimed</option>
                        <option name="cancelled" value="cancelled">Cancelled</option>
                        <option name="expired" value="expired">Stale</option>
                      </select>
                    </div>
                    <div class="form-group input-group">
                      <span class="input-group-addon" style="width:150px;">Program Type:</span>
                      <select class= "details-field-a" style="width:350px;height:50px;" id="filter_program" name="filter_program">
                        <option name="all" value="all">All types</option>  
                        <option name="BANG-UN" value="BANG-UN">BANG-UN</option>
                        <option name="CBB" value="CBB">CBB</option>
                        <option name="CENTENARIAN" value="CENTENARIAN">CENTENARIAN</option>
                        <option name="CENTER" value="CENTER">CENTER</option>
                        <option name="CENTER BASED" value="CENTER BASED">CENTER BASED</option>
                        <option name="COMMUNITY BASED" value="COMMUNITY BASED">COMMUNITY BASED</option>
                        <option name="COMPREHENSIVE" value="COMPREHENSIVE">COMPREHENSIVE</option>
                        <option name="DRRP PROPER/CC" value="DRRP PROPER/CC">DRRP PROPER/CC</option>
                        <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)" value="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                        <option name="ICTMS" value="ICTMS">ICTMS</option>
                        <option name="KALAHI-NCDDP ADB" value="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                        <option name="KALAHI-NCDDP GOP" value="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                        <option name="KALAHI-NCDDP WB" value="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                        <option name="KC-PAMANA" value="KC-PAMANA">KC-PAMANA</option>
                        <option name="NEW TRUST FUND" value="NEW TRUST FUND">NEW TRUST FUND</option>
                        <option name="NHTSPR" value="NHTSPR">NHTSPR</option>
                        <option name="PANTAWID" value="PANTAWID">PANTAWID</option>
                        <option name="PDPB" value="PDPB">PDPB</option>
                        <option name="PRPTP" value="PRPTP">PRPTP</option>
                        <option name="PSF ADOPTION" value="PSF ADOPTION">PSF ADOPTION</option>
                        <option name="PSP-AICS CURRENT CMF" value="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                        <option name="PWD/DP" value="PWD/DP">PWD/DP</option>
                        <option name="REGULAR TRUST FUND" value="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                        <option name="SB" value="SB">SB</option>
                        <option name="SFP" value="SFP">SFP</option>
                        <option name="SLP (DR)" value="SLP (DR)">SLP (DR)</option>
                        <option name="SOCTECH" value="SOCTECH">SOCTECH</option>
                        <option name="SP (DR)" value="SP (DR)">SP (DR)</option>
                        <option name="TARA" value="TARA">TARA</option>
                        <option name="UCT VALIDATION" value="UCT VALIDATION">UCT VALIDATION</option>
                        <option name="UWATO" value="UWATO">UWATO</option>
                      </select>
                    </div>
                    <div class="form-group input-group">
                      <span class="input-group-addon" style="width:150px;">Payee Type:</span>
                      <select class="details-field-a" style="width:350px;height:50px;" id="filter_payee_type" name="filter_payee_type">
                          <option name="all" value="all">All types</option>
                          <option name="creditor" value="creditor">Creditor</option>
                          <option name="employee" value="employee">Employee</option>
                      </select>
                    </div>
                    <div class="form-group input-group">
                      <span class="input-group-addon" style="width:150px;">Payee:</span>
                      <input type="text" class="details-field-a" style="width:350px;height:50px;" id="filter_payee" name="filter_payee" placeholder="  Input here.."/>
                    </div>
                    <div class="form-group input-group">
                      <span class="input-group-addon" style="width:150px;">From:</span>
                      <input class="details-field-a" style="width:250;height:50px;" type="date" id="filter_from" name="filter_from"/>
                    </div>					
                    <div class="form-group input-group">
                      <span class="input-group-addon" style="width:150px;">To:</span>
                      <input class="details-field-a" style="width:250;height:50px;" type="date" id="filter_to" name="filter_to"/>
                    </div>
                    <input type="submit" class="btn btn-default" name="filter" onclick="myFunction()" value="Filter"/>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>

        <div class= "div-div">
        <form action="<?php $_PHP_SELF; ?>" method="POST">
            <input type="hidden" name="limit" value="<?php echo $view_limit; ?>"/>
            <!--<button type="submit" class="buttons-2" name="show_more"/>Show More&nbsp&nbsp&nbsp<i class="fa fa-eye"></i></button>-->
            <button type="button" class="buttons-2" id="filter" data-toggle="modal" data-target="#pop"/>Enter Filter Fields</button>
            <a class="cancel" href="export.php?vc_select=yes">Cancel</a>
        </form>
        </div>

        <?php if(isset($_POST['filter']) || isset($_POST['save_filtered'])){ ?>
            <?php if(isset($filter_row) && $filter_row->num_rows>0){ ?>
            <div class= "div-div">
            <table class="table-acct">
            <thead style="background-color:#2c3531">
                <tr>
                    <th style="border-top-left-radius:15px;width:100px">Status</th>
                    <th style="width:100px">Date Encoded</th>
                    <th style="width:105px">Payee</th>
                    <th style="width:100px">Gross Amount</th>
                    <th style="width:100px">Check/ADA Number</th>
                    <th style="width:100px">&nbsp&nbsp&nbsp&nbsp&nbsp&nbspDate &nbsp&nbsp&nbsp&nbsp&nbsp&nbspReleased</th>
                    <th style="width:110px">Receipt Number</th>
                    <th style="width:110px">Date Issued</th>
                    <!--<th style="width:100px">Date Claimed</th>-->
                    <th style="width:110px">Claimed By</th>
                    <th style="width:110px">Date Cancelled</th>
                    <th style="border-top-right-radius:15px;width:100px">Expiry Date</th>
                </tr>
            </thead>
            </table>
            </div>

            <div class= "table-voucher2">
            <table class="table-acct" id="item_table">
            <tbody>
            <?php foreach($filter_row as $index => $value): ?>
                <tr>
                <?php if($value['status'] == "for_issuance"){ ?>
                        <td style="width:100px"><?php echo "<p style='color:darkslategrey;font-weight:bold'>On Process</p>"; ?></td>
                    <?php } else if($value['status'] == "for_claim/for_or" && $value['payment_type'] == "cheque"){ ?>
                        <td style="width:100px"><?php echo "<p style='color:darkblue;font-weight:bold'>For Claim</p>"; ?></td>
                    <?php } else if($value['status'] == "for_claim/for_or" && $value['payment_type'] == "ADA"){ ?>
                        <td style="width:100px"><?php echo "<p style='color:darkblue;font-weight:bold'>For Receipt</p>"; ?></td>
                    <?php } else if($value['status'] == "claimed") { ?>
                        <td style="width:100px"><?php echo "<p style='color:green;font-weight:bold'>Claimed</p>"; ?></td>
                    <?php } else if($value['status'] == "cancelled") { ?>
                        <td style="width:100px"><?php echo "<p style='color:orange;font-weight:bold'>Cancelled</p>"; ?></td>
                    <?php } else if($value['status'] == "expired") { ?>
                        <td style="width:100px"><?php echo "<p style='color:red;font-weight:bold'>Stale</p>"; ?></td>
                    <?php } ?>

                    <td style="width:100px"><?php if($value['date_encoded']>0){ $date=date_create($value['date_encoded']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>
                    <td style="width:100px"><?php echo $value['payee']; ?></td>
                    <td style="width:100px"><?php echo "₱". number_format($value['gross'],2,'.',','); ?></td>
                    <td style="width:100px"><?php echo $value['warrant_num']; ?></td>
                    <td style="width:100px"><?php if($value['date_released']>0){ $date=date_create($value['date_released']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>
                    <td style="width:100px"><?php echo $value['or_num']; ?></td>
                    <td style="width:100px"><?php if($value['date_issue']>0){ $date=date_create($value['date_issue']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>
                    <!--<td style="width:100px"><?php //if($value['date_claimed']>0){ $date=date_create($value['date_claimed']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>-->
                    <td style="width:100px"><?php echo $value['claimed_by']; ?></td>
                    <td style="width:100px"><?php if($value['date_cancelled']>0){ $date=date_create($value['date_cancelled']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>
                    <td style="width:100px"><?php if($value['date_expire']>0){ $date=date_create($value['date_expire']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
            </div>

            <div class="export-btn">

            <?php if($top == null){ ?>
            <button type="button" class="buttons-2" data-toggle="modal" data-target="#myModal1">
              <i class="fa fa-file-pdf-o"></i>&nbsp&nbsp    
                Export to PDF
            </button>
            <?php } else { ?>
            <input type="submit" class="buttons-2" onclick="printDiv();" value="Print Report"/>
            <?php } ?>

            <!-- Modal -->
            <div class="modal fade" id="myModal1" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">
                <form action="<?php $_PHP_SELF; ?>" method="POST">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Enter Information</h2>
                  </div>
                  <div class="modal-body" align="left">
                    <input type="hidden" class="details-field2" id="filter_status" name="filter_status" value="<?php echo $_POST['filter_status']; ?>"/>
                    <input type="hidden" class="details-field2" id="filter_program" name="filter_program" value="<?php echo $_POST['filter_program']; ?>"/>
                    <input type="hidden" class="details-field2" id="payee_type" name="filter_payee_type" value="<?php echo $_POST['filter_payee_type']; ?>"/>
                    <input type="hidden" class="details-field2" id="payee" name="filter_payee" value="<?php echo $_POST['filter_payee']; ?>" />
                    <input type="hidden" class="details-field2" id="from" name="filter_from" value="<?php echo $_POST['filter_from']; ?>" />
                    <input type="hidden" class="details-field2" id="to" name="filter_to" value="<?php echo $_POST['filter_to']; ?>" />
                    TO: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="top" name="top" /><br><br>
                    Position: &nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="top_position" name="top_position" /><br><br>
                    THRU: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="thru" name="thru" /><br><br>
                    Position: &nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="thru_position" name="thru_position" /><br><br>
                    FOCAL PERSON:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="focal_person" name="focal_person" /><br><br>
                    Position: &nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="focal_position" name="focal_position" value="Focal Person"/><br><br>
                    <div class= "div-div">
                    <table class="table-acct2">
                      <thead style="background-color:#2c3531" >
                          <tr>
                              <th style="width:40px">&nbsp&nbsp&nbspPayee</th>
                              <th style="width:90px">Gross Amount</th>
                              <th style="width:130px">Remarks</th>
                          </tr>
                      </thead>
                      </table>
                    </div>

                      <div class= "table-voucher3">
                      <table class="table-acct">
                      <tbody>
                      <?php $a=1; foreach($filter_row as $index => $value): ?>
                          <tr>
                              <td style="width:100px"><?php echo $value['payee']; ?></td>
                              <td style="width:100px"><?php echo "₱". number_format($value['gross'],2,'.',','); ?></td>
                              <td style="width:100px">
                                <input type="text" class="details-field3" id="remarks" name="remarks[<?php echo $a; ?>]" />
                              </td>
                          </tr>
                      <?php $a++; endforeach; ?>
                      </tbody>
                    </table>
                    </div><br>
                    Date Issued From: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    Deadline: 
                    <input type="date" style="width:230px;" class="details-field-a" id="issued_from" name="issued_from" />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <input type="date" style="width:230px;" class="details-field-a" id="deadline" name="deadline" />
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-default" name="save_filtered" value="Save"/>
                  </div>
                </form>
                </div>
                
              </div>
            </div>
            <!-- end Modal -->

            <button type="button" class="buttons-2">
                <a href="download.php?ex_select=yes&filter_status=<?php echo $_POST['filter_status']; ?>&payee_type=<?php echo $_POST['filter_payee_type']; ?>&payee=<?php echo $_POST['filter_payee']; ?>&from=<?php echo $_POST['filter_from']; ?>&to=<?php echo $_POST['filter_to']; ?>" >
                  <i class="fa fa-file-excel-o"></i>
                  &nbsp&nbspExport to Excel
                </a><br>
            </button>
            <input type="button" class="buttons" id="seeMoreRecords" value="Show More">
            <input type="button" class="buttons" id="seeLessRecords" value="Show Less">
            </div>

            
            <?php } else { ?>
                <h4 class="alert2">No items matched your search</h4>
            <?php } ?>
            

        <?php } else { ?>
          <div class= "div-div">
            <table class="table-acct">
            <thead style="background-color:#2c3531">
                <tr>
                    <th style="border-top-left-radius:15px;width:100px">Status</th>
                    <th style="width:100px">Date Encoded</th>
                    <th style="width:105px">Payee</th>
                    <th style="width:100px">Gross Amount</th>
                    <th style="width:100px">Check/ADA Number</th>
                    <th style="width:100px">&nbsp&nbsp&nbsp&nbsp&nbsp&nbspDate &nbsp&nbsp&nbsp&nbsp&nbsp&nbspReleased</th>
                    <th style="width:110px">Receipt Number</th>
                    <th style="width:110px">Date Issued</th>
                    <!--<th style="width:100px">Date Claimed</th>-->
                    <th style="width:110px">Claimed By</th>
                    <th style="width:110px">Date Cancelled</th>
                    <th style="border-top-right-radius:15px;width:100px">Expiry Date</th>
                </tr>
            </thead>
            </table>
          </div>

            <div class= "table-voucher2">
            <table class="table-acct" id="item_table">
            <tbody>
            <?php foreach($vrows as $index => $value): ?>
                <tr>
                    <?php if($value['status'] == "for_issuance"){ ?>
                        <td style="width:100px"><?php echo "<p style='color:darkslategrey;font-weight:bold'>On Process</p>"; ?></td>
                    <?php } else if($value['status'] == "for_claim/for_or" && $value['payment_type'] == "cheque"){ ?>
                        <td style="width:100px"><?php echo "<p style='color:darkblue;font-weight:bold'>For Claim</p>"; ?></td>
                    <?php } else if($value['status'] == "for_claim/for_or" && $value['payment_type'] == "ADA"){ ?>
                        <td style="width:100px"><?php echo "<p style='color:darkblue;font-weight:bold'>For Receipt</p>"; ?></td>
                    <?php } else if($value['status'] == "claimed") { ?>
                        <td style="width:100px"><?php echo "<p style='color:green;font-weight:bold'>Claimed</p>"; ?></td>
                    <?php } else if($value['status'] == "cancelled") { ?>
                        <td style="width:100px"><?php echo "<p style='color:orange;font-weight:bold'>Cancelled</p>"; ?></td>
                    <?php } else if($value['status'] == "expired") { ?>
                        <td style="width:100px"><?php echo "<p style='color:red;font-weight:bold'>Stale</p>"; ?></td>
                    <?php } ?>

                    <td style="width:100px"><?php if($value['date_encoded']>0){ $date=date_create($value['date_encoded']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>
                    <td style="width:100px"><?php echo $value['payee']; ?></td>
                    <td style="width:100px"><?php echo "₱". number_format($value['gross'],2,'.',','); ?></td>
                    <td style="width:100px"><?php echo $value['warrant_num']; ?></td>
                    <td style="width:100px"><?php if($value['date_released']>0){ $date=date_create($value['date_released']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>
                    <td style="width:100px"><?php echo $value['or_num']; ?></td>
                    <td style="width:100px"><?php if($value['date_issue']>0){ $date=date_create($value['date_issue']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>
                    <!--<td style="width:100px"><?php //if($value['date_claimed']>0){ $date=date_create($value['date_claimed']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>-->
                    <td style="width:100px"><?php echo $value['claimed_by']; ?></td>
                    <td style="width:100px"><?php if($value['date_cancelled']>0){ $date=date_create($value['date_cancelled']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>
                    <td style="width:100px"><?php if($value['date_expire']>0){ $date=date_create($value['date_expire']); echo date_format($date,"M-d-Y"); } else { echo ""; } ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
            </div>

            <div class="export-btn">
            <?php if($top == null){ ?>
            <button type="button" class="buttons-2" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-file-pdf-o"></i>&nbsp&nbsp
                Export to PDF
            </button>
            <?php } else { ?>
            <input type="submit" class="buttons-2" onclick="printDiv();" value="Print Report"/>
            <?php } ?>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">
                <form action="<?php $_PHP_SELF; ?>" method="POST">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Enter Information</h2>
                  </div>
                  <div class="modal-body" align="left">

                    TO: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="top" name="top" /><br><br>
                    Position: &nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="top_position" name="top_position" /><br><br>
                    THRU: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="thru" name="thru" /><br><br>
                    Position: &nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="thru_position" name="thru_position" /><br><br>
                    FOCAL PERSON:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="focal_person" name="focal_person" /><br><br>
                    Position: &nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="focal_position" name="focal_position" value="Focal Person"/><br><br>
                    <div class= "div-div">
                    <table class="table-acct2">
                      <thead style="background-color:#2c3531" >
                          <tr>
                              <th style="width:40px">Payee</th>
                              <th style="width:90px">Gross Amount</th>
                              <th style="width:140px">Remarks</th>
                          </tr>
                      </thead>
                      </table>
                    </div>

                      <div class= "table-voucher2">
                      <table class="table-acct">
                      <tbody>
                      <?php $a=1; foreach($vrows as $index => $value): ?>
                          <tr>
                              <td style="width:100px"><?php echo $value['payee']; ?></td>
                              <td style="width:100px"><?php echo "₱". number_format($value['gross'],2,'.',','); ?></td>
                              <td style="width:100px">
                                <input type="text" class="details-field3" id="remarks" name="remarks[<?php echo $a; ?>]" />
                              </td>
                          </tr>
                      <?php $a++; endforeach; ?>
                      </tbody>
                    </table>
                    </div><br>
                    Date Issued From: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    Deadline: 
                    <input type="date" style="width:230px;" class="details-field-a" id="issued_from" name="issued_from" />&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <input type="date" style="width:230px;" class="details-field-a" id="deadline" name="deadline" />
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-default" id="save" name="save" value="Save"/>
                  </div>
                </form>
                </div>
                
              </div>
            </div>
            <!-- end Modal -->

            <button type="button" class="buttons-2">
                <a href="download.php?all_select=yes">
                  <i class="fa fa-file-excel-o"></i>
                    &nbsp&nbspExport to Excel
                </a><br>
            </button>
            <input type="button" class="buttons" id="seeMoreRecords" value="Show More">
            <input type="button" class="buttons" id="seeLessRecords" value="Show Less">
            </div>
        <?php } ?>

        </ol>
          </div>
        </div>

             </section>
      <div class="text-right">
        <div class="credits">
          
        </div>
      </div>
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <script type="text/javascript">
        document.getElementById('filter_status').value = "<?php echo $_POST['filter_status'];?>";
  </script>
  <script type="text/javascript">
        document.getElementById('filter_payee_type').value = "<?php echo $_POST['filter_payee_type'];?>";
  </script>
  <script type="text/javascript">
        document.getElementById('filter_payee').value = "<?php echo $_POST['filter_payee'];?>";
  </script>
  <script type="text/javascript">
        document.getElementById('filter_from').value = "<?php echo $_POST['filter_from'];?>";
  </script>
  <script type="text/javascript">
        document.getElementById('filter_to').value = "<?php echo $_POST['filter_to'];?>";
  </script>
  <script type="text/javascript">
        document.getElementById('filter_program').value = "<?php echo $_POST['filter_program'];?>";
  </script>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript">
        $(function() {
            
            //autocomplete
            $("#filter_payee").autocomplete({
                source: "../controllers/voucher_search.php",
                minLength: 1
            });                

        });
        </script>
<script>
var trs = $("#item_table tr");
var btnMore = $("#seeMoreRecords");
var btnLess = $("#seeLessRecords");
var trsLength = trs.length;
var currentIndex = 10;

trs.hide();
trs.slice(0, 10).show(); 
checkButton();

btnMore.click(function (e) { 
    e.preventDefault();
    $("#item_table tr").slice(currentIndex, currentIndex + 10).show();
    currentIndex += 10;
    checkButton();
});

btnLess.click(function (e) { 
    e.preventDefault();
    $("#item_table tr").slice(currentIndex - 10, currentIndex).hide();          
    currentIndex -= 10;
    checkButton();
});

function checkButton() {
    var currentLength = $("#item_table tr:visible").length;
    
    if (currentLength >= trsLength) {
        btnMore.hide();            
    } else {
        btnMore.show();   
    }
    
    if (trsLength > 10 && currentLength > 10) {
        btnLess.show();
    } else {
        btnLess.hide();
    }
    
}
</script>
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="js/owl.carousel.js"></script>
  <!-- jQuery full calendar -->
  <script src="js/fullcalendar.min.js"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js"></script>
    <script src="assets/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/xcharts.min.js"></script>
    <script src="js/jquery.autosize.min.js"></script>
    <script src="js/jquery.placeholder.min.js"></script>
    <script src="js/gdp-data.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/sparklines.js"></script>
    <script src="js/charts.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script>
      //knob
      $(function() {
        $(".knob").knob({
          'draw': function() {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation: true,
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true

        });
      });

      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
    </script>
    
    <script type="text/javascript">
    var timestamp = '<?php date('Y-m-d H:i:s'); ?>';
    function updateTime(){
      $('#time').html(Date(timestamp));
      timestamp++;
    }
    $(function(){
      setInterval(updateTime, 1000);
    });
    </script>
    <script>
      function date_time(id)
      {
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sun', 'Mon', 'Tue', 'Wed', 'Thu' , 'Fri', 'Sat');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+days[day]+' '+months[month]+'-'+d+'-'+year+' '+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
    }
    </script>
    <script type="text/javascript">window.onload = date_time('date_time');</script>  
    <?php include "exportdoc.php"; ?>
  <script>
  function printDiv() {
     var printContents = document.getElementById('docdiv').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = "<html><head></head><body>" + printContents + "</body></html>" ;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<?php if(isset($vrows) && $vrows->num_rows<8){ ?>
        <style>
          .table-voucher2 {
            width: 100%;
          }
        </style>
    <?php } ?>
    <?php if(isset($filter_row) && $filter_row->num_rows<8){ ?>
        <style>
          .table-voucher2 {
            width: 100%;
          }
        </style>
    <?php } ?>
    </body>
</html>

<?php } else {
        header("location:index.php");
    } ?>