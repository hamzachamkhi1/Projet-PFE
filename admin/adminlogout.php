<?php   
session_start(); //to ensure you are using same session
unset($_SESSION["username"]);
unset($_SESSION["password"]);
session_destroy(); //destroy the session
header("location: ./adminlogin.php"); //to redirect back to "index.php" after logging out
exit();
?>