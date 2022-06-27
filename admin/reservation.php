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
    <link type="text/css" rel="stylesheet" href="../css/reset.css">
    <link type="text/css" rel="stylesheet" href="../css/plugins.css">
    <link type="text/css" rel="stylesheet" href="../css/style.css">
    <link type="text/css" rel="stylesheet" href="../css/color.css">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="images/favicon.ico">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['name'])) {
        header('Location: adminlogin.php');
    }
    include '../connection.php';
    ?>
    <!--loader-->
    <div class="loader-wrap">
        <div class="pin">
            <div class="pulse"></div>
        </div>
    </div>
    <!--loader end-->
    <!-- Main  -->
    <div id="main">
        <!-- content-->
        <div class="content">
            <!-- section-->
            <section class="flat-header color-bg adm-header">
                <div class="wave-bg wave-bg2"></div>
                <div class="container">
                    <div class="dasboard-wrap fl-wrap">
                        <div class="dasboard-breadcrumbs breadcrumbs"><a>Accueil</a><a>Tableau de bord</a><span>Liste des Utilisateurs</span></div>
                        <!--dasboard-sidebar-->
                        <?php include('./dasboard-sidebar.php')   ?>
                        <!--dasboard-sidebar end-->
                        <!-- dasboard-menu-->
                        <div class="dasboard-menu">
                                    <div class="dasboard-menu-btn color3-bg">Menu du tableau de bord <i class="fal fa-bars"></i></div>
                                    <ul class="dasboard-menu-wrap">
                                        <li>
                                            <a href="dashboard-listing-table.php"><i class="fa-solid fa-hotel"></i>Liste des hôtels</a>
                                        </li>
                                        <li><a href="dashboard-add-listing.php"><i class="fa-solid fa-plus"></i> Ajouter un Hôtel</a></li>
                                        <li>
                                            <a href="dasboardd-user.php"><i class="fa-solid fa-users"></i> Liste des Utilisateurs  </a>
                                          
                                        </li>
                                        <li><a href="reservation.php" class="user-profile-act"> <i class="fa-solid fa-receipt"></i>Liste des Réservations</a></li>                                    </ul>
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
                            <div class="dashboard-list-box fl-wrap">
                                <div class="dashboard-header fl-wrap">
                                    <h3>Réservations</h3>
                                </div>
                                <!-- dashboard-list end-->
                                <?php
                                $sql = "SELECT * FROM reservation";
                                $result = $conn->query($sql);
                                while ($data1 = $result->fetch_assoc()) {

                                ?>
                                    <div class="dashboard-list">
                                        <div class="dashboard-message">
                                            <span class="new-dashboard-item"><?php echo $data1["state"]; ?></span>
                                            <div class="dashboard-message-text">
                                                <div class="booking-details fl-wrap">
                                                    <span class="booking-title">Numéro de réservation</span> :
                                                    <span class="booking-text"><?php echo $data1["NumReservation"]; ?></span>
                                                </div>
                                                <div class="booking-details fl-wrap">
                                                    <span class="booking-title">Agent :</span>
                                                    <span class="booking-text"><?php echo $data1["Agent"]; ?></span>
                                                </div>
                                                <div class="booking-details fl-wrap">
                                                    <span class="booking-title">Destination :</span>
                                                    <span class="booking-text"><?php echo $data1["Destionation"]; ?></span>
                                                </div>
                                                <div class="booking-details fl-wrap">
                                                    <span class="booking-title">Client :</span>
                                                    <span class="booking-text"><?php echo $data1["Client"]; ?></span>
                                                </div>
                                                <div class="booking-details fl-wrap">
                                                    <span class="booking-title">Date de réservation :</span>
                                                    <span class="booking-text"><?php echo $data1["Dateofreservation"]; ?></span>
                                                </div>
                                                <div class="booking-details fl-wrap">
                                                    <span class="booking-title">Facture :</span>
                                                    <span class="booking-text"> <a href="<?php echo $data1["voucher"]; ?>" target="_top">Voir facture</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                                <!-- dashboard-list end-->
                            </div>
                            <!-- pagination-->
                            <div class="pagination">
                                <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                                <a href="#" class="current-page">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
                            </div>
                        </div>
                        <!-- dashboard-list-box end-->
                    </div>
                    <!-- dasboard-wrap end-->
                </div>
            </section>
            <div class="limit-box fl-wrap"></div>
        </div>
        <!-- content end-->
        <a class="to-top"><i class="fas fa-caret-up"></i></a>
    </div>
    <!-- Main end -->
    <!--=============== scripts  ===============-->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/plugins.js"></script>
    <script type="text/javascript" src="../js/scripts.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwJSRi0zFjDemECmFl9JtRj1FY7TiTRRo&libraries=places&callback=initAutocomplete"></script>
</body>

</html>