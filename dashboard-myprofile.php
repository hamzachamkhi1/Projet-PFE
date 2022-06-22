<?php
session_start();
require "registerform.php";
require "login.php";
require_once 'connection.php';
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE Username = '$username'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$userid= $data['UserID'] ;
if (isset($_POST['submit'])) {
    $uploadsDir = "uploads/";
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = $uploadsDir . $filename;
    require_once 'connection.php';
    // Get all the submitted data from the form
    $sql = " UPDATE users  SET image = '$filename' where UserID='$userid' ";

    // Execute query
    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>ChamkhiBooking</title>
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
                            <div class="dasboard-breadcrumbs breadcrumbs"><a href="#">Accueil</a><a href="#">Tableau de bord</a><span>Page de profil</span></div>
                            <!--dasboard-sidebar-->
                            <div class="dasboard-sidebar">
                                <div class="dasboard-sidebar-content fl-wrap">
                                    <div class="dasboard-avatar">
                                        <img src="images/avatar/4.jpg" alt="">
                                    </div>
                                    <div class="dasboard-sidebar-item fl-wrap">
                                        <h3>
                                            <span>Bienvenue</span>
                                            <?php echo $data['name'] ?> <?php echo $data['firstname'] ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <!--dasboard-sidebar end-->
                            <!-- dasboard-menu-->
                            <div class="dasboard-menu">
                                <div class="dasboard-menu-btn color3-bg">Menu du tableau de bord <i class="fas fa-bars"></i></div>
                                <ul class="dasboard-menu-wrap">
                                    <li>
                                        <a href="dashboard.php" class="user-profile-act"><i class="fas fa-user"></i>Profil</a>
                                        <ul>
                                            <li><a href="dashboard-password.php">Changer le mot de passe</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="dashboard-bookings.php"> <i class="fas fa-calendar-check"></i> Réservations <span>2</span></a></li>
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
                                    <h3> Votre profil</h3>
                                </div>
                                <!-- profile-edit-container-->
                                <form action="dashboard-myprofile.php" enctype="multipart/form-data" method="POST">
                                    <div class="profile-edit-container">
                                        <div class="custom-form">
                                            <label>votre nom <i class="fas fa-user"></i></label>
                                            <input type="text" placeholder="" value="<?php echo $data['firstname'] ?>" />
                                            <label>votre prénom <i class="fas fa-user"></i></label>
                                            <input type="text" placeholder="" value="<?php echo $data['name'] ?>" />
                                            <label>Adresse e-mail<i class="fas fa-envelope"></i> </label>
                                            <input type="text" placeholder="" value="<?php echo $data['EMail'] ?>" />
                                            <label>Numéro de téléphone<i class="fas fa-phone"></i> </label>
                                            <input type="text" placeholder="" value="<?php echo $data['Phone'] ?>" />
                                            <label> Adresse <i class="fas fa-map-marker"></i> </label>
                                            <input type="text" placeholder="" value="<?php echo $data['Adress'] ?>" />
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <label> Notes</label>
                                                    <textarea cols="40" rows="3" placeholder="About Me"></textarea>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Change Avatar</label>
                                                    <div class="add-list-media-wrap">
                                                        <div class="fuzone">
                                                            <div class="fu-text">
                                                                <span><i class="fas fa-cloud-upload-alt"></i> Cliquez ici ou déposez les fichiers à télécharger</span>
                                                                <div class="photoUpload-files fl-wrap"></div>
                                                            </div>
                                                            <input type="file" name="uploadfile" class="upload">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn    color2-bg  float-btn" name="submit" type="submit" >Save Changes<i class="fal fa-save"></i></button>
                                    </div>
                                </form>
                                <!-- profile-edit-container end-->
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
        <!--map-modal -->
        <div class="map-modal-wrap">
            <div class="map-modal-wrap-overlay"></div>
            <div class="map-modal-item">
                <div class="map-modal-container fl-wrap">
                    <h3>Hotel Title</h3>
                    <div class="map-modal fl-wrap">
                        <div id="singleMap" data-latitude="40.7" data-longitude="-73.1"></div>
                    </div>
                    <a href="#" class="btn color2-bg">View Details <i class="fas fa-angle-right"></i></a>
                    <div class="map-modal-close"><i class="fas fa-times"></i></div>
                </div>
            </div>
        </div>
        <!--map-modal end -->
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbVEb8GFpi-a1cw4KqU-eJ3Kg3cTMqJPM"></script>
</body>

</html>