<?php
require_once 'connection.php';
$username1 = $_SESSION['username'];
$sql2 = "SELECT * FROM users WHERE Username = '$username1'";
$result2 = $conn->query($sql2);
$data2 = $result2->fetch_assoc();
$image = "./admin/uploads/" . $data2['Image'];
print_r($image);
?>
<header class="main-header">
    <!-- header-top-->
    <div class="header-top fl-wrap">
        <div class="container">
            <div class="logo-holder">
                <a href="index.php"><img src="images/logo.png" alt=""></a>
            </div>
            <?php if (isset($_SESSION['Status']) && $_SESSION['Status'] == "Connected") {
                echo '<form method="POST">'
                    . '<div class="show-reg-form" id="logout"><button type="submit" name="logout"><span>Se déconnecter</span></button></div>'
                    . '</form>';
            } else {
                echo '<div class="show-reg-form modal-open" id="login"><i class="fas fa-sign-in"></i>Sidentifier</div>';
            }
            ?>
            <div class="lang-wrap">
                <div class="show-lang"><img src="images/lan/2.png" alt=""> <span>Fr</span></div>

            </div>
            <div class="currency-wrap">
                <div class="show-currency-tooltip">TND</div>
            </div>
        </div>
    </div>
    <!-- header-top end-->
    <!-- header-inner-->
    <div class="header-inner fl-wrap">
        <div class="container">
            <?php if (isset($_SESSION['Status']) && $_SESSION['Status'] == "Connected") {
                echo '<div class="header-user-menu">'
                    . '<div class="header-user-name">'
                    . ' <span><img src="'. $image .'" alt=""></span>' . $_SESSION['username']
                    . '</div>'
                    . '<ul>'
                    . '<li><a href="dashboard-myprofile.php"> Editer le profil</a></li>'
                    . '<li><a href="dashboard-add-listing.php">Ajouter une annonce</a></li>'
                    . '<li><a href="dashboard-bookings.php"> Réservations </a></li>'
                    . '</ul>'
                    . '</div>';
            } ?>
            <div class="home-btn"><a href="index.php"><i class="fas fa-home"></i></a></div>
            <!-- nav-button-wrap-->
            <div class="nav-button-wrap color-bg">
                <div class="nav-button">
                    <span></span><span></span><span></span>
                </div>
            </div>
            <!-- nav-button-wrap end-->
            <!--  navigation -->
            <div class="nav-holder main-menu">
                <nav>
                    <ul>
                        <li>
                            <a href="index.php" class="act-link">Hotel Tunisie</a>

                        </li>
                        <li>
                            <a href="voyages-organisés.html">Voyages Organisés</a>

                        </li>
                        <li>
                            <a href="vol.html">Vol</a>

                        </li>





                    </ul>
                </nav>
            </div>
            <!-- navigation  end -->
            <!-- wishlist-wrap-->
            <div class="wishlist-wrap scrollbar-inner novis_wishlist">
                <div class="box-widget-content">
                    <div class="widget-posts fl-wrap">
                        <ul>
                            <li class="clearfix">
                                <a href="#" class="widget-posts-img"><img src="images/gal/7.jpg" class="respimg" alt=""></a>
                                <div class="widget-posts-descr">
                                    <a href="#" title="">Park Central</a>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                    <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> 40 JOURNAL SQUARE PLAZA, NJ, US</a></div>
                                    <span class="rooms-price">$80 <strong> / Awg</strong></span>
                                </div>
                            </li>
                            <li class="clearfix">
                                <a href="#" class="widget-posts-img"><img src="images/gal/8.jpg" class="respimg" alt=""></a>
                                <div class="widget-posts-descr">
                                    <a href="#" title="">Holiday Home</a>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="3"></div>
                                    <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> 75 PRINCE ST, NY, USA</a></div>
                                    <span class="rooms-price">$50 <strong> / Awg</strong></span>
                                </div>
                            </li>
                            <li class="clearfix">
                                <a href="#" class="widget-posts-img"><img src="images/gal/9.jpg" class="respimg" alt=""></a>
                                <div class="widget-posts-descr">
                                    <a href="#" title="">Moonlight Hotel</a>
                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>
                                    <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> 70 BRIGHT ST NEW YORK, USA</a></div>
                                    <span class="rooms-price">$105 <strong> / Awg</strong></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- wishlist-wrap end-->
        </div>
    </div>
    <!-- header-inner end-->
    <!-- header-search -->
    <div class="header-search vis-search">
        <div class="container">
            <div class="row">
                <!-- header-search-input-item -->
                <div class="col-sm-4">
                    <div class="header-search-input-item fl-wrap location autocomplete-container">
                        <label>Nom de la destination ou de l'hôtel</label>
                        <span class="header-search-input-item-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <input type="text" placeholder="Location" class="autocomplete-input" id="autocompleteid" value="" />
                        <a href="#"><i class="fas fa-dot-circle"></i></a>
                    </div>
                </div>
                <!-- header-search-input-item end -->
                <!-- header-search-input-item -->
                <div class="col-sm-3">
                    <div class="header-search-input-item fl-wrap date-parent">
                        <label>Date d'entrée-sortie</label>
                        <span class="header-search-input-item-icon"><i class="fas fa-calendar-check"></i></span>
                        <input type="text" placeholder="When" name="header-search" value="" />
                    </div>
                </div>
                <!-- header-search-input-item end -->
                <!-- header-search-input-item -->
                <div class="col-sm-3">
                    <div class="header-search-input-item fl-wrap">
                        <div class="quantity-item">
                            <label>Pièces</label>
                            <div class="quantity">
                                <input type="number" min="1" max="3" step="1" value="1">
                            </div>
                        </div>
                        <div class="quantity-item">
                            <label>Adultes</label>
                            <div class="quantity">
                                <input type="number" min="1" max="3" step="1" value="1">
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
                <!-- header-search-input-item end -->
                <!-- header-search-input-item -->
                <div class="col-sm-2">
                    <div class="header-search-input-item fl-wrap">
                        <button class="header-search-button" onclick="window.location.href='listing.php'">Rechercher <i class="fas fa-search"></i></button>
                    </div>
                </div>
                <!-- header-search-input-item end -->
            </div>
        </div>
        <div class="close-header-search"><i class="fas fa-angle-double-up"></i></div>
    </div>
    <!-- header-search  end -->
</header>