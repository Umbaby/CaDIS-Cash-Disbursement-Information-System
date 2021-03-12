<?php session_start();
 include "../controllers/viewfunction.php";

$functions = new functions();

    /*$curr_date = date("Y-m-d");
    $expire_date = date('Y-m-d', strtotime("+3 months", strtotime($curr_date)));
    $days_remain = $expire_date - $curr_date;

    $notif = $functions->view_notif($_SESSION['anum']);
    foreach($notif as $index3 => $value3):
        if($value3['days_left']>0){
            $curr_date = date("Y-m-d");
            $future = strtotime($value3['expire_date']); //Future date.
            $timefromdb = strtotime($curr_date);
            $timeleft = $future-$timefromdb;
            $daysleft = round((($timeleft/24)/60)/60); 
            echo $daysleft . "<br>";
        }
    endforeach;

    echo "Current date: ". $curr_date;
    echo "<br>Expiration date: ". $expire_date;
    echo "<br>Days remaining: ". $days_remain;*/
?>
<html>
<head>
	<title>Shoe Glamour PoS</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<body>
    <input type="textbox" name="box" />
    <input type="submit" onclick="view()" name="sub" value="View">
    <?php $result = $functions->view_warrant(); 
            $arr = [];
            while($row = mysqli_fetch_array($result)){
                $arr[] = $row['0'];
            }
            echo json_encode($arr);
    ?>
<script>
    function view(){
        check = <?php echo json_encode($result); ?>;


    }
</script>
</body>
</html>