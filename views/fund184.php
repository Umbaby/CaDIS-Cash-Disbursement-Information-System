<?php session_start(); 
    include "../controllers/viewfunction.php"; 

    if(isset($_SESSION['name']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){
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
        <h3 class="page-header"><i class="fa fa-file-text"></i> 
          Fund 184 Vouchers 
          &nbsp&nbsp&nbsp&nbsp
          Choose Fund:
            <select class="details-field6" id="fund_select" name="fund_select" onchange="location = this.value;">
                <option name="184" value="#">Fund 101-184</option>
                <option name="101" value="fund101.php?fo_select=yes">Fund 101</option>
                <option name="102" value="fund102.php?ft_select=yes">Fund 102</option>
                <option name="171" value="fund171.php?f171_select=yes">Fund 171</option>
                <option name="both" value="vouchers.php?vc_select=yes">All Fund</option>
            </select>
            <button type="button" class= "buttons-2" data-toggle="modal" data-target="#myModal">Advance Search</button>
        </h3> <!-- name of user -->
        <ol class="breadcrumb" align= "center"> 

        <div class= "div-div">
        <form action="<?php $_PHP_SELF; ?>" method="POST">
            Status:
            <select class="details-field6" id="input_status" name="input_status" style="border-radius:20px">
                <option name="all" value="all">All types</option>
                <option name="for_issuance" value="for_issuance">On Process</option>
                <option name="for_claim/for_or" value="for_claim/for_or">For Claim/Receipt</option>
                <option name="claimed" value="claimed">Claimed</option>
                <option name="cancelled" value="cancelled">Cancelled</option>
                <option name="expired" value="expired">Stale</option>
            </select>
            <input type="text" class="details-field5" id="input184" name="input184" size="35" placeholder="Input here..."/>
            <input type="submit" class= "buttons" name="search_f184" value="Search"/>
            <a class="cancel" href="/CaDIS/views/fund184.php?f184_select=yes">Cancel</a>
        </form>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">
                <form action="<?php $_PHP_SELF; ?>" method="POST">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Advance Search</h2>
                  </div>
                  <div class="modal-body" align="left">

                    Payee: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="adsearch_payee" name="adsearch_payee" value="<?php echo $adsearch_payee; ?>"/><br><br>
                    Gross: &nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="adsearch_gross" name="adsearch_gross" value="<?php echo $adsearch_gross; ?>"/><br><br>
                    Net: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="adsearch_net" name="adsearch_net" value="<?php echo $adsearch_net; ?>"/><br><br>
                    OB Number: &nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="adsearch_obnum" name="adsearch_obnum" value="<?php echo $adsearch_obnum; ?>"/><br><br>
                    Check/ADA Number:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="width:520px;" class="details-field-a" id="adsearch_warrant" name="adsearch_warrant" value="<?php echo $adsearch_warrant; ?>"/><br>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="fund" value="101-184"/>
                    <input type="submit" class="btn btn-default" id="adsearch" name="adsearch" value="Search"/>
                  </div>
                </form>
                </div>
                
              </div>
            </div>
            <!-- end Modal -->
        </div>
        <?php if(isset($_POST['search_f184'])){ ?>
        <?php if(isset($f184_row) && $f184_row->num_rows>0){ ?>
            <div class= "div-div">
            <table class="table-acct">
            <thead style="background-color:#2c3531">
                
                <tr>   
                    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Claim/OR officer" || ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype']=="Releasing officer")){ ?>
                        <th style="border-top-left-radius:15px;">&nbsp&nbsp&nbsp&nbsp&nbspAction</th>
                    <?php } ?>

                    <th>&nbsp&nbsp&nbsp&nbsp&nbspStatus</th>

                    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                        <th>&nbsp&nbsp&nbsp&nbsp&nbspDate &nbsp&nbsp&nbsp&nbsp&nbspEncoded</th>
                    <?php } ?>

                    <th>&nbsp&nbsp&nbsp&nbsp&nbspPayee</th>

                    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                        <th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspParticular</th>
                        <th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspPeriod &nbsp&nbsp&nbsp&nbsp&nbsp&nbspFrom</th>
                        <th>Period To</th>
                        <th>Et Al</th>
                        <th>OB Number</th>
                    <?php } ?>

                    <th>Gross Amount</th>

                    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                        <th>Net Amount</th>
                        
                        <th>Program</th>
                        <th style="border-top-right-radius:15px;">Remarks</th>

                    <?php } ?>

                </tr>
            </thead>
            </table>
            </div>

            <div class= "table-voucher2">
            <table class="table-acct" id="item_table">
            <tbody>
            <?php foreach($f184_row as $index => $value): ?>
                <tr>
                <?php $v_num = $value['v_num']; ?>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Claim/OR officer" || ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype']== "Releasing officer")){ ?>
                    
                    <?php if($value['status']=="for_issuance"){ ?>
                        <td>
                        <?php if(($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype']=="Claim/OR officer"){ ?>
                            <form action="tagvc.php?v_select=yes" style="display:inline;margin:0px;padding:0px;" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <?php if($value['payment_type'] == "cheque"){ ?>
                                    <input type="submit" class= "buttons" name="for_claim/or" value="For Claim"/>
                                <?php } else { ?>
                                    <input type="submit" class= "buttons" name="for_claim/or" value="For Receipt"/>
                                <?php } ?>

                            </form>
                            <form action="<?php $_PHP_SELF; ?>" style="display:inline;margin:0px;padding:0px;" method="POST">
                                <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>"/>
                                <input type="hidden" name="net" value="<?php echo $value['net']; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" class= "buttons" name="cancel" value="Cancel" data-toggle="modal" data-target="#pop<?php echo $v_num; ?>"/>
                            </form>
                            <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button>
                            <div class="modal fade" id="pop<?php echo $v_num; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form action="<?php $_PHP_SELF; ?>" method="POST">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <center><strong><h3 class="modal-title" id="myModalLabel">Payee: <?php echo $value['payee']; ?></h3></strong></center>
                                            </div>
                                            <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="form-group input-group">
                                                <span class="input-group-addon" style="width:150px;">Remarks:</span>
                                                <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                                                <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>"/>
                                                <input type="hidden" name="net" value="<?php echo $value['net']; ?>"/>
                                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                                <input type="text" class="details-field-a" style="width:350px;height:45px;" id="cancel_remarks" name="cancel_remarks" placeholder="  Input here.."/>
                                                </div>
                                                <input type="submit" class="btn btn-default" name="cancel" value="Cancel"/>
                                            </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                        <?php } else { ?>
                            <form action="tagvc.php?v_select=yes" style="display:inline;margin:0px;padding:0px;" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <?php if($value['payment_type'] == "cheque"){ ?>
                                    <input type="submit" class= "buttons" name="for_claim/or" value="For Claim" disabled/>
                                <?php } else { ?>
                                    <input type="submit" class= "buttons" name="for_claim/or" value="For Receipt" disabled/>
                                <?php } ?>

                            </form>
                            <form action="<?php $_PHP_SELF; ?>" style="display:inline;margin:0px;padding:0px;" method="POST">
                                <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                                <input type="submit" class= "buttons" name="cancel" value="Cancel" disabled/>
                            </form>
                            <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button>
                        <?php } ?>
                        </td>

                    <?php } else if($value['status']=="for_claim/for_or" && $value['payment_type'] == "cheque"){ ?>
                        <td>
                        <form action="claimvc.php?v_select=yes" style="display:inline;margin:0px;padding:0px;" method="POST">
                            <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                            <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                            <input type="submit" class= "buttons" name="claimed" value="Claim"/>
                        </form>

                        <form action="<?php $_PHP_SELF; ?>" style="display:inline;margin:0px;padding:0px;" method="POST">
                            <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                            <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>"/>
                            <input type="hidden" name="net" value="<?php echo $value['net']; ?>"/>
                            <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                            <input type="submit" class= "buttons" name="cancel" value="Cancel" data-toggle="modal" data-target="#pop<?php echo $v_num; ?>"/>
                        </form>
                        <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button>
                        <div class="modal fade" id="pop<?php echo $v_num; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form action="<?php $_PHP_SELF; ?>" method="POST">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <center><strong><h3 class="modal-title" id="myModalLabel">Payee: <?php echo $value['payee']; ?></h3></strong></center>
                                            </div>
                                            <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="form-group input-group">
                                                <span class="input-group-addon" style="width:150px;">Remarks:</span>
                                                <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                                                <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>"/>
                                                <input type="hidden" name="net" value="<?php echo $value['net']; ?>"/>
                                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                                <input type="text" class="details-field-a" style="width:350px;height:45px;" id="cancel_remarks" name="cancel_remarks" placeholder="  Input here.."/>
                                                </div>
                                                <input type="submit" class="btn btn-default" name="cancel" value="Cancel"/>
                                            </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                        </td>

                    <?php } else if($value['status']=="claimed" && $value['payee_type'] == "creditor" && $value['payment_type'] == "ADA" && $value['date_issue']==0 && $value['or_num']=="") { ?>
                        <td style="width:4%">
                        <form action="claimvc.php?v_select=yes" style="display:inline;margin:0px;padding:0px;" method="POST">
                            <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                            <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                            <input type="submit" class= "buttons" name="enter_or" value="Enter Receipt"/>
                        </form>

                        <form action="<?php $_PHP_SELF; ?>" style="display:inline;margin:0px;padding:0px;" onsubmit="return confirm('Do you really want to cancel this voucher?');" method="POST">
                            <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                            <input type="submit" class= "buttons" name="cancel" value="Cancel" disabled/>
                        </form>
                        <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button>
                        </td>

                    <?php } else if($value['status']=="cancelled"){ ?>    
                            <td style="width:4%">
                                <form action="editvoucher.php?v_select=yes" method="POST" style="display:inline;margin:0px;padding:0px;" onsubmit="return confirm('Do you really want to re-issue this voucher?');">
                                    <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                    <input type="hidden" name="re_issue_warrant" value="<?php echo $value['warrant_num']; ?>"/>
                                    <input type="hidden" name="re_issue_vnum" value="<?php echo $v_num; ?>"/>
                                    <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                    <input type="hidden" name="re_issue" value="re_issue"/>
                                    <input type="submit" class= "buttons" name="re_issue" value="Re-Issue"/>
                                    <button type="button" class= "buttons" disabled>Cancel</button>
                                    <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button> 
                                </form>
                            </td>

                    <?php } else { ?>    
                        <?php if($value['status']=="claimed" && $value['payment_type'] == "ADA" && $value['date_issue']!=0 && $value['or_num']!=""){ ?> 
                            <td style="width:4%"><button type="button" class= "buttons" disabled>Done</button>
                                <input type="submit" class= "buttons" name="cancel" value="Cancel" disabled/>
                                <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button> 
                            </td>
                            <?php } else { ?>
                            <td style="width:4%"><button type="button" class= "buttons" disabled>Claim</button>
                                <input type="submit" class= "buttons" name="cancel" value="Cancel" disabled/>
                                <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button> 
                            </td>
                            <?php } ?>
                <?php } } ?>              

                <?php //if(isset($_SESSION['usertype']) && ($value['status']!="expired" && $value['status']!="cancelled") && ($_SESSION['usertype']== "Encoder" || $_SESSION['usertype']== "Claim/OR officer" || $_SESSION['usertype']=="Releasing officer")){ ?>
                    <!--<td>
                    <form action="editvoucher.php?v_select=yes" method="POST">
                            <input type="hidden" name="v_num" value="<?php //echo $v_num; ?>"/>
                            <input type="hidden" name="previous" value="vouchers.php?vc_select=yes"/>
                            <input type="submit" class= "buttons" name="edit" value="Edit"/>
                    </form>
                    </td>
                <?php //} else { ?>
                    <td><input type="submit" class= "buttons" name="edit" value="Edit" disabled/></td>-->
                <?php //} ?>

                <?php if($value['status'] == "for_issuance"){ ?>
                        <td><?php //echo "<p style='color:darkslategrey;font-weight:bold'>For Issuance</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:darkslategrey;font-weight:bold' class= "buttons-5" name="edit" value="On Process"/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "for_claim/for_or" && $value['payment_type'] == "cheque"){ ?>
                        <td><?php //echo "<p style='color:darkblue;font-weight:bold'>For Claim</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:darkblue;font-weight:bold' class= "buttons-5" name="edit" value="For Claim"/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "for_claim/for_or" && $value['payment_type'] == "ADA"){ ?>
                        <td><?php //echo "<p style='color:darkblue;font-weight:bold'>For OR</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:darkblue;font-weight:bold' class= "buttons-5" name="edit" value="For Receipt"/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "claimed") { ?>
                        <td><?php //echo "<p style='color:green;font-weight:bold'>Claimed</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:green;font-weight:bold' class= "buttons-5" name="edit" value="Claimed"/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "cancelled") { ?>
                        <td><?php //echo "<p style='color:orange;font-weight:bold'>Cancelled</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:orange;font-weight:bold' class= "buttons-5" name="edit" value="Cancelled" disabled/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "expired") { ?>
                        <td><?php //echo "<p style='color:red;font-weight:bold'>Expired</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:red;font-weight:bold' class= "buttons-5" name="edit" value="Stale" disabled/>
                        </form>
                        </td>
                    <?php } ?>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                    <?php $date=date_create($value['date_encoded']); $date2=date_create($value['time_encoded']); ?>
                    <td><?php echo date_format($date,"M-d-Y") . " " . date_format($date2,"h:i:s a") ; ?></td>
                <?php } ?>

                <td><?php echo $value['payee']; ?></td>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                    <td><?php echo $value['particular']; ?></td>
                <?php } ?>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>

                <?php if($value['period_from']>0){ ?>
                    <?php $date2=date_create($value['period_from']); ?>
                        <td><?php echo date_format($date2,"M-d-Y"); ?></td>
                    <?php } else {?>
                        <td>    </td>
                <?php } ?>

                <?php if($value['period_to']>0){ ?>
                    <?php $date2=date_create($value['period_to']); ?>
                        <td><?php echo date_format($date2,"M-d-Y"); ?></td>
                    <?php } else {?>
                        <td>    </td>
                <?php } ?>

                    <td><?php echo $value['et_al']; ?></td>
                    <td><?php echo $value['ob_num']; ?></td>
                <?php } ?>

                <td><?php echo "₱". number_format($value['gross'],2,'.',','); ?></td>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                    <td><?php echo "₱". number_format($value['net'],2,'.',','); ?></td>
                    
                    <td style="font-size:12px"><?php echo $value['program']; ?></td>
                    <td style="font-size:12px"><?php echo $value['remarks']; ?></td>
                    
                    <span class="hide" id="fund_type<?php echo $value['v_num']; ?>"><?php echo $value['fund']; ?></span>
                    <span class="hide" id="payment_type<?php echo $value['v_num']; ?>"><?php echo $value['payment_type']; ?></span>
                    <span class="hide" id="payee_type<?php echo $value['v_num']; ?>"><?php echo $value['payee_type']; ?></span>
                    <span class="hide" id="encoded_by<?php echo $value['v_num']; ?>"><?php echo $value['encoded_by']; ?></span>
                <?php } ?>

                <td><span class="hide" id="warrant_num<?php echo $value['v_num']; ?>"><?php echo $value['warrant_num']; ?></span></td>
                <td>
                    <?php if($value['date_released']>0){ ?>
                        <span class="hide" id="date_released<?php echo $value['v_num']; ?>">
                            <?php $date4=date_create($value['date_released']); echo date_format($date4,"M-d-Y"); } else { echo ""; } ?>
                        </span>
                </td>
                <td><?php if($value['released_tagger']!="") { ?>
                    <span class="hide" id="released_tagger<?php echo $value['v_num']; ?>">
                        <?php echo $value['released_tagger']; } else { echo ""; } ?>
                    </span>
                </td>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Claim/OR officer" || ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype']=="Releasing officer")){ ?>
                    <td><?php if($value['or_num']!=""){ ?>
                        <span class="hide" id="or_num<?php echo $value['v_num']; ?>">
                            <?php echo $value['or_num']; } else { echo ""; } ?>
                        </span>
                    </td>
                    <td><?php if($value['date_issue']>0){ ?>
                        <span class="hide" id="date_issue<?php echo $value['v_num']; ?>">
                            <?php $date7=date_create($value['date_issue']); echo date_format($date7,"M-d-Y"); } else { echo ""; } ?>
                        </span>
                    </td>
                <?php } ?>

                <td><?php if($value['date_claimed']>0){ ?>
                    <span class="hide" id="date_claimed<?php echo $value['v_num']; ?>">
                        <?php $date5=date_create($value['date_claimed']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?>
                    </span>
                </td>
                <td><?php if($value['claimed_by']!=""){ ?>
                    <span class="hide" id="claimed_by<?php echo $value['v_num']; ?>">
                        <?php echo $value['claimed_by'];} else { echo ""; } ?>
                    </span>
                </td>
                <td><?php if($value['claimed_tagger']!=""){ ?>
                    <span class="hide" id="claimed_tagger<?php echo $value['v_num']; ?>">
                        <?php echo $value['claimed_tagger'];} else { echo ""; } ?>
                    </span>
                </td>
                <td><?php if($value['cancelled_tagger']!=""){ ?>
                    <span class="hide" id="cancelled_tagger<?php echo $value['v_num']; ?>">
                        <?php echo $value['cancelled_tagger'];} else { echo ""; } ?>
                    </span>
                </td>

                    <?php if($value['date_cancelled']>0){ ?>
                        <span class="hide" id="date_cancelled<?php echo $value['v_num']; ?>">
                            <?php $date5=date_create($value['date_cancelled']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?>
                        </span>

                    <?php if($value['cancel_remarks']!=''){ ?>
                        <span class="hide" id="cancel_remarks<?php echo $value['v_num']; ?>">
                            <?php echo $value['cancel_remarks']; } else { echo ""; } ?>
                        </span>

                    <?php if($value['re_issued_by']!=""){ ?>
                        <span class="hide" id="re_issued_by<?php echo $value['v_num']; ?>">
                            <?php echo $value['re_issued_by'];} else { echo ""; } ?>
                        </span>

                    <?php if($value['date_re_issued']>0){ ?>
                        <span class="hide" id="date_re_issued<?php echo $value['v_num']; ?>">
                            <?php $date5=date_create($value['date_re_issued']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?>
                        </span>

                    <?php if($value['date_expire']>0){ ?>
                        <span class="hide" id="date_expire<?php echo $value['v_num']; ?>">
                            <?php $date5=date_create($value['date_expire']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?>
                        </span>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>

        <?php } else { ?>
            <h4 class= "alert2">No item/s match your search</h4>
        <?php } } ?>
          
        
        <?php if( isset($_SESSION['usertype']) && !isset($_POST['search_f184']) && !isset($_POST['adsearch']) && $_SESSION['usertype']!="AA"){ ?>
        <?php if(isset($f184_rows) && $f184_rows->num_rows>0){ ?>
            <div class= "div-div">
            <table class="table-acct">
            <thead style="background-color:#2c3531">
                
                <tr>   
                    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Claim/OR officer" || ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype']=="Releasing officer")){ ?>
                        <th style="border-top-left-radius:15px;">&nbsp&nbsp&nbsp&nbsp&nbspAction</th>
                    <?php } ?>

                    <th>&nbsp&nbsp&nbsp&nbsp&nbspStatus</th>

                    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                        <th>&nbsp&nbsp&nbsp&nbsp&nbspDate &nbsp&nbsp&nbsp&nbsp&nbspEncoded</th>
                    <?php } ?>

                    <th>&nbsp&nbsp&nbsp&nbsp&nbspPayee</th>

                    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                        <th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspParticular</th>
                        <th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspPeriod &nbsp&nbsp&nbsp&nbsp&nbsp&nbspFrom</th>
                        <th>Period To</th>
                        <th>Et Al</th>
                        <th>OB Number</th>
                    <?php } ?>

                    <th>Gross Amount</th>

                    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                        <th>Net Amount</th>
                        
                        <th>Program</th>
                        <th style="border-top-right-radius:15px;">Remarks</th>

                    <?php } ?>

                </tr>
            </thead>
            </table>
            </div>

            <div class= "table-voucher2">
            <table class="table-acct" id="item_table">
            <tbody>
            <?php foreach($f184_rows as $index => $value): ?>
                <tr>
                <?php $v_num = $value['v_num']; ?>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Claim/OR officer" || ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype']== "Releasing officer")){ ?>
                    
                    <?php if($value['status']=="for_issuance"){ ?>
                        <td>
                        <?php if(($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype']=="Claim/OR officer"){ ?>
                            <form action="tagvc.php?v_select=yes" style="display:inline;margin:0px;padding:0px;" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <?php if($value['payment_type'] == "cheque"){ ?>
                                    <input type="submit" class= "buttons" name="for_claim/or" value="For Claim"/>
                                <?php } else { ?>
                                    <input type="submit" class= "buttons" name="for_claim/or" value="For Receipt"/>
                                <?php } ?>

                            </form>
                            <form action="<?php $_PHP_SELF; ?>" style="display:inline;margin:0px;padding:0px;" method="POST">
                                <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>"/>
                                <input type="hidden" name="net" value="<?php echo $value['net']; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" class= "buttons" name="cancel" value="Cancel" data-toggle="modal" data-target="#pop<?php echo $v_num; ?>"/>
                            </form>
                            <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button>
                            <div class="modal fade" id="pop<?php echo $v_num; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form action="<?php $_PHP_SELF; ?>" method="POST">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <center><strong><h3 class="modal-title" id="myModalLabel">Payee: <?php echo $value['payee']; ?></h3></strong></center>
                                            </div>
                                            <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="form-group input-group">
                                                <span class="input-group-addon" style="width:150px;">Remarks:</span>
                                                <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                                                <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>"/>
                                                <input type="hidden" name="net" value="<?php echo $value['net']; ?>"/>
                                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                                <input type="text" class="details-field-a" style="width:350px;height:45px;" id="cancel_remarks" name="cancel_remarks" placeholder="  Input here.."/>
                                                </div>
                                                <input type="submit" class="btn btn-default" name="cancel" value="Cancel"/>
                                            </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                        <?php } else { ?>
                            <form action="tagvc.php?v_select=yes" style="display:inline;margin:0px;padding:0px;" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <?php if($value['payment_type'] == "cheque"){ ?>
                                    <input type="submit" class= "buttons" name="for_claim/or" value="For Claim" disabled/>
                                <?php } else { ?>
                                    <input type="submit" class= "buttons" name="for_claim/or" value="For Receipt" disabled/>
                                <?php } ?>

                            </form>
                            <form action="<?php $_PHP_SELF; ?>" style="display:inline;margin:0px;padding:0px;" method="POST">
                                <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                                <input type="submit" class= "buttons" name="cancel" value="Cancel" disabled/>
                            </form>
                            <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button>
                        <?php } ?>
                        </td>

                    <?php } else if($value['status']=="for_claim/for_or" && $value['payment_type'] == "cheque"){ ?>
                        <td>
                        <form action="claimvc.php?v_select=yes" style="display:inline;margin:0px;padding:0px;" method="POST">
                            <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                            <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                            <input type="submit" class= "buttons" name="claimed" value="Claim"/>
                        </form>

                        <form action="<?php $_PHP_SELF; ?>" style="display:inline;margin:0px;padding:0px;" method="POST">
                            <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                            <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>"/>
                            <input type="hidden" name="net" value="<?php echo $value['net']; ?>"/>
                            <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                            <input type="submit" class= "buttons" name="cancel" value="Cancel" data-toggle="modal" data-target="#pop<?php echo $v_num; ?>"/>
                        </form>
                        <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button>
                        <div class="modal fade" id="pop<?php echo $v_num; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form action="<?php $_PHP_SELF; ?>" method="POST">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <center><strong><h3 class="modal-title" id="myModalLabel">Payee: <?php echo $value['payee']; ?></h3></strong></center>
                                            </div>
                                            <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="form-group input-group">
                                                <span class="input-group-addon" style="width:150px;">Remarks:</span>
                                                <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                                                <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>"/>
                                                <input type="hidden" name="net" value="<?php echo $value['net']; ?>"/>
                                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                                <input type="text" class="details-field-a" style="width:350px;height:45px;" id="cancel_remarks" name="cancel_remarks" placeholder="  Input here.."/>
                                                </div>
                                                <input type="submit" class="btn btn-default" name="cancel" value="Cancel"/>
                                            </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                        </td>

                    <?php } else if($value['status']=="claimed" && $value['payee_type'] == "creditor" && $value['payment_type'] == "ADA" && $value['date_issue']==0 && $value['or_num']=="") { ?>
                        <td style="width:4%">
                        <form action="claimvc.php?v_select=yes" style="display:inline;margin:0px;padding:0px;" method="POST">
                            <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                            <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                            <input type="submit" class= "buttons" name="enter_or" value="Enter Receipt"/>
                        </form>

                        <form action="<?php $_PHP_SELF; ?>" style="display:inline;margin:0px;padding:0px;" onsubmit="return confirm('Do you really want to cancel this voucher?');" method="POST">
                            <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                            <input type="submit" class= "buttons" name="cancel" value="Cancel" disabled/>
                        </form>
                        <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button>
                        </td>

                    <?php } else if($value['status']=="cancelled"){ ?>    
                            <td style="width:4%">
                                <form action="editvoucher.php?v_select=yes" method="POST" style="display:inline;margin:0px;padding:0px;" onsubmit="return confirm('Do you really want to re-issue this voucher?');">
                                    <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                    <input type="hidden" name="re_issue_warrant" value="<?php echo $value['warrant_num']; ?>"/>
                                    <input type="hidden" name="re_issue_vnum" value="<?php echo $v_num; ?>"/>
                                    <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                    <input type="hidden" name="re_issue" value="re_issue"/>
                                    <input type="submit" class= "buttons" name="re_issue" value="Re-Issue"/>
                                    <button type="button" class= "buttons" disabled>Cancel</button>
                                    <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button> 
                                </form>
                            </td>

                    <?php } else { ?>    
                        <?php if($value['status']=="claimed" && $value['payment_type'] == "ADA" && $value['date_issue']!=0 && $value['or_num']!=""){ ?> 
                            <td style="width:4%"><button type="button" class= "buttons" disabled>Done</button>
                                <input type="submit" class= "buttons" name="cancel" value="Cancel" disabled/>
                                <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button> 
                            </td>
                            <?php } else { ?>
                            <td style="width:4%"><button type="button" class= "buttons" disabled>Claim</button>
                                <input type="submit" class= "buttons" name="cancel" value="Cancel" disabled/>
                                <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button> 
                            </td>
                            <?php } ?>
                <?php } } ?>              

                <?php //if(isset($_SESSION['usertype']) && ($value['status']!="expired" && $value['status']!="cancelled") && ($_SESSION['usertype']== "Encoder" || $_SESSION['usertype']== "Claim/OR officer" || $_SESSION['usertype']=="Releasing officer")){ ?>
                    <!--<td>
                    <form action="editvoucher.php?v_select=yes" method="POST">
                            <input type="hidden" name="v_num" value="<?php //echo $v_num; ?>"/>
                            <input type="hidden" name="previous" value="vouchers.php?vc_select=yes"/>
                            <input type="submit" class= "buttons" name="edit" value="Edit"/>
                    </form>
                    </td>
                <?php //} else { ?>
                    <td><input type="submit" class= "buttons" name="edit" value="Edit" disabled/></td>-->
                <?php //} ?>

                <?php if($value['status'] == "for_issuance"){ ?>
                        <td><?php //echo "<p style='color:darkslategrey;font-weight:bold'>For Issuance</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:darkslategrey;font-weight:bold' class= "buttons-5" name="edit" value="On Process"/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "for_claim/for_or" && $value['payment_type'] == "cheque"){ ?>
                        <td><?php //echo "<p style='color:darkblue;font-weight:bold'>For Claim</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:darkblue;font-weight:bold' class= "buttons-5" name="edit" value="For Claim"/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "for_claim/for_or" && $value['payment_type'] == "ADA"){ ?>
                        <td><?php //echo "<p style='color:darkblue;font-weight:bold'>For OR</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:darkblue;font-weight:bold' class= "buttons-5" name="edit" value="For Receipt"/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "claimed") { ?>
                        <td><?php //echo "<p style='color:green;font-weight:bold'>Claimed</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:green;font-weight:bold' class= "buttons-5" name="edit" value="Claimed"/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "cancelled") { ?>
                        <td><?php //echo "<p style='color:orange;font-weight:bold'>Cancelled</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:orange;font-weight:bold' class= "buttons-5" name="edit" value="Cancelled" disabled/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "expired") { ?>
                        <td><?php //echo "<p style='color:red;font-weight:bold'>Expired</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:red;font-weight:bold' class= "buttons-5" name="edit" value="Stale" disabled/>
                        </form>
                        </td>
                    <?php } ?>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                    <?php $date=date_create($value['date_encoded']); $date2=date_create($value['time_encoded']); ?>
                    <td><?php echo date_format($date,"M-d-Y") . " " . date_format($date2,"h:i:s a") ; ?></td>
                <?php } ?>

                <td><?php echo $value['payee']; ?></td>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                    <td><?php echo $value['particular']; ?></td>
                <?php } ?>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>

                <?php if($value['period_from']>0){ ?>
                    <?php $date2=date_create($value['period_from']); ?>
                        <td><?php echo date_format($date2,"M-d-Y"); ?></td>
                    <?php } else {?>
                        <td>    </td>
                <?php } ?>

                <?php if($value['period_to']>0){ ?>
                    <?php $date2=date_create($value['period_to']); ?>
                        <td><?php echo date_format($date2,"M-d-Y"); ?></td>
                    <?php } else {?>
                        <td>    </td>
                <?php } ?>

                    <td><?php echo $value['et_al']; ?></td>
                    <td><?php echo $value['ob_num']; ?></td>
                <?php } ?>

                <td><?php echo "₱". number_format($value['gross'],2,'.',','); ?></td>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                    <td><?php echo "₱". number_format($value['net'],2,'.',','); ?></td>
                    
                    <td style="font-size:12px"><?php echo $value['program']; ?></td>
                    <td style="font-size:12px"><?php echo $value['remarks']; ?></td>
                    
                    <span class="hide" id="fund_type<?php echo $value['v_num']; ?>"><?php echo $value['fund']; ?></span>
                    <span class="hide" id="payment_type<?php echo $value['v_num']; ?>"><?php echo $value['payment_type']; ?></span>
                    <span class="hide" id="payee_type<?php echo $value['v_num']; ?>"><?php echo $value['payee_type']; ?></span>
                    <span class="hide" id="encoded_by<?php echo $value['v_num']; ?>"><?php echo $value['encoded_by']; ?></span>
                <?php } ?>

                <td><span class="hide" id="warrant_num<?php echo $value['v_num']; ?>"><?php echo $value['warrant_num']; ?></span></td>
                <td>
                    <?php if($value['date_released']>0){ ?>
                        <span class="hide" id="date_released<?php echo $value['v_num']; ?>">
                            <?php $date4=date_create($value['date_released']); echo date_format($date4,"M-d-Y"); } else { echo ""; } ?>
                        </span>
                </td>
                <td><?php if($value['released_tagger']!="") { ?>
                    <span class="hide" id="released_tagger<?php echo $value['v_num']; ?>">
                        <?php echo $value['released_tagger']; } else { echo ""; } ?>
                    </span>
                </td>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Claim/OR officer" || ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype']=="Releasing officer")){ ?>
                    <td><?php if($value['or_num']!=""){ ?>
                        <span class="hide" id="or_num<?php echo $value['v_num']; ?>">
                            <?php echo $value['or_num']; } else { echo ""; } ?>
                        </span>
                    </td>
                    <td><?php if($value['date_issue']>0){ ?>
                        <span class="hide" id="date_issue<?php echo $value['v_num']; ?>">
                            <?php $date7=date_create($value['date_issue']); echo date_format($date7,"M-d-Y"); } else { echo ""; } ?>
                        </span>
                    </td>
                <?php } ?>

                <td><?php if($value['date_claimed']>0){ ?>
                    <span class="hide" id="date_claimed<?php echo $value['v_num']; ?>">
                        <?php $date5=date_create($value['date_claimed']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?>
                    </span>
                </td>
                <td><?php if($value['claimed_by']!=""){ ?>
                    <span class="hide" id="claimed_by<?php echo $value['v_num']; ?>">
                        <?php echo $value['claimed_by'];} else { echo ""; } ?>
                    </span>
                </td>
                <td><?php if($value['claimed_tagger']!=""){ ?>
                    <span class="hide" id="claimed_tagger<?php echo $value['v_num']; ?>">
                        <?php echo $value['claimed_tagger'];} else { echo ""; } ?>
                    </span>
                </td>
                <td><?php if($value['cancelled_tagger']!=""){ ?>
                    <span class="hide" id="cancelled_tagger<?php echo $value['v_num']; ?>">
                        <?php echo $value['cancelled_tagger'];} else { echo ""; } ?>
                    </span>
                </td>

                    <?php if($value['date_cancelled']>0){ ?>
                        <span class="hide" id="date_cancelled<?php echo $value['v_num']; ?>">
                            <?php $date5=date_create($value['date_cancelled']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?>
                        </span>

                    <?php if($value['cancel_remarks']!=''){ ?>
                        <span class="hide" id="cancel_remarks<?php echo $value['v_num']; ?>">
                            <?php echo $value['cancel_remarks']; } else { echo ""; } ?>
                        </span>

                    <?php if($value['re_issued_by']!=""){ ?>
                        <span class="hide" id="re_issued_by<?php echo $value['v_num']; ?>">
                            <?php echo $value['re_issued_by'];} else { echo ""; } ?>
                        </span>

                    <?php if($value['date_re_issued']>0){ ?>
                        <span class="hide" id="date_re_issued<?php echo $value['v_num']; ?>">
                            <?php $date5=date_create($value['date_re_issued']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?>
                        </span>

                    <?php if($value['date_expire']>0){ ?>
                        <span class="hide" id="date_expire<?php echo $value['v_num']; ?>">
                            <?php $date5=date_create($value['date_expire']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?>
                        </span>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
                    </div>        
        <?php } else { ?>
            <div class= "slideshow-div">
                  <img class= "slides-img" src= "img/empty-icon.png" style="width:50vh;height:50vh">
              </div>
            <h4 class= "alert2">No item/s encoded yet</h4>
        <?php } } ?>

        <?php if( isset($_SESSION['usertype']) && isset($_POST['adsearch']) ){ ?>
        <?php if(isset($adsearch) && $adsearch->num_rows>0){ ?>
            <div class= "div-div">
            <table class="table-acct">
            <thead style="background-color:#2c3531">
                
                <tr>   
                    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Claim/OR officer" || ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype']=="Releasing officer")){ ?>
                        <th style="border-top-left-radius:15px;">&nbsp&nbsp&nbsp&nbsp&nbspAction</th>
                    <?php } ?>

                    <th>&nbsp&nbsp&nbsp&nbsp&nbspStatus</th>

                    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                        <th>&nbsp&nbsp&nbsp&nbsp&nbspDate &nbsp&nbsp&nbsp&nbsp&nbspEncoded</th>
                    <?php } ?>

                    <th>&nbsp&nbsp&nbsp&nbsp&nbspPayee</th>

                    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                        <th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspParticular</th>
                        <th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspPeriod &nbsp&nbsp&nbsp&nbsp&nbsp&nbspFrom</th>
                        <th>Period To</th>
                        <th>Et Al</th>
                        <th>OB Number</th>
                    <?php } ?>

                    <th>Gross Amount</th>

                    <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                        <th>Net Amount</th>
                        
                        <th>Program</th>
                        <th style="border-top-right-radius:15px;">Remarks</th>

                    <?php } ?>

                </tr>
            </thead>
            </table>
            </div>

            <div class= "table-voucher2">
            <table class="table-acct" id="item_table">
            <tbody>
            <?php foreach($adsearch as $index => $value): ?>
                <tr>
                <?php $v_num = $value['v_num']; ?>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Claim/OR officer" || ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype']== "Releasing officer")){ ?>
                    
                    <?php if($value['status']=="for_issuance"){ ?>
                        <td>
                        <?php if(($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype']=="Claim/OR officer"){ ?>
                            <form action="tagvc.php?v_select=yes" style="display:inline;margin:0px;padding:0px;" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <?php if($value['payment_type'] == "cheque"){ ?>
                                    <input type="submit" class= "buttons" name="for_claim/or" value="For Claim"/>
                                <?php } else { ?>
                                    <input type="submit" class= "buttons" name="for_claim/or" value="For Receipt"/>
                                <?php } ?>

                            </form>
                            <form action="<?php $_PHP_SELF; ?>" style="display:inline;margin:0px;padding:0px;" method="POST">
                                <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>"/>
                                <input type="hidden" name="net" value="<?php echo $value['net']; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" class= "buttons" name="cancel" value="Cancel" data-toggle="modal" data-target="#pop<?php echo $v_num; ?>"/>
                            </form>
                            <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button>
                            <div class="modal fade" id="pop<?php echo $v_num; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form action="<?php $_PHP_SELF; ?>" method="POST">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <center><strong><h3 class="modal-title" id="myModalLabel">Payee: <?php echo $value['payee']; ?></h3></strong></center>
                                            </div>
                                            <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="form-group input-group">
                                                <span class="input-group-addon" style="width:150px;">Remarks:</span>
                                                <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                                                <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>"/>
                                                <input type="hidden" name="net" value="<?php echo $value['net']; ?>"/>
                                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                                <input type="text" class="details-field-a" style="width:350px;height:45px;" id="cancel_remarks" name="cancel_remarks" placeholder="  Input here.."/>
                                                </div>
                                                <input type="submit" class="btn btn-default" name="cancel" value="Cancel"/>
                                            </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                        <?php } else { ?>
                            <form action="tagvc.php?v_select=yes" style="display:inline;margin:0px;padding:0px;" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <?php if($value['payment_type'] == "cheque"){ ?>
                                    <input type="submit" class= "buttons" name="for_claim/or" value="For Claim" disabled/>
                                <?php } else { ?>
                                    <input type="submit" class= "buttons" name="for_claim/or" value="For Receipt" disabled/>
                                <?php } ?>

                            </form>
                            <form action="<?php $_PHP_SELF; ?>" style="display:inline;margin:0px;padding:0px;" method="POST">
                                <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                                <input type="submit" class= "buttons" name="cancel" value="Cancel" disabled/>
                            </form>
                            <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button>
                        <?php } ?>
                        </td>

                    <?php } else if($value['status']=="for_claim/for_or" && $value['payment_type'] == "cheque"){ ?>
                        <td>
                        <form action="claimvc.php?v_select=yes" style="display:inline;margin:0px;padding:0px;" method="POST">
                            <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                            <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                            <input type="submit" class= "buttons" name="claimed" value="Claim"/>
                        </form>

                        <form action="<?php $_PHP_SELF; ?>" style="display:inline;margin:0px;padding:0px;" method="POST">
                            <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                            <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>"/>
                            <input type="hidden" name="net" value="<?php echo $value['net']; ?>"/>
                            <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                            <input type="submit" class= "buttons" name="cancel" value="Cancel" data-toggle="modal" data-target="#pop<?php echo $v_num; ?>"/>
                        </form>
                        <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button>
                        <div class="modal fade" id="pop<?php echo $v_num; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <form action="<?php $_PHP_SELF; ?>" method="POST">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <center><strong><h3 class="modal-title" id="myModalLabel">Payee: <?php echo $value['payee']; ?></h3></strong></center>
                                            </div>
                                            <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="form-group input-group">
                                                <span class="input-group-addon" style="width:150px;">Remarks:</span>
                                                <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                                                <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>"/>
                                                <input type="hidden" name="net" value="<?php echo $value['net']; ?>"/>
                                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                                <input type="text" class="details-field-a" style="width:350px;height:45px;" id="cancel_remarks" name="cancel_remarks" placeholder="  Input here.."/>
                                                </div>
                                                <input type="submit" class="btn btn-default" name="cancel" value="Cancel"/>
                                            </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                        </td>

                    <?php } else if($value['status']=="claimed" && $value['payee_type'] == "creditor" && $value['payment_type'] == "ADA" && $value['date_issue']==0 && $value['or_num']=="") { ?>
                        <td style="width:4%">
                        <form action="claimvc.php?v_select=yes" style="display:inline;margin:0px;padding:0px;" method="POST">
                            <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                            <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                            <input type="submit" class= "buttons" name="enter_or" value="Enter Receipt"/>
                        </form>

                        <form action="<?php $_PHP_SELF; ?>" style="display:inline;margin:0px;padding:0px;" onsubmit="return confirm('Do you really want to cancel this voucher?');" method="POST">
                            <input type="hidden" name="cancel_v_num" value="<?php echo $v_num; ?>"/>
                            <input type="submit" class= "buttons" name="cancel" value="Cancel" disabled/>
                        </form>
                        <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button>
                        </td>

                    <?php } else if($value['status']=="cancelled"){ ?>    
                            <td style="width:4%">
                                <form action="editvoucher.php?v_select=yes" method="POST" style="display:inline;margin:0px;padding:0px;" onsubmit="return confirm('Do you really want to re-issue this voucher?');">
                                    <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                    <input type="hidden" name="re_issue_warrant" value="<?php echo $value['warrant_num']; ?>"/>
                                    <input type="hidden" name="re_issue_vnum" value="<?php echo $v_num; ?>"/>
                                    <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                    <input type="hidden" name="re_issue" value="re_issue"/>
                                    <input type="submit" class= "buttons" name="re_issue" value="Re-Issue"/>
                                    <button type="button" class= "buttons" disabled>Cancel</button>
                                    <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button> 
                                </form>
                            </td>

                    <?php } else { ?>    
                        <?php if($value['status']=="claimed" && $value['payment_type'] == "ADA" && $value['date_issue']!=0 && $value['or_num']!=""){ ?> 
                            <td style="width:4%"><button type="button" class= "buttons" disabled>Done</button>
                                <input type="submit" class= "buttons" name="cancel" value="Cancel" disabled/>
                                <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button> 
                            </td>
                            <?php } else { ?>
                            <td style="width:4%"><button type="button" class= "buttons" disabled>Claim</button>
                                <input type="submit" class= "buttons" name="cancel" value="Cancel" disabled/>
                                <button type="button" class="buttons-4" value="<?php echo $v_num; ?>">Details</button> 
                            </td>
                            <?php } ?>
                <?php } } ?>              

                <?php //if(isset($_SESSION['usertype']) && ($value['status']!="expired" && $value['status']!="cancelled") && ($_SESSION['usertype']== "Encoder" || $_SESSION['usertype']== "Claim/OR officer" || $_SESSION['usertype']=="Releasing officer")){ ?>
                    <!--<td>
                    <form action="editvoucher.php?v_select=yes" method="POST">
                            <input type="hidden" name="v_num" value="<?php //echo $v_num; ?>"/>
                            <input type="hidden" name="previous" value="vouchers.php?vc_select=yes"/>
                            <input type="submit" class= "buttons" name="edit" value="Edit"/>
                    </form>
                    </td>
                <?php //} else { ?>
                    <td><input type="submit" class= "buttons" name="edit" value="Edit" disabled/></td>-->
                <?php //} ?>

                <?php if($value['status'] == "for_issuance"){ ?>
                        <td><?php //echo "<p style='color:darkslategrey;font-weight:bold'>For Issuance</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:darkslategrey;font-weight:bold' class= "buttons-5" name="edit" value="On Process"/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "for_claim/for_or" && $value['payment_type'] == "cheque"){ ?>
                        <td><?php //echo "<p style='color:darkblue;font-weight:bold'>For Claim</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:darkblue;font-weight:bold' class= "buttons-5" name="edit" value="For Claim"/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "for_claim/for_or" && $value['payment_type'] == "ADA"){ ?>
                        <td><?php //echo "<p style='color:darkblue;font-weight:bold'>For OR</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:darkblue;font-weight:bold' class= "buttons-5" name="edit" value="For Receipt"/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "claimed") { ?>
                        <td><?php //echo "<p style='color:green;font-weight:bold'>Claimed</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:green;font-weight:bold' class= "buttons-5" name="edit" value="Claimed"/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "cancelled") { ?>
                        <td><?php //echo "<p style='color:orange;font-weight:bold'>Cancelled</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:orange;font-weight:bold' class= "buttons-5" name="edit" value="Cancelled" disabled/>
                        </form>
                        </td>
                    <?php } else if($value['status'] == "expired") { ?>
                        <td><?php //echo "<p style='color:red;font-weight:bold'>Expired</p>"; ?>
                        <form action="editvoucher.php?v_select=yes" method="POST">
                                <input type="hidden" name="v_num" value="<?php echo $v_num; ?>"/>
                                <input type="hidden" name="previous" value="fund184.php?f184_select=yes"/>
                                <input type="submit" style='color:red;font-weight:bold' class= "buttons-5" name="edit" value="Stale" disabled/>
                        </form>
                        </td>
                    <?php } ?>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                    <?php $date=date_create($value['date_encoded']); $date2=date_create($value['time_encoded']); ?>
                    <td><?php echo date_format($date,"M-d-Y") . " " . date_format($date2,"h:i:s a") ; ?></td>
                <?php } ?>

                <td><?php echo $value['payee']; ?></td>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                    <td><?php echo $value['particular']; ?></td>
                <?php } ?>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>

                <?php if($value['period_from']>0){ ?>
                    <?php $date2=date_create($value['period_from']); ?>
                        <td><?php echo date_format($date2,"M-d-Y"); ?></td>
                    <?php } else {?>
                        <td>    </td>
                <?php } ?>

                <?php if($value['period_to']>0){ ?>
                    <?php $date2=date_create($value['period_to']); ?>
                        <td><?php echo date_format($date2,"M-d-Y"); ?></td>
                    <?php } else {?>
                        <td>    </td>
                <?php } ?>

                    <td><?php echo $value['et_al']; ?></td>
                    <td><?php echo $value['ob_num']; ?></td>
                <?php } ?>

                <td><?php echo "₱". number_format($value['gross'],2,'.',','); ?></td>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
                    <td><?php echo "₱". number_format($value['net'],2,'.',','); ?></td>
                    
                    <td style="font-size:12px"><?php echo $value['program']; ?></td>
                    <td style="font-size:12px"><?php echo $value['remarks']; ?></td>
                    
                    <span class="hide" id="fund_type<?php echo $value['v_num']; ?>"><?php echo $value['fund']; ?></span>
                    <span class="hide" id="payment_type<?php echo $value['v_num']; ?>"><?php echo $value['payment_type']; ?></span>
                    <span class="hide" id="payee_type<?php echo $value['v_num']; ?>"><?php echo $value['payee_type']; ?></span>
                    <span class="hide" id="encoded_by<?php echo $value['v_num']; ?>"><?php echo $value['encoded_by']; ?></span>
                <?php } ?>

                <td><span class="hide" id="warrant_num<?php echo $value['v_num']; ?>"><?php echo $value['warrant_num']; ?></span></td>
                <td>
                    <?php if($value['date_released']>0){ ?>
                        <span class="hide" id="date_released<?php echo $value['v_num']; ?>">
                            <?php $date4=date_create($value['date_released']); echo date_format($date4,"M-d-Y"); } else { echo ""; } ?>
                        </span>
                </td>
                <td><?php if($value['released_tagger']!="") { ?>
                    <span class="hide" id="released_tagger<?php echo $value['v_num']; ?>">
                        <?php echo $value['released_tagger']; } else { echo ""; } ?>
                    </span>
                </td>

                <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype']=="Claim/OR officer" || ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype']=="Releasing officer")){ ?>
                    <td><?php if($value['or_num']!=""){ ?>
                        <span class="hide" id="or_num<?php echo $value['v_num']; ?>">
                            <?php echo $value['or_num']; } else { echo ""; } ?>
                        </span>
                    </td>
                    <td><?php if($value['date_issue']>0){ ?>
                        <span class="hide" id="date_issue<?php echo $value['v_num']; ?>">
                            <?php $date7=date_create($value['date_issue']); echo date_format($date7,"M-d-Y"); } else { echo ""; } ?>
                        </span>
                    </td>
                <?php } ?>

                <td><?php if($value['date_claimed']>0){ ?>
                    <span class="hide" id="date_claimed<?php echo $value['v_num']; ?>">
                        <?php $date5=date_create($value['date_claimed']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?>
                    </span>
                </td>
                <td><?php if($value['claimed_by']!=""){ ?>
                    <span class="hide" id="claimed_by<?php echo $value['v_num']; ?>">
                        <?php echo $value['claimed_by'];} else { echo ""; } ?>
                    </span>
                </td>
                <td><?php if($value['claimed_tagger']!=""){ ?>
                    <span class="hide" id="claimed_tagger<?php echo $value['v_num']; ?>">
                        <?php echo $value['claimed_tagger'];} else { echo ""; } ?>
                    </span>
                </td>
                <td><?php if($value['cancelled_tagger']!=""){ ?>
                    <span class="hide" id="cancelled_tagger<?php echo $value['v_num']; ?>">
                        <?php echo $value['cancelled_tagger'];} else { echo ""; } ?>
                    </span>
                </td>

                    <?php if($value['date_cancelled']>0){ ?>
                        <span class="hide" id="date_cancelled<?php echo $value['v_num']; ?>">
                            <?php $date5=date_create($value['date_cancelled']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?>
                        </span>

                    <?php if($value['cancel_remarks']!=''){ ?>
                        <span class="hide" id="cancel_remarks<?php echo $value['v_num']; ?>">
                            <?php echo $value['cancel_remarks']; } else { echo ""; } ?>
                        </span>

                    <?php if($value['re_issued_by']!=""){ ?>
                        <span class="hide" id="re_issued_by<?php echo $value['v_num']; ?>">
                            <?php echo $value['re_issued_by'];} else { echo ""; } ?>
                        </span>

                    <?php if($value['date_re_issued']>0){ ?>
                        <span class="hide" id="date_re_issued<?php echo $value['v_num']; ?>">
                            <?php $date5=date_create($value['date_re_issued']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?>
                        </span>

                    <?php if($value['date_expire']>0){ ?>
                        <span class="hide" id="date_expire<?php echo $value['v_num']; ?>">
                            <?php $date5=date_create($value['date_expire']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?>
                        </span>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
                    </div>
        
        <?php } else { ?>
            <h4 class= "alert2">No item/s match your search</h4>
        <?php } } ?>
            <input type="button" class="buttons" id="seeMoreRecords" value="Show More">
            <input type="button" class="buttons" id="seeLessRecords" value="Show Less">
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
  <?php include('modal.php'); ?>
  <script src="js/custom.js"></script>
  
  <script type="text/javascript">
        document.getElementById('input184').value = "<?php echo $_POST['input184'];?>";
  </script>
  <script type="text/javascript">
        document.getElementById('input_status').value = "<?php echo $_POST['input_status'];?>";
  </script>
  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript">
        $(function() {
            
            //autocomplete
            $("#input184").autocomplete({
                source: "../controllers/184_search.php",
                minLength: 1
            });                

        });
        </script>
        <script type="text/javascript">
        $(function() {
            
            //autocomplete
            $("#adsearch_payee").autocomplete({
                source: "../controllers/184_search.php",
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
<?php if(isset($f184_row) && ($f184_row->num_rows<=3) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
        <style>
        .table-voucher2 {
            width: 98%;
            margin-left: 0px;
            margin: auto;
        }
        </style>
    <?php } ?>
    <?php if(isset($f184_rows) && ($f184_rows->num_rows<=3) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
        <style>
        .table-voucher2 {
            width: 98%;
            margin-left: 0px;
            margin: auto;
        }
        </style>
    <?php } ?>
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
  <<script src="js/fullcalendar.min.js"></script>
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

    </body>
</html>
            <?php } else {
                header("location:index.php");
            } ?>
