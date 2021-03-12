<?php session_start();
      include "../controllers/viewfunction.php";

    if(isset($_SESSION['name'])){
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
			url: "view_notification.php",
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

      <!--<li id= "sidemenu">
        <a class="transition" href="activity.php?ac_select=yes">
                      <i class="fa fa-calendar-o"></i>
                      <span>User Activity</span>
        </a>
      </li>-->
    <?php } ?>

    <?php if(isset($_SESSION['usertype']) && $_SESSION['usertype'] != "Admin"){ ?>
    <li id= "sidemenu">
        <a href="vouchers.php?vc_select=yes">
                      <i class="fa fa-file-text"></i>
                      <span> Manage Vouchers </span>
                      
        </a>
        <?php } ?>

        <?php if(isset($_SESSION['usertype']) && ($_SESSION['usertype'] == "Encoder" || $_SESSION['usertype'] == "Encoder2")){ ?>
    <li id= "sidemenu">
        <a class="transition" href="addvoucher.php">
                      <i class="fa fa-files-o"></i>
                      <span> New Transaction </span>
                      
        </a>
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
        <h3 class="page-header"><i class="fa fa-calendar-o"></i>
          Timely Reports
        </h3> <!-- name of user -->
        <ol class="breadcrumb" align= "center"> 

        <div class= "div-div">
        <form action="<?php $_PHP_SELF; ?>" method="POST">
            <strong>(Choose Date Coverage) </strong>
            From: 
            <input class="details-field6" type="date" id="filter_report_from" name="filter_report_from"/>
            To:
            <input class="details-field6" type="date" id="filter_report_to" name="filter_report_to"/>
            <input type="submit" class="buttons" name="filter_report" value="Filter"/>
            <a class="cancel" href="/CaDIS/views/reports.php?r_select=yes">Cancel</a>
        </form>
        </div>

        <div class="center" align="center">
        <?php if(isset($_POST['filter_report'])){ ?>
            <?php if(isset($rrows) && $rrows->num_rows>0){ ?>
                <div class= "table-voucher">
                    <div class="for_issuance">
                        <br>Encoded Vouchers:<br><br>
                        <?php echo "<p class='report'>Total Count: " . $for_issuance . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($for_issuance_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($for_issuance_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <div class="for_claim">
                        <br>Tagged as For Claim/Receipt:<br><br>
                        <?php echo "<p class='report'>Total Count: " . $for_claim . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($for_claim_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($for_claim_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <div class="claimed">
                        <br>Tagged as Claimed:<br><br>
                        <?php echo "<p class='report'>Total Count: " . $claimed . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($claimed_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($claimed_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <div class="overall">
                        <br>Overall:<br><br>
                        <?php echo "<p class='report'>Total Count: " . ($for_issuance + $for_claim + $claimed) . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($total_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($total_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <br>
                    <div class="centered">
                        <div class="cancelled">
                            <br>Tagged as Cancelled:<br><br>
                            <?php echo "<p class='report'>Total Count: " . $cancelled . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Gross: ₱ " . number_format($cancelled_gross,2,'.',',') . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Net: ₱ " . number_format($cancelled_net,2,'.',',') . "</p>" ; ?>
                        </div>
                        <div class="expired">
                            <br>Tagged as Stale:<br><br>
                            <?php echo "<p class='report'>Total Count: " . $expired . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Gross: ₱ " . number_format($expired_gross,2,'.',',') . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Net: ₱ " . number_format($expired_net,2,'.',',') . "</p>" ; ?>
                        </div>
                </div>
                </div>
            <?php } else { ?>
                <div class= "table-voucher">
                    <div class="for_issuance">
                        <br>Encoded Vouchers:<br><br>
                        <?php echo "<p class='report'>Total Count: " . $for_issuance . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($for_issuance_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($for_issuance_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <div class="for_claim">
                        <br>Tagged as For Claim/Receipt:<br><br>
                        <?php echo "<p class='report'>Total Count: " . $for_claim . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($for_claim_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($for_claim_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <div class="claimed">
                        <br>Tagged as Claimed:<br><br>
                        <?php echo "<p class='report'>Total Count: " . $claimed . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($claimed_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($claimed_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <div class="overall">
                        <br>Overall:<br><br>
                        <?php echo "<p class='report'>Total Count: " . ($for_issuance + $for_claim + $claimed) . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($total_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($total_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <br>
                    <div class="centered">
                        <div class="cancelled">
                            <br>Tagged as Cancelled:<br><br>
                            <?php echo "<p class='report'>Total Count: " . $cancelled . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Gross: ₱ " . number_format($cancelled_gross,2,'.',',') . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Net: ₱ " . number_format($cancelled_net,2,'.',',') . "</p>" ; ?>
                        </div>
                        <div class="expired">
                            <br>Tagged as Stale:<br><br>
                            <?php echo "<p class='report'>Total Count: " . $expired . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Gross: ₱ " . number_format($expired_gross,2,'.',',') . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Net: ₱ " . number_format($expired_net,2,'.',',') . "</p>" ; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <?php if(isset($rrows) && $rrows->num_rows>0){ ?>
                <div class= "table-voucher">
                    <div class="for_issuance">
                        <br>On Process:<br><br>
                        <?php echo "<p class='report'>Total Count: " . $for_issuance . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($for_issuance_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($for_issuance_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <div class="for_claim">
                        <br>For Claim/For Receipt:<br><br>
                        <?php echo "<p class='report'>Total Count: " . $for_claim . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($for_claim_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($for_claim_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <div class="claimed">
                        <br>Claimed:<br><br>
                        <?php echo "<p class='report'>Total Count: " . $claimed . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($claimed_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($claimed_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <div class="overall">
                        <br>Overall:<br><br>
                        <?php echo "<p class='report'>Total Count: " . ($for_issuance + $for_claim + $claimed) . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($total_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($total_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <br>
                    <div class="centered">
                        <div class="cancelled">
                            <br>Cancelled:<br><br>
                            <?php echo "<p class='report'>Total Count: " . $cancelled . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Gross: ₱ " . number_format($cancelled_gross,2,'.',',') . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Net: ₱ " . number_format($cancelled_net,2,'.',',') . "</p>" ; ?>
                        </div>
                        <div class="expired">
                            <br>Stale:<br><br>
                            <?php echo "<p class='report'>Total Count: " . $expired . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Gross: ₱ " . number_format($expired_gross,2,'.',',') . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Net: ₱ " . number_format($expired_net,2,'.',',') . "</p>" ; ?>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class= "table-voucher">
                    <div class="for_issuance">
                        <br>On Process:<br><br>
                        <?php echo "<p class='report'>Total Count: " . $for_issuance . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($for_issuance_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($for_issuance_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <div class="for_claim">
                        <br>For Claim/For Receipt:<br><br>
                        <?php echo "<p class='report'>Total Count: " . $for_claim . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($for_claim_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($for_claim_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <div class="claimed">
                        <br>Claimed:<br><br>
                        <?php echo "<p class='report'>Total Count: " . $claimed . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($claimed_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($claimed_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <div class="overall">
                        <br>Overall:<br><br>
                        <?php echo "<p class='report'>Total Count: " . ($for_issuance + $for_claim + $claimed) . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Gross: ₱ " . number_format($total_gross,2,'.',',') . "</p>" ; ?>
                        <?php echo "<p class='report'>Total Net: ₱ " . number_format($total_net,2,'.',',') . "</p>" ; ?>
                    </div>
                    <br>
                    <div class="centered">
                        <div class="cancelled">
                            <br>Cancelled:<br><br>
                            <?php echo "<p class='report'>Total Count: " . $cancelled . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Gross: ₱ " . number_format($cancelled_gross,2,'.',',') . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Net: ₱ " . number_format($cancelled_net,2,'.',',') . "</p>" ; ?>
                        </div>
                        <div class="expired">
                            <br>Stale:<br><br>
                            <?php echo "<p class='report'>Total Count: " . $expired . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Gross: ₱ " . number_format($expired_gross,2,'.',',') . "</p>" ; ?>
                            <?php echo "<p class='report'>Total Net: ₱ " . number_format($expired_net,2,'.',',') . "</p>" ; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
        </div>

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
        document.getElementById('filter_report_from').value = "<?php echo $_POST['filter_report_from'];?>";
  </script>
  <script type="text/javascript">
        document.getElementById('filter_report_to').value = "<?php echo $_POST['filter_report_to'];?>";
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