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
    <?php
    session_start();
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
                                <h2> <?php echo $rowcount; ?> Hotels in : <?php echo $city; ?></h2>
                            </div>
                            <!-- list-main-wrap-title end-->
                            <!-- list-main-wrap-opt-->
                            <div class="list-main-wrap-opt fl-wrap">
                                <!-- price-opt-->
                                <div class="price-opt">
                                    <span class="price-opt-title">Trier les résultats par:</span>
                                    <div class="listsearch-input-item">
                                        <select data-placeholder="Popularity" class="chosen-select no-search-select">
                                            <option>Popularité</option>
                                            <option>Note moyenne</option>
                                            <option>Prix ​​: Croissant</option>
                                            <option>prix : Décroissant</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- price-opt end-->
                                <!-- price-opt-->
                                <div class="grid-opt">
                                    <ul>
                                        <li><span class="two-col-grid act-grid-opt"><i class="fas fa-th-large"></i></span></li>
                                        <li><span class="one-col-grid"><i class="fas fa-bars"></i></span></li>
                                    </ul>
                                </div>
                                <!-- price-opt end-->
                            </div>
                            <!-- list-main-wrap-opt end-->
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
                                                            <div class="score"><strong>Very Good</strong>27 Reviews </div>
                                                            <span>5.0</span>
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
        <div class="main-register-wrap modal">
            <div class="reg-overlay"></div>
            <div class="main-register-holder">
                <div class="main-register fl-wrap">
                    <div class="close-reg color-bg"><i class="fas fa-times"></i></div>
                    <ul class="tabs-menu">
                        <li class="current"><a href="#tab-1"><i class="fas fa-sign-in-alt"></i> Connexion</a></li>
                        <li><a href="#tab-2"><i class="fas fa-user-plus"></i> S'inscrire</a></li>
                    </ul>
                    <!--tabs -->
                    <div id="tabs-container">
                        <div class="tab">
                            <!--tab -->
                            <div id="tab-1" class="tab-content">
                                <h3>S'identifier <span>Easy<strong>Book</strong></span></h3>
                                <div class="custom-form">
                                    <form method="post" name="registerform">
                                        <label>nom d'utilisateur ou adresse e-mail <span>*</span> </label>
                                        <input name="email" type="text" onClick="this.select()" value="">
                                        <label>Mot de passe <span>*</span> </label>
                                        <input name="password" type="password" onClick="this.select()" value="">
                                        <button type="submit" class="log-submit-btn"><span>Connexion</span></button>
                                        <div class="clearfix"></div>
                                        <div class="filter-tags">
                                            <input id="check-a" type="checkbox" name="check">
                                            <label for="check-a">Souviens-toi de moi</label>
                                        </div>
                                    </form>
                                    <div class="lost_password">
                                        <a href="#">Mot de passe perdu?</a>
                                    </div>
                                </div>
                            </div>
                            <!--tab end -->
                            <!--tab -->
                            <div class="tab">
                                <div id="tab-2" class="tab-content">
                                    <h3>S'inscrire <span>Easy<strong>Book</strong></span></h3>
                                    <div class="custom-form">
                                        <form method="post" name="registerform" class="main-register-form" id="main-register-form2">
                                            <label>Nom et prénom <span>*</span> </label>
                                            <input name="name" type="text" onClick="this.select()" value="">
                                            <label>Adresse e-mail <span>*</span></label>
                                            <input name="email" type="text" onClick="this.select()" value="">
                                            <label>Mot de passe <span>*</span></label>
                                            <input name="password" type="password" onClick="this.select()" value="">
                                            <button type="submit" class="log-submit-btn"><span>S'inscrire</span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--tab end -->
                        </div>
                        <!--tabs end -->
                        <div class="log-separator fl-wrap"><span>or</span></div>
                        <div class="soc-log fl-wrap">
                            <p>Pour une connexion ou un enregistrement plus rapide, utilisez votre compte social.</p>
                            <a href="#" class="facebook-log"><i class="fab fa-facebook-f"></i>Connecter avec Facebook</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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