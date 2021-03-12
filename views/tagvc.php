<?php session_start(); 
    include "../controllers/tagvcfunction.php"; 
    
    if(isset($_SESSION['usertype']) && (($_SESSION['usertype']=="Encoder" || $_SESSION['usertype']=="Encoder2") || $_SESSION['usertype'] == "Claim/OR officer")){
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <title>CaDIS</title>
        <link rel="shortcut icon" href="img/dswd2.png">

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
                    <?php if($value['image']==null && $value['employee_id'] == $empid){ ?>
                      <center><img src= "img/prof.png" class="profilepic" align="center"></center>
                    <?php } else if($value['image']!=null && $value['employee_id'] == $empid) { 
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
          Tag as For Claim/For OR
        </h3> <!-- name of user -->
        <ol class="breadcrumb" align= "center"> 

        <?php if($et_al=="no"){ ?>
        <!-- FOR NONE ET AL VOUCHERS -->
        <form action="<?php $_PHP_SELF; ?>" method="POST">
        <h4 class="page-header">Enter Cheque/ADA Number</h4>
        <table class="table-acct">
            <thead style="background-color:#2c3531">
                <tr>    
                    <th>Cheque/ADA Number</th>
                    <th>Check/ADA Date Issued</th>
                    <th>Payee</th>
                    <th>Amount</th>                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($v_row as $index => $value): ?>
                <tr>
                    <input type="hidden" name="v_num" value="<?php echo $value['v_num']; ?>" />
                    <td>
                    <?php if($value['warrant_num'] != ''){ ?>
                      <input type="number" class="details-field4" id="warrant" name="warrant" placeholder="Input here..." value="<?php echo $value['warrant_num']; ?>" readonly/>
                    <?php } else { ?>
                      <input type="number" class="details-field4" id="warrant" name="warrant" placeholder="Input here..." value="<?php echo $value['warrant_num']; ?>" required/>
                    <?php } ?>
                    </td>
                    <td>
                    <?php if($value['date_released'] > 0){ ?>  
                      <input type="date" class="details-field4" id="date_released" name="date_released" value="<?php echo $value['date_released']; ?>" readonly/>
                    <?php } else { ?>
                      <input type="date" class="details-field4" id="date_released" name="date_released" value="<?php echo $value['date_released']; ?>" required/>
                    <?php } ?>
                    </td>

                    <td><input type="text" class="details-field7" id="payee" name="payee" size="50px" value="<?php echo $value['payee']; ?>" readonly/></td>
                    <td><input type="text" class="details-field4" id="net" name="net" min="0" max="<?php echo $value['net']; ?>" style="width:150px" value="<?php echo number_format($value['net'],2,'.',','); ?>" readonly/></td>
                    
                    <?php if(isset($value['et_al']) && $value['et_al'] == ""){ ?>
                      <input type="hidden" name="previous" value="<?php echo $_POST['previous']; ?>"/>
                        <td><input type="submit" class="buttons" name="save" onclick="warr2()" value="Save"/></td>
                    <?php } else { ?>
                        <td><input type="submit" class="buttons" name="save" value="Save" disabled/></td>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </form><br>

        <?php } else { ?>

        <!-- FOR ET AL VOUCHERS -->
        <form action="<?php $_PHP_SELF; ?>" id="insert_form" method="POST">
        <h4 class="page-header">Enter Cheque/ADA Number</h4>
        <table class="table-acct" id="item_table">
            <thead style="background-color:#2c3531">
                <tr>    
                    <th>Cheque/ADA Number</th>
                    <th>Payee</th>
                    <th>Amount</th>                    
                    <th><button type="button" style="width:80px" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($v_row as $index => $value): ?>
                    <input type="hidden" name="v_num" value="<?php echo $value['v_num']; ?>" />
                    <input type="hidden" name="date_encoded" value="<?php echo $value['date_encoded']; ?>" />
                    <input type="hidden" name="time_encoded" value="<?php echo $value['time_encoded']; ?>" />
                    <input type="hidden" name="particular" value="<?php echo $value['particular']; ?>" />
                    <input type="hidden" name="period_from" value="<?php echo $value['period_from']; ?>" />
                    <input type="hidden" name="period_to" value="<?php echo $value['period_to']; ?>" />
                    <input type="hidden" name="et_al" value="<?php echo $value['et_al']; ?>" />
                    <input type="hidden" name="ob_num" value="<?php echo $value['ob_num']; ?>" />
                    <input type="hidden" name="gross" value="<?php echo $value['gross']; ?>" />
                    <input type="hidden" name="fund" value="<?php echo $value['fund']; ?>" />
                    <input type="hidden" name="program" value="<?php echo $value['program']; ?>" />
                    <input type="hidden" name="remarks" value="<?php echo $value['remarks']; ?>" />
                    <input type="hidden" name="payment_type" value="<?php echo $value['payment_type']; ?>" />
                <tr>
                    <td><input type="number" class="details-field4" id="warrant2" name="warrant[]" placeholder="Input here..." required/></td>
                    <td><input type="text" class="details-field7" id="payee2" name="payee[]" size="50px" value="<?php echo $value['payee']; ?>" required/></td>
                    <td><input onkeyup = "javascript:this.value=Comma(this.value);" onblur="findTotal()" type="text" class="details-field4" id="net2" name="net[]" min="0" style="width:150px" placeholder="Input here..." step=".01" required/></td>
                    <td><button type="button" name="remove" style="width:80px" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td>
                </tr>
                <tr> 
                    <td><input type="number" class="details-field4" id="warrant2" name="warrant[]" placeholder="Input here..." required/></td>
                    <td><input type="text" class="details-field7" id="payee2" name="payee[]" size="50px" value="<?php echo $value['payee']; ?>" required/></td>
                    <td><input onkeyup = "javascript:this.value=Comma(this.value);" onblur="findTotal()" type="text" class="details-field4" id="net3" name="net[]" min="0" style="width:150px" placeholder="Input here..." step=".01" required/></td>
                    <td><button type="button" name="remove" style="width:80px" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
                <tr>
                    
                    <td>Check/ADA Date Issued<br><input type="date" class="details-field4" id="date_released2" name="date_released" required/></td>
                    <td><input type="text" style="background-color:#2c3531;color:#fff" class="details-field3" id="error" value="<?php echo "Remaining: ₱" . number_format($gross,2,'.',','); ?>" readonly></td>
                    <td>Total<br><input type="text" class="details-field4" id="total" min="0" style="width:150px" step=".01" readonly/></td>
                    <td></td>
                </tr>
        </table>
            <input type="hidden" name="previous" value="<?php echo $_POST['previous']; ?>"/>
            <input type="submit" onclick="warr()" class="buttons" id="add" name="add" value="Add"/>
            
        </form>
        
        <?php } ?>

            <a href="<?php echo $previous; ?>" class="cancel">Back</a><br>


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
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><input type="number" id="warrant2" name="warrant[]" class="details-field4 warrant" placeholder="Input here..." required/></td>';
  html += '<td><input type="text" name="payee[]" size="50px" class="details-field7 payee" value="<?php echo $value['payee']; ?>"/></td>';
  html += '<td><input onkeyup = "javascript:this.value=Comma(this.value);" onblur="findTotal()" type="text" name="net[]" min="0" style="width:150px" class="details-field4 net" step=".01" placeholder="Input here..." required/></td>';
  html += '<td><button type="button" name="remove" style="width:80px" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';

  $('#item_table').append(html);
 });
 
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });
 
});
</script>
<!--
<script type="text/javascript">
        $(function() {
            
            //autocomplete
            $("#warrant").autocomplete({
                source: "../controllers/warrant_search.php",
                minLength: 1
            });                

        });
        </script>
        <script type="text/javascript">
        $(function() {
            
            //autocomplete
            $("#warrant2").autocomplete({
                source: "../controllers/warrant_search.php",
                minLength: 1
            });                

        });
        </script>-->
    <script type="text/javascript">
    function findTotal(){
        var arr = document.getElementsByName('net[]');
        var tot=0;
        var balance=0;
        var gross = <?php echo $gross; ?>;
        for(var i=0;i<arr.length;i++){
            if(parseInt(arr[i].value))
                tot += parseFloat(arr[i].value.replace(/,/g, ''));
        }
        balance = gross - tot;
        document.getElementById('total').value = '₱' + tot.toLocaleString('en');
        document.getElementById('error').value = 'Remaining :₱' + balance.toLocaleString('en');
        if(tot > gross ){
          document.getElementById('error').value = 'The total amount is unbalanced.';
        }

        if(tot != gross){
          document.getElementById('add').disabled = true;
        } else {
          document.getElementById('add').disabled = false;
        }
        
    }

    function Comma(Num) { //function to add commas to textboxes
        Num += '';
        Num = Num.replace(',', ''); 
        x = Num.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        return x1 + x2;
    }


    function warr(){
      //alert('Cheque/ADA numbers must be unique.');
      var values = [];
      var check = [];
      check = <?php echo json_encode($arr); ?>;

        $('input[id^=warrant2]').each(function () {
            var varr = this.value;
            if ($.inArray(varr, values) >= 0) {
                alert('Cheque/ADA numbers must be unique.');
                document.getElementById('add').disabled = true;
                return false; // <-- stops the loop
            } else {
              document.getElementById('add').disabled = false;
            }

            if ($.inArray(varr, check) >= 0) {
                alert('Cheque/ADA numbers must be unique.');
                document.getElementById('add').disabled = true;
                return false; // <-- stops the loop
            } else {
              document.getElementById('add').disabled = false;
            }

            values.push(this.value);
        });
    }

    function warr2(){
      var check = [];
      check = <?php echo json_encode($arr); ?>;

        $('input[id^=warrant]').each(function () {
            var varr = this.value;
            if ($.inArray(varr, check) >= 0) {
                alert('Cheque/ADA numbers must be unique.');
                //document.getElementById('add').disabled = true;
                return false; // <-- stops the loop
            } else {
              alert('The voucher was successfully tagged.');
              //document.getElementById('add').disabled = false;
            }

            values.push(this.value);
        });
    }
    </script>

  <script src="js/jquery-1.4.4.min.js"></script>
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
    if($('#warrant').val() == '' || ($('#date_released').val() == null) || $('#payee').val() == '' || ($('#net').val() == null)){
        alert("Some information are missing.");
    } else {
        alert("The voucher was successfully tagged.");
    }
}
function myFunction2() {
    if($('#warrant2').val() == '' || ($('#date_released2').val() == null) || $('#payee2').val() == '' || ($('#net2').val() == null)){
        alert("Some information are missing.");
    } else {
        alert("The voucher was successfully tagged.");
    }
}
</script>
            <?php } else {
                        header("location:index.php");
            } ?>

