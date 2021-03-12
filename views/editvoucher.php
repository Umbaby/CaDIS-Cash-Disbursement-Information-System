<?php session_start(); 
    include "../controllers/editvcfunction.php"; 
    
    if(isset($_SESSION['usertype']) && (($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype'] == "Claim/OR officer" || $_SESSION['usertype'] == "Releasing officer")){
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
          Edit Voucher
        </h3> <!-- name of user -->
        <ol class="breadcrumb" align= "left"> 


    <form action="<?php $_PHP_SELF; ?>" method="POST">
    <div class="container-fluid">
        <?php foreach($vrow as $index => $value): ?>
            <input type="hidden" name="v_num" value="<?php echo $value['v_num']; ?>"/>
            <?php if(($value['status']=="for_issuance" || $value['status']=="cancelled" || isset($re_issue)) && ($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2")){ ?>
            <!-- Edit Date Encoded:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp -->
                <input type="hidden" class="details-field3" name="new_date_encoded" value="<?php echo $value['date_encoded']; ?>" required/>
            <!--    <br><br> -->
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit Payee:</span>
						<input type="text" class="details-field2" name="new_payee" value="<?php echo $value['payee']; ?>" required/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit Particular:</span>
						<input type="text" class="details-field2" name="new_particular" value="<?php echo $value['particular']; ?>" required/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit Period From:</span>
						<input type="date" class="details-field3" name="new_period_from" value="<?php echo $value['period_from']; ?>" />
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit Period To:</span>
						<input type="date" class="details-field3" name="new_period_to" value="<?php echo $value['period_to']; ?>" />
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit Et. Al./Place:</span>
						<input type="text" class="details-field2" name="new_et_al" value="<?php echo $value['et_al']; ?>" />
					</div>	
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit OB No.:</span>
						<input type="text" class="details-field2" name="new_ob_num" value="<?php echo $value['ob_num']; ?>" required/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit Gross Amount:</span>
                        <input onblur="comma()" type="text" class="details-field2" id="gross" name="new_gross" value="<?php echo number_format($value['gross'],2,'.',','); ?>" step=".01" required/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit Net Amount:</span>
						<input onblur="comma()" type="text" class="details-field2" id="net" name="new_net" value="<?php echo number_format($value['net'],2,'.',','); ?>" step=".01" required/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit Fund:</span>
                        <?php if($value['fund'] == "101"){ ?>
                            <select class="details-field2" name="new_fund" required/>
                                <option name="101">101</option>
                                <option name="102">102</option>
                                <option name="171">171</option>
                                <option name="101-184">101-184</option>
                            </select>
                        <?php } else if($value['fund'] == "102") { ?>   
                            <select class="details-field2" name="new_fund" required/>
                                <option name="102">102</option>
                                <option name="101">101</option>
                                <option name="171">171</option>
                                <option name="101-184">101-184</option>
                            </select>
                        <?php } else if($value['fund'] == "171") { ?>   
                            <select class="details-field2" name="new_fund" required/>
                                <option name="171">171</option>
                                <option name="101">101</option>
                                <option name="102">102</option>
                                <option name="101-184">101-184</option>
                            </select>
                        <?php } else if($value['fund'] == "101-184") { ?>   
                            <select class="details-field2" name="new_fund" required/>
                                <option name="101-184">101-184</option>
                                <option name="101">101</option>
                                <option name="102">102</option>
                                <option name="171">171</option>
                            </select>
                        <?php } ?>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit Program:</span>
                        <?php if($value['program'] == "BANG-UN"){  ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "CBB"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="CBB">CBB</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "CENTENARIAN"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "CENTER"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="CENTER">CENTER</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "CENTER BASED"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "COMMUNITY BASED"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="CBB">CBB</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "COMPREHENSIVE"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "DRRP PROPER/CC"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "ICTMS"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="ICTMS">ICTMS</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "KALAHI-NCDDP ADB"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "KALAHI-NCDDP GOP"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "KALAHI-NCDDP WB"){ ?> 
                            <select class="details-field2" name="new_program" required>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "KC-PAMANA"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "NEW TRUST FUND"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "NHTSPR"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "PANTAWID"){ ?>
                            <select class="details-fiel2" name="new_program" required>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "PDPB"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="PDPB">PDPB</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "PRPTP"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="PRPTP">PRPTP</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "PSF ADOPTION"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "PSP-AICS CURRENT CMF"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "PWD/DP"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "REGULAR TRUST FUND"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "SB"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="SB">SB</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "SFP"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="SFP">SFP</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "SLP (DR)"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "SOCTECH"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "SP (DR)"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "TARA"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="TARA">TARA</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "UCT VALIDATION"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UWATO">UWATO</option>
                            </select>
                        <?php } else if ($value['program'] == "UWATO"){ ?>
                            <select class="details-field2" name="new_program" required>
                                <option name="UWATO">UWATO</option>
                                <option name="BANG-UN">BANG-UN</option>
                                <option name="CBB">CBB</option>
                                <option name="CENTENARIAN">CENTENARIAN</option>
                                <option name="CENTER">CENTER</option>
                                <option name="CENTER BASED">CENTER BASED</option>
                                <option name="COMMUNITY BASED">COMMUNITY BASED</option>
                                <option name="COMPREHENSIVE">COMPREHENSIVE</option>
                                <option name="DRRP PROPER/CC">DRRP PROPER/CC</option>
                                <option name="GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)">GENERAL ADMINISTRATIVE and SUPPORT SERVICES (GASS)</option>
                                <option name="ICTMS">ICTMS</option>
                                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                                <option name="KC-PAMANA">KC-PAMANA</option>
                                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                                <option name="NHTSPR">NHTSPR</option>
                                <option name="PANTAWID">PANTAWID</option>
                                <option name="PDPB">PDPB</option>
                                <option name="PRPTP">PRPTP</option>
                                <option name="PSF ADOPTION">PSF ADOPTION</option>
                                <option name="PSP-AICS CURRENT CMF">PSP-AICS CURRENT CMF</option>
                                <option name="PWD/DP">PWD/DP</option>
                                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                                <option name="SB">SB</option>
                                <option name="SFP">SFP</option>
                                <option name="SLP (DR)">SLP (DR)</option>
                                <option name="SOCTECH">SOCTECH</option>
                                <option name="SP (DR)">SP (DR)</option>
                                <option name="TARA">TARA</option>
                                <option name="UCT VALIDATION">UCT VALIDATION</option>
                            </select>
                        <?php } ?>
                    </div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit Remarks:</span>
                        <input type="text" class="details-field2" name="new_remarks" value="<?php echo $value['remarks']; ?>" />
                    </div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit Payment Type:</span>
                        <?php if($value['payment_type']=="ADA"){ ?>
                            <select class="details-field2" name="new_payment_type" required/>
                                <option name="ada">ADA</option>
                                <option name="cheque">cheque</option>
                            </select>
                        <?php } else { ?>
                            <select class="details-field2" name="new_payment_type" required/>
                                <option name="cheque">cheque</option>
                                <option name="ada">ADA</option>
                            </select>
                        <?php } ?>
                    </div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Edit Payee Type:</span>
						<?php if($value['payee_type']=="creditor"){ ?>
                            <select class="details-field2" name="new_payee_type" required/>
                                <option name="creditor">creditor</option>
                                <option name="employee">employee</option>
                            </select>
                        <?php } else { ?>
                            <select class="details-field2" name="new_payee_type" required/>
                                <option name="employee">employee</option>
                                <option name="creditor">creditor</option>
                            </select>
                        <?php } ?>
					</div>

                    ----------------------------------------------------------------------------------------------------------------------------------------------<br><br>
            <?php } else { ?>

            <!--Date Encoded:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            -->    <input type="hidden" class="details-field3" name="new_date_encoded" value="<?php echo $value['date_encoded']; ?>" readonly/>
            <!--    <br><br> --> 
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Payee:</span>
						<input type="text" class="details-field2" name="new_payee" value="<?php echo $value['payee']; ?>" readonly/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Particular:</span>
						<input type="text" class="details-field2" name="new_particular" value="<?php echo $value['particular']; ?>" readonly/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Period From:</span>
						<input type="date" class="details-field3" name="new_period_from" value="<?php echo $value['period_from']; ?>" readonly/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Period To:</span>
						<input type="date" class="details-field3" name="new_period_to" value="<?php echo $value['period_to']; ?>" readonly/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Et. Al./Place:</span>
						<input type="text" class="details-field2" name="new_et_al" value="<?php echo $value['et_al']; ?>" readonly/>
					</div>	
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">OB No.:</span>
						<input type="text" class="details-field2" name="new_ob_num" value="<?php echo $value['ob_num']; ?>" readonly/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Gross Amount:</span>
                        <input type="text" class="details-field2" name="new_gross" value="<?php echo number_format($value['gross'],2,'.',','); ?>" readonly/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Net Amount:</span>
						<input type="text" class="details-field2" name="new_net" value="<?php echo number_format($value['net'],2,'.',','); ?>" readonly/>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Fund:</span>
						<input type="text" class="details-field2" name="new_fund" value="<?php echo $value['fund']; ?>" readonly/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Program:</span>
                        <input type="text" class="details-field2" name="new_program" value="<?php echo $value['program']; ?>" readonly/>
                    </div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Remarks:</span>
                        <input type="text" class="details-field2" name="new_remarks" value="<?php echo $value['remarks']; ?>" readonly/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Payment Type:</span>
						<input type="text" class="details-field2" name="new_payment_type" value="<?php echo $value['payment_type']; ?>" readonly/>
					</div>
                    <div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Payee Type:</span>
						<input type="text" class="details-field2" name="new_payee_type" value="<?php echo $value['payee_type']; ?>" readonly/>
					</div>

                ----------------------------------------------------------------------------------------------------------------------------------------------<br><br>
            <?php } ?>
            <?php if(($value['status']=="for_claim/for_or" || $value['status']=="cancelled") && (($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype'] == "Claim/OR officer")){ ?>
                <div class="form-group input-group">
					<span class="input-group-addon" style="width:150px;">Edit Check/ADA #:</span>
                    <?php if($value['warrant_num']!=''){ ?>
                        <input type="text" class="details-field2" name="new_warrant_num" value="<?php echo $value['warrant_num']; ?>" required/>
                    <?php } else { ?>
                        <input type="text" class="details-field2" name="new_warrant_num" value="<?php echo $value['warrant_num']; ?>" readonly />
                    <?php } ?>
                </div>
                <div class="form-group input-group">
					<span class="input-group-addon" style="width:150px;">Edit Date Released:</span>
                    <?php if($value['date_released']>0){ ?>
                        <input type="date" class="details-field3" name="new_date_released" value="<?php echo $value['date_released']; ?>" required/>
                    <?php } else { ?>
                        <input type="date" class="details-field3" name="new_date_released" value="<?php echo $value['date_released']; ?>" readonly />
                    <?php } ?>
                </div>
                ----------------------------------------------------------------------------------------------------------------------------------------------<br><br>
            <?php } else { ?>
                <div class="form-group input-group">
					<span class="input-group-addon" style="width:150px;">Check/ADA Number:</span>
                    <input type="text" class="details-field2" name="new_warrant_num" value="<?php echo $value['warrant_num']; ?>" readonly/>
                </div>
                <div class="form-group input-group">
					<span class="input-group-addon" style="width:150px;">Date Released:</span>
                    <input type="date" class="details-field3" name="new_date_released" value="<?php echo $value['date_released']; ?>" readonly/>
                </div>
                ----------------------------------------------------------------------------------------------------------------------------------------------<br><br>
            <?php } ?>
            <?php if($value['status']=="claimed"){ ?>
                <div class="form-group input-group">
					<span class="input-group-addon" style="width:150px;">Edit Receipt Number:</span>
                    <?php if($value['or_num']!=''){ ?>
                        <input type="text" class="details-field2" name="new_or_num" value="<?php echo $value['or_num']; ?>" />
                    <?php } else { ?>
                        <input type="text" class="details-field2" name="new_or_num" value="<?php echo $value['or_num']; ?>" readonly />
                    <?php } ?>
                </div>
                <div class="form-group input-group">
					<span class="input-group-addon" style="width:150px;">Edit Date Issued:</span>
                    <?php if($value['date_issue']!=''){ ?>
                        <input type="date" class="details-field3" name="new_date_issue" value="<?php echo $value['date_issue']; ?>" />
                    <?php } else { ?>
                        <input type="date" class="details-field3" name="new_date_issue" value="<?php echo $value['date_issue']; ?>" readonly />
                    <?php } ?>
                </div>
            <!--Edit Claimed By:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <?php //if($value['claimed_by']!=''){ ?>
                    <input type="text" class="details-field2" name="new_claimed_by" value="<?php //echo $value['claimed_by']; ?>" />
                <?php //} else { ?>
                    <input type="text" class="details-field2" name="new_claimed_by" value="<?php //echo $value['claimed_by']; ?>" readonly />
                <?php //} ?>
                <br><br>-->
                <div class="form-group input-group">
					<span class="input-group-addon" style="width:150px;">Edit Date Claimed:</span>
                    <?php if($value['claimed_by']!=''){ ?>
                        <input type="date" class="details-field3" name="new_date_claimed" value="<?php echo $value['date_claimed']; ?>" />
                    <?php } else { ?>
                        <input type="date" class="details-field3" name="new_date_claimed" value="<?php echo $value['date_claimed']; ?>" readonly />
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="form-group input-group">
					<span class="input-group-addon" style="width:150px;">Receipt Number:</span>
                    <input type="text" class="details-field2" name="new_or_num" value="<?php echo $value['or_num']; ?>" readonly/>
                </div>
                <div class="form-group input-group">
					<span class="input-group-addon" style="width:150px;">Date Issued:</span>
                    <input type="date" class="details-field3" name="new_date_issue" value="<?php echo $value['date_issue']; ?>" readonly/>
                </div>
            <!--Claimed By:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <input type="text" class="details-field2" name="new_claimed_by" value="<?php //echo $value['claimed_by']; ?>" readonly/>
                <br><br>-->
                <div class="form-group input-group">
					<span class="input-group-addon" style="width:150px;">Date Claimed:</span>
                    <input type="date" class="details-field3" name="new_date_claimed" value="<?php echo $value['date_claimed']; ?>" readonly/>
                </div>
            <?php } ?>

                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <input type="hidden" name="previous" value="<?php echo $_POST['previous']; ?>"/>
                    <?php if(isset($re_issue)){ ?>
                        <input type="hidden" name="re_issue" value="<?php echo $re_issue; ?>"/>
                        <input type="hidden" name="re_issue_vnum" value="<?php echo $re_issue_vnum; ?>"/>
                        <input type="hidden" name="re_issue_warrant" value="<?php echo $re_issue_warrant; ?>"/>
                    <?php } ?>
                    <input type="submit" class="buttons-2" name="save" onclick="alert('The voucher was successfully changed')" value="Save Changes"/>
            <?php endforeach; ?>
            <a class="cancel" href="<?php echo $previous; ?>" class="buttons">Back</a>
        </div>
    </form>
    
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
    function comma(){
        var grossa = 1000;
        var neta = 1000;
        var gross = document.getElementById('gross').value;
        var net = document.getElementById('net').value;
        var tot = gross - 0;
        var tot2 = net - 0;

        if(!isNaN(tot)){
          document.getElementById('gross').value = tot.toLocaleString('en');
        }
        if(!isNaN(tot2)){
          document.getElementById('net').value = tot2.toLocaleString('en');
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

