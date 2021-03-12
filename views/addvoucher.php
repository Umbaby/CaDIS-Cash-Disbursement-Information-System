<?php session_start(); 
    include "../controllers/addvoucherfunction.php";  
    
    if(isset($_SESSION['name']) && ($_SESSION['usertype'] == "Encoder" || $_SESSION['usertype'] == "Encoder2")){
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
          Encode New Transaction
        </h3> <!-- name of user -->
        <ol class="breadcrumb" align= "left"> 


        <form action="<?php $_PHP_SELF; ?>" method="POST">
            <!--Date Encoded:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <input type="date" class= "details-field3" id="date_encoded" name="date_encoded" required/>
            <br><br>-->
          <div class="container-fluid">
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Payee:</span>
						<input type="text" class= "details-field2" id="payee" name="payee" required/>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Particular:</span>
						<input type="text" class= "details-field2" id="particular" name="particular" required/>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Period From:</span>
						<input type="date" class= "details-field3" style="width:250px;" id="from" name="from" />
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Period To:</span>
						<input type="date" class= "details-field3" style="width:250px;" id="to" name="to" />
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Et. Al./Place:</span>
						<input type="text" class= "details-field2" id="etal" name="etal" />
					</div>					
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">OB No.:</span>
						<input type="text" class= "details-field2" id="obno" name="obno" required/>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Gross Amount:</span>
						<input onblur="comma()" type="text" class= "details-field2" id="gross" name="gross" required/>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Net Amount:</span>
						<input onblur="comma()" type="text" class= "details-field2" id="net" name="net" required/>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Fund:</span>
						<select id="fund" class= "details-field2" name="fund" required>
                <option name="101">101</option>
                <option name="102">102</option>
                <option name="171">171</option>
                <option name="184">101-184</option>
            </select>
					</div>
					<!--<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Claimed By:</span>
						<input type="text" style="width:350px;" class="details-field-a" id="eclaimed_by" readonly>
					</div>-->
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Program:</span>
						<select id="program" class= "details-field2" name="program" required>
                <option name="ADMINISTRATION OF PERSONNEL BENEFITS">ADMINISTRATION OF PERSONNEL BENEFITS</option>
                <option name="BANG-UN">BANG-UN</option>
                <option name="CAPABILITY TRAINING PROGRAMS">CAPABILITY TRAINING PROGRAMS</option>
                <option name="CENTENARIAN">CENTENARIAN</option>
                <option name="CENTER/COMM BASED CLIENTS">CENTER/COMM BASED CLIENTS</option>
                <option name="COMPREHENSIVE PROJECT FOR STREET CHILDREN, FAMILIES & IPs">COMPREHENSIVE PROJECT FOR STREET CHILDREN, FAMILIES & IPs</option>
                <option name="DISASTER RESPONSE AND REHABILITATION PROGRAM">DISASTER RESPONSE AND REHABILITATION PROGRAM</option>
                <option name="FORMULATION & DEVELOPMENT OF PLANS & POLICIES">FORMULATION & DEVELOPMENT OF PLANS & POLICIES</option>
                <option name="GASS">GASS</option>
                <option name="GENERAL MANAGEMENT & SUPERVISION">GENERAL MANAGEMENT & SUPERVISION</option>
                <option name="ICTMS">ICTMS</option>
                <option name="KALAHI-NCDDP ADB">KALAHI-NCDDP ADB</option>
                <option name="KALAHI-NCDDP GOP">KALAHI-NCDDP GOP</option>
                <option name="KALAHI-NCDDP WB">KALAHI-NCDDP WB</option>
                <option name="KC - KKB">KC - KKB</option>
                <option name="KC-PAMANA">KC-PAMANA</option>
                <option name="NATIONAL RESPONSE FUND">NATIONAL RESPONSE FUND</option>
                <option name="NEW TRUST FUND">NEW TRUST FUND</option>
                <option name="NHTS-PR">NHTS-PR</option>
                <option name="PAMANA PROGRAM DSWD/LGU LED LIVELIHOOD">PAMANA PROGRAM DSWD/LGU LED LIVELIHOOD</option>
                <option name="PAMANA PROGRAM PEACE & DEVELOPMENT">PAMANA PROGRAM PEACE & DEVELOPMENT</option>
                <option name="PANTAWID PAMILYA">PANTAWID PAMILYA</option>
                <option name="PRPTP">PRPTP</option>
                <option name="PSIFDC">PSIFDC</option>
                <option name="PWD/OP">PWD/OP</option>
                <option name="QRF">QRF</option>
                <option name="REGULAR TRUST FUND">REGULAR TRUST FUND</option>
                <option name="SERVICES FOR DISPLACED PERSON (DEPORTEES)">SERVICES FOR DISPLACED PERSON (DEPORTEES)</option>
                <option name="SERVICES TO DISTRESSED OVERSEAS FILIPINOS">SERVICES TO DISTRESSED OVERSEAS FILIPINOS</option>
                <option name="SFP">SFP</option>
                <option name="SLP">SLP</option>
                <option name="SMS">SMS</option>
                <option name="SOCIAL PENSION">SOCIAL PENSION</option>
                <option name="SOCTECH">SOCTECH</option>
                <option name="STANDARDS">STANDARDS</option>
                <option name="TARA">TARA</option>
                <option name="TAX REFORM CASH TRANSFER">TAX REFORM CASH TRANSFER</option>
                <option name="TECHNICAL/ADVISORY ASSISTANCE & RELATED SERVICES">TECHNICAL/ADVISORY ASSISTANCE & RELATED SERVICES</option>
              </select>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Remarks:</span>
            <input type="text" class= "details-field2" id="remarks" name="remarks" />
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Payment Type:</span>
						<select id="payment_type" class= "details-field2" name="payment_type" required>
                <option name="ada">ADA</option>
                <option name="cheque">cheque</option>
            </select>
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Payee Type:</span>
						<select id="payee_type" class= "details-field2" name="payee_type" required>
                <option name="creditor">creditor</option>
                <option name="employee">employee</option>
            </select>
            <input type="hidden" class= "details-field2" name="status" value="for_issuance"/>
					</div>
				</div>
            
            <input type="submit" class="buttons" name="add" onclick="myFunction()" value="Add"/>
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
  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript">
        $(function() {
            
            //autocomplete
            $("#payee").autocomplete({
                source: "../controllers/voucher_search.php",
                minLength: 1
            });                

        });
        </script>
        <script type="text/javascript">
        $(function() {
            
            //autocomplete
            $("#particular").autocomplete({
                source: "../controllers/particular_search.php",
                minLength: 1
            });                

        });
        </script>
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
<script>

function myFunction() {
    if($('#payee').val() == '' || $('#particular').val() == '' || $('#obno').val() == '' || $('#gross').val() == '' || $('#net').val() == ''){
        alert("Some important information are missing.");
    } else {
        alert("The voucher was successfully encoded.");
    }
}
</script>
<?php } else {
                header("location:index.php");
            }?> 