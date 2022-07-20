<?php
if (session_status() != 2)
    session_start();
require "registerform.php";
require "login.php" ?>
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
    require_once 'connection.php';
    $_SESSION['idho']=$_GET["id"];
    $hotelid = $_SESSION['idho'];
    $noOfRooms = $_SESSION['rooms'];
    $date = $_SESSION['main-input-search'];
    $date1 = new DateTime($date[0]);
    $date2 = new DateTime($date[1]);
    // this calculates the diff between two dates, which is the number of nights
    $numberOfNights = $date2->diff($date1)->format("%a");
    $r = $noOfRooms - 1;
    $sql = "SELECT * FROM hotel WHERE id = $hotelid";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $services = json_decode($data['services'], true);
    $hotelservicessize = sizeof($services);

    if ($r == 0) {
        $pax[$r]['adultes'] = $_SESSION['adultes' . $r + 1];
        $val_adult = $pax[$r]['adultes'];
        $pax[$r + 1]['enfant'] = $_SESSION['Enfants' . $r + 1];
        $val_enf = $pax[$r + 1]['enfant'];
        $chmb = array($val_adult, $val_enf);
        $totchambre = array($chmb);
        $sqlro = "SELECT * FROM room where id_hotel='$hotelid' and   max_adulte>='$val_adult' and  max_enfant>='$val_enf' and min_adulte <= '$val_adult' and min_enfant<='$val_enf' ";
        $resultro = mysqli_query($conn, $sqlro);
        $arr_values = array();
        while ($row = mysqli_fetch_array($resultro, MYSQLI_ASSOC)) {

            array_push($arr_values, $row);
        }
        $arr = array_unique($arr_values, SORT_REGULAR);
        $count = sizeof($arr);
        $countch = sizeof($arr_values);
    } elseif ($r == 1) {
        $pax[$r - 1]['adultes'] = $_SESSION['adultes' . $r];
        $val_adult = $pax[$r - 1]['adultes'];
        $pax[$r]['enfant'] = $_SESSION['Enfants' . $r];
        $val_enf = $pax[$r]['enfant'];
        $chmb1 = array($val_adult, $val_enf);
        $pax[$r]['adultes'] = $_SESSION['adultes' . $r + 1];
        $val_adult1 = $pax[$r]['adultes'];
        $pax[$r + 1]['enfant'] = $_SESSION['Enfants' . $r + 1];
        $val_enf1 = $pax[$r + 1]['enfant'];
        $chmb2 = array($val_adult1, $val_enf1);
        $totchambre = array($chmb1, $chmb2);
        $sqlro = "SELECT * FROM room where id_hotel='$hotelid' and   max_adulte>='$val_adult' and  max_enfant>='$val_enf' and min_adulte <= '$val_adult' and min_enfant<='$val_enf' ";
        $resultro = mysqli_query($conn, $sqlro);
        $arr_values = array();
        while ($row = mysqli_fetch_array($resultro, MYSQLI_ASSOC)) {

            array_push($arr_values, $row);
        }
        $sqlroo = "SELECT * FROM room where id_hotel='$hotelid' and max_adulte>='$val_adult1' and max_enfant>='$val_enf1' and min_adulte <= '$val_adult1' and min_enfant<='$val_enf1'";
        $resultroo = mysqli_query($conn, $sqlroo);
        while ($row = mysqli_fetch_array($resultroo, MYSQLI_ASSOC)) {
            array_push($arr_values, $row);
        }
        $arr = array_unique($arr_values, SORT_REGULAR);
        $count = sizeof($arr);
        $countch = sizeof($arr_values);
    } elseif ($r == 2) {
        $pax[$r - 2]['adultes'] = $_SESSION['adultes' . $r - 1];
        $val_adult = $pax[$r - 2]['adultes'];
        $pax[$r - 1]['enfant'] = $_SESSION['Enfants' . $r - 1];
        $val_enf = $pax[$r - 1]['enfant'];
        $chmb1 = array($val_adult, $val_enf);
        $pax[$r - 1]['adultes'] = $_SESSION['adultes' . $r];
        $val_adult1 = $pax[$r - 1]['adultes'];
        $pax[$r]['enfant'] = $_SESSION['Enfants' . $r];
        $val_enf1 = $pax[$r]['enfant'];
        $chmb2 = array($val_adult1, $val_enf1);
        $pax[$r]['adultes'] = $_SESSION['adultes' . $r + 1];
        $val_adult2 = $pax[$r]['adultes'];
        $pax[$r + 1]['enfant'] = $_SESSION['Enfants' . $r + 1];
        $val_enf2 = $pax[$r + 1]['enfant'];
        $chmb3 = array($val_adult2, $val_enf3);
        $totchambre = array($chmb1, $chmb2, $chmb3);
        $sqlro = "SELECT * FROM room where id_hotel='$hotelid' and   max_adulte>='$val_adult' and  max_enfant>='$val_enf' and min_adulte <= '$val_adult' and min_enfant<='$val_enf' ";
        $resultro = mysqli_query($conn, $sqlro);
        $arr_values = array();
        while ($row = mysqli_fetch_array($resultro, MYSQLI_ASSOC)) {

            array_push($arr_values, $row);
        }
        $sqlroo = "SELECT * FROM room where id_hotel='$hotelid' and max_adulte>='$val_adult1' and max_enfant>='$val_enf1' and min_adulte <= '$val_adult1' and min_enfant<='$val_enf1'";
        $resultroo = mysqli_query($conn, $sqlroo);
        while ($row = mysqli_fetch_array($resultroo, MYSQLI_ASSOC)) {
            array_push($arr_values, $row);
        }

        $sqlroom = "SELECT * FROM room where id_hotel='$hotelid' and  max_adulte>='$val_adult2' and  max_enfant>='$val_enf2' and min_adulte <= '$val_adult2' and min_enfant<='$val_enf2'";
        $resultroom = mysqli_query($conn, $sqlroom);
        while ($row = mysqli_fetch_array($resultroom, MYSQLI_ASSOC)) {
            array_push($arr_values, $row);
        }
        $arr = array_unique($arr_values, SORT_REGULAR);
        $count = sizeof($arr);
        $countch = sizeof($arr_values);
    }
    $date11 = date_format($date1, "y/m/d");
    $date22 = date_format($date2, "y/m/d");
    $sqlperiode = "SELECT * FROM periode WHERE id_hotel='$hotelid' AND datefrom<='$date11' and dateto>='$date22'";
    $resultperiode = $conn->query($sqlperiode);
    $dataperiode = $resultperiode->fetch_assoc();

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
                <!--  section  -->
                <section class="grey-blue-bg small-padding scroll-nav-container">
                    <div class="top-dec"></div>
                    <!--  scroll-nav-wrapper  -->
                    <div class="scroll-nav-wrapper fl-wrap">
                        <div class="hidden-map-container fl-wrap">
                            <input id="pac-input" class="controls fl-wrap controls-mapwn" type="text" placeholder="What Nearby ?   Bar , Gym , Restaurant ">
                            <div class="map-container">
                                <div id="singleMap" data-latitude="40.7427837" data-longitude="-73.11445617675781"></div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="container">
                            <nav class="scroll-nav scroll-init">
                                <ul>
                                    <li><a class="act-scrlink" href="#sec1">Gallery</a></li>
                                    <li><a href="#sec2">Details</a></li>
                                    <li><a href="#sec3">Amenities</a></li>
                                    <li><a href="#sec4">Rooms</a></li>
                                    <li><a href="#sec5">Reviews</a></li>
                                </ul>
                            </nav>
                            <a href="#" class="show-hidden-map"> <span>On The Map</span> <i class="fal fa-map-marked-alt"></i></a>
                        </div>
                    </div>
                    <!--  scroll-nav-wrapper end  -->
                    <!--   container  -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="list-single-main-container ">
                                    <!-- fixed-scroll-column  -->
                                    <div class="fixed-scroll-column">
                                        <div class="fixed-scroll-column-item fl-wrap">
                                            <div class="showshare sfcs fc-button"><i class="fas fa-share-alt"></i><span>Partager</span></div>
                                            <div class="share-holder fixed-scroll-column-share-container">
                                                <div class="share-container  isShare"></div>
                                            </div>
                                            <a class="fc-button custom-scroll-link" href="#sec6"><i class="fa-solid fa-comment"></i> <span> Ajouter un commentaire </span></a>
                                            <a class="fc-button" href="#"><i class="fas fa-heart"></i> <span>sauvegarder</span></a>
                                            <a href="booking-single.php" class="fc-button"><i class="fa-solid fa-bookmark"></i><span> Reserver maintenant </span></a>
                                        </div>

                                    </div>

                                    <!-- fixed-scroll-column end   -->

                                    <div class="list-single-main-media fl-wrap" id="sec1">
                                        <div class="single-slider-wrapper fl-wrap">
                                            <div class="slider-for fl-wrap">
                                                <?php
                                                $sql1 = "SELECT * FROM images_hotel WHERE id_hotel =  $hotelid";
                                                $result1 = $conn->query($sql1);
                                                while ($row = $result1->fetch_assoc()) {



                                                ?>
                                                    <div class="slick-slide-item"><img src='<?php echo "./admin/uploads/" . $row["file_name"]; ?>' alt=""></div>

                                                <?php

                                                } ?>
                                            </div>
                                            <div class="swiper-button-prev sw-btn"><i class="fas fa-long-arrow-left"></i></div>
                                            <div class="swiper-button-next sw-btn"><i class="fas fa-long-arrow-right"></i></div>
                                        </div>
                                        <div class="single-slider-wrapper fl-wrap">
                                            <div class="slider-nav fl-wrap">
                                                <?php
                                                $sql1 = "SELECT * FROM images_hotel WHERE id_hotel =  $hotelid";
                                                $result1 = $conn->query($sql1);
                                                while ($row = $result1->fetch_assoc()) {



                                                ?>
                                                    <div class="slick-slide-item"><img src='<?php echo "./admin/uploads/" . $row["file_name"]; ?>' alt=""></div>

                                                <?php

                                                } ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <!--  flat-hero-container -->

                                <div class="flat-hero-container fl-wrap">
                                    <div class="box-widget-item-header fl-wrap ">
                                        <h3><?php echo $data['hoteltname']; ?></h3>
                                        <div class="listing-rating-wrap">
                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $data['star']; ?>"></div>
                                        </div>
                                    </div>
                                    <div class="reviews-score-wrap fl-wrap">
                                        <div class="rate-class-name-wrap fl-wrap">
                                            <div class="rate-class-name">
                                                <span>4.5</span>
                                                <div class="score"><strong>Très bien</strong>2 Commentaires </div>
                                            </div>
                                            <a href="#sec6" class="color-bg  custom-scroll-link">Ajouter un commentaire</a>
                                        </div>
                                        <div class="review-score-detail">
                                            <!-- review-score-detail-list-->
                                            <div class="review-score-detail-list">
                                                <!-- rate item-->
                                                <div class="rate-item fl-wrap">
                                                    <div class="rate-item-title fl-wrap"><span>Propreté</span></div>
                                                    <div class="rate-item-bg" data-percent="100%">
                                                        <div class="rate-item-line color-bg"></div>
                                                    </div>
                                                    <div class="rate-item-percent">5.0</div>
                                                </div>
                                                <!-- rate item end-->
                                                <!-- rate item-->
                                                <div class="rate-item fl-wrap">
                                                    <div class="rate-item-title fl-wrap"><span>Confort</span></div>
                                                    <div class="rate-item-bg" data-percent="90%">
                                                        <div class="rate-item-line color-bg"></div>
                                                    </div>
                                                    <div class="rate-item-percent">5.0</div>
                                                </div>
                                                <!-- rate item end-->
                                                <!-- rate item-->
                                                <div class="rate-item fl-wrap">
                                                    <div class="rate-item-title fl-wrap"><span>Personnel</span></div>
                                                    <div class="rate-item-bg" data-percent="80%">
                                                        <div class="rate-item-line color-bg"></div>
                                                    </div>
                                                    <div class="rate-item-percent">4.0</div>
                                                </div>
                                                <!-- rate item end-->
                                                <!-- rate item-->
                                                <div class="rate-item fl-wrap">
                                                    <div class="rate-item-title fl-wrap"><span>Installations</span></div>
                                                    <div class="rate-item-bg" data-percent="90%">
                                                        <div class="rate-item-line color-bg"></div>
                                                    </div>
                                                    <div class="rate-item-percent">4.5</div>
                                                </div>
                                                <!-- rate item end-->
                                            </div>
                                            <!-- review-score-detail-list end-->
                                        </div>
                                    </div>
                                    <!-- reviews-score-wrap end -->
                                </div>

                                <!--   flat-hero-container end -->
                            </div>
                        </div>
                        <!--   row  -->
                        <div class="row">
                            <!--   datails -->
                            <div class="col-md-8">
                                <div class="list-single-main-container ">
                                    <!-- list-single-header end -->
                                    <div class="list-single-facts fl-wrap" id="sec2">
                                        <!-- inline-facts -->
                                        <div class="inline-facts-wrap">
                                            <div class="inline-facts">
                                                <i class="fas fa-bed"></i>
                                                <div class="milestone-counter">
                                                    <div class="stats animaper">
                                                        45
                                                    </div>
                                                </div>
                                                <h6>Chambres d'hôtel</h6>
                                            </div>
                                        </div>
                                        <!-- inline-facts end -->
                                        <!-- inline-facts  -->
                                        <div class="inline-facts-wrap">
                                            <div class="inline-facts">
                                                <i class="fas fa-users"></i>
                                                <div class="milestone-counter">
                                                    <div class="stats animaper">
                                                        2557
                                                    </div>
                                                </div>
                                                <h6>Clients chaque année</h6>
                                            </div>
                                        </div>
                                        <!-- inline-facts end -->
                                        <!-- inline-facts -->
                                        <div class="inline-facts-wrap">
                                            <div class="inline-facts">
                                                <i class="fas fa-taxi"></i>
                                                <div class="milestone-counter">
                                                    <div class="stats animaper">
                                                        15
                                                    </div>
                                                </div>
                                                <h6>Distance au centre</h6>
                                            </div>
                                        </div>
                                        <!-- inline-facts end -->
                                        <!-- inline-facts -->
                                        <div class="inline-facts-wrap">
                                            <div class="inline-facts">
                                                <i class="fas fa-cocktail"></i>
                                                <div class="milestone-counter">
                                                    <div class="stats animaper">
                                                        4
                                                    </div>
                                                </div>
                                                <h6>Restaurant à l'intérieur</h6>
                                            </div>
                                        </div>
                                        <!-- inline-facts end -->
                                    </div>
                                    <!--   list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>À propos de l'hôtel </h3>
                                        </div>
                                        <p><?php echo $data['description']; ?></p>

                                    </div>
                                    <!--   list-single-main-item end -->
                                    <!--   list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap" id="sec3">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Commodités</h3>
                                        </div>
                                        <div class="listing-features fl-wrap">

                                            <ul>
                                                <?php

                                                if (array_key_exists("1", $services)) {
                                                    echo '<li><i class="fas fa-wifi"></i>Wifi gratuit
                                                    </li>';
                                                }
                                                if (array_key_exists("2", $services)) {
                                                    echo '<li><i class="fas fa-parking"></i> Parking gratuit</li>';
                                                }
                                                if (array_key_exists("3", $services)) {
                                                    echo ' <li><i class="fa-solid fa-dumbbell"></i>Centre Fitness
                                                    </li>';
                                                }
                                                if (array_key_exists("4", $services)) {
                                                    echo ' <li><i class="fa-solid fa-ban-smoking"></i></i>chambres non fumeur
                                                    </li>';
                                                }
                                                if (array_key_exists("5", $services)) {
                                                    echo ' <li><i class="fas fa-plane"></i>Navette aéroport</li>';
                                                }
                                                if (array_key_exists("6", $services)) {
                                                    echo '<li><i class="fas fa-snowflake"></i> Climatisé</li>';
                                                }

                                                ?>

                                            </ul>

                                        </div>

                                    </div>
                                    <!--   list-single-main-item end -->

                                    <!--   list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap" id="sec4">


                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Chambres disponibles</h3>
                                        </div>
                                        <!--   rooms-container -->
                                        <?php
                                        for ($i = 0; $i < $noOfRooms; $i++) {
                                            $idroom = $arr[$i]['id'];
                                            $sqlimg1 = "SELECT * FROM images_room where id_room=$idroom limit 1";
                                            $resultimg1 = $conn->query($sqlimg1);
                                            $sqlimg2 = "SELECT * FROM images_room where id_room=$idroom";
                                            $resultimg2 = mysqli_query($conn, $sqlimg2);
                                            $num_rows = mysqli_num_rows($resultimg2);
                                            while ($rowimg1 = $resultimg1->fetch_assoc()) {



                                        ?>
                                                <div class="rooms-container fl-wrap">
                                                    <!--  rooms-item -->

                                                    <div class="rooms-item fl-wrap">
                                                        <div class="rooms-media">
                                                            <img src='<?php echo "./admin/uploads/" . $rowimg1["file_name"]; ?>' alt="">


                                                            <div class="dynamic-gal more-photos-button" data-dynamicPath="[<?php while ($rowimg2 = $resultimg2->fetch_assoc()) { ?>{src: '<?php echo "./admin/uploads/" . $rowimg2["file_name"]; ?>'},<?php } ?>]"> View Gallery <span><?php echo $num_rows; ?> photos</span> <i class="fas fa-long-arrow-right"></i></div>
                                                        <?php  } ?>
                                                        </div>
                                                        <div class="rooms-details">
                                                            <div class="rooms-details-header fl-wrap">
                                                                <h3> <?php echo $arr[$i]["roomname"] ?></h3>
                                                            </div>
                                                            <p><?php echo $arr[$i]["room_description"] ?></p>
                                                            <div class="facilities-list fl-wrap">
                                                                <ul>
                                                                    <?php
                                                                    $servicesroom = json_decode($arr[$i]["services"], true);
                                                                    if (array_key_exists('wifi', $servicesroom)) {
                                                                        echo '<li><i class="fas fa-wifi"></i><span>Wifi gratuit</span></li>';
                                                                    }
                                                                    if (array_key_exists('bathroom', $servicesroom)) {
                                                                        echo '<li><i class="fas fa-bath"></i><span>Salle de bain</span></li>';
                                                                    }
                                                                    if (array_key_exists('air_cond', $servicesroom)) {
                                                                        echo '<li><i class="fas fa-tv"></i><span> Télévision à l intérieur</span></li>';
                                                                    }
                                                                    if (array_key_exists('tv', $servicesroom)) {
                                                                        echo '<li><i class="fas fa-snowflake"></i><span>Climatiseur</span></li>';
                                                                    }
                                                                    if (array_key_exists('breakfast', $servicesroom)) {
                                                                        echo '<li><i class="fas fa-concierge-bell"></i><span>Petit-déjeuner</span></li>';
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <!--  rooms-item end -->
                                                </div>
                                            <?php  } ?>
                                            <button class="btn color-bg " id="tarif" onclick="Tarif()">Tarifs<i class="fas fa-caret-right"></i></button>
                                            <!--   rooms-container end -->
                                    </div>
                                    <!-- list-single-main-item end -->
                                    <!-- list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap" id="sec8" hidden>
                                        <div class="TableCalculateurHotels">
                                            <div class="col-lg-122">
                                                <div class="row justify-content-end">
                                                    <table class="table table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th>Type de chambre</th>
                                                                <th></th>
                                                                <th>Services</th>
                                                                <th class="text-right">
                                                                    Total <?php echo $numberOfNights; ?> nuitées
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        $nbenf = 0;
                                                        $nbadulte = 0;
                                                        for ($i = 0; $i < $noOfRooms; $i++) {
                                                            $nbenf = $nbenf + $totchambre[$i][1];
                                                            $nbadulte = $nbadulte + $totchambre[$i][0];
                                                        }
                                                        $_SESSION['nbenf'] = $nbenf;
                                                        $_SESSION['nbadulte'] = $nbadulte;
                                                        for ($i = 0; $i < $noOfRooms; $i++) {


                                                        ?>
                                                            <tbody>
                                                                <tr>
                                                                    <td data-title="Type de chambre">
                                                                        <input type="hidden" value="" name="supp_red_<?php echo $arr_values[$i]["id"] ?>_<?php echo $i ?>" id="supp_red_<?php echo $arr_values[$i]["id"] ?>_<?php echo $i ?>">
                                                                        <input type="hidden" value="" name="supp_chambre_supp_red_<?php echo $arr_values[$i]["id"] ?>_<?php echo $i ?>" id="supp_chambre_supp_red_<?php echo $arr_values[$i]["id"] ?>_<?php echo $i ?>">
                                                                        <input type="hidden" id="nbroom" value="<?php echo $noOfRooms; ?>">
                                                                        <input type="hidden" id="nbrenf<?php echo $i; ?>" value="<?php echo $totchambre[$i][1]; ?>">
                                                                        <input type="hidden" id="nbradulte<?php echo $i; ?>" value="<?php echo $totchambre[$i][0]; ?>">
                                                                        <input type="hidden" id="nbnights" value="<?php echo  $numberOfNights; ?>">
                                                                        <label class="custom-control custom-radio">
                                                                            <input name="proposition_<?php echo $i + 1; ?>" type="radio" class="custom-control-input" id="proposition<?php echo $i ?>__<?php echo $i ?>" value="<?php echo $i ?>_<?php echo $i ?>" checked onchange="majtotal()">
                                                                            <span class="custom-control-indicator"></span>
                                                                            <span class="custom-control-description"><small>Chambre <?php echo $i + 1; ?> :

                                                                                </small>
                                                                                <br>
                                                                                <span class="Room"> <?php echo $arr_values[$i]["roomname"]; ?></span></span>
                                                                        </label>
                                                                    </td>
                                                                    <td> <span aria-hidden="true" class="fa fa-user IconeAdulte"></span> <span aria-hidden="true" class="glyphicon glyphicon-user IconeAdulte"></span> <span aria-hidden="true" class="glyphicon glyphicon-user IconeChildren"></span></td>
                                                                    <td>
                                                                        <div class="arrangements">
                                                                            <select class="form-control custom-select" name="logement_<?php echo $arr_values[$i]["id"] ?>_<?php echo $i ?>" id="logement_<?php echo $i; ?>" onchange=" getpo(document.getElementById('logement_' + <?php echo $i; ?>),document.getElementById('supp_red_' + <?php echo $i; ?>))">
                                                                                <option value="<?php echo $dataperiode["demi_pension"] ?>" selected>Demi pension </option>
                                                                                <option value="<?php echo $dataperiode["pension_complète"] ?>">Pension complète </option>
                                                                                <option value="<?php echo $dataperiode["petit_déjeuner"] ?>">Petit_déjeuner </option>
                                                                            </select>
                                                                            <input type="hidden" name="prixarrangements" value="" id="op<?php echo $i; ?>">
                                                                        </div>
                                                                        <script>
                                                                            var select = document.getElementById('logement_' + <?php echo $i; ?>);
                                                                            var valueop = select.options[select.selectedIndex].value;
                                                                            document.getElementById('op' + <?php echo $i; ?>).value = valueop;
                                                                        </script>
                                                                        <script type="text/javascript">
                                                                            function getpoo(selectObject) {
                                                                                if (selectObject.id == 'logement_0') {
                                                                                    value = selectObject.value;
                                                                                    console.log(value);
                                                                                    const el = document.getElementById('op0');
                                                                                    el.value = value;
                                                                                } else if (selectObject.id == 'logement_1') {
                                                                                    value = selectObject.value;
                                                                                    console.log(value);
                                                                                    const el = document.getElementById('op1');
                                                                                    el.value = value;
                                                                                } else if (selectObject.id == 'logement_2') {
                                                                                    value = selectObject.value;
                                                                                    console.log(value);
                                                                                    const el = document.getElementById('op2');
                                                                                    el.value = value;
                                                                                }

                                                                            };
                                                                        </script>
                                                                        <div id="block_sous_0" class="supplements">
                                                                            <div id="DivSuppChambre_0">

                                                                                <select class="form-control custom-select" name="supp_red_<?php echo $arr_values[$i]["id"] ?>_<?php echo $i ?>" id="supp_red_<?php echo $i; ?>" onchange=" getpo(document.getElementById('logement_' + <?php echo $i; ?>),document.getElementById('supp_red_' + <?php echo $i; ?>))">
                                                                                    <option value="<?php echo $dataperiode["Standard"] ?>" selected>Standard </option>
                                                                                    <option value="<?php echo $dataperiode["Vue_Mer"] ?>">Vue_Mer</option>
                                                                                    <option value="<?php echo $dataperiode["vue_piscine"] ?>">vue_piscine </option>
                                                                                </select>



                                                                                <input type="hidden" name="prixsuup" value="" id="opp<?php echo $i; ?>">

                                                                            </div>
                                                                            <script>
                                                                                var select = document.getElementById('supp_red_' + <?php echo $i; ?>);
                                                                                var valueop = select.options[select.selectedIndex].value;
                                                                                document.getElementById('opp' + <?php echo $i; ?>).value = valueop;
                                                                            </script>
                                                                            <script type="text/javascript">
                                                                                function getpcheckbox(selectObject) {
                                                                                    if (selectObject.id == 'supp_red_0') {
                                                                                        value = selectObject.value;
                                                                                        const el = document.getElementById('opp0');
                                                                                        el.value = value;
                                                                                    } else if (selectObject.id == 'supp_red_1') {
                                                                                        value = selectObject.value;
                                                                                        const el = document.getElementById('opp1');
                                                                                        el.value = value;
                                                                                    } else if (selectObject.id == 'supp_red_2') {
                                                                                        value = selectObject.value;
                                                                                        const el = document.getElementById('opp2');
                                                                                        el.value = value;
                                                                                    }

                                                                                };
                                                                            </script>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <div class="box-PriceTotal">
                                                                            <span class="PriceTotal" value="" id="prixtotal_<?php echo $i; ?>"></span><br>
                                                                            <small> prix par nuit <small id="prixtotal_nuit_<?php echo $i; ?>"></small></small>
                                                                        </div>
                                                                        <script>
                                                                            var prixarrang = document.getElementById('op' + <?php echo $i; ?>).value;
                                                                            var prixsupp = document.getElementById('opp' + <?php echo $i; ?>).value;
                                                                            var nbrnights = document.getElementById('nbnights').value;
                                                                            var nbradulte = document.getElementById('nbradulte' + <?php echo $i; ?>).value;
                                                                            var nbrenf = document.getElementById('nbrenf' + <?php echo $i; ?>).value;
                                                                            var prixtotal = Number(nbrnights) * (Number(nbradulte) * (Number(prixarrang) + Number(prixsupp))) + (1 / 2 * Number(nbrenf) * (Number(prixarrang) + Number(prixsupp)));
                                                                            var prixtotal_nuit = (nbradulte * (Number(prixarrang) + Number(prixsupp))) + (1 / 2 * Number(nbrenf) * (Number(prixarrang) + Number(prixsupp)));
                                                                            var totalsejour = Number(totalsejour) + Number(prixtotal);
                                                                            document.getElementById('prixtotal_' + <?php echo $i; ?>).innerHTML = "" + prixtotal + "<sup>DT</sup>";
                                                                            document.getElementById('prixtotal_' + <?php echo $i; ?>).value = prixtotal;
                                                                            document.getElementById('prixtotal_nuit_' + <?php echo $i; ?>).innerHTML = "" + prixtotal_nuit + "<sup>DT</sup>";
                                                                        </script>
                                                                    </td>

                                                                </tr>

                                                                <tr>
                                                                    <td colspan="6" class="SeparateurRoom"></td>
                                                                </tr>

                                                            </tbody>
                                                        <?php } ?>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="3"></td>
                                                                <td class="TotalSejour">
                                                                    <div class="text-total-hotel" name="total">Total Séjour</div><span class="price" id="total"><sup>DT</sup></span>
                                                                </td>

                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <form action=<?php echo ((isset($_SESSION['Status']) && $_SESSION['Status'] == "Connected") ? "booking-single.php" : "listing-single.php") ?>>
                                                        <button name="reserve" type="submit" class="btn ml-auto btn_confirmation btn-lg" id="button_envoie">
                                                            Je réserve
                                                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                        </button>
                                                        <input type="hidden" name="id" value=<?php echo '"' . $_GET["id"] . '"' ?> />
                                                        <input type="hidden" name="total" value="" id="totalinput">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap" id="sec5">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Avis sur les articles - <span> 2 </span></h3>
                                        </div>
                                        <!--reviews-score-wrap-->
                                        <div class="reviews-score-wrap fl-wrap">
                                            <div class="review-score-total">
                                                <span>
                                                    4.5
                                                    <strong>Très bien</strong>
                                                </span>
                                                <a href="#sec6" class="color2-bg">Ajouter un commentaire</a>
                                            </div>
                                            <div class="review-score-detail">
                                                <!-- review-score-detail-list-->
                                                <div class="review-score-detail-list">
                                                    <!-- rate item-->
                                                    <div class="rate-item fl-wrap">
                                                        <div class="rate-item-title fl-wrap"><span>Propreté</span></div>
                                                        <div class="rate-item-bg" data-percent="100%">
                                                            <div class="rate-item-line color-bg" style="width: 100%;"></div>
                                                        </div>
                                                        <div class="rate-item-percent">5.0</div>
                                                    </div>
                                                    <!-- rate item end-->
                                                    <!-- rate item-->
                                                    <div class="rate-item fl-wrap">
                                                        <div class="rate-item-title fl-wrap"><span>Confort</span></div>
                                                        <div class="rate-item-bg" data-percent="90%">
                                                            <div class="rate-item-line color-bg" style="width: 90%;"></div>
                                                        </div>
                                                        <div class="rate-item-percent">5.0</div>
                                                    </div>
                                                    <!-- rate item end-->
                                                    <!-- rate item-->
                                                    <div class="rate-item fl-wrap">
                                                        <div class="rate-item-title fl-wrap"><span>Personnel</span></div>
                                                        <div class="rate-item-bg" data-percent="80%">
                                                            <div class="rate-item-line color-bg" style="width: 80%;"></div>
                                                        </div>
                                                        <div class="rate-item-percent">4.0</div>
                                                    </div>
                                                    <!-- rate item end-->
                                                    <!-- rate item-->
                                                    <div class="rate-item fl-wrap">
                                                        <div class="rate-item-title fl-wrap"><span>Installations</span></div>
                                                        <div class="rate-item-bg" data-percent="90%">
                                                            <div class="rate-item-line color-bg" style="width: 90%;"></div>
                                                        </div>
                                                        <div class="rate-item-percent">4.5</div>
                                                    </div>
                                                    <!-- rate item end-->
                                                </div>
                                                <!-- review-score-detail-list end-->
                                            </div>
                                        </div>
                                        <!-- reviews-score-wrap end -->
                                    </div>
                                    <!-- list-single-main-item end -->
                                    <!-- list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap" id="sec6">
                                        <div class="list-single-main-item-title fl-wrap">
                                            <h3>Ajouter un commentaire</h3>
                                        </div>
                                        <!-- Add Review Box -->
                                        <div id="add-review" class="add-review-box">
                                            <!-- Review Comment -->
                                            <form id="add-comment" class="add-comment  custom-form" name="rangeCalc">
                                                <fieldset>
                                                    <div class="review-score-form fl-wrap">
                                                        <div class="review-range-container">
                                                            <!-- review-range-item-->
                                                            <div class="review-range-item">
                                                                <div class="range-slider-title">Propreté</div>
                                                                <div class="range-slider-wrap ">
                                                                    <input type="text" class="rate-range" data-min="0" data-max="5" name="rgcl" data-step="1" value="4">
                                                                </div>
                                                            </div>
                                                            <!-- review-range-item end -->
                                                            <!-- review-range-item-->
                                                            <div class="review-range-item">
                                                                <div class="range-slider-title">Confort</div>
                                                                <div class="range-slider-wrap ">
                                                                    <input type="text" class="rate-range" data-min="0" data-max="5" name="rgcl" data-step="1" value="1">
                                                                </div>
                                                            </div>
                                                            <!-- review-range-item end -->
                                                            <!-- review-range-item-->
                                                            <div class="review-range-item">
                                                                <div class="range-slider-title">Personnel</div>
                                                                <div class="range-slider-wrap ">
                                                                    <input type="text" class="rate-range" data-min="0" data-max="5" name="rgcl" data-step="1" value="5">
                                                                </div>
                                                            </div>
                                                            <!-- review-range-item end -->
                                                            <!-- review-range-item-->
                                                            <div class="review-range-item">
                                                                <div class="range-slider-title">Installations</div>
                                                                <div class="range-slider-wrap">
                                                                    <input type="text" class="rate-range" data-min="0" data-max="5" name="rgcl" data-step="1" value="3">
                                                                </div>
                                                            </div>
                                                            <!-- review-range-item end -->
                                                        </div>
                                                        <div class="review-total">
                                                            <span><input type="text" name="rg_total" value="" data-form="AVG({rgcl})" value="0"></span>
                                                            <strong>Ton score</strong>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label><i class="fas fa-user"></i></label>
                                                            <input type="text" placeholder="votre nom*" value="" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><i class="fas fa-envelope"></i> </label>
                                                            <input type="text" placeholder="Adresse e-mail*" value="" />
                                                        </div>
                                                    </div>
                                                    <textarea cols="40" rows="3" placeholder="Votre avis :"></textarea>
                                                </fieldset>
                                                <button class="btn  big-btn flat-btn float-btn color2-bg" style="margin-top:30px">Poster le commentaire <i class="fas fa-paper-plane"></i></button>
                                            </form>
                                        </div>
                                        <!-- Add Review Box / End -->
                                    </div>
                                    <!-- list-single-main-item end -->
                                </div>

                            </div>

                            <!--   datails end  -->
                            <!--   sidebar  -->
                            <div class="col-md-4">
                                <!--box-widget-wrap -->
                                <div class="box-widget-wrap">
                                    <!--box-widget-item -->
                                    <div class="box-widget-item fl-wrap">
                                        <div class="box-widget">
                                            <div class="box-widget-content">
                                                <div class="box-widget-item-header">
                                                    <h3> Coordonnées</h3>
                                                </div>
                                                <div class="box-widget-list">
                                                    <ul>
                                                        <li><span><i class="fas fa-map-marker"></i> Adresse :</span> <a href="#"><?php echo $data['adresse']; ?></a></li>
                                                        <li><span><i class="fas fa-phone"></i> Téléphoner :</span> <a href="#"><?php echo $data['phone']; ?></a></li>
                                                        <li><span><i class="fa-solid fa-fax"></i></i> Fax :</span> <a href="#"><?php echo $data['fax']; ?></a></li>
                                                        <li><span><i class="fas fa-envelope"></i> Courrier :</span> <a href="#"><?php echo $data['Email_adresse']; ?></a></li>
                                                        <li><span><i class="fas fa-browser"></i> Site Internet :</span> <a href="#"><?php echo $data['website']; ?></a></li>
                                                    </ul>
                                                </div>
                                                <div class="list-widget-social">
                                                    <ul>
                                                        <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i><?php echo $data['facebook']; ?></a></li>
                                                        <li><a href="#" target="_blank"><i class="fab fa-twitter"></i><?php echo $data['twitter']; ?></a></li>
                                                        <li><a href="#" target="_blank"><i class="fab fa-instagram"></i><?php echo $data['instagram']; ?></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--box-widget-item end -->
                                    <!--box-widget-item -->
                                    <?php
                                    $id_city = $data['id_city'];
                                    $sqlwea = "SELECT * FROM cites WHERE id=$id_city";
                                    $resultwea = $conn->query($sqlwea);
                                    $datawea = $resultwea->fetch_assoc();
                                    ?>
                                    <div class="box-widget-item fl-wrap">
                                        <div id="weather-widget" class="gradient-bg ideaboxWeather" data-city="<?php echo $datawea['Nom'] ?>"></div>
                                    </div>
                                    <!--box-widget-item end -->
                                </div>
                                <!--box-widget-wrap end -->
                            </div>
                            <!--   sidebar end  -->
                        </div>
                        <!--   row end  -->
                    </div>
                    <!--   container  end  -->
                </section>
                <!--  section  end-->
            </div>
            <!-- content end-->
            <div class="limit-box fl-wrap"></div>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA844tkNbu9Gk651PRbkdn0AwxAPUXp8wI"></script>

</body>

</html>
<script>
    if (document.getElementById('prixtotal_1') == null && document.getElementById('prixtotal_2') == null) {
        var prix1 = document.getElementById("prixtotal_0").value;


        var prix = parseFloat(prix1);
        console.log(prix)
        document.getElementById("total").innerHTML = "" + prix + "<sup>DT</sup>";
        document.getElementById("totalinput").value = prix;

    }

    if (document.getElementById('prixtotal_1') != null && document.getElementById('prixtotal_2') != null) {
        var prix1 = document.getElementById("prixtotal_0").value;

        var prix2 = document.getElementById("prixtotal_1").value;
        var prix3 = document.getElementById("prixtotal_2").value;
        var prix = parseFloat(prix1) + parseFloat(prix2) + parseFloat(prix3);
    }
    if (document.getElementById('prixtotal_1') != null &&document.getElementById('prixtotal_2') == null) {
        var prix1 = document.getElementById("prixtotal_0").value;

        var prix2 = document.getElementById("prixtotal_1").value;
        var prix = parseFloat(prix1) + parseFloat(prix2);
    }
    document.getElementById("total").innerHTML = "" + prix + "<sup>DT</sup>";

    document.getElementById("totalinput").value = prix;
</script>
<script>
        function getpo(selectObject, checkObject) {
            var prix = 0;
            if (selectObject.id == 'logement_0' && checkObject.id == 'supp_red_0') {
                const el = document.getElementById('op0');
                const el1 = document.getElementById('opp0');
                value = selectObject.value;
                el.value = value;
                valuech = checkObject.value;
                console.log(valuech);
                console.log(value);
                el1.value = valuech;
                var nbrnights = document.getElementById('nbnights').value;
                var nbradulte = document.getElementById('nbradulte0').value;
                var nbrenf = document.getElementById('nbrenf0').value;
                var prixtotal0 = Number(nbrnights) * (Number(nbradulte) * (Number(value) + Number(valuech))) + (1 / 2 * Number(nbrenf) * (Number(value) + Number(valuech)));
                var prixtotal_nuit = (nbradulte * (Number(value) + Number(valuech))) + (1 / 2 * Number(nbrenf) * (Number(value) + Number(valuech)));
                document.getElementById('prixtotal_0').innerHTML = "" + prixtotal0 + "<sup>DT</sup>";
                document.getElementById('prixtotal_0').value = prixtotal0;
                document.getElementById('prixtotal_nuit_0').innerHTML = prixtotal_nuit;


            }
            if (selectObject.id == 'logement_1' && checkObject.id == 'supp_red_1') {
                value = selectObject.value;
                const el = document.getElementById('op1');
                el.value = value;
                valuech = checkObject.value;
                console.log(valuech);
                console.log(value);
                const el1 = document.getElementById('opp1');
                el1.value = valuech;
                var nbrnights = document.getElementById('nbnights').value;
                var nbradulte = document.getElementById('nbradulte1').value;
                var nbrenf = document.getElementById('nbrenf1').value;
                var prixtotal1 = Number(nbrnights) * (Number(nbradulte) * (Number(value) + Number(valuech))) + (1 / 2 * Number(nbrenf) * (Number(value) + Number(valuech)));
                var prixtotal_nuit = (nbradulte * (Number(value) + Number(valuech))) + (1 / 2 * Number(nbrenf) * (Number(value) + Number(valuech)));
                document.getElementById('prixtotal_1').innerHTML = "" + prixtotal1 + "<sup>DT</sup>";
                document.getElementById('prixtotal_1').value = prixtotal1;
                document.getElementById('prixtotal_nuit_1').innerHTML = prixtotal_nuit;


            }
            if (selectObject.id == 'logement_2' && checkObject.id == 'supp_red_2') {
                value = selectObject.value;
                console.log(value);
                const el = document.getElementById('op2');
                el.value = value;
                valuech = checkObject.value;
                console.log(valuech);
                const el1 = document.getElementById('opp2');
                el1.value = valuech;
                var nbrnights = document.getElementById('nbnights').value;
                var nbradulte = document.getElementById('nbradulte2').value;
                var nbrenf = document.getElementById('nbrenf2').value;
                var prixtotal2 = Number(nbrnights) * (Number(nbradulte) * (Number(value) + Number(valuech))) + (1 / 2 * Number(nbrenf) * (Number(value) + Number(valuech)));
                var prixtotal_nuit = (nbradulte * (Number(value) + Number(valuech))) + (1 / 2 * Number(nbrenf) * (Number(value) + Number(valuech)));
                document.getElementById('prixtotal_2').innerHTML = "" + prixtotal2 + "<sup>DT</sup>";
                document.getElementById('prixtotal_2').value = prixtotal2;
                document.getElementById('prixtotal_nuit_2').innerHTML = "" + prixtotal_nuit + "<sup>DT</sup>";

            }

            if (document.getElementById('prixtotal_1') == null && document.getElementById('prixtotal_2') == null) {
                var prix1 = document.getElementById("prixtotal_0").value;
                var prix = parseFloat(prix1);
                document.getElementById("total").innerHTML = "" + prix + "<sup>DT</sup>";
                document.getElementById("totalinput").value =prix;
            }

            if (document.getElementById('prixtotal_1') != null && document.getElementById('prixtotal_2') != null) {
                var prix1 = document.getElementById("prixtotal_0").value;

                var prix2 = document.getElementById("prixtotal_1").value;
                var prix3 = document.getElementById("prixtotal_2").value;
                var prix = parseFloat(prix1) + parseFloat(prix2) + parseFloat(prix3);
            }
            if (document.getElementById('prixtotal_2') == null) {
                var prix1 = document.getElementById("prixtotal_0").value;

                var prix2 = document.getElementById("prixtotal_1").value;
                var prix = parseFloat(prix1) + parseFloat(prix2);
            }
            document.getElementById("total").innerHTML = "" + prix + "<sup>DT</sup>";
            document.getElementById("totalinput").value =prix;

        };
    </script>
    <script>
        
        function majtotal() {

            var prix1 = document.getElementById("prixtotal_0").value;
            if (document.getElementById('prixtotal_1') != null && document.getElementById('prixtotal_2') != null) {

                var prix2 = document.getElementById("prixtotal_1").value;
                var prix3 = document.getElementById("prixtotal_2").value;

                var prix = parseFloat(prix1) + parseFloat(prix2) + parseFloat(prix3);
            }
            if (document.getElementById('prixtotal_2') == null) {
                var prix2 = document.getElementById("prixtotal_1").value;
                var prix = parseFloat(prix1) + parseFloat(prix2);
            }
            if (document.getElementById('prixtotal_1') == null && document.getElementById('prixtotal_2') == null) {
                var prix = parseFloat(prix1);
            }
           
          
            document.getElementById("total").innerHTML = "" + prix + "<sup>DT</sup>";
            document.getElementById("totalinput").value =prix;
        }
    </script>
    <script>
        function Tarif() {
            var x = document.getElementById("sec8");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
        <?php if (isset($_GET["reserve"]) && (!isset($_SESSION['Status']) || $_SESSION['Status'] == "Disconnected")) {
            echo 'setTimeout(()=>{document.getElementById("login").click();},1000);';
        }
        ?>
    </script>