<?php session_start(); 
    include "../controllers/viewfunction.php"; 
    if(!isset($_SESSION['name'])){
?>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
      <link rel="shortcut icon" href="img/favicon.png">
      
      <title>DSWD XI - CASH DISBURSEMENT INFORMATION SYSTEM</title>
    
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
      <script type="text/javascript">
    $(document).ready(function() {
            $("body-index").css("display", "none");
            $("body-index").fadeIn(250);
            $("a.transition").click(function(event){
                event.preventDefault();
                linkLocation = this.href;
                $("body-index").fadeOut(250, redirectPage);      
            });
                
            function redirectPage() {
                window.location = linkLocation;
            }
    });
</script>
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript">
        $(function() {
            
            //autocomplete
            $("#input").autocomplete({
                source: "../controllers/index_search.php",
                minLength: 1
            });                

        });
        </script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    </head>

    <body class= "body-index">

        <!-- container section start -->
        <section id="container" class="">
      
          <header class="header dark-bg">
         
            <!--logo start-->
            
              <a href="#" class="logo">
                  <img src= "img/dswd2.png" class= "img-logo">
                DSWD XI - CaDIS
              </a>
            <!--logo end-->

            <div class="top-nav notification-row">
            
                <button class= "buttons-2"> <i class= "fa fa-sign-in"></i>
                    <a class="transition" href="/CaDIS/views/login.php">SIGN IN</a>  
                </button>
            
            </div>
              
          </header>

          <section id="main-content">
                <section class="wrapper">
                  <!--overview start-->
                  <div class="row">
                    <div class="col-lg-12">
                      <div class= "search-div">

                        <form action="<?php $_PHP_SELF; ?>" method="POST">
                            <input type="text" class= "search-btn" id="input" name="input" size="35" placeholder="Search for Payee" required/>
                            <input type="submit" class= "buttons" name="search" value="Search"/>
                            <a class= "cancel2" href="/CaDIS/views/index.php">Cancel</a>
                        </form>

                    </div>
                    
                    <?php if(isset($_POST['search'])){ ?>
                        <?php if($vrow->num_rows>0){ ?>
                            <div class= "div-div-a">
                                <table class="table-acct">
                                    <thead style="background-color:#2c3531;color:#ccc">
                                        <tr>
                                            <th style="border-top-left-radius:15px;">Status</th>
                                            <th>Payee</th>
                                            <th>Gross Amount</th>
                                            <th>Net Amount</th>
                                            <th>Warrant Number</th>
                                            <th style="border-top-right-radius:15px;">Date Released</th>
                                            <!--<th>Date Claimed</th>
                                            <th>Claimed By</th>-->
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class= "table-voucher2-a">
                            <table class="table-acct" id="item_table">
                                <tbody style="background-color:#fff;color:#000;opacity:0.8">
                                    <?php foreach($vrow as $index => $value): ?>
                                        <tr>
                                        <?php if($value['status'] == "for_issuance"){ ?>
                                            <td><?php echo "On Process"; ?></td>
                                        <?php } else if($value['status'] == "for_claim/for_or" && $value['payment_type'] == "cheque"){ ?>
                                            <td><?php echo "For Claim"; ?></td>
                                        <?php } else if($value['status'] == "for_claim/for_or" && $value['payment_type'] == "ADA"){ ?>
                                            <td><?php echo "For Receipt"; ?></td>
                                        <?php } ?>

                                            <td><?php echo $value['payee']; ?></td>                    
                                            <td><?php echo "₱". number_format($value['gross'],2,'.',','); ?></td>
                                            <td><?php echo "₱". number_format($value['net'],2,'.',','); ?></td>
                                            <td><?php if($value['warrant_num']>0){echo $value['warrant_num'];} else { echo ""; }  ?></td>
                                            <td><?php if($value['date_released']>0){ $date4=date_create($value['date_released']); echo date_format($date4,"M-d-Y"); } else { echo ""; } ?></td>
                                            <!--<td><?php// if($value['date_claimed']>0){ $date5=date_create($value['date_claimed']); echo date_format($date5,"M-d-Y"); } else { echo ""; } ?></td>-->
                                            <!--<td><?php// if($value['claimed_by']==""){echo "";} else { echo $value['claimed_by']; } ?></td>-->            
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                                <div class="buttons-div" style="margin-left:40%;">
                                    <input type="button" class="buttons" id="seeMoreRecords" value="Show More">
                                    <input type="button" class="buttons" id="seeLessRecords" value="Show Less">
                                </div>
                        <?php  } else { ?>
                            <div class="slideshow-div">
                                <br><br><br><br><br><br><br><br><br>
                                <p style="font-size:40px;color:red">NO ITEM(S) MATCHED YOUR SEARCH</p> 
                                </div>
                               
                    <?php } } else { ?>
                            <div class= "slideshow-div">
                            <img class= "slides-img" src= "img/background.png" style="width: 100vh">
                            </div>
                    <script>
                            var myIndex = 0;
                            carousel();
                            
                            function carousel() {
                                var i;
                                var x = document.getElementsByClassName("slides-img");
                                for (i = 0; i < x.length; i++) {
                                   x[i].style.display = "none";  
                                }
                                myIndex++;
                                if (myIndex > x.length) {myIndex = 1}    
                                x[myIndex-1].style.display = "block";  
                                setTimeout(carousel, 3000); // Change image every 2 seconds
                                document.getElementById('slider').className += "fadeOut";
                            }
                    </script>
                    <?php } ?>
                  </div>
          </section>
          <script type="text/javascript">
                document.getElementById('input').value = "<?php echo $_POST['input'];?>";
        </script>
        <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
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
    </body>
</html>
            <?php } else {
                header("location:login.php");
            } ?>

