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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="css/reset.css">
    <link type="text/css" rel="stylesheet" href="css/plugins.css">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/color.css">
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="images/favicon.ico">
</head>

<body>
    <?php
    include 'connection.php';
    $sql = "SELECT * FROM hotel limit 10";
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
                <!--section -->
                <section class="hero-section" data-scrollax-parent="true" id="sec1">
                    <div class="hero-parallax">
                        <div class="slideshow-container" data-scrollax="properties: { translateY: '200px' }">
                            <!-- slideshow-item -->
                            <div class="slideshow-item">
                                <div class="bg" data-bg="images/bg/9.jpg"></div>
                            </div>
                            <!--  slideshow-item end  -->
                            <!-- slideshow-item -->
                            <div class="slideshow-item">
                                <div class="bg" data-bg="images/bg/13.jpg"></div>
                            </div>
                            <!--  slideshow-item end  -->
                            <!-- slideshow-item -->
                            <div class="slideshow-item">
                                <div class="bg" data-bg="images/bg/6.jpg"></div>
                            </div>
                            <!--  slideshow-item end  -->
                        </div>
                        <div class="overlay op7"></div>
                    </div>
                    <div class="hero-section-wrap fl-wrap">
                        <div class="container">
                            <div class="home-intro">
                                <div class="section-title-separator"><span></span></div>
                                <h2>EasyBook Hotel Booking System</h2>
                                <span class="section-separator"></span>
                                <h3>Let's start exploring the world together with EasyBook</h3>
                            </div>
                            <div class="main-search-input-wrap">
                                <form action="listing1.php" method="GET" id="">
                                    <div class="main-search-input fl-wrap">
                                        <div class=" main-search-input-item location">
                                            <div class="col-list-search-input-item in-loc-dec fl-wrap not-vis-arrow  ">

                                                <div class="listsearch-input-item">
                                                    <select data-placeholder="Ville" class="chosen-select " name="ville" required>
                                                        <option>Toutes les villes</option>


                                                        <?php
                                                        include 'connection.php';
                                                        $records = mysqli_query($conn, "select id,Nom from cites");
                                                        while ($row = mysqli_fetch_array($records)) {
                                                            echo "<option value= " . $row['Nom'], ">" . $row['Nom'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <p class="color-red error-destination"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-search-input-item main-date-parent main-search-input-item_small">
                                            <span class="inpt_dec"><i class="fas fa-calendar-check"></i></span> <input type="text" placeholder="Quand" name="main-input-search" value="" required />
                                        </div>
                                        <div class="main-search-input-item">
                                            <div class="qty-dropdown fl-wrap">
                                                <div class="qty-dropdown-header fl-wrap" required><i class="fas fa-users"></i> Personnes</div>
                                                <div class="qty-dropdown-content fl-wrap" id="resvhotel">
                                                    <div class="qty-dropdown-content fl-wrap resvhotel1" id="a0">
                                                        <div class="quantity-item" id="chamb">
                                                            <label style=" margin-bottom: 20px;"><i class="fa-solid fa-bed"></i> Chambres</label>
                                                            <div class="quantity" id="r3">
                                                                <input type="number" min="1" max="3" step="1" value="1" name="rooms" id="rooms">
                                                                <div class="quantity-nav">
                                                                    <div class="quantity-button quantity-up">+</div>
                                                                    <div class="quantity-button quantity-down">-</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="qty-dropdown-content fl-wrap resvhotel1" id="a1">
                                                        <div class="quantity-item" id="chamb">
                                                            <label id="labchab"><i class="fa-solid fa-bed"></i> Chambre 1</label>
                                                            <div class="quantity" id="r3">

                                                            </div>
                                                        </div>
                                                        <div class="quantity-item" id="adul">

                                                            <label><i class="fas fa-male"></i> Adultes :<p> </p> </label>
                                                            <div class="quantity" id="r2">
                                                                <input type="number" min="1" max="3" step="1" value="2" id="adultes" name="adultes1">
                                                                <div class="quantity-nav">
                                                                    <div class="quantity-button quantity-up">+</div>
                                                                    <div class="quantity-button quantity-down">-</div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="quantity-item" id="enf">

                                                            <label><i class="fa-solid fa-baby"> </i> Enfants :<p> </p> </label>
                                                            <div class="quantity" id="r1">
                                                                <input type="number" min="0" max="2" step="1" value="0" id="enfant" name="Enfants1">
                                                                <div class="quantity-nav">
                                                                    <div class="quantity-button quantity-up">+</div>
                                                                    <div class="quantity-button quantity-down">-</div>
                                                                </div>
                                                            </div>
                                                            <div class="quantity-item" id="age-hold">
                                                                <div class="quantity-item" id="ag">

                                                                    <label id="labage"></i> Age1:<p> </p> </label>
                                                                    <div class="quantity" id="age">

                                                                        <select id="age2" class="selectpicker form-control" data-size="5" title="Select no. of guests" name="Age10">
                                                                            <option value=""> </option>
                                                                            <option value="1">1 </option>


                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                            <option value="11">11</option>
                                                                            <option value="12">12</option>
                                                                        </select>

                                                                        </select>

                                                                    </div>




                                                                </div>
                                                                <div class="quantity-item" id="ag1">

                                                                    <label id="labage1"></i> Age2:<p> </p> </label>
                                                                    <div class="quantity" id="age1">

                                                                        <select id="age3" class="selectpicker form-control" data-size="5" title="Select no. of guests" name="Age11">
                                                                            <option value=""> </option>
                                                                            <option value="1">1 </option>

                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                            <option value="11">11</option>
                                                                            <option value="12">12</option>
                                                                        </select>

                                                                        </select>

                                                                    </div>




                                                                </div>
                                                            </div>






                                                        </div>
                                                    </div>
                                                    <div class="qty-dropdown-content fl-wrap resvhotel1" id="a2">
                                                        <div class="quantity-item" id="chamb">
                                                            <label id="labchab"><i class="fa-solid fa-bed"></i> Chambre 2</label>
                                                            <div class="quantity" id="r3">

                                                            </div>
                                                        </div>
                                                        <div class="quantity-item" id="adul">

                                                            <label><i class="fas fa-male"></i> Adultes :<p> </p> </label>
                                                            <div class="quantity" id="r2">
                                                                <input type="number" min="1" max="3" step="1" value="2" id="adultes" name="adultes2">
                                                                <div class="quantity-nav">
                                                                    <div class="quantity-button quantity-up">+</div>
                                                                    <div class="quantity-button quantity-down">-</div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="quantity-item" id="enf">

                                                            <label><i class="fa-solid fa-baby"> </i> Enfants :<p> </p> </label>
                                                            <div class="quantity" id="r1">
                                                                <input type="number" min="0" max="2" step="1" value="0" id="enfant2" name="Enfants2">
                                                                <div class="quantity-nav">
                                                                    <div class="quantity-button quantity-up">+</div>
                                                                    <div class="quantity-button quantity-down">-</div>
                                                                </div>
                                                            </div>
                                                            <div class="quantity-item" id="age-hold">
                                                                <div class="quantity-item" id="ag2">

                                                                    <label id="labage"></i> Age1:<p> </p> </label>
                                                                    <div class="quantity" id="age">

                                                                        <select id="age1" class="selectpicker form-control" data-size="5" title="Select no. of guests" name="Age20">
                                                                            <option value=""> </option>
                                                                            <option value="1">1 </option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                            <option value="11">11</option>
                                                                            <option value="12">12</option>
                                                                        </select>

                                                                        </select>

                                                                    </div>




                                                                </div>
                                                                <div class="quantity-item" id="ag2-">

                                                                    <label id="labage1"></i> Age2:<p> </p> </label>
                                                                    <div class="quantity" id="age2">

                                                                        <select id="age3" class="selectpicker form-control" data-size="5" title="Select no. of guests" name="Age21">
                                                                            <option value=""> </option>
                                                                            <option value="1">1 </option>

                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                            <option value="11">11</option>
                                                                            <option value="12">12</option>
                                                                        </select>

                                                                        </select>

                                                                    </div>




                                                                </div>
                                                            </div>

                                                        </div>





                                                    </div>
                                                    <div class="qty-dropdown-content fl-wrap resvhotel1" id="a3">
                                                        <div class="quantity-item" id="chamb">
                                                            <label id="labchab"><i class="fa-solid fa-bed"></i> Chambre 3</label>

                                                        </div>
                                                        <div class="quantity-item" id="adul">

                                                            <label><i class="fas fa-male"></i> Adultes :<p> </p> </label>
                                                            <div class="quantity" id="r2">
                                                                <input type="number" min="1" max="3" step="1" value="2" id="adultes" name="adultes3">
                                                                <div class="quantity-nav">
                                                                    <div class="quantity-button quantity-up">+</div>
                                                                    <div class="quantity-button quantity-down">-</div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="quantity-item" id="enf">

                                                            <label><i class="fa-solid fa-baby"> </i> Enfants :<p> </p> </label>
                                                            <div class="quantity" id="r1">
                                                                <input type="number" min="0" max="2" step="1" value="0" id="enfant3" name="Enfants3">
                                                                <div class="quantity-nav">
                                                                    <div class="quantity-button quantity-up">+</div>
                                                                    <div class="quantity-button quantity-down">-</div>
                                                                </div>
                                                            </div>
                                                            <div class="quantity-item" id="age-hold">
                                                                <div class="quantity-item" id="ag3">

                                                                    <label id="labage"></i> Age1:<p> </p> </label>
                                                                    <div class="quantity" id="age">

                                                                        <select id="age2" class="selectpicker form-control" data-size="5" title="Select no. of guests" name="Age30">
                                                                            <option value=""> </option>
                                                                            <option value="1">1 </option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                            <option value="11">11</option>
                                                                            <option value="12">12</option>
                                                                        </select>

                                                                        </select>

                                                                    </div>




                                                                </div>
                                                                <div class="quantity-item" id="ag3-">

                                                                    <label id="labage1"></i> Age2:<p> </p> </label>
                                                                    <div class="quantity" id="age1">

                                                                        <select id="age3" class="selectpicker form-control" data-size="5" title="Select no. of guests" name="Age31">
                                                                            <option value=""> </option>
                                                                            <option value="1">1 </option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                            <option value="6">6</option>
                                                                            <option value="7">7</option>
                                                                            <option value="8">8</option>
                                                                            <option value="9">9</option>
                                                                            <option value="10">10</option>
                                                                            <option value="11">11</option>
                                                                            <option value="12">12</option>
                                                                        </select>

                                                                        </select>

                                                                    </div>




                                                                </div>

                                                            </div>




                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="main-search-button color2-bg" name='submit' type="button" onclick="TestForm()">Rechercher<i class="fas fa-search"></i></button>
                                        <input type="submit" value="submit" id="myform">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="header-sec-link">
                        <div class="container"><a href="#sec1" class="custom-scroll-link color-bg"><i class="fal fa-angle-double-down"></i></a></div>
                    </div>
                </section>
                <!-- section end -->
                <!-- section-->
                <section class="grey-blue-bg">
                    <!-- container-->
                    <div class="container">
                        <div class="section-title">
                            <div class="section-title-separator"><span></span></div>
                            <h2>Hôtels ajoutés récemment</h2>
                            <span class="section-separator"></span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.</p>
                        </div>
                    </div>
                    <!-- container end-->
                    <!-- carousel -->
                    <div class="list-carousel fl-wrap card-listing ">
                        <!--listing-carousel-->
                        <div class="listing-carousel  fl-wrap ">
                            <!--slick-slide-item-->
                            <?php

                            while ($row = $result->fetch_assoc()) {
                                $idhotel = $row['id'];
                                $sql2 = "SELECT* FROM images_hotel WHERE id_hotel=$idhotel limit 1";
                                $result2 = $conn->query($sql2);
                                $services = json_decode($row['services'], true);
                                $hotelservicessize = sizeof($services);
                                while ($row2 = $result2->fetch_assoc()) {

                            ?>
                                    <div class="slick-slide-item">
                                        <!-- listing-item  -->
                                        <div class="listing-item">
                                            <article class="geodir-category-listing fl-wrap">
                                                <div class="geodir-category-img">
                                                    <a href="#"><img src='<?php echo "./admin/uploads/" . $row2["file_name"]; ?>' alt=""></a>
                                                    <div class="geodir-category-opt">
                                                        <div class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $row['star']; ?>"></div>
                                                        <div class="rate-class-name">
                                                            <div class="score"><strong>Very Good</strong>27 Reviews </div>
                                                            <span>5.0</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="geodir-category-content fl-wrap title-sin_item">
                                                    <div class="geodir-category-content-title fl-wrap">
                                                        <div class="geodir-category-content-title-item">
                                                            <h3 class="title-sin_map"><a href="#"><?php echo $row['hoteltname']; ?></a></h3>
                                                            <div class="geodir-category-location fl-wrap"><a href="#" class="map-item"><i class="fas fa-map-marker-alt"></i><?php echo $row['adresse']; ?></a></div>
                                                        </div>
                                                    </div>
                                                    <p><?php echo $row['description']; ?></p>

                                                    <ul class="facilities-list fl-wrap">
                                                        <?php

                                                        if (array_key_exists("1", $services)) {
                                                            echo '<li><i class="fas fa-wifi"></i><span>Wifi gratuit</span></li>';
                                                        }
                                                        if (array_key_exists("2", $services)) {
                                                            echo '<li><i class="fas fa-parking"></i><span> Parking gratuit</span></li>';
                                                        }
                                                        if (array_key_exists("3", $services)) {
                                                            echo ' <li><i class="fa-solid fa-dumbbell"></i><span>Centre Fitness</span></li>';
                                                        }
                                                        if (array_key_exists("4", $services)) {
                                                            echo ' <li><i class="fa-solid fa-ban-smoking"></i></i><span>chambres non fumeur</span></li>';
                                                        }
                                                        if (array_key_exists("5", $services)) {
                                                            echo ' <li><i class="fas fa-plane"></i><span>Navette aéroport</span></li>';
                                                        }
                                                        if (array_key_exists("6", $services)) {
                                                            echo '<li><i class="fas fa-snowflake"></i><span> Climatisé</span></li>';
                                                        }

                                                        ?>

                                                    </ul>
                                                    <div class="geodir-category-footer fl-wrap">
                                                        <div class="geodir-category-price">Awg/Night <span>320dt</span></div>
                                                        <div class="geodir-opt-list">
                                                            <a href="#" class="single-map-item" data-newlatitude="40.72956781" data-newlongitude="-73.99726866"><i class="fas fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map</span></a>
                                                            <a href="#" class="geodir-js-favorite"><i class="fas fa-heart"></i><span class="geodir-opt-tooltip">sauvegarder</span></a>
                                                            <a href="#" class="geodir-js-booking"><i class="fas fa-exchange"></i><span class="geodir-opt-tooltip">Trouver un itinéraire</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <!-- listing-item end -->
                                    </div>
                                <?php

                                } ?>
                            <?php

                            } ?>
                        </div>
                        <!--listing-carousel end-->
                        <div class="swiper-button-prev sw-btn"><i class="fas fa-long-arrow-left"></i></div>
                        <div class="swiper-button-next sw-btn"><i class="fas fa-long-arrow-right"></i></div>
                    </div>
                    <!--  carousel end-->
                </section>
                <!-- section end -->
                <!--section -->
                <section class="parallax-section" data-scrollax-parent="true">
                    <div class="bg" data-bg="images/bg/2.jpg" data-scrollax="properties: { translateY: '100px' }"></div>
                    <div class="overlay op7"></div>
                    <!--container-->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="colomn-text fl-wrap pad-top-column-text_small">
                                    <div class="colomn-text-title">
                                        <h3>Hôtels les plus populaires</h3>
                                        <a href="listing.php" class="btn  color2-bg float-btn">Voir tous les hôtels<i class="fas fa-caret-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <!--light-carousel-wrap-->
                                <div class="light-carousel-wrap fl-wrap">
                                    <!--light-carousel-->
                                    <div class="light-carousel">
                                        <!--slick-slide-item-->
                                        <div class="slick-slide-item">
                                            <div class="hotel-card fl-wrap title-sin_item">
                                                <div class="geodir-category-img card-post">
                                                    <a href="listing-single.php"><img src="images/gal/8.jpg" alt=""></a>
                                                    <div class="listing-counter">Awg/Night <strong>$85</strong></div>
                                                    <div class="sale-window">Sale 20%</div>
                                                    <div class="geodir-category-opt">
                                                        <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                        <h4 class="title-sin_map"><a href="listing-single.php">Moonlight Hotel</a></h4>
                                                        <div class="geodir-category-location"><a href="#" class="single-map-item" data-newlatitude="40.90261483" data-newlongitude="-74.15737152"><i class="fas fa-map-marker-alt"></i> 75 Prince St, NY, USA</a></div>
                                                        <div class="rate-class-name">
                                                            <div class="score"><strong> Good</strong>8 Reviews </div>
                                                            <span>4.8</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--slick-slide-item end-->
                                        <!--slick-slide-item-->
                                        <div class="slick-slide-item">
                                            <div class="hotel-card fl-wrap title-sin_item">
                                                <div class="geodir-category-img">
                                                    <a href="listing-single.php"><img src="images/gal/7.jpg" alt=""></a>
                                                    <div class="listing-counter">Awg/Night <strong>$80</strong></div>
                                                    <div class="sale-window big-sale">Sale 50%</div>
                                                    <div class="geodir-category-opt">
                                                        <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                        <h4 class="title-sin_map"><a href="listing-single.php">Holiday Home</a></h4>
                                                        <div class="geodir-category-location"><a href="#" class="single-map-item" data-newlatitude="40.72228267" data-newlongitude="-73.99246214"><i class="fas fa-map-marker-alt"></i> 34-42 Montgomery St , NY, USA</a></div>
                                                        <div class="rate-class-name">
                                                            <div class="score"><strong> Good</strong>2 Reviews </div>
                                                            <span>4.7</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--slick-slide-item end-->
                                        <!--slick-slide-item-->
                                        <div class="slick-slide-item">
                                            <div class="hotel-card fl-wrap title-sin_item">
                                                <div class="geodir-category-img">
                                                    <a href="listing-single.php"><img src="images/gal/9.jpg" alt=""></a>
                                                    <div class="listing-counter">Awg/Night <strong>$120</strong></div>
                                                    <div class="sale-window">Sale 10%</div>
                                                    <div class="geodir-category-opt">
                                                        <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                        <h4 class="title-sin_map"><a href="listing-single.php">Grand Hero Palace</a></h4>
                                                        <div class="geodir-category-location"><a href="#" class="single-map-item" data-newlatitude="40.76221766" data-newlongitude="-73.96511769"><i class="fas fa-map-marker-alt"></i> 70 Bright St New York, USA</a></div>
                                                        <div class="rate-class-name">
                                                            <div class="score"><strong> Good</strong>31 Reviews </div>
                                                            <span>4.9</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--slick-slide-item end-->
                                    </div>
                                    <!--light-carousel end-->
                                    <div class="fc-cont  lc-prev"><i class="fas fa-angle-left"></i></div>
                                    <div class="fc-cont  lc-next"><i class="fas fa-angle-right"></i></div>
                                </div>
                                <!--light-carousel-wrap end-->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- section end -->
                <!--section -->
                <section>
                    <div class="container">
                        <div class="section-title">
                            <div class="section-title-separator"><span></span></div>
                            <h2>Why Choose Us</h2>
                            <span class="section-separator"></span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.</p>
                        </div>
                        <!-- -->
                        <div class="row">
                            <div class="col-md-4">
                                <!-- process-item-->
                                <div class="process-item big-pad-pr-item">
                                    <span class="process-count"> </span>
                                    <div class="time-line-icon"><i class="fas fa-headset"></i></div>
                                    <h4><a href="#"> Meilleure garantie de service</a></h4>
                                    <p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
                                </div>
                                <!-- process-item end -->
                            </div>
                            <div class="col-md-4">
                                <!-- process-item-->
                                <div class="process-item big-pad-pr-item">
                                    <span class="process-count"> </span>
                                    <div class="time-line-icon"><i class="fas fa-gift"></i></div>
                                    <h4> <a href="#">Cadeaux exclusifs</a></h4>
                                    <p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
                                </div>
                                <!-- process-item end -->
                            </div>
                            <div class="col-md-4">
                                <!-- process-item-->
                                <div class="process-item big-pad-pr-item nodecpre">
                                    <span class="process-count"> </span>
                                    <div class="time-line-icon"><i class="fas fa-credit-card"></i></div>
                                    <h4><a href="#"> Obtenez plus de votre carte</a></h4>
                                    <p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
                                </div>
                                <!-- process-item end -->
                            </div>
                        </div>
                        <!--process-wrap   end-->
                        <div class=" single-facts fl-wrap mar-top">
                            <!-- inline-facts -->
                            <div class="inline-facts-wrap">
                                <div class="inline-facts">
                                    <i class="fas fa-users"></i>
                                    <div class="milestone-counter">
                                        <div class="stats animaper">
                                            <div class="num" data-content="0" data-num="254">154</div>
                                        </div>
                                    </div>
                                    <h6>De nouveaux visiteurs chaque semaine</h6>
                                </div>
                            </div>
                            <!-- inline-facts end -->
                            <!-- inline-facts  -->
                            <div class="inline-facts-wrap">
                                <div class="inline-facts">
                                    <i class="fas fa-thumbs-up"></i>
                                    <div class="milestone-counter">
                                        <div class="stats animaper">
                                            <div class="num" data-content="0" data-num="12168">12168</div>
                                        </div>
                                    </div>
                                    <h6>Des clients satisfaits chaque année</h6>
                                </div>
                            </div>
                            <!-- inline-facts end -->
                            <!-- inline-facts  -->
                            <div class="inline-facts-wrap">
                                <div class="inline-facts">
                                    <i class="fas fa-award"></i>
                                    <div class="milestone-counter">
                                        <div class="stats animaper">
                                            <div class="num" data-content="0" data-num="172">172</div>
                                        </div>
                                    </div>
                                    <h6>Récompenses remportées</h6>
                                </div>
                            </div>
                            <!-- inline-facts end -->
                            <!-- inline-facts  -->
                            <div class="inline-facts-wrap">
                                <div class="inline-facts">
                                    <i class="fas fa-hotel"></i>
                                    <div class="milestone-counter">
                                        <div class="stats animaper">
                                            <div class="num" data-content="0" data-num="732">732</div>
                                        </div>
                                    </div>
                                    <h6>Nouvelle annonce chaque semaine</h6>
                                </div>
                            </div>
                            <!-- inline-facts end -->
                        </div>
                    </div>
                </section>
                <!-- section end -->
                <!--section -->
                <section class=" middle-padding">
                    <div class="container">
                        <div class="section-decor"></div>
                </section>
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
                    <div class="map-modal fl-wrap">
                        <div id="singleMap" data-latitude="40.7" data-longitude="-73.1"></div>
                    </div>
                    <h3><i class="fas fa-location-arrow"></i><a href="#">Titre de l'hôtel</a></h3>
                    <input id="pac-input" class="controls fl-wrap controls-mapwn" type="text" placeholder="What Nearby ?   Bar , Gym , Restaurant ">
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
    <script type="text/javascript" src="js/jquerytest.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbVEb8GFpi-a1cw4KqU-eJ3Kg3cTMqJPM"></script>
    <script type="text/javascript" src="js/map-single.js"></script>
    <script>
        function TestForm() {
            var destination = $('.chosen-select').val();
            if (destination == "Toutes les villes") {
                $('.error-destination').html('Destination is required');
            } else {
                $('.error-destination').html('');

                $('#myform').trigger('click');
            }
        }
    </script>
</body>

</html>