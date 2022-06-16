<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="login.css">
	<title> Admin Login Page</title>
</head>

<body>
<?php
session_start();
require '../connection.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['pwd'];
if(isset($_POST['username']) && isset($_POST['pwd'])){

    $sqlquery="SELECT id FROM admin WHERE nom='$username' and mot_de_passe='$password'";
    
    $result=mysqli_query($conn,$sqlquery);
    
    $row=mysqli_fetch_assoc($result);
    $count=mysqli_num_rows($result);
	
    if($count>0){
    
    //session_register("username");
    
    $_SESSION['name']=$username;
    header("location:dashboard-listing-table.php");
    
    }
	else{
		echo "<h4 class='text-center bg-danger' style='font-weight:bold';>Invalid username and password</h4>";
	}
    
    }
    
    }
?>

	<form action="adminlogin.php" method="POST" class="form">
		<div class="login-box">
			<h1>Login</h1>

			<div class="textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type="text" placeholder="Adminname" name="username" value="">

			</div>

			<div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="Password" name="pwd" value="">

			</div>

			<input class="button" type="submit" name="login" value="Sign In">

		</div>
	</form>
</body>

</html>