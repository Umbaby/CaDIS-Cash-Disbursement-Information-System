<?php session_start(); 
        session_regenerate_id();
    include "../controllers/loginfunction.php"; 
    
    if(!isset($_SESSION['name'])){ 
            if(isset($_COOKIE['attempts'])){

?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<head>
		<title>Sign In</title>
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
            
               <button class= "view-btn" style="border-radius:10px;"> <i class= "fa fa-list-alt"></i>
              <a class="transition" href="/CaDIS/views/index.php"> VIEW VOUCHERS </a>
               </button>
           
            </div>
              
          </header>

          <section id="main-content">
                <section class="wrapper">
                  <!--overview start-->
                  <div class="row">
                    <div class="col-lg-12">
                            <div class="login-form">

                            <form action="<?php $_PHP_SELF ?>" method="POST">
                            <img src= "img/userimg.png" class= "user">
                            <h2 class= "text-center">Sign In</h2>
                                <div class= "form-group">
                                    <div class= "input-group">
                                        <p> Username </p>
                                            <input type="text" class= "form-control" id="login_username" name="login_username" <?php if($login_username==null){ ?> placeholder="Enter username" <?php } else { ?> placeholder="Enter username" value="<?php echo $login_username; ?>" <?php } ?> disabled><br>
                                        <p> Password </p>
                                            <input type="password" id="myInput" class= "form-control" name="login_password" placeholder="Enter Password" disabled>
                                    </div>
                                </div>
                                    <div class= "clearfix">
                                        <input type="checkbox" onclick="myFunction()" disabled> Show Password</input><br><br>
                                        
                                        <script>
                                            function myFunction() {
                                                var x = document.getElementById("myInput");
                                                if (x.type === "password") {
                                                x.type = "text";
                                                } else {
                                                x.type = "password";
                                                }
                                            }
                                        </script>
                                    </div>  

                                    <div class="form-group">
                                            <p class= "alert2"> YOU HAVE REACHED THE MAXIMUM LOGIN ATTEMPTS(3).
                                            WAIT FOR <q id= "countdown" class="alert3"></q> SECONDS AND TRY AGAIN. </p>
                                            <br> 
                                        <input type="submit" class="btn btn-primary btn-block" id="submit" name="submit" value="Login" disabled>
                                    </div>

                                   
                            </form>
                        </div>

                                     <script type="text/javascript">
                                        window.onload = countdown(60);

                                        var myVar;
                                        function countdown(val)
                                        {
	                                    var counter=val;
	
	                                    myVar= setInterval(function()
	                                    { 
	                                    if(counter>=0)
		                                {
		                                document.getElementById("countdown").innerHTML=counter;
		                                }
	                                    if(counter<0)
		                                {
		                                location.reload();
		                                }
		
		                                counter--;		
	                                    }, 1000)
	
                                        }

                                        function set_count()
                                        {
	                                    clearInterval(myVar);
	                                    var count_val=document.getElementById("counter_val").value;
	                                    countdown(count_val);
                                        }
                                        </script>
                    </div>     
                </div>
          </section>
    </body>
</html>

<?php  } else { ?>

<html>
	<head>
		<title>Sign In</title>
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

        <script>
            function myFunction() {
                var x = document.getElementById("login_password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
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
        
           <button class= "view-btn" style="border-radius:10px;"> <i class= "fa fa-list-alt"></i>
          <a class="transition" href="/CaDIS/views/index.php"> VIEW VOUCHERS </a>
           </button>
        
        </div>
          
      </header>

      <section id="main-content">
            <section class="wrapper">
              <!--overview start-->
              <div class="row">
                <div class="col-lg-12">
                        <div class="login-form">


                        <form action="<?php $_PHP_SELF ?>" method="POST">
                        <img src= "img/userimg.png" class= "user">
                            <h2 class= "text-center">Sign In</h2>
                                <div class= "form-group">
                                    <div class= "input-group">
                                        <p> Username </p>
                                            <input type="text" class= "form-control" id="login_username" name="login_username" <?php if($login_username==null){ ?> placeholder="Enter username" <?php } else { ?> placeholder="Enter username" value="<?php echo $login_username; ?>" <?php } ?> required><br>
                                        <p> Password </p>
                                            <input type="password" id="myInput" class= "form-control" name="login_password" placeholder="Enter Password" required>
                                    </div>
                                </div>

                                <div class= "clearfix">
                                    <input type="checkbox" onclick="myFunction()" > Show Password</input><br><br>
                                        
                                        <script>
                                            function myFunction() {
                                                var x = document.getElementById("myInput");
                                                if (x.type === "password") {
                                                x.type = "text";
                                                } else {
                                                x.type = "password";
                                                }
                                            }
                                        </script>
                                </div>
                                     
                                <div class= "form-group">
                                    
                                    <br> <br> <br> <br> <br>
                                    <input type="submit" class="btn btn-primary btn-block" name="submit" value="Login">
                                </div>
                        </form>
                    </div>              
                </div>
            </div>
        </section>
    </body>
</html>
        <?php    
                if(isset($Logged_In)&&!$Logged_In){ ?>
                    <script type='text/javascript'>alert('INVALID CREDENTIALS');</script>
        <?php   }
            }
    } else {
        header("location:profile.php?pr_select=yes");
    }  
?>