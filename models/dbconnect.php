<?php

    class dbconnect {
        protected $con;

        function __construct(){
            $dbname = "cadisdb";
            $username = "root";
            $password = "";
            $server = "localhost";

            $this->con = mysqli_connect($server,$username,$password,$dbname);
            $this->con->set_charset('utf8');

            if(!$this->con){ echo "Error connecting to db". mysqli_error(); }
            if(!$this->con->set_charset('utf8')){ echo "Error charset". mysqli_error(); }
        }

        function close(){
            mysqli_close($this->con);
        }

    }


?>