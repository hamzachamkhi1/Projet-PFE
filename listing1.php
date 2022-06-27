<?php
if (session_status() != 2)
  session_start();
require "registerform.php";
require "login.php";
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
    <?php
    $_SESSION['ville'] = $_GET["ville"];
    $city =   $_SESSION['ville'];
    $_SESSION['rooms'] = $_GET["rooms"];
    $noOfRooms = $_SESSION['rooms'];
    $_SESSION['main-input-search'][0] = explode('-', $_GET["main-input-search"])[0];
    $checkin = $_SESSION['main-input-search'][0];
    $_SESSION['main-input-search'][1] = explode('-', $_GET["main-input-search"])[1];
    $checkout = $_SESSION['main-input-search'][1];
    $pax = [];
    for ($i = 0; $i < $noOfRooms; $i++) {
        $_SESSION['adultes' . $i + 1] = $_GET['adultes' . $i + 1];
        $pax[$i]['adultes'] = $_SESSION['adultes' . $i + 1];
        $_SESSION['Enfants' . $i + 1] = $_GET['Enfants' . $i + 1];
        $pax[$i]['enfants'] =  $_SESSION['Enfants' . $i + 1];

        if ($_GET['Enfants' . $i + 1] == 1) {
            $pax[$i]['age1'] = $_GET['Age' . $i + 1 . 0];
        } else 
        if ($_GET['Enfants' . $i + 1] == 2) {
            $pax[$i]['age1'] = $_GET['Age' . $i + 1 . 0];
            $pax[$i]['age2'] = $_GET['Age' . $i + 1 . 1];
        }
    }
    include 'connection.php';
    $sql1 = "SELECT id FROM cites WHERE Nom='$city'";
    $result1 = mysqli_query($conn, $sql1);
    while ($row1 = $result1->fetch_assoc()) {
        $_SESSION["id"] = $row1["id"];
        $val = $_SESSION["id"];
    }

    $sql = "SELECT * FROM hotel WHERE id_city = $val";
    $rowcount = mysqli_num_rows(mysqli_query($conn, $sql));
    $result = $conn->query($sql);



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
        <!-- header-->
        <?php include('./Layout/header.php')   ?>
        <!--  header end -->
        <!--  wrapper  -->
        <div id="wrapper">
            <!-- content-->
            <div class="content">
                <!-- Map -->
                <div class="map-container column-map right-pos-map fix-map hid-mob-map">
                    <div class="map-main"></div>
                    <ul class="mapnavigation">
                        <li><a href="#" class="prevmap-nav"><i class="fas fa-caret-left"></i> Préc</a></li>
                        <li><a href="#" class="nextmap-nav">Suiv <i class="fas fa-caret-right"></i></a></li>
                    </ul>
                    <div class="map-close"><i class="fas fa-times"></i></div>
                    <input id="pac-input" class="controls fl-wrap controls-mapwn" type="text" placeholder="Quoi à proximité ?">
                </div>
                <!-- Map end -->
                <!--col-list-wrap -->
                <div class="col-list-wrap left-list">
                    <div class="mobile-list-controls fl-wrap">
                        <div class="container">
                            <div class="mlc show-hidden-column-map schm"><i class="fas fa-map-marked-alt"></i> Afficher la carte</div>
                            <div class="mlc show-list-wrap-search"><i class="fas fa-filter"></i> Filtrer</div>
                        </div>
                    </div>
                    <!--list-wrap-search   -->

                    <!--list-wrap-search end -->
                    <!-- list-main-wrap-->
                    <div class="list-main-wrap fl-wrap card-listing">
                        <a class="custom-scroll-link back-to-filters" href="#lisfw"><i class="fas fa-angle-up"></i><span>Retour aux filtres</span></a>
                        <div class="container">
                            <!-- list-main-wrap-title-->
                            <div class="list-main-wrap-title fl-wrap">
                                <h2> <?php echo $rowcount; ?> Hôtels à :<?php echo $city; ?></h2>
                            </div>
                            <!-- list-main-wrap-title end-->
                            <!-- listing-item-container -->

                            <div class="listing-item-container init-grid-items fl-wrap">
                                <?php

                                while ($row = $result->fetch_assoc()) {
                                    $idhotel = $row['id'];
                                    $sql2 = "SELECT* FROM images_hotel WHERE id_hotel=$idhotel limit 1";
                                    $result2 = $conn->query($sql2);
                                    while ($row2 = $result2->fetch_assoc()) {

                                ?>

                                        <div class="listing-item">
                                            <div class="hotel-card fl-wrap">
                                                <div class="geodir-category-img card-post">
                                                    <a href="listing-single.php?id=<?php echo $row["id"] ?>"><img src='<?php echo "./admin/uploads/" . $row2["file_name"]; ?>' alt=""></a>
                                                    <div class="geodir-category-opt">
                                                        <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $row['star']; ?>"></div>
                                                        <h4><a href="listing-single.php?id=<?php echo $row["id"] ?>"><?php echo $row['hoteltname']; ?></a></h4>
                                                        <div class="geodir-category-location"><a href="#0" class="map-item"><i class="fas fa-map-marker-alt"></i><?php echo $row['adresse']; ?></a></div>
                                                        <div class="rate-class-name">
                                                            <div class="score"></div>
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php

                                    } ?>
                                <?php

                                } ?>
                            </div>

                            <!-- listing-item-container end-->
                            <!-- pagination-->
                            <div class="pagination">
                                <a href="#" class="prevposts-link"><i class="fas fa-caret-left"></i></a>
                                <a href="#">1</a>
                                <a href="#" class="current-page">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#" class="nextposts-link"><i class="fas fa-caret-right"></i></a>
                            </div>
                            <!-- pagination end-->
                        </div>
                    </div>
                    <!-- list-main-wrap end-->
                </div>
                <!--col-list-wrap end -->
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

        <?php $conn->close(); //closing the connection to the database 
        ?>
    </div>
    <!-- Main end -->
    <!--=============== scripts  ===============-->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbVEb8GFpi-a1cw4KqU-eJ3Kg3cTMqJPM"></script>
    <script type="text/javascript" src="js/mapplugins.js"></script>
    <script type="text/javascript" src="js/maps.js"></script>
</body>

</html>