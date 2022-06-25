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


//savi el data
if(true) {
//data is saved
    echo "True";
    $sql = "INSERT INTO reservation (Agent,Destionation,Client,Dateofreservation,voucher) VALUES ('$username','$city','$surname $name','$date11','$facture')";
    if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
}
else
    echo "False";