<?php
if(isset($_POST['logout'])){
    $_SESSION['Status'] =  'Disconnected';
    if(isset($_SESSION['username']))
        unset($_SESSION['username']);
    if(isset($_SESSION['password']))
        unset($_SESSION['password']);
    if(isset($_GET["reserve"]))
        unset($_GET["reserve"]);
}
if(!isset($_SESSION['Status'])){
    $_SESSION['Status'] =  'Disconnected';
}
if (isset($_POST['login']) && $_SESSION['Status'] == "Disconnected" && isset($_POST['Username']) && isset($_POST['Password'])) {
    require_once './connection.php';
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $sqlquery="SELECT UserID FROM users WHERE Username='$username' and Password='$password'";
        
    $result=mysqli_query($conn,$sqlquery);
        
    $row=mysqli_fetch_assoc($result);
    $count=mysqli_num_rows($result);
    if($count>0){
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        $_SESSION["Status"] = "Connected";    
    }
    else{
        throw new Exception("User Doesn't Exist!");
        header("location:dashboard-review.php");
        // echo "<h4 class='text-center bg-danger' style='font-weight:bold';>Invalid username and password</h4>";
    } 
}
?>