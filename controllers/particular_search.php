<?php include "../models/functions.php";

    $functions = new functions();
    $conn = $functions->get_con();

    if (isset($_GET['term'])){
        $return_arr = array();
        $term = mysqli_real_escape_string($conn, $_GET['term']);

        $result = $functions->particular_fetch($term);

        if($result){
            while ($row = $result->fetch_array()){
                $return_arr[] = $row['particular'];
            }
        } else {
            echo "Error";
        }
        echo json_encode($return_arr);
    }
?>
