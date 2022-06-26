<?php
require_once 'connection.php';

if (session_status() != 2)
    session_start();
require "login.php";

if (!isset($_SESSION['Status']) || $_SESSION['Status'] == "Disconnected") {
    header("Location:index.php");
    die();
}
$username = $_SESSION['username'];
$sql1 = "SELECT * FROM users WHERE Username = '$username'";
$result1 = $conn->query($sql1);
$data1 = $result1->fetch_assoc();
$noOfRooms = $_SESSION['rooms'];
$nbenf = $_SESSION['nbenf'];
$nbadulte = $_SESSION['nbadulte'];
$date = $_SESSION['main-input-search'];
$date1 = new DateTime($date[0]);
$date2 = new DateTime($date[1]);
$hotelid = $_GET["id"];
$_SESSION['hotelid'] = $hotelid;
$numberOfNights = $date2->diff($date1)->format("%a");
$sql = "SELECT * FROM hotel WHERE id = $hotelid";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$date11 = date_format($date1, "y/m/d");
$date22 = date_format($date2, "y/m/d");
$r = $noOfRooms - 1;
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
$sql = "SELECT id_city FROM hotel WHERE id = $hotelid";
$resultcity = $conn->query($sql);
$datacity = $resultcity->fetch_assoc();
$id_city = $datacity["id_city"];
$sqlcity = "SELECT * FROM cites WHERE id = $id_city";
$resultNcity = $conn->query($sqlcity);
$dataNcity = $resultNcity->fetch_assoc();
$city = $dataNcity['Nom'];
$user_id = $data1['UserID'];
$sqlreser = "SELECT * FROM reservation WHERE Agent='$username'";
$result = mysqli_query($conn, $sqlreser);
$row = mysqli_num_rows($result);
$facture = "invoice.php?id=$hotelid&iduser=$user_id&num=$row";
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
        <?php include('./Layout/header.php')
        ?>

        <!--  header end -->
        <!--  wrapper  -->
        <div id="wrapper">
            <!-- content-->
            <div class="content">
                <div class="breadcrumbs-fs fl-wrap">
                    <div class="container">
                        <div class="breadcrumbs fl-wrap"><a href="#">Accueil</a><a href="#">Pages</a><span>Page de réservation</span></div>
                    </div>
                </div>
                <section class="middle-padding gre y-blue-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="bookiing-form-wrap">
                                    <ul id="progressbar">
                                        <li class="active"><span>01.</span>Informations personnelles</li>
                                        <li><span>02.</span>Adresse de facturation</li>
                                        <li><span>03.</span>Mode de paiement</li>
                                        <li><span>04.</span>Confirmer</li>
                                    </ul>
                                    <!--   list-single-main-item -->
                                    <div class="list-single-main-item fl-wrap hidden-section tr-sec">
                                        <div class="profile-edit-container">
                                            <div class="custom-form">
                                                <form id="GFG" action="booking-single.php" method="post">
                                                    <fieldset class="fl-wrap book_mdf">
                                                        <div class="list-single-main-item-title fl-wrap">
                                                            <h3>Vos informations personnelles</h3>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="hidden" id="city" name='city' value="<?php echo  $city; ?>" />
                                                            <input type="hidden" id="hotelid" name='hotelid' value="<?php echo  $hotelid; ?>" />
                                                            <input type="hidden" id="userid" name='userid' value="<?php echo  $data1['UserID']; ?>" />
                                                            <input type="hidden" id="username" name='username' value="<?php echo $username; ?>" />
                                                            <input type="hidden" id="date11" name='date11' value="<?php echo $date11; ?>" />
                                                            <input type="hidden" id="facture" name='facture' value="<?php echo  $facture; ?>" />
                                                            <input type="hidden" id="state" name='state' value="Confirmer" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Prénom <i class="fas fa-user"></i></label>
                                                                <input type="text" id="surname" name='name1' placeholder="Your Name" value="<?php echo $data1['firstname'] ?>" />
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>Nom de famille <i class="fas fa-user"></i></label>
                                                                <input type="text" id="name" name='name2' placeholder="Your Last Name" value="<?php echo $data1['name'] ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Adresse e-mail<i class="fas fa-envelope"></i> </label>
                                                                <input type="text" placeholder="yourmail@domain.com" value="<?php echo $data1['EMail'] ?>" />
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>Phone<i class="fas fa-phone"></i> </label>
                                                                <input type="text" placeholder="87945612233" value="<?php echo $data1['Phone'] ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="filter-tags">
                                                            <input id="check-a" type="checkbox" name="check">
                                                            <label for="check-a">En continuant, vous acceptez les<a href="#" target="_blank" required>Termes et conditions</a>.</label>
                                                        </div>
                                                        <span class="fw-separator"></span>
                                                        <a href="#" class="next-form action-button btn no-shdow-btn color-bg">Adresse de facturation <i class="fas fa-angle-right"></i></a>
                                                    </fieldset>
                                                    <fieldset class="fl-wrap book_mdf">
                                                        <div class="list-single-main-item-title fl-wrap">
                                                            <h3>Adresse de facturation</h3>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Ville <i class="fas fa-globe-asia"></i></label>
                                                                <input type="text" placeholder="Your city" value="" />
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>Pays </label>
                                                                <div class="listsearch-input-item ">
                                                                    <select data-placeholder="Your Country" class="chosen-select no-search-select">
                                                                        <option>United states</option>
                                                                        <option>Asia</option>
                                                                        <option>Australia</option>
                                                                        <option>Europe</option>
                                                                        <option>South America</option>
                                                                        <option>Africa</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label>Rue <i class="fas fa-road"></i> </label>
                                                                <input type="text" placeholder="Your Street" value="" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <label>État<i class="fas fa-street-view"></i></label>
                                                                <input type="text" placeholder="Your State" value="" />
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Code postal<i class="fas fa-barcode"></i> </label>
                                                                <input type="text" placeholder="123456" value="" />
                                                            </div>
                                                        </div>
                                                        <span class="fw-separator"></span>
                                                        <a href="#" class="previous-form action-button back-form   color-bg"><i class="fas fa-angle-left"></i> Retour</a>
                                                        <a href="#" class="next-form back-form action-button btn no-shdow-btn color-bg">Étape de paiement <i class="fas fa-angle-right"></i></a>
                                                    </fieldset>
                                                    <fieldset class="fl-wrap book_mdf">
                                                        <div class="list-single-main-item-title fl-wrap">
                                                            <h3>Mode de paiement</h3>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label>Nom du titulaire de la carte<i class="fas fa-user"></i></label>
                                                                <input type="text" placeholder="" value="Adam Kowalsky" />
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>Numéro de carte <i class="fas fa-credit-card-front"></i></label>
                                                                <input type="text" placeholder="xxxx-xxxx-xxxx-xxxx" value="" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <label>Mois d'expiration<i class="fas fa-calendar"></i></label>
                                                                <input type="text" placeholder="MM" value="" />
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>Année d'expiration<i class="fas fa-calendar"></i></label>
                                                                <input type="text" placeholder="YY" value="" />
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <label>CVV / CVC *<i class="fas fa-credit-card"></i></label>
                                                                <input type="password" placeholder="***" value="" />
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p style="padding-top:20px;">*Numéro à trois chiffres au dos de votre carte</p>
                                                            </div>
                                                        </div>
                                                        <span class="fw-separator"></span>
                                                        <a href="#" class="previous-form  back-form action-button    color-bg"><i class="fas fa-angle-left"></i> Retour</a>
                                                        <a href="#" id="action" name="action" class="action-button btn color2-bg no-shdow-btn" style="float : right">Confirmer et payer<i class="fas fa-angle-right"></i></a>
                                                        <p id="errorMsg" style="color : red; text-align : center; opacity : 0;pointer-events: none">Erreur lors de l'envoi de la demande, veuillez réessayer dans quelques minutes</p>
                                                    </fieldset>
                                                    <fieldset class="fl-wrap book_mdf">
                                                        <div class="list-single-main-item-title fl-wrap">
                                                            <h3>Confirmation</h3>
                                                        </div>
                                                        <div class="success-table-container">
                                                            <div class="success-table-header fl-wrap">
                                                                <i class="fas fa-check-circle decsth"></i>
                                                                <h4>Merci. Votre réservation a été reçue.</h4>
                                                                <div class="clearfix"></div>
                                                                <p>Votre paiement a été traité avec succès.</p>
                                                                <a href="invoice.php?id=<?php echo $facture;?>" target="_blank" class="color-bg">Voir la facture</a>
                                                            </div>
                                                        </div>
                                                        <span class="fw-separator"></span>
                                                        <a href="#" class="previous-form action-button  back-form   color-bg"><i class="fas fa-angle-left"></i> Retour</a>
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--   list-single-main-item end -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!--cart-details  -->
                                <div class="cart-details fl-wrap">
                                    <!--cart-details_header-->
                                    <div class="cart-details_header">
                                        <?php
                                        $idhotel = $data['id'];
                                        $sql2 = "SELECT* FROM images_hotel WHERE id_hotel=$idhotel limit 1";
                                        $result2 = $conn->query($sql2);
                                        while ($row2 = $result2->fetch_assoc()) {  ?>
                                            <a href="#" class="widget-posts-img"><img src="<?php echo "./admin/uploads/" . $row2["file_name"]; ?>" class="respimg" alt=""></a>
                                        <?php

                                        } ?>


                                        <div class="widget-posts-descr">
                                            <a href="#" title=""><?php echo $data['hoteltname']; ?></a>
                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $data['star']; ?>"></div>
                                            <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i><?php echo $data['adresse']; ?></a></div>
                                        </div>
                                    </div>
                                    <!--cart-details_header end-->
                                    <!--ccart-details_text-->
                                    <div class="cart-details_text">
                                        <ul class="cart_list">
                                            <?php
                                            for ($i = 0; $i < $noOfRooms; $i++) { ?>
                                                <li>Type de chambre<span><?php echo $arr[$i]["roomname"] ?></span></li>
                                            <?php  } ?>
                                            <li>De <span><?php echo $date11; ?></span></li>
                                            <li>À <span><?php echo $date22; ?></span></li>
                                            <li>Journées<span><?php echo $numberOfNights; ?> </span></li>
                                            <li>Adultes <span><?php echo $nbadulte; ?></span></li>
                                            <li>Enfants <span><?php echo $nbenf; ?> <strong>-10%</strong></span></li>
                                        </ul>
                                    </div>
                                    <!--cart-details_text end -->
                                </div>
                                <!--cart-details end -->
                                <!--cart-total -->
                                <div class="cart-total">
                                    <span class="cart-total_item_title">Coût total</span>
                                    <strong>$690</strong>
                                </div>
                                <!--cart-total end -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- section end -->
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbVEb8GFpi-a1cw4KqU-eJ3Kg3cTMqJPM"></script>
</body>

</html>