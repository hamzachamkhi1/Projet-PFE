<?php
session_start();
require "registerform.php";
require "login.php";
require_once 'connection.php';
if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE Username = '$username'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $userid = $data["UserID"];
    $Pass = $data["Pass"];
    if (isset($_POST['submit']) && $_POST["oldpass"] == $Pass && $_POST["newpass"] == $_POST["newpass2"]) {
        $newpass = $_POST["newpass"];
        $sql = " UPDATE users  SET Pass ='$newpass'where UserID='$userid' ";
        // Execute query
        mysqli_query($conn, $sql);
        header("Location:index.php");
    } else {
        if ($_POST["newpass"] != $_POST["newpass2"]) {
            $error = 1;
            print_r($error);
        } elseif ($_POST["oldpass"] != $Pass) {
            $error = 0;
            print_r($error);
        }
    }
}


?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>Easybook - Hotel Booking Directory Listing Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!--=============== css  ===============-->
    <link type="text/css" rel="stylesheet" href="css/reset.css">
    <link type="text/css" rel="stylesheet" href="css/plugins.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/color.css">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="images/favicon.ico">
</head>

<body>
    <!--loader-->
    <div class="loader-wrap">
        <div class="pin">
            <div class="pulse"></div>
        </div>
    </div>
    <!--loader end-->
    <!-- Main  -->
    <div id="main">
        <!-- header-->
        <?php include('./Layout/header.php')   ?>
        <!--  header end -->
        <!--  wrapper  -->
        <div id="wrapper">
            <!-- content-->
            <div class="content">
                <!-- section-->
                <section class="flat-header color-bg adm-header">
                    <div class="wave-bg wave-bg2"></div>
                    <div class="container">
                        <div class="dasboard-wrap fl-wrap">
                            <div class="dasboard-breadcrumbs breadcrumbs"><a href="#">Home</a><a href="#">Dashboard</a><span>Profile page</span><span>Changer le mot de passe</span></div>
                            <!--dasboard-sidebar-->
                            <?php include('./dashboard.php')   ?>
                            <!--dasboard-sidebar end-->
                            <!-- dasboard-menu-->
                            <div class="dasboard-menu">
                                <div class="dasboard-menu-btn color3-bg">Menu du tableau de bord <i class="fas fa-bars"></i></div>
                                <ul class="dasboard-menu-wrap">
                                    <li>
                                        <a href="" class="user-profile-act"><i class="fas fa-user"></i>Profil</a>
                                        <ul>
                                            <li><a href="dashboard-myprofile.php">Editer le profil</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="dashboard-bookings.php"> <i class="fas fa-calendar-check"></i> Réservations</a></li>
                                </ul>
                            </div>
                            <!--dasboard-menu end-->
                        </div>
                    </div>
                </section>
                <!-- section end-->
                <!-- section-->
                <section class="middle-padding">
                    <div class="container">
                        <!--dasboard-wrap-->
                        <div class="dasboard-wrap fl-wrap">
                            <!-- dashboard-content-->
                            <div class="dashboard-content fl-wrap">
                                <div class="box-widget-item-header">
                                    <h3> Changer le mot de passe</h3>
                                </div>
                                <?php
                                ?>
                                <form action="dashboard-password.php" method="POST">

                                    <div class="custom-form no-icons">
                                        <div class="pass-input-wrap fl-wrap">
                                            <label>Mot de passe actuel</label>
                                            <input type="password" name="oldpass" class="pass-input" placeholder="" value="" />
                                            <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                                        </div>
                                        <div class="pass-input-wrap fl-wrap">
                                            <label>nouveau mot de passe</label>
                                            <input type="password" name="newpass" class="pass-input" placeholder="" value="" />
                                            <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                                        </div>
                                        <div class="pass-input-wrap fl-wrap">
                                            <label>Confirmer le nouveau mot de passe</label>
                                            <input type="password" name="newpass2" class="pass-input" placeholder="" value="" />
                                            <span class="eye"><i class="far fa-eye" aria-hidden="true"></i> </span>
                                        </div>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                        if ($error == 0) {
                                            echo '<div class="box-widget-item-header">'
                                                . '<h3>Saisissez un mot de passe valide et réessayez.</h3>'
                                                . '</div>';
                                        } elseif ($error == 1) {
                                            echo '<div class="box-widget-item-header">'
                                                . '<h3> Vous devez saisir deux fois le même mot de passe pour le confirmer.</h3>'
                                                . '</div>';
                                        }
                                    }
                                        ?>

                                        <button name="submit" type="submit" class="btn  big-btn  color2-bg flat-btn float-btn">Sauvegarder les modifications<i class="fal fa-save"></i></button>
                                    </div>
                                </form>
                            </div>
                            <!-- dashboard-list-box end-->
                        </div>
                        <!-- dasboard-wrap end-->
                    </div>
                </section>
                <div class="limit-box fl-wrap"></div>
            </div>
            <!-- content end-->
        </div>
        <!--wrapper end -->
        <!--footer -->
        <?php include('./Layout/footer.php')   ?>
        <!--footer end -->
        <!--register form -->
        <?php include('./dashbord-connection.php')   ?>
        <!--register form end -->
        <a class="to-top"><i class="fas fa-caret-up"></i></a>
    </div>
    <!-- Main end -->
    <!--=============== scripts  ===============-->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwJSRi0zFjDemECmFl9JtRj1FY7TiTRRo&libraries=places&callback=initAutocomplete"></script>
</body>

</html>