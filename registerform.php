<?php
if (isset($_POST['register'])) {
    require_once './connection.php';
    $name = $_POST['name'];
    $firstname=$_POST['firstname'];
    $phone=$_POST['phone'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $select = "SELECT `EMail` FROM `users` WHERE `EMail` = '" . $_POST['email'] . "'";
    $select1 = "SELECT `Username` FROM `users` WHERE `Username` = '" . $_POST['username'] . "'";
    $res = mysqli_query($conn, $select);
    $res1 = mysqli_query($conn, $select1);
    if (mysqli_num_rows($res) == 0 and mysqli_num_rows($res1) == 0) {
        $sql = "INSERT INTO users (firstname,name,email,Phone,Username,Pass)
                VALUES ('$firstname','$name','$email',' $phone','$username',' $password')";
        if (mysqli_query($conn, $sql)) {
        } else {
            echo "Error: " . $sql . ":-" . mysqli_error($conn);
        }
    } 
}
