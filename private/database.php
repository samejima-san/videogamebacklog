<?php
require_once('initialize.php');
require_once('db_credentials.php');


function db_connect(){
    $connection = mysqli_connect($_ENV["DB_SERVER"], $_ENV["DB_USER"], $_ENV["DB_PASS"], $_ENV["DB_NAME"]);
    //$connection = mysqli_connect("localhost", "saint", "karatekidv2", "users");
    return $connection;
}

function db_disconnect($connection){
    if(isset($connection)){
        mysqli_close($connection);
    }
}

function confirm_db_connect(){
    if(mysqli_connect_errno()){
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

function confirm_result_set($result_set){
    if(!$result_set){
        exit("Database query failed.");
    }
}

?>