<?php
require_once 'connection.php';
$surname = $_REQUEST["surname"];
$hotelid = $_REQUEST["hotelid"];
$userid = $_REQUEST["userid"];
$name = $_REQUEST["name"];
$username = $_REQUEST["username"];
$city = $_REQUEST["city"];
$date11 = $_REQUEST["date11"];
$facture = $_REQUEST["facture"];
$state=$_REQUEST["state"];

//savi el data
//data is saved
   
    $sql = "INSERT INTO reservation (Agent,Destionation,Client,Dateofreservation,voucher,state) VALUES ('$username','$city','$surname $name','$date11','$facture','$state')";
    if (mysqli_query($conn, $sql)) {
        echo "True";
     } else
     echo "False"; 


