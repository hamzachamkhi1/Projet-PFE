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

    $city = $_GET["ville"];
    $date = $_GET["main-input-search"];

    $noOfRooms = $_GET["rooms"];



    ?>
  <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "projectmeteor";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM hotels WHERE city='$city'";
        $rowcount = mysqli_num_rows(mysqli_query($conn, $sql));

        $result = $conn->query($sql);
        
    ?>
    <?php
				while($row = $result->fetch_assoc()) {
        			
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
                    <div class="list-wrap-search fl-wrap lws_mobile" id="lisfw">
                        <div class="container">
                            <div class="row">
                                <!-- col-list-search-input-item -->
                                <div class="col-md-4">
                                    <div class="col-list-search-input-item in-loc-dec fl-wrap not-vis-arrow">
                                        <label>Ville/Catégorie</label>
                                        <div class="listsearch-input-item">
                                            <select data-placeholder="Ville" class="chosen-select">
                                                <option>Toutes les villes</option>
                                                <option>New York</option>
                                                <option>London</option>
                                                <option>Paris</option>
                                                <option>Kiev</option>
                                                <option>Moscow</option>
                                                <option>Dubai</option>
                                                <option>Rome</option>
                                                <option>Beijing</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- col-list-search-input-item end -->
                                <!-- col-list-search-input-item -->
                                <div class="col-md-4">
                                    <div class="col-list-search-input-item fl-wrap location autocomplete-container">
                                        <label>Destination</label>
                                        <span class="header-search-input-item-icon"><i class="fas fa-map-marker-alt"></i></span>
                                        <input type="text" placeholder="Nom de la destination ou de l'hôtel" class="autocomplete-input" id="autocompleteid3" value="" />
                                        <a href="#"><i class="fas fa-dot-circle"></i></a>
                                    </div>
                                </div>
                                <!-- col-list-search-input-item end -->
                                <!-- col-list-search-input-item -->
                                <div class="col-md-4">
                                    <div class="col-list-search-input-item in-loc-dec date-container  fl-wrap">
                                        <label>Date d'entrée-sortie </label>
                                        <span class="header-search-input-item-icon"><i class="fas fa-calendar-check"></i></span>
                                        <input type="text" placeholder="Quand" name="dates" value="" />
                                    </div>
                                </div>
                                <!-- col-list-search-input-item end -->
                            </div>
                            <div class="search-opt-wrap fl-wrap">
                                <div class="search-opt-wrap-container">
                                    <!-- col-list-search-input-item -->
                                    <div class="search-input-item midd-input">
                                        <div class="col-list-search-input-item fl-wrap">
                                            <div class="quantity-item">
                                                <label>Pièces</label>
                                                <div class="quantity">
                                                    <input type="number" min="1" max="3" step="1" value="1">
                                                </div>
                                            </div>
                                            <div class="quantity-item">
                                                <label>Adultes</label>
                                                <div class="quantity">
                                                    <input type="number" min="1" max="5" step="1" value="1">
                                                </div>
                                            </div>
                                            <div class="quantity-item">
                                                <label>Enfants</label>
                                                <div class="quantity">
                                                    <input type="number" min="0" max="3" step="1" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- col-list-search-input-item end -->
                                    <!-- col-list-search-input-item -->
                                    <div class="search-input-item">
                                        <div class="range-slider-title">Échelle des prix</div>
                                        <div class="range-slider-wrap fl-wrap">
                                            <input class="range-slider" data-from="300" data-to="1200" data-step="50" data-min="50" data-max="2000" data-prefix="$">
                                        </div>
                                    </div>
                                    <!-- col-list-search-input-item end -->
                                    <!-- col-list-search-input-item -->
                                    <div class="search-input-item small-input ">
                                        <div class="col-list-search-input-item fl-wrap">
                                            <button class="header-search-button" onclick="window.location.href='listing.php'">Rechercher <i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                    <!-- col-list-search-input-item end -->
                                    <!-- hidden-listing-filter -->
                                    <div class="hidden-listing-filter fl-wrap">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <!--col-list-search-input-item -->
                                                <div class="col-list-search-input-item fl-wrap">
                                                    <h4>Évaluation étoilée</h4>
                                                    <div class="search-opt-container fl-wrap">
                                                        <!-- Checkboxes -->
                                                        <ul class="fl-wrap filter-tags">
                                                            <li class="five-star-rating">
                                                                <input id="check-aa2" type="checkbox" name="check" checked>
                                                                <label for="check-aa2"><span class="listing-rating card-popup-rainingvis" data-starrating2="5"><span>5 Étoiles</span></span></label>
                                                            </li>
                                                            <li class="four-star-rating">
                                                                <input id="check-aa3" type="checkbox" name="check">
                                                                <label for="check-aa3"><span class="listing-rating card-popup-rainingvis" data-starrating2="5"><span>4 Étoiles</span></span></label>
                                                            </li>
                                                            <li class="three-star-rating">
                                                                <input id="check-aa4" type="checkbox" name="check">
                                                                <label for="check-aa4"><span class="listing-rating card-popup-rainingvis" data-starrating2="5"><span>3 Étoiles</span></span></label>
                                                            </li>
                                                        </ul>
                                                        <!-- Checkboxes end -->
                                                    </div>
                                                </div>
                                                <!--col-list-search-input-item end-->
                                            </div>
                                            <div class="col-md-8">
                                                <!--col-list-search-input-item -->
                                                <div class="col-list-search-input-item fl-wrap">
                                                    <h4>Installations</h4>
                                                    <div class="search-opt-container fl-wrap">
                                                        <!-- Checkboxes -->
                                                        <ul class="fl-wrap filter-tags half-tags">
                                                            <li>
                                                                <input id="check-aaa5" type="checkbox" name="check" checked>
                                                                <label for="check-aaa5">Wifi gratuit</label>
                                                            </li>
                                                            <li>
                                                                <input id="check-bb5" type="checkbox" name="check" checked>
                                                                <label for="check-bb5">Parking</label>
                                                            </li>
                                                            <li>
                                                                <input id="check-dd5" type="checkbox" name="check">
                                                                <label for="check-dd5">Centre Fitness</label>
                                                            </li>
                                                        </ul>
                                                        <!-- Checkboxes end -->
                                                        <!-- Checkboxes -->
                                                        <ul class="fl-wrap filter-tags half-tags">
                                                            <li>
                                                                <input id="check-cc5" type="checkbox" name="check">
                                                                <label for="check-cc5">Chambres non-fumeurs</label>
                                                            </li>
                                                            <li>
                                                                <input id="check-ff5" type="checkbox" name="check" checked>
                                                                <label for="check-ff5">Navette aéroport</label>
                                                            </li>
                                                            <li>
                                                                <input id="check-c4" type="checkbox" name="check">
                                                                <label for="check-c4">Climatisation</label>
                                                            </li>
                                                        </ul>
                                                        <!-- Checkboxes end -->
                                                    </div>
                                                </div>
                                                <!--col-list-search-input-item end-->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- hidden-listing-filter end -->
                                </div>
                                <div class="show-more-filters act-hiddenpanel color3-bg"><i class="fas fa-plus"></i><span>Plus d'options</span></div>
                            </div>
                        </div>
                    </div>
                    <!--list-wrap-search end -->
                    <!-- list-main-wrap-->
                    <div class="list-main-wrap fl-wrap card-listing">
                        <a class="custom-scroll-link back-to-filters" href="#lisfw"><i class="fas fa-angle-up"></i><span>Retour aux filtres</span></a>
                        <div class="container">
                            <!-- list-main-wrap-title-->
                            <div class="list-main-wrap-title fl-wrap">
                                <h2> Hotels in : <?php echo $city; ?></h2>
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
                                <!-- listing-item  -->
                                <div class="listing-item">
                                    <div class="hotel-card fl-wrap">
                                        <div class="geodir-category-img card-post">
                                            <a href="listing-single.php"><<?php echo $row["mainImage"]; ?> alt=""></a>
                                            <div class="listing-counter">Par nuitée <strong><?php echo $row["price"] ?></strong></div>
                                            <div class="sale-window big-sale">Sale 50%</div>
                                            <div class="geodir-category-opt">
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                <h4><a href="listing-single.php"><?php echo $row["hotelName"]; ?></a></h4>
                                                <div class="geodir-category-location"><a href="#0" class="map-item"><i class="fas fa-map-marker-alt"></i> 27th Brooklyn New York, USA</a></div>
                                                <div class="rate-class-name">
                                                    <div class="score"><strong>Very Good</strong>27 Reviews </div>
                                                    <span>5.0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- listing-item end -->
                                <!-- listing-item  -->
                                <div class="listing-item">
                                    <div class="hotel-card fl-wrap">
                                        <div class="geodir-category-img card-post">
                                            <a href="listing-single.php"><img src="images/gal/4.jpg" alt=""></a>
                                            <div class="listing-counter">Awg/Night <strong>$120</strong></div>
                                            <div class="sale-window">Sale 20%</div>
                                            <div class="geodir-category-opt">
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>
                                                <h4><a href="listing-single.php">Grand Hero Palace</a></h4>
                                                <div class="geodir-category-location"><a href="#1" class="map-item"><i class="fas fa-map-marker-alt"></i> W 85th St, New York, USA</a></div>
                                                <div class="rate-class-name">
                                                    <div class="score"><strong>Good</strong>12 Reviews </div>
                                                    <span>4.2</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- listing-item end -->
                                <!-- listing-item  -->
                                <div class="listing-item">
                                    <div class="hotel-card fl-wrap">
                                        <div class="geodir-category-img card-post">
                                            <a href="listing-single.php"><img src="images/gal/6.jpg" alt=""></a>
                                            <div class="listing-counter">Awg/Night <strong>$80</strong></div>
                                            <div class="geodir-category-opt">
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                <h4><a href="listing-single.php">Park Central</a></h4>
                                                <div class="geodir-category-location"><a href="#2" class="map-item"><i class="fas fa-map-marker-alt"></i>40 Journal Square Plaza, NJ, USA</a></div>
                                                <div class="rate-class-name">
                                                    <div class="score"><strong>Good</strong>6 Reviews </div>
                                                    <span>4.7</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- listing-item end -->
                                <!-- listing-item  -->
                                <div class="listing-item">
                                    <div class="hotel-card fl-wrap">
                                        <div class="geodir-category-img card-post">
                                            <a href="listing-single.php"><img src="images/gal/2.jpg" alt=""></a>
                                            <div class="listing-counter">Awg/Night <strong>$50</strong></div>
                                            <div class="geodir-category-opt">
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="3"></div>
                                                <h4><a href="listing-single.php">Holiday Home</a></h4>
                                                <div class="geodir-category-location"><a href="#1" class="map-item"><i class="fas fa-map-marker-alt"></i> 75 Prince St, NY, USA</a></div>
                                                <div class="rate-class-name">
                                                    <div class="score"><strong>Pleasant</strong>10 Reviews </div>
                                                    <span>3.2</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- listing-item end -->
                                <!-- listing-item  -->
                                <div class="listing-item">
                                    <div class="hotel-card fl-wrap">
                                        <div class="geodir-category-img card-post">
                                            <a href="listing-single.php"><img src="images/gal/3.jpg" alt=""></a>
                                            <div class="listing-counter">Awg/Night <strong>$210</strong></div>
                                            <div class="sale-window">Sale 10%</div>
                                            <div class="geodir-category-opt">
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                <h4><a href="listing-single.php">Moonlight Hotel</a></h4>
                                                <div class="geodir-category-location"><a href="#4" class="map-item"><i class="fas fa-map-marker-alt"></i> 34-42 Montgomery St , NY, USA</a></div>
                                                <div class="rate-class-name">
                                                    <div class="score"><strong>Very Good</strong>102 Reviews </div>
                                                    <span>4.7</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- listing-item end -->
                                <!-- listing-item  -->
                                <div class="listing-item">
                                    <div class="hotel-card fl-wrap">
                                        <div class="geodir-category-img card-post">
                                            <a href="listing-single.php"><img src="images/gal/5.jpg" alt=""></a>
                                            <div class="listing-counter">Awg/Night <strong>$105</strong></div>
                                            <div class="sale-window big-sale">Sale 70%</div>
                                            <div class="geodir-category-opt">
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>
                                                <h4><a href="listing-single.php">Moonlight Hotel</a></h4>
                                                <div class="geodir-category-location"><a href="#5" class="map-item"><i class="fas fa-map-marker-alt"></i> 70 Bright St New York, USA</a></div>
                                                <div class="rate-class-name">
                                                    <div class="score"><strong> Good</strong>8 Reviews </div>
                                                    <span>4.1</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- listing-item end -->
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
        <?php
    			
            } ?>
            <?php $conn->close(); //closing the connection to the database ?>
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